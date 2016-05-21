#include "ZendAccelerator.h"
#include "Optimizer/zend_optimizer_internal.h"
#include "Optimizer/ssa_pass.h"

/* The ssa_verify_integrity() function ensures that that certain invariants of the SSA form and
 * CFG are upheld and prints messages to stderr if this is not the case. */

static inline zend_bool is_in_use_chain(zend_ssa *ssa, int var, int check) {
	int use;
	FOREACH_USE(&ssa->vars[var], use) {
		if (use == check) {
			return 1;
		}
	} FOREACH_USE_END();
	return 0;
}

static inline zend_bool is_in_phi_use_chain(zend_ssa *ssa, int var, zend_ssa_phi *check) {
	zend_ssa_phi *phi;
	FOREACH_PHI_USE(&ssa->vars[var], phi) {
		if (phi == check) {
			return 1;
		}
	} FOREACH_PHI_USE_END();
	return 0;
}

static inline zend_bool is_used_by_op(zend_ssa *ssa, int op, int check) {
	zend_ssa_op *ssa_op = &ssa->ops[op];
	return (ssa_op->op1_use == check)
		|| (ssa_op->op2_use == check)
		|| (ssa_op->result_use == check);
}

static inline zend_bool is_defined_by_op(zend_ssa *ssa, int op, int check) {
	zend_ssa_op *ssa_op = &ssa->ops[op];
	return (ssa_op->op1_def == check)
		|| (ssa_op->op2_def == check)
		|| (ssa_op->result_def == check);
}

static inline zend_bool is_in_phi_sources(zend_ssa *ssa, zend_ssa_phi *phi, int check) {
	int source;
	FOREACH_PHI_SOURCE(phi, source) {
		if (source == check) {
			return 1;
		}
	} FOREACH_PHI_SOURCE_END();
	return 0;
}

static inline zend_bool is_in_predecessors(zend_cfg *cfg, zend_basic_block *block, int check) {
	int i, *predecessors = &cfg->predecessors[block->predecessor_offset];
	for (i = 0; i < block->predecessors_count; i++) {
		if (predecessors[i] == check) {
			return 1;
		}
	}
	return 0;
}

static inline zend_bool is_var_type(zend_uchar type) {
	return type == IS_CV || type == IS_VAR || type == IS_TMP_VAR;
}

#define FAIL(...) do { \
	if (status == SUCCESS) { \
		fprintf(stderr, "\nIn function %s::%s (%s):\n", \
			op_array->scope ? ZSTR_VAL(op_array->scope->name) : "", \
			op_array->function_name ? ZSTR_VAL(op_array->function_name) : "{main}", extra); \
	} \
	fprintf(stderr, __VA_ARGS__); \
	status = FAILURE; \
} while (0)

#define VARFMT "%d (%s%s)"
#define VAR(i) \
	(i), (ssa->vars[i].var < op_array->last_var ? "CV $" : "TMP"), \
	(ssa->vars[i].var < op_array->last_var ? ZSTR_VAL(op_array->vars[ssa->vars[i].var]) : "")

#define INSTRFMT "%d (%s)"
#define INSTR(i) \
	(i), (zend_get_opcode_name(op_array->opcodes[i].opcode))

