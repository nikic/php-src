/*
 * "streamable kanji code filter and converter"
 * Copyright (c) 1998-2002 HappySize, Inc. All rights reserved.
 *
 * LICENSE NOTICES
 *
 * This file is part of "streamable kanji code filter and converter",
 * which is distributed under the terms of GNU Lesser General Public
 * License (version 2) as published by the Free Software Foundation.
 *
 * This software is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with "streamable kanji code filter and converter";
 * if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA  02111-1307  USA
 *
 * The author of this file:
 *
 */
/*
 * The source code included in this files was separated from mbfilter.c
 * by moriyoshi koizumi <moriyoshi@php.net> on 20 dec 2002.
 *
 */

#ifndef MBFL_MBFILTER_UTF32_H
#define MBFL_MBFILTER_UTF32_H

extern const mbfl_encoding mbfl_encoding_utf32;
extern const mbfl_encoding mbfl_encoding_utf32be;
extern const mbfl_encoding mbfl_encoding_utf32le;
extern const struct mbfl_convert_vtbl vtbl_utf32_wchar;
extern const struct mbfl_convert_vtbl vtbl_wchar_utf32;
extern const struct mbfl_convert_vtbl vtbl_utf32be_wchar;
extern const struct mbfl_convert_vtbl vtbl_wchar_utf32be;
extern const struct mbfl_convert_vtbl vtbl_utf32le_wchar;
extern const struct mbfl_convert_vtbl vtbl_wchar_utf32le;

int mbfl_filt_conv_utf32_wchar(int c, mbfl_convert_filter *filter);
int mbfl_filt_conv_utf32be_wchar(int c, mbfl_convert_filter *filter);
int mbfl_filt_conv_wchar_utf32be(int c, mbfl_convert_filter *filter);
int mbfl_filt_conv_utf32le_wchar(int c, mbfl_convert_filter *filter);
int mbfl_filt_conv_wchar_utf32le(int c, mbfl_convert_filter *filter);
int mbfl_filt_conv_utf32_flush(mbfl_convert_filter *filter);

#endif /* MBFL_MBFILTER_UTF32_H */
