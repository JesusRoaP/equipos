<?php

/* Defines highlight select options. */
function dmb_equipos_social_links_options() {
	$options = array ( 
		__('-', EQ_NAME ) => 'nada',
		__('CvLac', EQ_NAME ) => 'cvlac',
		__('Correo Electrónico', EQ_NAME ) => 'email',
		__('Research Gate', EQ_NAME ) => 'researchgate',
		__('LinkedIn', EQ_NAME ) => 'linkedin',
		__('Sitio Web', EQ_NAME ) => 'website',
		__('Teléfono', EQ_NAME ) => 'phone',
		__('Twitter', EQ_NAME ) => 'twitter',
		__('Facebook', EQ_NAME ) => 'facebook',
		__('Instagram', EQ_NAME ) => 'instagram',
    	__('YouTube', EQ_NAME ) => 'youtube',
    	__('Google+', EQ_NAME ) => 'googleplus',
		__('Pinterest', EQ_NAME ) => 'pinterest',
    	__('VK', EQ_NAME ) => 'vk',
		__('Tumblr', EQ_NAME ) => 'tumblr',
    	__('Otros links', EQ_NAME ) => 'customlink'
  	);
	return $options;
}


/* Hooks the metabox. */
add_action('admin_init', 'dmb_equipos_add_team', 1);
function dmb_equipos_add_team() {
	add_meta_box( 
		'equipos', 
		__('Administra tu equipo', EQ_NAME ), 
		'dmb_equipos_team_display', // Below
		'equipos', 
		'normal', 
		'high'
	);
}


