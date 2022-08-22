<?php

get_header(); 

get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events.'
));
 ?>

<div class="container container--narrow page-section">
<?php

    $today = date('Ymd');
    $pastEvents = new WP_Query(array(
    // De esta manera cuando haya más de 10 eventos, pagination se activará. 
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
        array(
        'key' => 'event_date',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
        )
    )
    ));

    while($pastEvents->have_posts()) {
        $pastEvents->the_post(); 
        get_template_part('template-parts/content-event');
        
    }
    // Esta función de la paginación únicamente funciona automáticamente para las default queries y no para las custom queries. Por eso hay que brindarle 
    // información sobre nuestra custom query. 
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages,
    ));
?>
</div>

<?php get_footer();

?>