<?php 
/* Handles shortcode column display. */
function equipos_custom_columns( $column, $post_id ) {
  switch ( $column ) {
    case 'dk_shortcode' :
      global $post;
      $slug = '' ;
      $slug = $post->post_name;
      $shortcode = '<span style="display:inline-block;border:solid 2px lightgray; background:white; padding:0 8px; font-size:13px; line-height:25px; vertical-align:middle;">[equipos name="'.$slug.'"]</span>';
      echo $shortcode;
      break;
  }
}
add_action( 'manage_equipos_posts_custom_column' , 'equipos_custom_columns', 10, 2 );

/* Adds the shortcode column in admin. */
function add_equipos_columns( $columns ) {
  return array_merge( $columns, array('dk_shortcode' => 'Shortcode') );
}
add_filter( 'manage_equipos_posts_columns' , 'add_equipos_columns' );
?>