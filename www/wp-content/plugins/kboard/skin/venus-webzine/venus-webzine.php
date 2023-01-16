<?php
/*
Plugin Name: KBoard 비너스 웹진 스킨
Plugin URI: https://www.cosmosfarm.com/wpstore/product/kboard-venus-webzine-skin
Description: KBoard 비너스 웹진 스킨입니다.
Version: 2.3
Author: 코스모스팜 - Cosmosfarm
Author URI: https://www.cosmosfarm.com/
*/

if(!defined('ABSPATH')) exit;

add_filter('kboard_skin_list', 'kboard_skin_list_venus_webzine', 10, 1);
function kboard_skin_list_venus_webzine($list){

	$skin = new stdClass();
	$skin->dir = dirname(__FILE__);
	$skin->url = plugins_url('', __FILE__);
	$skin->name = basename($skin->dir);

	$list[$skin->name] = $skin;

	return $list;
}
?>