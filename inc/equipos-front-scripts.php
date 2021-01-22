<?php
/* Enqueues front scripts. */
function add_equipos_scripts() {

  /* Front end CSS. */
  wp_enqueue_style( 'equipos', plugins_url('css/equipos_style.css', __FILE__));
  wp_enqueue_style( 'style-carrusel', plugins_url('css/style.css', __FILE__));
  wp_enqueue_script( 'script-carrusel', plugins_url('js/script.js', __FILE__));
  wp_enqueue_script('velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.1.0/velocity.min.js');
  
}
add_action( 'wp_enqueue_scripts', 'add_equipos_scripts', 99 );
?>