/* Displays the metabox. */
function dmb_equipos_team_display() {

	global $post;
	
	/* Gets team data. */
	$team = get_post_meta( $post->ID, '_equipos_head', true );
	
	$fields_to_process = array(
    '_equipos_firstname',
    '_equipos_lastname',
    '_equipos_job',
    '_equipos_desc',
    '_equipos_sc_type1', '_equipos_sc_title1', '_equipos_sc_url1',
    '_equipos_sc_type2', '_equipos_sc_title2', '_equipos_sc_url2',
    '_equipos_sc_type3', '_equipos_sc_title3', '_equipos_sc_url3',
    '_equipos_photo',
    '_equipos_photo_url'
	);

	/* Retrieves select options. */
	$social_links_options = dmb_equipos_social_links_options();

	wp_nonce_field( 'dmb_equipos_meta_box_nonce', 'dmb_equipos_meta_box_nonce' ); ?>

	<div id="dmb_preview_team">
		<!-- Closes preview button. -->
		<a class="dmb_button dmb_button_huge dmb_button_gold dmb_preview_team_close" href="#">
			<?php _e('Cerrar vista previa', EQ_NAME ) ?>
		</a>
	</div>

	<?php if( !class_exists('acf') ) { ?>

	<div id="dmb_unique_editor">
		<?php wp_editor( '', 'dmb_editor', array('editor_height' => '300px' ) );  ?>
		<br/>
		<a class="dmb_button dmb_button_huge dmb_button_blue dmb_ue_update" href="#">
			<?php _e('Actualizar biografía', EQ_NAME ) ?>
		</a>
		<a class="dmb_button dmb_button_huge dmb_ue_cancel" href="#">
			<?php _e('Cancelar', EQ_NAME ) ?>
		</a>
	</div>

	<?php } ?>

	<!-- Toolbar for member metabox -->
	<div class="dmb_toolbar">
		<a class="dmb_button dmb_button_large dmb_expand_rows" href="#"><span class="dashicons dashicons-editor-expand"></span> <?php _e('Expandir todo', EQ_NAME ) ?></a>
		<a class="dmb_button dmb_button_large dmb_collapse_rows" href="#"><span class="dashicons dashicons-editor-contract"></span> <?php _e('Colapsar todo', EQ_NAME ) ?></a>
		<a class="dmb_show_preview_team dmb_button dmb_button_huge dmb_button_gold"><?php _e('Vista previa instantánea', EQ_NAME ) ?></a>
		<div class="dmb_clearfix"></div>
	</div>

	<?php if ( $team ) {

		/* Loops through rows. */
		foreach ( $team as $team_member ) {

			/* Retrieves each field for current member. */
			$member = array();
			foreach ( $fields_to_process as $field) {
				switch ($field) {
					default:
						$member[$field] = ( isset($team_member[$field]) ) ? esc_attr($team_member[$field]) : '';
						break;
				}
			} ?>

			<!-- START member -->
			<div class="dmb_main">

        <textarea class="dmb_data_dump" name="equipos_data_dumps[]"></textarea>  

				<!-- Member handle bar -->
				<div class="dmb_handle">
					<a class="dmb_button dmb_button_large dmb_button_compact dmb_move_row_up" href="#" title="Move up"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
					<a class="dmb_button dmb_button_large dmb_button_compact dmb_move_row_down" href="#" title="Move down"><span class="dashicons dashicons-arrow-down-alt2"></span></a>
					<div class="dmb_handle_title"></div>
					<a class="dmb_button dmb_button_large dmb_button_compact dmb_remove_row_btn" href="#" title="Remove"><span class="dashicons dashicons-trash"></span></a>
					<a class="dmb_button dmb_button_large dmb_clone_row" href="#" title="Clone"><span class="dashicons dashicons-admin-page"></span><?php _e('Clonar', EQ_NAME ); ?></a>
					<div class="dmb_clearfix"></div>
				</div>

				<!-- START inner -->
				<div class="dmb_inner">

					<div class="dmb_section_title">
						<?php _e('Detalles del miembro', EQ_NAME ) ?>
					</div>

					<div class="dmb_grid dmb_grid_33 dmb_grid_first">
						<div class="dmb_field_title">
							<?php _e('Nombre', EQ_NAME ) ?>
						</div>
						<input class="dmb_field dmb_highlight_field dmb_firstname_of_member" type="text" value="<?php echo $member['_equipos_firstname']; ?>" placeholder="<?php _e('e.g. Jesús', EQ_NAME ) ?>" />
					</div>

					<div class="dmb_grid dmb_grid_33 ">
						<div class="dmb_field_title">
							<?php _e('Apellido', EQ_NAME ) ?>
						</div>
						<input class="dmb_field dmb_lastname_of_member" type="text" value="<?php echo $member['_equipos_lastname']; ?>" placeholder="<?php _e('e.g. Roa', EQ_NAME ) ?>" />
					</div>

					<div class="dmb_grid dmb_grid_33 dmb_grid_last">
						<div class="dmb_field_title">
							<?php _e('Cargo/rol', EQ_NAME ) ?>
						</div>
						<input class="dmb_field dmb_job_of_member" type="text" value="<?php echo $member['_equipos_job']; ?>" placeholder="<?php _e('e.g. Desarrollador Web', EQ_NAME ) ?>" />
					</div>

					<div class="dmb_grid dmb_grid_100 dmb_grid_first dmb_grid_last">
					
						<?php if( !class_exists('acf') ) { ?>

								<div class="dmb_field_title">
									<?php _e('Descripción/biografía', EQ_NAME ) ?>
									<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Edite la biografía de su miembro haciendo clic en el botón de abajo. Una vez actualizado, aparecerá aquí.', EQ_NAME ) ?>">[?]</a>
								</div>

								<div class="dmb_field dmb_description_of_member">
									<?php echo $member["_equipos_desc"]; ?>
								</div>

						<?php } else { ?>

							<div class="dmb_field_title">
								<?php _e('Descripción/biografía', EQ_NAME ) ?>
							</div>

							<div class="dmb_field dmb_description_of_member_fb" style="display:none !important;"><?php echo $member["_equipos_desc"]; ?></div>
							<textarea id="acf-fallback-bio"><?php echo $member["_equipos_desc"]; ?></textarea>

						<?php } ?>

						<div class="dmb_clearfix"></div>

						<?php if( !class_exists('acf') ) { ?>
							<div class="dmb_edit_description_of_member dmb_button dmb_button_large dmb_button_blue">
								<?php _e('Editar biografía', EQ_NAME ) ?>
							</div>
						<?php } ?>

					</div>

					<div class="dmb_clearfix"></div>

					<div class="dmb_section_title">
						<?php _e('Social links', EQ_NAME ) ?>
						<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Estos enlaces aparecerán debajo de la biografía de sus miembros.', EQ_NAME ) ?>">[?]</a>
					</div>

          <div class="dmb_grid dmb_grid_33 dmb_grid_first">
            <div class="dmb_field_title">
              <?php _e('Tipo de link', EQ_NAME ) ?>
            </div>
            <select class="dmb_scl_type_select dmb_scl_type1_of_member">
              <?php foreach ( $social_links_options as $label => $value ) { ?>
              <option value="<?php echo $value; ?>"<?php selected( $member['_equipos_sc_type1'], $value ); ?>><?php echo $label; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="dmb_grid dmb_grid_33 ">
						<div class="dmb_field_title">
							<?php _e('Título del atributo', EQ_NAME ) ?>
							<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Opcional. Este es el atributo de título de la etiqueta HTML <a>.', EQ_NAME ) ?>">[?]</a>
						</div>
						<input class="dmb_field dmb_scl_title1_of_member" type="text" value="<?php echo $member['_equipos_sc_title1']; ?>" placeholder="<?php _e('e.g. Página de Faceook', EQ_NAME ) ?>" />
					</div>

					<div class="dmb_grid dmb_grid_33 dmb_grid_last">
						<div class="dmb_field_title">
							<?php _e('URL del link', EQ_NAME ) ?>
						</div>
						<input class="dmb_field dmb_scl_url1_of_member" type="text" value="<?php echo $member['_equipos_sc_url1']; ?>" placeholder="<?php _e('e.g. http://fb.com/member-profile', EQ_NAME ) ?>" />
          </div>

          <div class="dmb_clearfix" style="margin-bottom:6px"></div>
          
          <div class="dmb_grid dmb_grid_33 dmb_grid_first">
            <select class="dmb_scl_type_select dmb_scl_type2_of_member">
              <?php foreach ( $social_links_options as $label => $value ) { ?>
              <option value="<?php echo $value; ?>"<?php selected( $member['_equipos_sc_type2'], $value ); ?>><?php echo $label; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="dmb_grid dmb_grid_33 ">
						<input class="dmb_field dmb_scl_title2_of_member" type="text" value="<?php echo $member['_equipos_sc_title2']; ?>" placeholder="<?php _e('e.g. Página de Twitter', EQ_NAME ) ?>" />
					</div>

					<div class="dmb_grid dmb_grid_33 dmb_grid_last">
						<input class="dmb_field dmb_scl_url2_of_member" type="text" value="<?php echo $member['_equipos_sc_url2']; ?>" placeholder="<?php _e('e.g. http://tw.com/member-profile', EQ_NAME ) ?>" />
          </div>

          <div class="dmb_clearfix" style="margin-bottom:6px"></div>

          <div class="dmb_grid dmb_grid_33 dmb_grid_first dmb_grid_first">
            <select class="dmb_scl_type_select dmb_scl_type3_of_member">
              <?php foreach ( $social_links_options as $label => $value ) { ?>
              <option value="<?php echo $value; ?>"<?php selected( $member['_equipos_sc_type3'], $value ); ?>><?php echo $label; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="dmb_grid dmb_grid_33 ">
						<input class="dmb_field dmb_scl_title3_of_member" type="text" value="<?php echo $member['_equipos_sc_title3']; ?>" placeholder="<?php _e('e.g. Página de Google+', EQ_NAME ) ?>" />
					</div>

					<div class="dmb_grid dmb_grid_33 dmb_grid_last">
						<input class="dmb_field dmb_scl_url3_of_member" type="text" value="<?php echo $member['_equipos_sc_url3']; ?>" placeholder="<?php _e('e.g. http://gp.com/member-profile', EQ_NAME ) ?>" />
          </div>

					<div class="dmb_clearfix"></div>

					<div class="dmb_tip">
						<span class="dashicons dashicons-yes"></span> <?php _e('Los enlaces con el tipo <strong>correo electrónico</strong> abren el cliente de correo de sus visitantes.', EQ_NAME ); ?> <a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('La dirección de correo electrónico de su miembro debe ingresarse en el campo URL del enlace. El atributo de título se puede dejar en blanco.', EQ_NAME ) ?>">[?]</a>
						<br/><span class="dashicons dashicons-yes"></span> <?php _e('Los enlaces con el tipo <strong>teléfono</strong> abren la aplicación de teléfono predeterminada de sus visitantes.', EQ_NAME ) ?> <a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('El número de teléfono de su miembro debe ingresarse en el campo URL del enlace (por ejemplo, tel: +11234567890). El título del atributo se puede dejar en blanco.', EQ_NAME ) ?>">[?]</a>
					</div>

					<div class="dmb_clearfix"></div>
					
					<div class="dmb_section_title">
						<?php _e('Foto', EQ_NAME ) ?>
					</div>
		
					<div class="dmb_grid dmb_grid_33 dmb_grid_first">
		
						<div class="dmb_field_title">
							<?php _e('Foto del miembro', EQ_NAME ) ?>
							<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Recomendamos que todas las fotos sean del mismo tamaño.', EQ_NAME ) ?>">[?]</a>
						</div>
		
						<div class="dmb_photo_of_member">
							<div class="dmb_field_title dmb_img_data_url" data-img="<?php echo $member['_equipos_photo']; ?>">
						</div>
							<div class="dmb_upload_img_btn dmb_button dmb_button_large dmb_button_blue">
								<?php _e('Cargar foto', EQ_NAME ) ?>
							</div>
						</div>
		
					</div>

					<div class="dmb_grid dmb_grid_100 dmb_grid_first dmb_grid_last" style="margin-top:7px;">
						<div class="dmb_field_title">
							<?php _e('Link de foto', EQ_NAME ) ?>
							<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Sus visitantes serán redirigidos a este enlace si hacen clic en la foto del miembro.', EQ_NAME ) ?>">[?]</a>
						</div>
						<input class="dmb_field dmb_photo_url_of_member" type="text" value="<?php echo $member['_equipos_photo_url']; ?>" placeholder="<?php _e('e.g. http://your-site.com/full-member-page/', EQ_NAME ) ?>" />
          </div>

					<div class="dmb_clearfix" style="margin-bottom:6px"></div>	

				<!-- END inner -->
				</div>
			
			<!-- END row -->
			</div>

			<?php
		}
	} ?>

	<!-- START empty member -->
	<div class="dmb_main dmb_empty_row" style="display:none;">

		<textarea class="dmb_data_dump" name="equipos_data_dumps[]"></textarea>  

		<!-- Member handle bar -->
		<div class="dmb_handle">
			<a class="dmb_button dmb_button_large dmb_button_compact dmb_move_row_up" href="#" title="Move up"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
			<a class="dmb_button dmb_button_large dmb_button_compact dmb_move_row_down" href="#" title="Move down"><span class="dashicons dashicons-arrow-down-alt2"></span></a>
			<div class="dmb_handle_title"></div>
			<a class="dmb_button dmb_button_large dmb_button_compact dmb_remove_row_btn" href="#" title="Remove"><span class="dashicons dashicons-trash"></span></a>
			<a class="dmb_button dmb_button_large dmb_clone_row" href="#" title="Clone"><span class="dashicons dashicons-admin-page"></span><?php _e('Clonar', EQ_NAME ); ?></a>
			<div class="dmb_clearfix"></div>
		</div>

		<!-- START inner -->
		<div class="dmb_inner">

			<div class="dmb_section_title">
				<?php _e('Detalles del miembro', EQ_NAME ) ?>
			</div>
      
      <div class="dmb_grid dmb_grid_33 dmb_grid_first">
        <div class="dmb_field_title">
          <?php _e('Nombre', EQ_NAME ) ?>
        </div>
        <input class="dmb_field dmb_highlight_field dmb_firstname_of_member" type="text" value="" placeholder="<?php _e('e.g. Jesús', EQ_NAME ) ?>" />
      </div>

      <div class="dmb_grid dmb_grid_33 ">
        <div class="dmb_field_title">
          <?php _e('Apellido', EQ_NAME ) ?>
        </div>
        <input class="dmb_field dmb_lastname_of_member" type="text" value="" placeholder="<?php _e('e.g. Roa', EQ_NAME ) ?>" />
      </div>

      <div class="dmb_grid dmb_grid_33 dmb_grid_last">
        <div class="dmb_field_title">
          <?php _e('Cargo/rol', EQ_NAME ) ?>
        </div>
        <input class="dmb_field dmb_job_of_member" type="text" value="" placeholder="<?php _e('e.g. Desarrollador web', EQ_NAME ) ?>" />
      </div>

			<div class="dmb_grid dmb_grid_100 dmb_grid_first dmb_grid_last">

			
			<?php if( !class_exists('acf') ) { ?>

				<div class="dmb_field_title">
					<?php _e('Descripción/biografía', EQ_NAME ) ?>
					<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Edite la biografía de su miembro haciendo clic en el botón de abajo. Una vez actualizado, aparecerá aquí.', EQ_NAME ) ?>">[?]</a>
				</div>

				<div class="dmb_field dmb_description_of_member"></div>

			<?php } else { ?>

					<div class="dmb_field_title">
						<?php _e('Descripción/biografía', EQ_NAME ) ?>
					</div>

					<div class="dmb_field dmb_description_of_member_fb" style="display:none !important;"></div>
					<textarea id="acf-fallback-bio"></textarea>

			<?php } ?>

			<div class="dmb_clearfix"></div>

			<?php if( !class_exists('acf') ) { ?>
				<div class="dmb_edit_description_of_member dmb_button dmb_button_large dmb_button_blue">
					<?php _e('Editar biografía', EQ_NAME ) ?>
				</div>
			<?php } ?>

			</div>

			<div class="dmb_clearfix"></div>

			<div class="dmb_section_title">
				<?php _e('Social links', EQ_NAME ) ?>
				<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Estos enlaces aparecerán debajo de la biografía de sus miembros.', EQ_NAME ) ?>">[?]</a>
			</div>

			<div class="dmb_clearfix"></div>

			<div class="dmb_grid dmb_grid_33 dmb_grid_first">
				<div class="dmb_field_title">
					<?php _e('Tipo de link', EQ_NAME ) ?>
				</div>
			
        <select class="dmb_scl_type_select dmb_scl_type1_of_member">
					<?php foreach ( $social_links_options as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
					<?php } ?>
				</select>
      </div>

      <div class="dmb_grid dmb_grid_33">
				<div class="dmb_field_title">
					<?php _e('Título del atributo', EQ_NAME ) ?>
					<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Opcional. Este es el atributo de título de la etiqueta HTML <a>.', EQ_NAME ) ?>">[?]</a>
				</div>
        <input class="dmb_field dmb_scl_title1_of_member" type="text" value="" placeholder="<?php _e('e.g. Página de Facebook', EQ_NAME ) ?>" />
      </div>

      <div class="dmb_grid dmb_grid_33 dmb_grid_last">
        <div class="dmb_field_title">
          <?php _e('URL del link', EQ_NAME ) ?>
        </div>
        <input class="dmb_field dmb_scl_url1_of_member" type="text" value="" placeholder="<?php _e('e.g. http://fb.com/member-profile', EQ_NAME ) ?>" />
      </div>

      <div class="dmb_clearfix" style="margin-bottom:6px"></div>

      <div class="dmb_grid dmb_grid_33 dmb_grid_first">
        <select class="dmb_scl_type_select dmb_scl_type2_of_member">
					<?php foreach ( $social_links_options as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
					<?php } ?>
				</select>
      </div>

      <div class="dmb_grid dmb_grid_33">
        <input class="dmb_field dmb_scl_title2_of_member" type="text" value="" placeholder="<?php _e('e.g. Página de Twitter', EQ_NAME ) ?>" />
      </div>

      <div class="dmb_grid dmb_grid_33 dmb_grid_last">
        <input class="dmb_field dmb_scl_url2_of_member" type="text" value="" placeholder="<?php _e('e.g. http://tw.com/member-profile', EQ_NAME ) ?>" />
      </div>

      <div class="dmb_clearfix" style="margin-bottom:6px"></div>

      <div class="dmb_grid dmb_grid_33 dmb_grid_first">
        <select class="dmb_scl_type_select dmb_scl_type3_of_member">
					<?php foreach ( $social_links_options as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
					<?php } ?>
				</select>
      </div>

      <div class="dmb_grid dmb_grid_33">
        <input class="dmb_field dmb_scl_title3_of_member" type="text" value="" placeholder="<?php _e('e.g. Página de Google+', EQ_NAME ) ?>" />
      </div>

      <div class="dmb_grid dmb_grid_33 dmb_grid_last">
        <input class="dmb_field dmb_scl_url3_of_member" type="text" value="" placeholder="<?php _e('e.g. http://gp.com/member-profile', EQ_NAME ) ?>" />
      </div>

			<div class="dmb_clearfix"></div>

			<div class="dmb_tip">
				<span class="dashicons dashicons-yes"></span> <?php _e('Los enlaces con el tipo <strong>correo electrónico</strong> abren el cliente de correo de sus visitantes.', EQ_NAME ); ?> <a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('La dirección de correo electrónico de su miembro debe ingresarse en el campo URL del enlace. El título del atributo se puede dejar en blanco.', EQ_NAME ) ?>">[?]</a>
				<br/><span class="dashicons dashicons-yes"></span> <?php _e('Los enlaces con el tipo <strong>teléfono</strong> abren la aplicación de teléfono predeterminada de sus visitantes.', EQ_NAME ) ?> <a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('El número de teléfono de su miembro debe ingresarse en el campo URL del enlace (por ejemplo, tel: +11234567890). El título del atributo se puede dejar en blanco.', EQ_NAME ) ?>">[?]</a>
			</div>

			<div class="dmb_clearfix"></div>
			
			<div class="dmb_section_title">
				<?php _e('Foto', EQ_NAME ) ?>
			</div>

			<div class="dmb_grid dmb_grid_33 dmb_grid_first">

				<div class="dmb_field_title">
					<?php _e('Foto del miembro', EQ_NAME ) ?>
					<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Recomendamos que todas las fotos sean del mismo tamaño.', EQ_NAME ) ?>">[?]</a>
				</div>

				<div class="dmb_photo_of_member">
					<div class="dmb_field_title dmb_img_data_url" data-img=""></div>
					<div class="dmb_upload_img_btn dmb_button dmb_button_large dmb_button_blue">
						<?php _e('Cargar foto', EQ_NAME ) ?>
					</div>
				</div>

			</div>

			<div class="dmb_grid dmb_grid_100 dmb_grid_first dmb_grid_last" style="margin-top:7px;">
				<div class="dmb_field_title">
					<?php _e('Link de foto', EQ_NAME ) ?>
					<a class="dmb_inline_tip dmb_tooltip_large" data-tooltip="<?php _e('Sus visitantes serán redirigidos a este enlace si hacen clic en la foto del miembro.', EQ_NAME ) ?>">[?]</a>
				</div>
				<input class="dmb_field dmb_photo_url_of_member" type="text" value="" placeholder="<?php _e('e.g. http://your-site.com/full-member-page/', EQ_NAME ) ?>" />
			</div>

			<div class="dmb_clearfix" style="margin-bottom:6px"></div>

		<!-- END inner -->
		</div>

	<!-- END empty row -->
	</div>

	<div class="dmb_clearfix"></div>

	<div class="dmb_no_row_notice">
		<?php /* translators: Leave HTML tags */ _e('Haga clic en el botón <strong>Agregar un miembro</strong> a continuación para comenzar.', EQ_NAME ) ?>
	</div>

	<!-- Add row button -->
	<a class="dmb_button dmb_button_huge dmb_button_green dmb_add_row" href="#">
		<?php _e('Agregar un miembro', EQ_NAME ) ?>
	</a>

<?php }