<?php 
/* Hooks the metabox. */
function dmb_equipos_add_help() {
	add_meta_box( 
		'equipos_help', 
		'Shortcode', 
		'dmb_equipos_help_display', // Below
		'equipos', 
		'side', 
		'high'
	);
}
add_action('admin_init', 'dmb_equipos_add_help', 1);

/* Displays the metabox. */
function dmb_equipos_help_display() { ?>

	<div class="dmb_side_block">
		<p>
			<?php 
				global $post;
				$slug = '';
				$slug = $post->post_name;
				$shortcode = '<span style="display:inline-block;border:solid 2px #999999; background:white; padding:0 8px 2px; font-size:14px; line-height:25px; vertical-align:middle;">[equipos name="'.$slug.'"]</span>';
				$shortcode_unpublished = "<span style='display:inline-block;color:#e17055'>" . /* translators: Leave HTML tags */ __("<strong>Publica</strong> tu equipo para que puedas ver tu shortcode aquí.", EQ_NAME ) . "</span>";
				echo ($slug != '') ? $shortcode : $shortcode_unpublished;
			?>
		</p>
		<p>
			<?php /* translators: Leave HTML tags */ _e('Para mostrar este equipo en tu sitio web, copie y pegue el <strong>[Shortcode]</strong> de arriba en una entrada o página.', EQ_NAME ) ?>
		</p>	
	</div>

<?php } ?>