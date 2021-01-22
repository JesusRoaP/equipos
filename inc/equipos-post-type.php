<?php 
/* Registers the teams post type. */
function register_equipos_type() {
	
  /* Defines labels. */
  $labels = array(
		'name'               => __( 'Equipos', EQ_NAME ),
		'singular_name'      => __( 'Equipo', EQ_NAME ),
		'menu_name'          => __( 'Equipos', EQ_NAME ),
		'name_admin_bar'     => __( 'Equipo', EQ_NAME ),
		'add_new'            => __( 'Agregar Nuevo', EQ_NAME ),
		'add_new_item'       => __( 'Agregar Nuevo Equipo', EQ_NAME ),
		'new_item'           => __( 'Nuevo Equipo', EQ_NAME ),
		'edit_item'          => __( 'Editar Equipo', EQ_NAME ),
		'view_item'          => __( 'Ver Equipo', EQ_NAME ),
		'all_items'          => __( 'Todos los Equipos', EQ_NAME ),
		'search_items'       => __( 'Buscar Equipos', EQ_NAME ),
		'not_found'          => __( 'No existen Equipos.', EQ_NAME ),
		'not_found_in_trash' => __( 'No existen equipos en la papelera.', EQ_NAME )
	);

	// Icon
	$icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNC4yLjEsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjUwMHB4IiBoZWlnaHQ9IjUwMHB4IiB2aWV3Qm94PSIwIDAgNTAwIDUwMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTAwIDUwMDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6I0EwQTVBQTt9DQo8L3N0eWxlPg0KPGc+DQoJPGNpcmNsZSBjbGFzcz0ic3QwIiBjeD0iODMuMyIgY3k9IjE5Mi43IiByPSI0MS43Ii8+DQoJPHBhdGggY2xhc3M9InN0MCIgZD0iTTEzOSwyNjMuNWMtMjEsMTUuOC0zNC44LDQxLjMtMzQuOCw2OS44djUuMkgxNS42Yy04LjUsMC0xNS42LTcuMS0xNS42LTE1LjZ2LTEwLjQNCgkJYzAtMzEuNywyNS42LTU3LjMsNTcuMy01Ny4zaDUyLjFDMTIwLjIsMjU1LjIsMTMwLjQsMjU4LjMsMTM5LDI2My41eiIvPg0KCTxjaXJjbGUgY2xhc3M9InN0MCIgY3g9IjQxNi43IiBjeT0iMTkyLjciIHI9IjQxLjciLz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNTAwLDMxMi41djEwLjRjMCw4LjUtNy4xLDE1LjYtMTUuNiwxNS42aC04OC41di01LjJjMC0yOC41LTEzLjgtNTQtMzQuOC02OS44YzguNS01LjIsMTguOC04LjMsMjkuNi04LjMNCgkJaDUyLjFDNDc0LjQsMjU1LjIsNTAwLDI4MC44LDUwMCwzMTIuNXoiLz4NCgk8Y2lyY2xlIGNsYXNzPSJzdDAiIGN4PSIyNTAiIGN5PSIxODIuMyIgcj0iNjIuNSIvPg0KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zMDcuMywyNzZIMTkyLjdjLTMxLjYsMC01Ny4zLDI1LjctNTcuMyw1Ny4zdjMxLjNjMCw4LjYsNywxNS42LDE1LjYsMTUuNkgzNDljOC42LDAsMTUuNi03LDE1LjYtMTUuNnYtMzEuMw0KCQlDMzY0LjYsMzAxLjcsMzM4LjksMjc2LDMwNy4zLDI3NnoiLz4NCjwvZz4NCjwvc3ZnPg0K';

	/* Defines permissions. */
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
    	'show_in_admin_bar'  => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title' ),
    	'menu_icon'          => $icon
	);

  /* Registers post type. */
	register_post_type( 'equipos', $args );  
}
add_action( 'init', 'register_equipos_type' );

/* Customizes teams update messages. */
function equipos_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
  $post_type_object = get_post_type_object( $post_type );
  
  /* Defines update messages. */
	$messages['equipos'] = array(
		1  => __( 'Equipo actualizado.', EQ_NAME ),
		4  => __( 'Equipo actualizado.', EQ_NAME ),
		6  => __( 'Equipo publicado.', EQ_NAME ),
		7  => __( 'Equipo guardado.', EQ_NAME ),
		10 => __( 'Equipo guardado como borrador.', EQ_NAME )
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'equipos_updated_messages' );
?>