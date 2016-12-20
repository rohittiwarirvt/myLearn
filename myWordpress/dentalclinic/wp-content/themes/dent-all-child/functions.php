<?php

  add_action( 'wp_enqueue_scripts', 'stm_enqueue_parent_and_child_styles' );
  add_action( 'wp_enqueue_scripts', 'stm_dequeue_stylsheets', 99);

  function stm_enqueue_parent_and_child_styles() {
    print_r(get_template_directory_uri());
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/stylesheets/style.css');
  }

  function stm_dequeue_stylsheets() {
    wp_dequeue_style('stm_theme-style');
  }



