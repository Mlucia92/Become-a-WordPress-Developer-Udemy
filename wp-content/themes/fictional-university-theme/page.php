<!-- Acá se mostrarán todas las páginas creadas desde el administrador. -->

<?php

  get_header();

  while(have_posts()) {
    the_post(); ?>
    
    
    <div class="page-banner">
        <!-- Función nativa: echo get_theme_file_uri() imprime una imagen de la carpeta. -->
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
      <div class="page-banner__content container container--narrow">
        <!-- Función nativa: the_title() imprime el título de la página. -->
        <h1 class="page-banner__title"><?php the_title()?></h1>
        <div class="page-banner__intro">
          <p>Don't forget to replace me later</p>
        </div>
      </div>
    </div>

    <!-- Solo queremos que este parte se vea cuando es una child-page y se oculte cuando sea una parent-page. 
    Por lo tanto, se trabaja con el número de ID, si el número es 0 es parent y si el número es 1 o mayor, es child.  -->

    <div class="container container--narrow page-section">
        
        <?php 
        $theParent = wp_get_post_parent_id(get_the_ID());
        if ($theParent) { ?> 
                <div class="metabox metabox--position-up metabox--with-home-link">
                    <p>
                    <!-- Con la función: get_the_title() se puede poner parámetros en donde se especifique la ID.  -->
                    <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent) ?></a> <span class="metabox__main"><?php the_title() ?></span>
                    </p>
                </div>
        <?php
        } ?>

    <?php
    // Con este if se evalúa si la página tiene children. Si no tiene no aparecerán los links. 

    $testArray = get_pages(array(
        'child_of' => get_the_ID()
    ));
    
    if ($theParent or $testArray) { ?>

        <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent) ?>"><?php echo get_the_title($theParent) ?></a></h2>
            <ul class="min-list">
            <?php 
                //Función nativa: wp_list_pages(); te crea links a todas las páginas del sitio web. Va a necesitar una array asociativa (se le asocia un valor 
                // a cada elemento. 
                if ($theParent ) {
                    $findChildrenOf = $theParent;
                } else {
                    $findChildrenOf = get_the_ID();
                }
                wp_list_pages(array(
                    'title_li' => NULL,
                    'child_of' => $findChildrenOf,
                    'sort_column' => 'menu_order'
                ));
            ?>
            </ul>
        </div>
    <?php  } ?>

      <div class="generic-content">
          <!-- Función nativa: the_content() imprime el título de la página. -->
          <p><?php the_content()?></p>
      </div>
    </div>
    
  <?php }

  get_footer();

?>