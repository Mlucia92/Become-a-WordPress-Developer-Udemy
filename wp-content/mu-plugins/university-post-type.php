<?php

// Aquí son registrados los post types. El primer parámetro en el add action es init y en el segundo es el nombre que vayamos a ponerle a la función. 
// Se puede elegir. Se ubican en la carpeta mu-plugins porque en functions.php no es el mejor lugar para tenerlos. Porque de la otra manera la 
// accesibilidad dependerá de que el tema esté activo. 

function university_post_types() {

    // Campus Post Type
  register_post_type('campus', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'campuses'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Campuses',
      'add_new_item' => 'Add New Campus',
      'edit_item' => 'Edit Campus',
      'all_items' => 'All Campuses',
      'singular_name' => 'Campus'
    ),
    'menu_icon' => 'dashicons-location-alt'
  ));

  // Event post type:

  register_post_type('event', array(
    // Con el show_in_rest se mostrará el modern block editor.
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'excerpt'),
    // Lo que se verá en la URL: 
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true,
    // Será visto por los visitantes de la página. 
    'public' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));

  // Program post type:

  register_post_type('program', array(
    // Con el show_in_rest se mostrará el modern block editor.
    'show_in_rest' => true,
    'supports' => array('title'),
    // Lo que se verá en la URL: 
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    // Será visto por los visitantes de la página. 
    'public' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    ),
    'menu_icon' => 'dashicons-awards'
  ));

  // Professors post type:

  register_post_type('professor', array(
    // Con el show_in_rest se mostrará el modern block editor.
    'show_in_rest' => true,
    'supports' => array('title', 'editor','thumbnail'),
    // Será visto por los visitantes de la página. 
    'public' => true,
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more'
  ));


  // Note Post Type
  register_post_type('note', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Notes',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog'
  ));

  // Lik Post Type
  register_post_type('like', array(
    'supports' => array('title'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'likes',
      'add_new_item' => 'Add New like',
      'edit_item' => 'Edit like',
      'all_items' => 'All likes',
      'singular_name' => 'like'
    ),
    'menu_icon' => 'dashicons-heart'
  ));
}

add_action('init', 'university_post_types');