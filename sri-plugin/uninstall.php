<?php

/* 
 * Uninstall File
 * @package sriplugin 
 */

if (!defined('WP_UNINSTALL_PLUGIN')){
    die;
}

// clear database data
$books = get_post( array( 'post_type'=> 'book' , 'numberposts'=>-1 ) );

/*foreach ($books as $book){
    wp_delete_post($book->ID , TRUE);
}*/

global $wpdb;

$wpdb->query("DELETE FROM wp_posts WHERE post_type='book'");
$wpdb->query("DELETE FROM wp_postmeta where post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");