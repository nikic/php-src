#!/bin/bash
set -e

# Start MySQL
mysql.server start

# Use bison installed by homebrew
export YACC=/usr/local/opt/bison/bin/bison
