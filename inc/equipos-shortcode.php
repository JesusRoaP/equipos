<?php 
/* Handles team shortcodes. */
function equipos_sc($atts) {

  global $post;

  /* Gets table slug (post name). */
  $all_attr = shortcode_atts( array( "name" => '' ), $atts );
  $name = $all_attr['name'];

  /* Gets the team. */
  $args = array('post_type' => 'equipos', 'name' => $name);
  $custom_posts = get_posts($args);

  foreach($custom_posts as $post) : setup_postdata($post);

    $members = get_post_meta( get_the_id(), '_equipos_head', true );
    $equipos_columns = get_post_meta( $post->ID, '_equipos_columns', true );
    $equipos_color = get_post_meta( $post->ID, '_equipos_color', true );
    $equipos_bio_alignment = get_post_meta( $post->ID, '_equipos_bio_alignment', true );

    /* Checks if member links open in new window. */
    $equipos_piclink_beh = get_post_meta( $post->ID, '_equipos_piclink_beh', true );
    ($equipos_piclink_beh == 'new' ? $equipos_plb = 'target="_blank"' : $equipos_plb = '');

    /* Checks if forcing original fonts. */
    $original_font = get_post_meta( $post->ID, '_equipos_original_font', true );
    if ($original_font) {
      if ($original_font == "no") { $ori_f = 'equipos_theme_f'; }
      else if ($original_font == "yes") { $ori_f = 'equipos_plugin_f'; }
    } else {
      $ori_f = 'equipos_plugin_f';
    }

    $team_view = '';
    $team_view .= '<div class="slider--teams equipos equipos_'.$name.'">';
      $team_view .= '<div class="slider--teams__team equipos_'.$equipos_columns.'_columns equipos_wrap '.$ori_f.'">';

        if (is_array($members) || is_object($members)) {

          $team_view .= '<ul id="list" class="cf equipos_container">';

          foreach ($members as $key => $member) { 

            /* START member. */
            $team_view .= '<li>';
            $team_view .= '<figure class="">';

            $team_view .= '<div class="equipos_member" style="border-top:'.$equipos_color.' solid 5px;">';

            

              /* Displays member photo. */
              if (!empty($member['_equipos_photo_url']))
                $team_view .= '<span '.$equipos_plb.' onclick="window.open(`'.$member['_equipos_photo_url'].'`)" title="'.$member['_equipos_firstname'].' '.$member['_equipos_lastname'].'">';

                if (!empty($member['_equipos_photo'])) {
                  $team_view .= '<div class="equipos_photo equipos_pic_'.$name.'_'.$key.'" style="background: url('.$member['_equipos_photo'].'); margin-left: auto; margin-right:auto; background-size:cover !important;"></div>';
                } else {
                  $team_view .= '<div class="equipos_photo equipos_pic_'.$name.'_'.$key.'" style="background: url('.plugins_url('img/profile.jpg', __FILE__).'); margin-left: auto; margin-right:auto; background-size:cover !important;"></div>';
                }
                  
              if (!empty($member['_equipos_photo_url']))
                $team_view .= '</span>';

              /* Creates text block. */
              $team_view .= '<div class="equipos_textblock">';

                /* Displays names. */
                $team_view .= '<div class="equipos_names">';
                  if (!empty($member['_equipos_firstname']))
                    $team_view .= '<span class="equipos_fname">'.$member['_equipos_firstname'].'</span> ';
                  if (!empty($member['_equipos_lastname']))
                    $team_view .= '<span class="equipos_lname">'.$member['_equipos_lastname'].'</span>';
                $team_view .= '</div>';

                /* Displays jobs. */
                if (!empty($member['_equipos_job']))
                $team_view .= '<div class="equipos_job">'.$member['_equipos_job'].'</div>';

                /* Displays bios. */
                if (!empty($member['_equipos_desc']))
                $team_view .= '<div class="equipos_desc" style="text-align:'.$equipos_bio_alignment.'">'.do_shortcode($member['_equipos_desc']).'</div>';

                /* Creates social block. */
                $team_view .= '<div class="equipos_scblock">';

                  /* Displays social links. */
                  for ($i = 1; $i <= 3; $i++) {
                    if ($member['_equipos_sc_type'.$i] != 'nada') {
                      if ($member['_equipos_sc_type'.$i] == 'email') {
                        $team_view .= '<span class="equipos_sociallink" onclick="window.open(`mailto:'.(!empty($member['_equipos_sc_url'.$i])?$member['_equipos_sc_url'.$i]:'').'`)" title="'.(!empty($member['_equipos_sc_title'.$i])?$member['_equipos_sc_title'.$i]:'').'"><img alt="'.(!empty($member['_equipos_sc_title'.$i])?$member['_equipos_sc_title'.$i]:'').'" src="'.plugins_url('img/links/', __FILE__).$member['_equipos_sc_type'.$i].'.png"/>';
                        if (!empty($member['_equipos_sc_url'.$i])) {
                          $team_view .= '<span class="tooltiptext" style="background:'.$equipos_color.'">'.(!empty($member['_equipos_sc_url'.$i])?$member['_equipos_sc_url'.$i]:'').'</span>';
                        }
                        $team_view .= '</span>';
                      } else {
                        $team_view .= '<span target="_blank" class="equipos_sociallink" onclick="window.open(`'.(!empty($member['_equipos_sc_url'.$i])?$member['_equipos_sc_url'.$i]:'').'`)" title="'.(!empty($member['_equipos_sc_title'.$i])?$member['_equipos_sc_title'.$i]:'').'"><img alt="'.(!empty($member['_equipos_sc_title'.$i])?$member['_equipos_sc_title'.$i]:'').'" src="'.plugins_url('img/links/', __FILE__).$member['_equipos_sc_type'.$i].'.png"/></span>';
                      }
                    }
                  }

                $team_view .= '</div>'; // Closes social block.
              $team_view .= '</div>'; // Closes text block.
              
            $team_view .= '</div>'; // END member.
            $team_view .= '</figure>';
            $team_view .= '</li>';

            $page_count = count( $members );
            if ($key == $page_count - 1) $team_view .= '<div style="clear:both;"></div>';
          }
        }

        $team_view .= '</ul>'; // Closes container.
      $team_view .= '</div>'; // Closes wrap.
    $team_view .= '</div>'; // Closes equipos.

  endforeach; wp_reset_postdata();
  return $team_view;
}
add_shortcode("equipos", "equipos_sc");
?>