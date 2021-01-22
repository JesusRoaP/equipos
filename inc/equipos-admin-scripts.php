<?php
/* Enqueues admin scripts. */
function add_admin_equipos_style() {

  /* Gets the post type. */
  global $post_type;

  if( 'equipos' == $post_type ) {

    /* CSS for metaboxes. */
    wp_enqueue_style( 'equipos_dmb_styles', plugins_url('dmb/dmb.min.css', __FILE__));
    /* CSS for preview.s */
    wp_enqueue_style( 'equipos_styles', plugins_url('css/equipos_style.min.css', __FILE__));
    /* Others. */
    wp_enqueue_style( 'wp-color-picker' );

    /* JS for metaboxes. */
    wp_enqueue_script( 'equipos', plugins_url('dmb/dmb.js', __FILE__), array( 'jquery', 'thickbox', 'wp-color-picker' ));

    /* Localizes string for JS file. */
    wp_localize_script( 'equipos', 'objectL10n', array(
      'untitled' => __( 'Sin título', EQ_NAME ),
      'noMemberNotice' => __( 'Agregue al menos <strong>1</strong> miembro para obtener una vista previa del equipo.', EQ_NAME ),
      'previewAccuracy' => __( 'Esta es solo una vista previa, los códigos cortos utilizados en los campos no se mostrarán y los resultados pueden variar según el ancho de su contenedor.', EQ_NAME )
    ));
    wp_enqueue_style( 'thickbox' );

    /* Carrusel */
    wp_enqueue_style( 'style-carrusel', plugins_url('css/style.css', __FILE__));
    wp_enqueue_script( 'script-carrusel', plugins_url('js/script.js', __FILE__));
    wp_enqueue_script('velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.1.0/velocity.min.js');
    
  }
}
add_action( 'admin_enqueue_scripts', 'add_admin_equipos_style' );
?>