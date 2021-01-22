<?php 
/* Saves metaboxes. */
function dmb_equipos_plan_meta_box_save($post_id) {

	if ( ! isset( $_POST['dmb_equipos_meta_box_nonce'] ) ||
	! wp_verify_nonce( $_POST['dmb_equipos_meta_box_nonce'], 'dmb_equipos_meta_box_nonce' ) )
		return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	if (!current_user_can('edit_post', $post_id))
		return;

	/* Gets members. */
	$old_team = get_post_meta($post_id, '_equipos_head', true);

	/* Inits new team. */
	$new_team = array();

	/* Settings. */
	$old_team_settings = array();

	$old_team_settings['_equipos_columns'] = get_post_meta( $post_id, '_equipos_columns', true );
	$old_team_settings['_equipos_color'] = get_post_meta( $post_id, '_equipos_color', true );
	$old_team_settings['_equipos_bio_alignment'] = get_post_meta( $post_id, '_equipos_bio_alignment', true );
	$old_team_settings['_equipos_piclink_beh'] = get_post_meta( $post_id, '_equipos_piclink_beh', true );
	$old_team_settings['_equipos_original_font'] = get_post_meta( $post_id, '_equipos_original_font', true );

	$count = count($_POST['equipos_data_dumps']) - 1;

	for ( $i = 0; $i < $count; $i++ ) {

		if($_POST['equipos_data_dumps'][$i]){

      /* Data travels using a single field to avoid max_input_vars issue. */
			$member_data = explode(']--[', $_POST['equipos_data_dumps'][$i]);
			
			$member_firstname = $member_data[0];
			$member_lastname = $member_data[1];
			$member_job = $member_data[2];
			$member_bio = $member_data[3];
	
			$member_scl_type1 = $member_data[4];
			$member_scl_title1 = $member_data[5];
			$member_scl_url1 = $member_data[6];
	
			$member_scl_type2 = $member_data[7];
			$member_scl_title2 = $member_data[8];
			$member_scl_url2 = $member_data[9];
	
			$member_scl_type3 = $member_data[10];
			$member_scl_title3 = $member_data[11];
			$member_scl_url3 = $member_data[12];
			
			$member_photo = $member_data[13];
			$member_photo_url = $member_data[14];

      /* Saves the member if at least one of these fields are not empty. */
			if ( 
				$member_firstname != ''
				|| $member_lastname != '' 
				|| $member_job != ''
				|| $member_bio != ''
				|| $member_photo != ''
			) {
	
				/* Head. */
				(isset($member_firstname) && $member_firstname) ? $new_team[$i]['_equipos_firstname'] = stripslashes( wp_kses_post( $member_firstname ) ) : $new_team[$i]['_equipos_firstname'] = __('Sin título', EQ_NAME );
				(isset($member_lastname) && $member_lastname) ? $new_team[$i]['_equipos_lastname'] = stripslashes( wp_kses_post( $member_lastname ) ) : $new_team[$i]['_equipos_lastname'] = '';
				(isset($member_job) && $member_job) ? $new_team[$i]['_equipos_job'] = stripslashes( wp_kses_post( $member_job ) ) : $new_team[$i]['_equipos_job'] = '';
				(isset($member_bio) && $member_bio) ? $new_team[$i]['_equipos_desc'] = wp_kses_post(balanceTags( $member_bio )) : $new_team[$i]['_equipos_desc'] = '';
				(isset($member_photo) && $member_photo) ? $new_team[$i]['_equipos_photo'] = stripslashes( strip_tags( sanitize_text_field( $member_photo ) ) ) : $new_team[$i]['_equipos_photo'] = '';
				(isset($member_photo_url) && $member_photo_url) ? $new_team[$i]['_equipos_photo_url'] = stripslashes( strip_tags( sanitize_text_field( $member_photo_url ) ) ) : $new_team[$i]['_equipos_photo_url'] = '';
	
				(isset($member_scl_type1) && $member_scl_type1) ? $new_team[$i]['_equipos_sc_type1'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_type1 ) ) ) : $new_team[$i]['_equipos_sc_type1'] = '';
				(isset($member_scl_title1) && $member_scl_title1) ? $new_team[$i]['_equipos_sc_title1'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_title1 ) ) ) : $new_team[$i]['_equipos_sc_title1'] = '';
				(isset($member_scl_url1) && $member_scl_url1) ? $new_team[$i]['_equipos_sc_url1'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_url1 ) ) ) : $new_team[$i]['_equipos_sc_url1'] = '';
				
				(isset($member_scl_type2) && $member_scl_type2) ? $new_team[$i]['_equipos_sc_type2'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_type2 ) ) ) : $new_team[$i]['_equipos_sc_type2'] = '';
				(isset($member_scl_title2) && $member_scl_title2) ? $new_team[$i]['_equipos_sc_title2'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_title2 ) ) ) : $new_team[$i]['_equipos_sc_title2'] = '';
				(isset($member_scl_url2) && $member_scl_url2) ? $new_team[$i]['_equipos_sc_url2'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_url2 ) ) ) : $new_team[$i]['_equipos_sc_url2'] = '';
				
				(isset($member_scl_type3) && $member_scl_type3) ? $new_team[$i]['_equipos_sc_type3'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_type3 ) ) ) : $new_team[$i]['_equipos_sc_type3'] = '';
				(isset($member_scl_title3) && $member_scl_title3) ? $new_team[$i]['_equipos_sc_title3'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_title3 ) ) ) : $new_team[$i]['_equipos_sc_title3'] = '';
				(isset($member_scl_url3) && $member_scl_url3) ? $new_team[$i]['_equipos_sc_url3'] = stripslashes( strip_tags( sanitize_text_field( $member_scl_url3 ) ) ) : $new_team[$i]['_equipos_sc_url3'] = '';
				
			}

		}

	}

  /* Settings. */
	(isset($_POST['team_color']) && $_POST['team_color']) ? $new_team_settings['_equipos_color'] = stripslashes( strip_tags( sanitize_text_field( $_POST['team_color'] ) ) ) : $new_team_settings['_equipos_color'] = '';
	(isset($_POST['team_columns']) && $_POST['team_columns']) ? $new_team_settings['_equipos_columns'] = stripslashes( strip_tags( sanitize_text_field( $_POST['team_columns'] ) ) ) : $new_team_settings['_equipos_columns'] = '';
	(isset($_POST['team_bio_align']) && $_POST['team_bio_align']) ? $new_team_settings['_equipos_bio_alignment'] = stripslashes( strip_tags( sanitize_text_field( $_POST['team_bio_align'] ) ) ) : $new_team_settings['_equipos_bio_alignment'] = '';
	(isset($_POST['team_force_font']) && $_POST['team_force_font']) ? $new_team_settings['_equipos_original_font'] = stripslashes( strip_tags( sanitize_text_field( $_POST['team_force_font'] ) ) ) : $new_team_settings['_equipos_original_font'] = '';
	(isset($_POST['team_piclink_beh']) && $_POST['team_piclink_beh']) ? $new_team_settings['_equipos_piclink_beh'] = stripslashes( strip_tags( sanitize_text_field( $_POST['team_piclink_beh'] ) ) ) : $new_team_settings['_equipos_piclink_beh'] = '';

	/* Updates plans. */
	if ( !empty( $new_team ) && $new_team != $old_team )
		update_post_meta( $post_id, '_equipos_head', $new_team );
	elseif ( empty($new_team) && $old_team )
		delete_post_meta( $post_id, '_equipos_head', $old_team );

	if ( !empty( $new_team_settings['_equipos_color'] ) && $new_team_settings['_equipos_color'] != $old_team_settings['_equipos_color'] )
		update_post_meta( $post_id, '_equipos_color', $new_team_settings['_equipos_color'] );

	if ( !empty( $new_team_settings['_equipos_columns'] ) && $new_team_settings['_equipos_columns'] != $old_team_settings['_equipos_columns'] )
		update_post_meta( $post_id, '_equipos_columns', $new_team_settings['_equipos_columns'] );

	if ( !empty( $new_team_settings['_equipos_bio_alignment'] ) && $new_team_settings['_equipos_bio_alignment'] != $old_team_settings['_equipos_bio_alignment'] )
		update_post_meta( $post_id, '_equipos_bio_alignment', $new_team_settings['_equipos_bio_alignment'] );

	if ( !empty( $new_team_settings['_equipos_original_font'] ) && $new_team_settings['_equipos_original_font'] != $old_team_settings['_equipos_original_font'] )
		update_post_meta( $post_id, '_equipos_original_font', $new_team_settings['_equipos_original_font'] );

	if ( !empty( $new_team_settings['_equipos_piclink_beh'] ) && $new_team_settings['_equipos_piclink_beh'] != $old_team_settings['_equipos_piclink_beh'] )
		update_post_meta( $post_id, '_equipos_piclink_beh', $new_team_settings['_equipos_piclink_beh'] );

}
add_action('save_post', 'dmb_equipos_plan_meta_box_save');