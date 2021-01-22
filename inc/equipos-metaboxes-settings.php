<?php 
/* Defines force font select options. */
function dmb_equipos_force_fonts_options() {
	$options = array ( 
		__('Use plugin defaults', EQ_NAME ) => 'yes',
		__('Use fonts from my theme', EQ_NAME ) => 'no'
	);
	return $options;
}


/* Defines picture link behavior options. */
function dmb_equipos_piclink_beh_options(){
	$options = array ( 
		__('Nueva ventana', EQ_NAME ) => 'new', 
		__('Misma ventana', EQ_NAME ) => 'same' 
	);
	return $options;
}


/* Defines bio alignment options. */
function dmb_equipos_bio_align_options() {
	$options = array ( 
		__('Center', EQ_NAME) => 'center',
		__('Left', EQ_NAME) => 'left',
		__('Right', EQ_NAME) => 'right',
		__('Justify', EQ_NAME) => 'justify'    
	);
	return $options;
}


/* Defines team columns options. */
function dmb_equipos_columns_options() {
	$options = array ( 
		__('1 por linea', EQ_NAME) => '1',
		__('2 por linea', EQ_NAME) => '2',
		__('3 por linea', EQ_NAME) => '3',
		__('4 por linea', EQ_NAME) => '4',
		__('5 por linea', EQ_NAME) => '5'    
	);
	return $options;
}


/* Hooks the metabox. */
add_action('admin_init', 'dmb_equipos_add_settings', 1);
function dmb_equipos_add_settings() {
	add_meta_box( 
		'equipos_settings', 
		'Configuraciones', 
		'dmb_equipos_settings_display', 
		'equipos', 
		'side', 
		'high'
	);
}


/* Displays the metabox. */
function dmb_equipos_settings_display() { 
	
	global $post;

	/* Retrieves select options. */
	$team_columns = dmb_equipos_columns_options();
	$team_bio_align = dmb_equipos_bio_align_options();
	$team_piclink_beh = dmb_equipos_piclink_beh_options();
	$team_force_font = dmb_equipos_force_fonts_options();

	/* Processes retrieved fields. */
	$settings = array();

	$settings['_equipos_columns'] = get_post_meta( $post->ID, '_equipos_columns', true );
	if (!$settings['_equipos_columns']) { $settings['_equipos_columns'] = '3'; }

	$settings['_equipos_color'] = get_post_meta( $post->ID, '_equipos_color', true );
	if (!$settings['_equipos_color']) { $settings['_equipos_color'] = '#333333'; }

	$settings['_equipos_bio_alignment'] = get_post_meta( $post->ID, '_equipos_bio_alignment', true );

	/* Checks if member links open in new window. */
	$settings['_equipos_piclink_beh'] = get_post_meta( $post->ID, '_equipos_piclink_beh', true );
	($settings['_equipos_piclink_beh'] == 'new' ? $equipos_plb = 'target="_blank"' : $equipos_plb = '');

	/* Checks if forcing original fonts. */
	$settings['_equipos_original_font'] = get_post_meta( $post->ID, '_equipos_original_font', true );
	if (!$settings['_equipos_original_font']) { $settings['_equipos_original_font'] = 'yes'; }

	?>

	<div class="dmb_settings_box dmb_sidebar">

		<div class="dmb_section_title">
			<?php /* translators: General settings */ _e('General', EQ_NAME) ?>
		</div>

		<!-- Team layout -->
		<div class="dmb_grid dmb_grid_50 dmb_grid_first">
			<div class="dmb_field_title">
				<?php _e('Miembros por linea', EQ_NAME ) ?>
			</div>
			<select class="dmb_side_select" name="team_columns" disabled>
				<?php foreach ( $team_columns as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"<?php selected( (isset($settings['_equipos_columns'])) ? $settings['_equipos_columns'] : '3', $value ); ?>><?php echo $label; ?></option>
				<?php } ?>
			</select>
		</div>
		

		<!-- Photo link behavior -->
		<div class="dmb_grid dmb_grid_50 dmb_grid_last">
			<div class="dmb_field_title">
				<?php _e('Abrir link de foto en', EQ_NAME ) ?>
			</div>
			<select class="dmb_side_select" name="team_piclink_beh">
				<?php foreach ( $team_piclink_beh as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"<?php selected( (isset($settings['_equipos_piclink_beh'])) ? $settings['_equipos_piclink_beh'] : 'new', $value ); ?>><?php echo $label; ?></option>
				<?php } ?>
			</select>
		</div>
		

			<!-- Font option
			<div class="dmb_grid dmb_grid_100 dmb_grid_first dmb_grid_last">
			<div class="dmb_field_title">
				<?php _e('Fonts to use', EQ_NAME ) ?>
			</div>
			<select class="dmb_side_select" name="team_force_font">
				<?php foreach ( $team_force_font as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"<?php selected( (isset($settings['_equipos_original_font'])) ? $settings['_equipos_original_font'] : 'yes', $value ); ?>><?php echo $label; ?></option>
				<?php } ?>
			</select>
		</div>
		-->

		<!-- Main color -->
		<div class="dmb_color_of_team dmb_grid dmb_grid_100 dmb_grid_first dmb_grid_last">
			<div class="dmb_field_title">
				<?php _e('Color del Equipo', EQ_NAME) ?>
			</div>
			<input class="dmb_color_picker dmb_field dmb_color_of_team" name="team_color" type="text" value="<?php echo (isset($settings['_equipos_color'])) ? $settings['_equipos_color'] : '#333333'; ?>" />
		</div>

		<div class="dmb_clearfix"></div>

	</div>

<?php } ?>