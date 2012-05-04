<?php
/*
Plugin Name: CSS Columns
Plugin URI: https://github.com/redwerks/css-columns
Description: Provides a [columns] shortcode that gives a secion of post content multiple columns using css3's column properties.
Author: Redwerks
Author URI: http://redwerks.org/
Version: 0.9.0
License: GPL2+

Copyright © 2012 — Redwerks Systems Inc. (http://redwerks.org/)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_shortcode( 'columns', 'css_columns_shortcode' );
function css_columns_shortcode( $params, $content = null ) {
	if ( is_null( $content ) ) {
		return __( '<p class="error">[columns] shortcode requires a closing [/columns] tag.</p>', 'css-columns' );
	}
	extract( shortcode_atts( array(
		'count' => '1',
		'gap' => '1em',
	), $params ) );
	$count = (int)$count;

	// Trim out any whitespace or breaks appearing in between the column tags and the content
	// to avoid any unwanted extra spacing caused by the simple presence of the tags
	$content = preg_replace( '!^\s*<br\s*/?>|<br\s*/?>\s*$!', '', $content );
	$content = preg_replace( '!^\s*</p\s*>|<p[^>]*>\s*$!', '', $content );
	$content = trim( $content );

	// Don't bother with the div when asked for a single column that won't actually do anything
	if ( $count < 2 ) {
		return $content;
	}

	$style = '';
	$style .= "-moz-column-count: $count; -webkit-column-count: $count; column-count: $count; ";
	$style .= "-moz-column-gap: $gap; -webkit-column-gap: $gap; column-gap: $gap; ";
	return '<div style="' . esc_attr( trim( $style ) ) . '">' . $content . '</div>';
}