int ssa_verify_integrity(zend_ssa *ssa, const char *extra) {
	zend_cfg *cfg = &ssa->cfg;
	zend_op_array *op_array = ssa->op_array;
	zend_ssa_phi *phi;
	int i, status = SUCCESS;

	/* Vars */
	for (i = 0; i < ssa->vars_count; i++) {
		zend_ssa_var *var = &ssa->vars[i];
		int use, c;

		if (var->definition < 0 && !var->definition_phi && i > op_array->last_var) {
			if (var->use_chain >= 0) {
				FAIL("var " VARFMT " without def has op uses\n", VAR(i));
			}
			if (var->phi_use_chain) {
				FAIL("var " VARFMT " without def has phi uses\n", VAR(i));
			}
		}
		if (var->definition >= 0 && var->definition_phi) {
			FAIL("var " VARFMT " has both def and def_phi\n", VAR(i));
		}
		if (var->definition >= 0) {
			if (!is_defined_by_op(ssa, var->definition, i)) {
				FAIL("var " VARFMT " not defined by op " INSTRFMT "\n",
						VAR(i), INSTR(var->definition));
			}
		}
		if (var->definition_phi) {
			if (var->definition_phi->ssa_var != i) {
				FAIL("var " VARFMT " not defined by given phi\n", VAR(i));
			}
		}

		c = 0;
		FOREACH_USE(var, use) {
			if (++c > 10000) {
				FAIL("cycle in uses of " VARFMT "\n", VAR(i));
				return status;
			}
			if (!is_used_by_op(ssa, use, i)) {
				fprintf(stderr, "var " VARFMT " not in uses of op %d\n", VAR(i), use);
			}
		} FOREACH_USE_END();

		c = 0;
		FOREACH_PHI_USE(var, phi) {
			if (++c > 10000) {
				FAIL("cycle in phi uses of " VARFMT "\n", VAR(i));
				return status;
			}
			if (!is_in_phi_sources(ssa, phi, i)) {
				FAIL("var " VARFMT " not in phi sources of %d\n", VAR(i), phi->ssa_var);
			}
		} FOREACH_PHI_USE_END();
	}

	/* Instructions */
	FOREACH_INSTR_NUM(i) {
		zend_ssa_op *ssa_op = &ssa->ops[i];
		zend_op *opline = &op_array->opcodes[i];
		if (is_var_type(opline->op1_type)) {
			if (ssa_op->op1_use < 0 && ssa_op->op1_def < 0) {
				FAIL("var op1 of " INSTRFMT " does not use/def an ssa var\n", INSTR(i));
			}
		} else {
			if (ssa_op->op1_use >= 0 || ssa_op->op1_def >= 0) {
				FAIL("non-var op1 of " INSTRFMT " uses or defs an ssa var\n", INSTR(i));
			}
		}
		if (is_var_type(opline->op2_type)) {
			if (ssa_op->op2_use < 0 && ssa_op->op2_def < 0) {
				FAIL("var op2 of " INSTRFMT " does not use/def an ssa var\n", INSTR(i));
			}
		} else {
			if (ssa_op->op2_use >= 0 || ssa_op->op2_def >= 0) {
				FAIL("non-var op2 of " INSTRFMT " uses or defs an ssa var\n", INSTR(i));
			}
		}
		if (is_var_type(opline->result_type)) {
			if (ssa_op->result_use < 0 && ssa_op->result_def < 0) {
				FAIL("var result of " INSTRFMT " does not use/def an ssa var\n", INSTR(i));
			}
		} else {
			if (ssa_op->result_use >= 0 || ssa_op->result_def >= 0) {
				FAIL("non-var result of " INSTRFMT " uses or defs an ssa var\n", INSTR(i));
			}
		}

		if (ssa_op->op1_use >= 0) {
			if (ssa_op->op1_use >= ssa->vars_count) {
				FAIL("op1 use %d out of range\n", ssa_op->op1_use);
			}
			if (!is_in_use_chain(ssa, ssa_op->op1_use, i)) {
				FAIL("op1 use of " VARFMT " in " INSTRFMT " not in use chain\n",
						VAR(ssa_op->op1_use), INSTR(i));
			}
			if (VAR_NUM(opline->op1.var) != ssa->vars[ssa_op->op1_use].var) {
				FAIL("op1 use of " VARFMT " does not match op %d of " INSTRFMT "\n",
						VAR(ssa_op->op1_use), VAR_NUM(opline->op1.var), INSTR(i));
			}
		}
		if (ssa_op->op2_use >= 0) {
			if (ssa_op->op2_use >= ssa->vars_count) {
				FAIL("op2 use %d out of range\n", ssa_op->op2_use);
			}
			if (!is_in_use_chain(ssa, ssa_op->op2_use, i)) {
				FAIL("op1 use of " VARFMT " in " INSTRFMT " not in use chain\n",
						VAR(ssa_op->op2_use), INSTR(i));
			}
			if (VAR_NUM(opline->op2.var) != ssa->vars[ssa_op->op2_use].var) {
				FAIL("op2 use of " VARFMT " does not match op %d of " INSTRFMT "\n",
						VAR(ssa_op->op2_use), VAR_NUM(opline->op2.var), INSTR(i));
			}
		}
		if (ssa_op->result_use >= 0) {
			if (ssa_op->result_use >= ssa->vars_count) {
				FAIL("result use %d out of range\n", ssa_op->result_use);
			}
			if (!is_in_use_chain(ssa, ssa_op->result_use, i)) {
				FAIL("result use of " VARFMT " in " INSTRFMT " not in use chain\n",
					VAR(ssa_op->result_use), INSTR(i));
			}
			if (VAR_NUM(opline->result.var) != ssa->vars[ssa_op->result_use].var) {
				FAIL("result use of " VARFMT " does not match op %d of " INSTRFMT "\n",
						VAR(ssa_op->result_use), VAR_NUM(opline->result.var), INSTR(i));
			}
		}
		if (ssa_op->op1_def >= 0) {
			if (ssa_op->op1_def >= ssa->vars_count) {
				FAIL("op1 def %d out of range\n", ssa_op->op1_def);
			}
			if (ssa->vars[ssa_op->op1_def].definition != i) {
				FAIL("op1 def of " VARFMT " in " INSTRFMT " invalid\n",
						VAR(ssa_op->op1_def), INSTR(i));
			}
			if (VAR_NUM(opline->op1.var) != ssa->vars[ssa_op->op1_def].var) {
				FAIL("op1 def of " VARFMT " does not match op %d of " INSTRFMT "\n",
						VAR(ssa_op->op1_def), VAR_NUM(opline->op1.var), INSTR(i));
			}
		}
		if (ssa_op->op2_def >= 0) {
			if (ssa_op->op2_def >= ssa->vars_count) {
				FAIL("op2 def %d out of range\n", ssa_op->op2_def);
			}
			if (ssa->vars[ssa_op->op2_def].definition != i) {
				FAIL("op2 def of " VARFMT " in " INSTRFMT " invalid\n",
						VAR(ssa_op->op2_def), INSTR(i));
			}
			if (VAR_NUM(opline->op2.var) != ssa->vars[ssa_op->op2_def].var) {
				FAIL("op2 def of " VARFMT " does not match op %d of " INSTRFMT "\n",
						VAR(ssa_op->op2_def), VAR_NUM(opline->op2.var), INSTR(i));
			}
		}
		if (ssa_op->result_def >= 0) {
			if (ssa_op->result_def >= ssa->vars_count) {
				FAIL("result def %d out of range\n", ssa_op->result_def);
			}
			if (ssa->vars[ssa_op->result_def].definition != i) {
				FAIL("result def of " VARFMT " in " INSTRFMT " invalid\n",
						VAR(ssa_op->result_def), INSTR(i));
			}
			if (VAR_NUM(opline->result.var) != ssa->vars[ssa_op->result_def].var) {
				FAIL("result def of " VARFMT " does not match op %d of " INSTRFMT "\n",
						VAR(ssa_op->result_def), VAR_NUM(opline->result.var), INSTR(i));
			}
		}
	} FOREACH_INSTR_NUM_END();

	/* Phis */
	FOREACH_PHI(phi) {
		int source;
		FOREACH_PHI_SOURCE(phi, source) {
			if (!is_in_phi_use_chain(ssa, source, phi)) {
				FAIL(VARFMT " not in phi use chain of %d\n", VAR(phi->ssa_var), source);
			}
			if (ssa->vars[source].var != ssa->vars[phi->ssa_var].var) {
				FAIL(VARFMT " source of phi for " VARFMT "\n", VAR(source), VAR(phi->ssa_var));
			}
		} FOREACH_PHI_SOURCE_END();
		if (ssa->vars[phi->ssa_var].definition_phi != phi) {
			FAIL(VARFMT " does not define this phi\n", VAR(phi->ssa_var));
		}
	} FOREACH_PHI_END();

	/* Blocks */
	for (i = 0; i < cfg->blocks_count; i++) {
		zend_basic_block *block = &cfg->blocks[i];
		int *predecessors = &cfg->predecessors[block->predecessor_offset];
		int s, j;

		if (i != 0 && block->start != (block-1)->end + 1) {
			FAIL("Block %d start %d not adjacent to %d\n", i, block->start, (block-1)->end);
		}
		if (i != cfg->blocks_count-1 && block->end != (block+1)->start - 1) {
			FAIL("Block %d end %d not adjacent to %d\n", i, block->end, (block+1)->start);
		}

		for (j = block->start; j <= block->end; j++) {
			if (cfg->map[j] != i) {
				FAIL("Instr " INSTRFMT " not associated with block %d\n", INSTR(j), i);
			}
		}

		if (!(block->flags & ZEND_BB_REACHABLE)) {
			if (ssa->blocks[i].phis) {
				FAIL("Unreachable block %d has phis\n", i);
			}
			continue;
		}

		for (s = 0; s < 2; s++) {
			if (block->successors[s] >= 0) {
				zend_basic_block *next_block = &cfg->blocks[block->successors[s]];
				if (!(next_block->flags & ZEND_BB_REACHABLE)) {
					FAIL("Successor %d of %d not reachable\n", block->successors[s], i);
				}
				if (!is_in_predecessors(cfg, next_block, i)) {
					FAIL("Block %d predecessors missing %d\n", block->successors[s], i);
				}
			}
		}

		for (j = 0; j < block->predecessors_count; j++) {
			if (predecessors[j] >= 0) {
				int k;
				zend_basic_block *prev_block = &cfg->blocks[predecessors[j]];
				if (!(prev_block->flags & ZEND_BB_REACHABLE)) {
					FAIL("Predecessor %d of %d not reachable\n", predecessors[j], i);
				}
				if (prev_block->successors[0] != i && prev_block->successors[1] != i) {
					FAIL("Block %d successors missing %d\n", predecessors[j], i);
				}
				for (k = 0; k < block->predecessors_count; k++) {
					if (k != j && predecessors[k] == predecessors[j]) {
						FAIL("Block %d has duplicate predecessor %d\n", i, predecessors[j]);
					}
				}
			}
		}
	}

	return status;
}
