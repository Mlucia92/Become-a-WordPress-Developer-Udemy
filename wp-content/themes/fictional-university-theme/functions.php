<?php 

// En este archivo se colocan todas las funciones que se utilizarán para customizar la página. 

// Para que no se duplique el código del banner y poder customizar el banner:

function pageBanner($args = NULL) {
  
    if (!$args['title']) {
      $args['title'] = get_the_title();
    }
  
    if (!$args['subtitle']) {
      $args['subtitle'] = get_field('page_banner_subtitle');
    }
  
    if (!$args['photo']) {
      if (get_field('page_banner_background_image')AND !is_archive() AND !is_home()) {
        $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
      } else {
        $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
      }
    }
  
    ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
        </div>
      </div>  
    </div>
  <?php }

// Con esta función se logra que los estilos y scripts tomen lugar en la página. 

function university_files() {
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'university_files');

// Con esta función se logra que en las tag del navegador figure el título de la página.

function university_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    // Para setear las imágenes: (nickname, width, height, si queŕes que la imagen se corte para encajar) También hay un pluging para cortar la imagen
    // manualmente para que quede con es aspecto que querramos. 
    add_image_size('professorLandScape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}
  
add_action('after_setup_theme', 'university_features');

// Esta función permite manipular las queries default de WordPress. Con esta función se logra que no se publiquen los eventos de pasado y que se 
//ordenen de manera ascendente. 

function university_adjust_queries($query) {
    if (!is_admin() AND is_post_type_archive('program') AND $query -> is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('post_per_page', -1);
    }

    if (!is_admin() AND is_post_type_archive('event') AND $query -> is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )));
    }
   
}

add_action('pre_get_posts', 'university_adjust_queries');

?>