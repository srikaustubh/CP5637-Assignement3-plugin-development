<?php

/* 
 * @package sriplugin 
 */
/*
 Plugin Name: Srikaustubh
 Plugin URI: http://127.0.0.1/wordpress
 Description: This is my custome plugin will allow you to create books just like posts and also addd all google fonts to our website so that the user can use them in his style sheets.
 Version: 1.0.0
 Author: Srikaustubh Mandaleeka
 Author URI: http://127.0.0.1/wordpress
 License: GPLv2 or Later
 Text Domain: Sri-plugin
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

// three different ways to provide security

/*if(!defined('ABSPATH')){
    die;
}*/

defined('ABSPATH') or die('you Cannot access this file dummy');

/*if(!function_exists('addd_action')){
    echo 'you Cannot access this file dummy';
    exit;
}*/

class SriPlugin
{
    public function __construct() {
        add_action('init',array($this,'custom_post_type'));
    }
    
    function register(){
        add_action('admin_enqueue_scripts', array($this,'enqueue'));
    }
    
    function activate(){
        // generated a CPT
        $this->custom_post_type();
        //flush rewrite rules
        flush_rewrite_rules();
    }
    
    function deactivate(){
        //flush rewrite rules
        
    }
    
    function custom_post_type(){
        register_post_type( 'book', array( 'public' => true, 'label' => 'Books' ) );
    }
    
    function enqueue(){
        wp_enqueue_style('style', plugins_url('assets/style.css',__FILE__));
        wp_register_style('googleFonts', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAIk5O7Se2L8A6C5Ne815vVob5ey46tRZ8');
        wp_enqueue_style('googleFonts');
        wp_enqueue_script('script', plugins_url('assets/script'));
    }
}

if(class_exists('SriPlugin')){
    $sriPlugin = new SriPlugin();
    $sriPlugin->register();
}

//activation hook
register_activation_hook(__FILE__, array($sriPlugin,'activate'));

//deactivation hook
register_activation_hook(__FILE__, array($sriPlugin,'deactivate'));
