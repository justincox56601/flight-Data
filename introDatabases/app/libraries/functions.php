<?php
/**
 * non class helper functions that can be used from anywhere
 */

function get_header(String $addon=null){
$header = ($addon === NULL)? 'header' : 'header-' . $addon;
include_once(APP_ROOT . '/template-parts/' . $header . '.php');
}

function get_footer(String $addon=NULL){
	$footer = ($addon === NULL)? 'footer' : 'footer-' . $addon;
	include_once(APP_ROOT . '/template-parts/' . $footer . '.php');
}