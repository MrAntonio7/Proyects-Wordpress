<?php
/*
Plugin Name: My First Plugin - Link Admin panel
Description: This is my first plugin! It makes a new admin menu link!
Author: Antonio Jesús Álvarez Malagón
*/

add_action('admin_menu', 'plugin_admin_add_page');

function plugin_admin_add_page() {

  $page_title = 'WordPress Extra Post Info';
  $menu_title = 'My plugin';
  $capability = 'manage_options';
  $menu_slug  = 'extra-post-info';
  $function   = 'plugin_options_page';
  $icon_url   = 'dashicons-carrot';
  $position   = 4;


// Add link to panel admin
  add_menu_page( $page_title,
                 $menu_title, 
                 $capability, 
                 $menu_slug, 
                 $function, 
                 $icon_url, 
                 $position );

 // Add link to menu Settings in Admin Panel
  add_options_page('Custom Plugin Page', 'Custom Plugin Options Page', 'manage_options', 'page_slug', 'plugin_options_page');

}


function plugin_options_page() {
    //Content to plugins
    echo "<h2>Hello World</h2>";
}

?>
