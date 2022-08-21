<?php

// Aquí son registrados los post types. El primer parámetro en el add action es init y en el segundo es el nombre que vayamos a ponerle a la función. 
// Se puede elegir. Se ubican en la carpeta mu-plugins porque en functions.php no es el mejor lugar para tenerlos. Porque de la otra manera la 
// accesibilidad dependerá de que el tema esté activo. 

function university_post_types() {
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
}

add_action('init', 'university_post_types');