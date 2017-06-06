<?php
/*
   Plugin Name: My LearN
   Plugin URI: https://github.com/rohittiwarirvt
   Description: A plugin which will help me learning the plugin development in wordpress
   Version: 1.0
   Author: Mr. Rohit Tiwari
   Author URI: http://github.com/rohittiwarirvt
   License: GPL2
   */


add_action('init', 'create_post_type');


function create_post_type() {
  register_post_type(
   'mylearn_service' ,array(
      'labels' => array(
          'name' => __('Services'),
          'singular_name' => __('Service')
        ),
      'public' => true,
      'has archived' => true,
      'rewrite' => array('slug' => 'services'),
    )
  );
}
