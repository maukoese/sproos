<?php 
class _hMenus {
//$h_code = substr( md5(date( 'YmdHms' ).rand(10,1000) ), 0, 12);

	/**
	* Create menu
	**/
	function create ( $h_alias, $h_author, $h_avatar, $h_code, $h_for, $h_link, $h_location, $h_status, $h_type ) {
		if( mysqli_query( $GLOBALS['conn'], "INSERT INTO hmenus ( h_alias, h_author, h_avatar, h_code, h_for, h_link, h_location, h_status, h_type ) VALUES ( '".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_code."', '".$h_for."', '".$h_link."', '".$h_location."', '".$h_status."', '".$h_type."')" ) ) {
               _show_( "<script type = \"text/javascript\">
                        alert(\"Menu Created Successfully!\" );
                    </script>" );
          } else {
      echo '<script type = \"text/javascript\">
              alert(\"Error: "'.$GLOBALS['conn']->error.'!\" );
          </script>';
    }
	}

	function update ( $h_alias, $h_author, $h_avatar, $h_code, $h_for, $h_link, $h_location, $h_status, $h_type ) {
		if( mysqli_query( $GLOBALS['conn'], "UPDATE hmenus SET h_alias='".$h_alias."', h_author='".$h_author."', h_avatar='".$h_avatar."', h_code='".$h_code."', h_for='".$h_for."', h_link='".$h_link."', h_location='".$h_location."', h_status='".$h_status."', h_type='".$h_type."' WHERE h_code ='".$h_code."' " ) ) {
               _show_( "<script type = \"text/javascript\">
              alert(\"Menu Updated Successfully!\" );
          </script>" );
          } else {
      echo 'Error: '.$GLOBALS['conn']->error;
    }
	}

	function delete ( $h_code ) {
		mysqli_query( $GLOBALS['conn'], "DELETE FROM hmenus WHERE h_code = '".$h_code."' " );
	}

	/**
	* Show default drawer menus
	**/
	function drawerdef($code) {
		$getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_type = 'drop' AND h_author = 'jabali' AND h_location = 'drawer' AND h_status = 'visible' AND h_code = '".$code."'" );
		if ( $getMenu -> num_rows > 0 ) {
			while ( $menus = mysqli_fetch_assoc( $getMenu) ) {
				echo '<a class="mdl-navigation__link" id= "'.$menus['h_code'].'" href="'.$menus["h_link"].'"><i class="mdl-color-text--white material-icons" role="presentation">'.$menus["h_avatar"].'</i>'.$menus["h_alias"].'</a>';
				if ( $menus['h_type'] == "drop" ) {
					$subMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_type != 'drop' AND h_location = 'drawer' AND h_status = 'visible' AND h_for = '".$menus['h_code']."'" );
					if ( $subMenu -> num_rows > 0 ) { ?>
						<ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor(); ?>" for="<?php _show_( $menus['h_code'] ); ?>"><?php
						while ( $menusub = mysqli_fetch_assoc( $subMenu) ) {
							echo '<a class="mdl-navigation__link" href="'.$menusub["h_link"].'"><i class="mdl-color-text--white material-icons" role="presentation">'.$menusub["h_avatar"].'</i>'.$menusub["h_alias"].'</a>';
						}
						echo "</ul>";
					}
				}
			}
		}
	}

	/**
	* Show user defined drawer menus
	**/
	function drawer() {
		$getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_type = 'drop' AND h_author != 'jabali' AND h_location = 'drawer' AND h_status = 'visible'" );
		if ( $getMenu -> num_rows > 0 ) {
			while ( $menus = mysqli_fetch_assoc( $getMenu) ) {
				echo '<a class="mdl-navigation__link" id= "'.$menus['h_code'].'" href="'.$menus["h_link"].'"><i class="mdl-color-text--white material-icons" role="presentation">'.$menus["h_avatar"].'</i>'.$menus["h_alias"].'</a>';
				if ( $menus['h_type'] == "drop" ) {
					$subMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_type != 'drop' AND h_location = 'drawer' AND h_status = 'visible' AND h_for = '".$menus['h_code']."'" );
					if ( $subMenu -> num_rows > 0 ) { ?>
						<ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor(); ?>" for="<?php _show_( $menus['h_code'] ); ?>"><?php
						while ( $menusub = mysqli_fetch_assoc( $subMenu) ) {
							echo '<a class="mdl-navigation__link" href="'.$menusub["h_link"].'"><i class="mdl-color-text--white material-icons" role="presentation">'.$menusub["h_avatar"].'</i>'.$menusub["h_alias"].'</a>';
						}
						echo "</ul>";
					}
				}
			}
		}
	}

	/**
	* Header menu
	**/
	function header() {
          $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_location = 'header' AND h_status = 'visible' ORDER BY h_code DESC" );
          if ( $getMenu -> num_rows > 0 ) {
               while ( $menus = mysqli_fetch_assoc( $getMenu) ) {
                    echo '<a class="mdl-list__item" id= "'.$menus['h_code'].'" href="'.$menus["h_link"].'">'.$menus["h_alias"].'</a>';
                    if ( $menus['h_type'] == "drop" ) {
                         $subMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_type != 'drop' AND h_location = 'drawer' AND h_status = 'visible' AND h_for = '".$menus['h_code']."'" );
                         if ( $subMenu -> num_rows > 0 ) { ?>
                              <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-left mdl-color--<?php primaryColor(); ?>" for="<?php _show_( $menus['h_code'] ); ?>"><?php
                              while ( $menusub = mysqli_fetch_assoc( $subMenu) ) {
                                   echo '<a class="mdl-navigation__link" href="'.$menusub["h_link"].'"><i class="mdl-color-text--white material-icons" role="presentation">'.$menusub["h_avatar"].'</i>'.$menusub["h_alias"].'</a>';
                              }
                              echo "</ul>";
                         }
                    }
               }
          }
     }

	/**
	* Main Front menu
	**/
	function main() {}

	/**
	* Front Footer Menu
	**/
	function footer() {}

	//Options

	function theMenu( $code ) {
     $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_code ='".$code."'");
     if ( $getMenu -> num_rows > 0 ) {
          while ($menus = mysqli_fetch_assoc( $getMenu )) {
               $menu[] = $menus; 
          } ?>

          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--2-col">
            <a href="?edit=<?php _show_( $menu[0]['h_code'] ); ?>&key=menu"
              <i class="material-icons"><?php
              if ( $menu[0]['h_avatar'] == "" ) {
                    $icon = 'edit';
               } else {
                    $icon = $menu[0]['h_avatar'];
                    } 
                    _show_( $icon ); ?></i>
          </a>
            </div>

            <div class="mdl-cell mdl-cell--8-col">
            <b><?php _show_( $menu[0]['h_alias'] ); ?></b> <a class="alignrght" href="<?php _show_( $menu[0]['h_link'] ); ?>"><?php _show_( $menu[0]['h_link'] ); ?></a>
            </div>

            <div class="mdl-cell mdl-cell--2-col">
              <center><b>Click icon to edit</b></center>
            </div>
          </div>

     <?php
     }
}

function subMenu( $code ) {
     $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_for ='".$code."'");
     if ( $getMenu -> num_rows > 0 ) {
          while ($menus = mysqli_fetch_assoc( $getMenu )) {
               $menu[] = $menus; 
          }

           _show_( '<table class="mdl-data-table mdl-js-data-table">
               <thead>
                    <tr>
                         <th class="mdl-data-table__cell--non-numeric">ICON</th>
                         <th class="mdl-data-table__cell--non-numeric">MENU</th>
                         <th class="mdl-data-table__cell--non-numeric">LINK</th>
                    </tr>
               </thead>
               <tbody>' );

          foreach ($menu as $menui) { ?>
          
               <tr>
                    <td class="mdl-data-table__cell--non-numeric"><a href="?edit=<?php _show_( $menui['h_code'] ); ?>&key=menu">
                         <i class="material-icons"><?php
              if ( $menui['h_avatar'] == "" ) {
                    $icon = 'edit';
               } else {
                    $icon = $menu[0]['h_avatar'];
                    } 
                    _show_( $icon ); ?></i></a>
                         </td>
                    <td class="mdl-data-table__cell--non-numeric"><?php _show_( $menui['h_alias'] ); ?></td>
                    <td class="mdl-data-table__cell--non-numeric"><?php _show_( $menui['h_link'] ); ?></td>
               </tr>
                    

     <?php } _show_( '
               </tbody>
          </table>' );
     }
}

function uMenu( ) {
     $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_author !='jabali' AND h_location= 'drawer'");
     if ( $getMenu -> num_rows > 0 ) {
          while ($menus = mysqli_fetch_assoc( $getMenu )) {
               $menu[] = $menus; 
          }

          _show_( '<table class="mdl-data-table mdl-js-data-table">
               <thead>
                    <tr>
                         <th class="mdl-data-table__cell--non-numeric">ICON</th>
                         <th class="mdl-data-table__cell--non-numeric">MENU</th>
                         <th class="mdl-data-table__cell--non-numeric">LINK</th>
                    </tr>
               </thead>
               <tbody>' );

          foreach ($menu as $menui) { ?>
          
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><a href="?edit=<?php _show_( $menui['h_code'] ); ?>&key=menu">
                         <i class="material-icons"><?php
              if ( $menui['h_avatar'] == "" ) {
                    $icon = 'edit';
               } else {
                    $icon = $menu[0]['h_avatar'];
                    } 
                    _show_( $icon ); ?></i></a>
                         </td>
                    <td class="mdl-data-table__cell--non-numeric"><?php _show_( $menui['h_alias'] ); ?></td>
                    <td class="mdl-data-table__cell--non-numeric"><?php _show_( $menui['h_link'] ); ?></td>
               </tr>
                    

     <?php } _show_( '
               </tbody>
          </table>' );
     } else {
          _show_( '<h1> No Menus Found</h1>');
     }
}

function headMenu( ) {
     $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_author !='jabali' AND h_location= 'header'");
     if ( $getMenu -> num_rows > 0 ) {
          while ($menus = mysqli_fetch_assoc( $getMenu )) {
               $menu[] = $menus; 
          }

          _show_( '<table class="mdl-data-table mdl-js-data-table">
               <thead>
                    <tr>
                         <th class="mdl-data-table__cell--non-numeric">ICON</th>
                         <th class="mdl-data-table__cell--non-numeric">MENU</th>
                         <th class="mdl-data-table__cell--non-numeric">LINK</th>
                    </tr>
               </thead>
               <tbody>' );

          foreach ($menu as $menui) { ?>
          
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><a href="?edit=<?php _show_( $menui['h_code'] ); ?>&key=menu">
                         <i class="material-icons"><?php
              if ( $menui['h_avatar'] == "" ) {
                    $icon = 'edit';
               } else {
                    $icon = $menu[0]['h_avatar'];
                    } 
                    _show_( $icon ); ?></i></a>
                         </td>
                    <td class="mdl-data-table__cell--non-numeric"><?php _show_( $menui['h_alias'] ); ?></td>
                    <td class="mdl-data-table__cell--non-numeric"><?php _show_( $menui['h_link'] ); ?></td>
               </tr>
                    

     <?php } _show_( '
               </tbody>
          </table>' );
     } else {
          _show_( '<h1> No Menus Found</h1>');
     }
}

function materialIcons($icon) {
     $material_icons = array(
          '3d_rotation' => '3d_rotation',
          'access_alarm' => 'access_alarm',
          'access_alarms' => 'access_alarms',
          'access_time' => 'access_time',
          'accessibility' => 'accessibility',
          'account_balance' => 'account_balance',
          'account_balance_wallet' => 'account_balance_wallet',
          'account_box' => 'account_box',
          'account_circle' => 'account_circle',
          'adb' => 'adb',
          'add' => 'add',
          'add_alarm' => 'add_alarm',
          'add_alert' => 'add_alert',
          'add_box' => 'add_box',
          'add_circle' => 'add_circle',
          'add_circle_outline' => 'add_circle_outline',
          'add_shopping_cart' => 'add_shopping_cart',
          'add_to_photos' => 'add_to_photos',
          'adjust' => 'adjust',
          'airline_seat_flat' => 'airline_seat_flat',
          'airline_seat_flat_angled' => 'airline_seat_flat_angled',
          'airline_seat_individual_suite' => 'airline_seat_individual_suite',
          'airline_seat_legroom_extra' => 'airline_seat_legroom_extra',
          'airline_seat_legroom_normal' => 'airline_seat_legroom_normal',
          'airline_seat_legroom_reduced' => 'airline_seat_legroom_reduced',
          'airline_seat_recline_extra' => 'airline_seat_recline_extra',
          'airline_seat_recline_normal' => 'airline_seat_recline_normal',
          'airplanemode_active' => 'airplanemode_active',
          'airplanemode_inactive' => 'airplanemode_inactive',
          'airplay' => 'airplay',
          'alarm' => 'alarm',
          'alarm_add' => 'alarm_add',
          'alarm_off' => 'alarm_off',
          'alarm_on' => 'alarm_on',
          'album' => 'album',
          'android' => 'android',
          'announcement' => 'announcement',
          'apps' => 'apps',
          'archive' => 'archive',
          'arrow_back' => 'arrow_back',
          'arrow_drop_down' => 'arrow_drop_down',
          'arrow_drop_down_circle' => 'arrow_drop_down_circle',
          'arrow_drop_up' => 'arrow_drop_up',
          'arrow_forward' => 'arrow_forward',
          'aspect_ratio' => 'aspect_ratio',
          'assessment' => 'assessment',
          'assignment' => 'assignment',
          'assignment_ind' => 'assignment_ind',
          'assignment_late' => 'assignment_late',
          'assignment_return' => 'assignment_return',
          'assignment_returned' => 'assignment_returned',
          'assignment_turned_in' => 'assignment_turned_in',
          'assistant' => 'assistant',
          'assistant_photo' => 'assistant_photo',
          'attach_file' => 'attach_file',
          'attach_money' => 'attach_money',
          'attachment' => 'attachment',
          'audiotrack' => 'audiotrack',
          'autorenew' => 'autorenew',
          'av_timer' => 'av_timer',
          'backspace' => 'backspace',
          'backup' => 'backup',
          'battery_alert' => 'battery_alert',
          'battery_charging_full' => 'battery_charging_full',
          'battery_full' => 'battery_full',
          'battery_std' => 'battery_std',
          'battery_unknown' => 'battery_unknown',
          'beenhere' => 'beenhere',
          'block' => 'block',
          'bluetooth' => 'bluetooth',
          'bluetooth_audio' => 'bluetooth_audio',
          'bluetooth_connected' => 'bluetooth_connected',
          'bluetooth_disabled' => 'bluetooth_disabled',
          'bluetooth_searching' => 'bluetooth_searching',
          'blur_circular' => 'blur_circular',
          'blur_linear' => 'blur_linear',
          'blur_off' => 'blur_off',
          'blur_on' => 'blur_on',
          'book' => 'book',
          'bookmark' => 'bookmark',
          'bookmark_border' => 'bookmark_border',
          'border_all' => 'border_all',
          'border_bottom' => 'border_bottom',
          'border_clear' => 'border_clear',
          'border_color' => 'border_color',
          'border_horizontal' => 'border_horizontal',
          'border_inner' => 'border_inner',
          'border_left' => 'border_left',
          'border_outer' => 'border_outer',
          'border_right' => 'border_right',
          'border_style' => 'border_style',
          'border_top' => 'border_top',
          'border_vertical' => 'border_vertical',
          'brightness_1' => 'brightness_1',
          'brightness_2' => 'brightness_2',
          'brightness_3' => 'brightness_3',
          'brightness_4' => 'brightness_4',
          'brightness_5' => 'brightness_5',
          'brightness_6' => 'brightness_6',
          'brightness_7' => 'brightness_7',
          'brightness_auto' => 'brightness_auto',
          'brightness_high' => 'brightness_high',
          'brightness_low' => 'brightness_low',
          'brightness_medium' => 'brightness_medium',
          'broken_image' => 'broken_image',
          'brush' => 'brush',
          'bug_report' => 'bug_report',
          'build' => 'build',
          'business' => 'business',
          'cached' => 'cached',
          'cake' => 'cake',
          'call' => 'call',
          'call_end' => 'call_end',
          'call_made' => 'call_made',
          'call_merge' => 'call_merge',
          'call_missed' => 'call_missed',
          'call_received' => 'call_received',
          'call_split' => 'call_split',
          'camera' => 'camera',
          'camera_alt' => 'camera_alt',
          'camera_enhance' => 'camera_enhance',
          'camera_front' => 'camera_front',
          'camera_rear' => 'camera_rear',
          'camera_roll' => 'camera_roll',
          'cancel' => 'cancel',
          'card_giftcard' => 'card_giftcard',
          'card_membership' => 'card_membership',
          'card_travel' => 'card_travel',
          'cast' => 'cast',
          'cast_connected' => 'cast_connected',
          'center_focus_strong' => 'center_focus_strong',
          'center_focus_weak' => 'center_focus_weak',
          'change_history' => 'change_history',
          'chat' => 'chat',
          'chat_bubble' => 'chat_bubble',
          'chat_bubble_outline' => 'chat_bubble_outline',
          'check' => 'check',
          'check_box' => 'check_box',
          'check_box_outline_blank' => 'check_box_outline_blank',
          'check_circle' => 'check_circle',
          'chevron_left' => 'chevron_left',
          'chevron_right' => 'chevron_right',
          'chrome_reader_mode' => 'chrome_reader_mode',
          'class' => 'class',
          'clear' => 'clear',
          'clear_all' => 'clear_all',
          'close' => 'close',
          'closed_caption' => 'closed_caption',
          'cloud' => 'cloud',
          'cloud_circle' => 'cloud_circle',
          'cloud_done' => 'cloud_done',
          'cloud_download' => 'cloud_download',
          'cloud_off' => 'cloud_off',
          'cloud_queue' => 'cloud_queue',
          'cloud_upload' => 'cloud_upload',
          'code' => 'code',
          'collections' => 'collections',
          'collections_bookmark' => 'collections_bookmark',
          'color_lens' => 'color_lens',
          'colorize' => 'colorize',
          'comment' => 'comment',
          'compare' => 'compare',
          'computer' => 'computer',
          'confirmation_number' => 'confirmation_number',
          'contact_phone' => 'contact_phone',
          'contacts' => 'contacts',
          'content_copy' => 'content_copy',
          'content_cut' => 'content_cut',
          'content_paste' => 'content_paste',
          'control_point' => 'control_point',
          'control_point_duplicate' => 'control_point_duplicate',
          'create' => 'create',
          'credit_card' => 'credit_card',
          'crop' => 'crop',
          'crop_16_9' => 'crop_16_9',
          'crop_3_2' => 'crop_3_2',
          'crop_5_4' => 'crop_5_4',
          'crop_7_5' => 'crop_7_5',
          'crop_din' => 'crop_din',
          'crop_free' => 'crop_free',
          'crop_landscape' => 'crop_landscape',
          'crop_original' => 'crop_original',
          'crop_portrait' => 'crop_portrait',
          'crop_square' => 'crop_square',
          'dashboard' => 'dashboard',
          'data_usage' => 'data_usage',
          'dehaze' => 'dehaze',
          'delete' => 'delete',
          'description' => 'description',
          'desktop_mac' => 'desktop_mac',
          'desktop_windows' => 'desktop_windows',
          'details' => 'details',
          'developer_board' => 'developer_board',
          'developer_mode' => 'developer_mode',
          'device_hub' => 'device_hub',
          'devices' => 'devices',
          'dialer_sip' => 'dialer_sip',
          'dialpad' => 'dialpad',
          'directions' => 'directions',
          'directions_bike' => 'directions_bike',
          'directions_boat' => 'directions_boat',
          'directions_bus' => 'directions_bus',
          'directions_car' => 'directions_car',
          'directions_railway' => 'directions_railway',
          'directions_run' => 'directions_run',
          'directions_subway' => 'directions_subway',
          'directions_transit' => 'directions_transit',
          'directions_walk' => 'directions_walk',
          'disc_full' => 'disc_full',
          'dns' => 'dns',
          'do_not_disturb' => 'do_not_disturb',
          'do_not_disturb_alt' => 'do_not_disturb_alt',
          'dock' => 'dock',
          'domain' => 'domain',
          'done' => 'done',
          'done_all' => 'done_all',
          'drafts' => 'drafts',
          'drive_eta' => 'drive_eta',
          'dvr' => 'dvr',
          'edit' => 'edit',
          'eject' => 'eject',
          'email' => 'email',
          'equalizer' => 'equalizer',
          'error' => 'error',
          'error_outline' => 'error_outline',
          'event' => 'event',
          'event_available' => 'event_available',
          'event_busy' => 'event_busy',
          'event_note' => 'event_note',
          'event_seat' => 'event_seat',
          'exit_to_app' => 'exit_to_app',
          'expand_less' => 'expand_less',
          'expand_more' => 'expand_more',
          'explicit' => 'explicit',
          'explore' => 'explore',
          'exposure' => 'exposure',
          'exposure_neg_1' => 'exposure_neg_1',
          'exposure_neg_2' => 'exposure_neg_2',
          'exposure_plus_1' => 'exposure_plus_1',
          'exposure_plus_2' => 'exposure_plus_2',
          'exposure_zero' => 'exposure_zero',
          'extension' => 'extension',
          'face' => 'face',
          'fast_forward' => 'fast_forward',
          'fast_rewind' => 'fast_rewind',
          'favorite' => 'favorite',
          'favorite_border' => 'favorite_border',
          'feedback' => 'feedback',
          'file_download' => 'file_download',
          'file_upload' => 'file_upload',
          'filter' => 'filter',
          'filter_1' => 'filter_1',
          'filter_2' => 'filter_2',
          'filter_3' => 'filter_3',
          'filter_4' => 'filter_4',
          'filter_5' => 'filter_5',
          'filter_6' => 'filter_6',
          'filter_7' => 'filter_7',
          'filter_8' => 'filter_8',
          'filter_9' => 'filter_9',
          'filter_9_plus' => 'filter_9_plus',
          'filter_b_and_w' => 'filter_b_and_w',
          'filter_center_focus' => 'filter_center_focus',
          'filter_drama' => 'filter_drama',
          'filter_frames' => 'filter_frames',
          'filter_hdr' => 'filter_hdr',
          'filter_list' => 'filter_list',
          'filter_none' => 'filter_none',
          'filter_tilt_shift' => 'filter_tilt_shift',
          'filter_vintage' => 'filter_vintage',
          'find_in_page' => 'find_in_page',
          'find_replace' => 'find_replace',
          'flag' => 'flag',
          'flare' => 'flare',
          'flash_auto' => 'flash_auto',
          'flash_off' => 'flash_off',
          'flash_on' => 'flash_on',
          'flight' => 'flight',
          'flight_land' => 'flight_land',
          'flight_takeoff' => 'flight_takeoff',
          'flip' => 'flip',
          'flip_to_back' => 'flip_to_back',
          'flip_to_front' => 'flip_to_front',
          'folder' => 'folder',
          'folder_open' => 'folder_open',
          'folder_shared' => 'folder_shared',
          'folder_special' => 'folder_special',
          'font_download' => 'font_download',
          'format_align_center' => 'format_align_center',
          'format_align_justify' => 'format_align_justify',
          'format_align_left' => 'format_align_left',
          'format_align_right' => 'format_align_right',
          'format_bold' => 'format_bold',
          'format_clear' => 'format_clear',
          'format_color_fill' => 'format_color_fill',
          'format_color_reset' => 'format_color_reset',
          'format_color_text' => 'format_color_text',
          'format_indent_decrease' => 'format_indent_decrease',
          'format_indent_increase' => 'format_indent_increase',
          'format_italic' => 'format_italic',
          'format_line_spacing' => 'format_line_spacing',
          'format_list_bulleted' => 'format_list_bulleted',
          'format_list_numbered' => 'format_list_numbered',
          'format_paint' => 'format_paint',
          'format_quote' => 'format_quote',
          'format_size' => 'format_size',
          'format_strikethrough' => 'format_strikethrough',
          'format_textdirection_l_to_r' => 'format_textdirection_l_to_r',
          'format_textdirection_r_to_l' => 'format_textdirection_r_to_l',
          'format_underlined' => 'format_underlined',
          'forum' => 'forum',
          'forward' => 'forward',
          'forward_10' => 'forward_10',
          'forward_30' => 'forward_30',
          'forward_5' => 'forward_5',
          'fullscreen' => 'fullscreen',
          'fullscreen_exit' => 'fullscreen_exit',
          'functions' => 'functions',
          'gamepad' => 'gamepad',
          'games' => 'games',
          'gesture' => 'gesture',
          'get_app' => 'get_app',
          'gif' => 'gif',
          'gps_fixed' => 'gps_fixed',
          'gps_not_fixed' => 'gps_not_fixed',
          'gps_off' => 'gps_off',
          'grade' => 'grade',
          'gradient' => 'gradient',
          'grain' => 'grain',
          'graphic_eq' => 'graphic_eq',
          'grid_off' => 'grid_off',
          'grid_on' => 'grid_on',
          'group' => 'group',
          'group_add' => 'group_add',
          'group_work' => 'group_work',
          'hd' => 'hd',
          'hdr_off' => 'hdr_off',
          'hdr_on' => 'hdr_on',
          'hdr_strong' => 'hdr_strong',
          'hdr_weak' => 'hdr_weak',
          'headset' => 'headset',
          'headset_mic' => 'headset_mic',
          'healing' => 'healing',
          'hearing' => 'hearing',
          'help' => 'help',
          'help_outline' => 'help_outline',
          'high_quality' => 'high_quality',
          'highlight_off' => 'highlight_off',
          'history' => 'history',
          'home' => 'home',
          'hotel' => 'hotel',
          'hourglass_empty' => 'hourglass_empty',
          'hourglass_full' => 'hourglass_full',
          'http' => 'http',
          'https' => 'https',
          'image' => 'image',
          'image_aspect_ratio' => 'image_aspect_ratio',
          'import_export' => 'import_export',
          'inbox' => 'inbox',
          'indeterminate_check_box' => 'indeterminate_check_box',
          'info' => 'info',
          'info_outline' => 'info_outline',
          'input' => 'input',
          'insert_chart' => 'insert_chart',
          'insert_comment' => 'insert_comment',
          'insert_drive_file' => 'insert_drive_file',
          'insert_emoticon' => 'insert_emoticon',
          'insert_invitation' => 'insert_invitation',
          'insert_link' => 'insert_link',
          'insert_photo' => 'insert_photo',
          'invert_colors' => 'invert_colors',
          'invert_colors_off' => 'invert_colors_off',
          'iso' => 'iso',
          'keyboard' => 'keyboard',
          'keyboard_arrow_down' => 'keyboard_arrow_down',
          'keyboard_arrow_left' => 'keyboard_arrow_left',
          'keyboard_arrow_right' => 'keyboard_arrow_right',
          'keyboard_arrow_up' => 'keyboard_arrow_up',
          'keyboard_backspace' => 'keyboard_backspace',
          'keyboard_capslock' => 'keyboard_capslock',
          'keyboard_hide' => 'keyboard_hide',
          'keyboard_return' => 'keyboard_return',
          'keyboard_tab' => 'keyboard_tab',
          'keyboard_voice' => 'keyboard_voice',
          'label' => 'label',
          'label_outline' => 'label_outline',
          'landscape' => 'landscape',
          'language' => 'language',
          'laptop' => 'laptop',
          'laptop_chromebook' => 'laptop_chromebook',
          'laptop_mac' => 'laptop_mac',
          'laptop_windows' => 'laptop_windows',
          'launch' => 'launch',
          'layers' => 'layers',
          'layers_clear' => 'layers_clear',
          'leak_add' => 'leak_add',
          'leak_remove' => 'leak_remove',
          'lens' => 'lens',
          'library_add' => 'library_add',
          'library_books' => 'library_books',
          'library_music' => 'library_music',
          'link' => 'link',
          'list' => 'list',
          'live_help' => 'live_help',
          'live_tv' => 'live_tv',
          'local_activity' => 'local_activity',
          'local_airport' => 'local_airport',
          'local_atm' => 'local_atm',
          'local_bar' => 'local_bar',
          'local_cafe' => 'local_cafe',
          'local_car_wash' => 'local_car_wash',
          'local_convenience_store' => 'local_convenience_store',
          'local_dining' => 'local_dining',
          'local_drink' => 'local_drink',
          'local_florist' => 'local_florist',
          'local_gas_station' => 'local_gas_station',
          'local_grocery_store' => 'local_grocery_store',
          'local_hospital' => 'local_hospital',
          'local_hotel' => 'local_hotel',
          'local_laundry_service' => 'local_laundry_service',
          'local_library' => 'local_library',
          'local_mall' => 'local_mall',
          'local_movies' => 'local_movies',
          'local_offer' => 'local_offer',
          'local_parking' => 'local_parking',
          'local_pharmacy' => 'local_pharmacy',
          'local_phone' => 'local_phone',
          'local_pizza' => 'local_pizza',
          'local_play' => 'local_play',
          'local_post_office' => 'local_post_office',
          'local_printshop' => 'local_printshop',
          'local_see' => 'local_see',
          'local_shipping' => 'local_shipping',
          'local_taxi' => 'local_taxi',
          'location_city' => 'location_city',
          'location_disabled' => 'location_disabled',
          'location_off' => 'location_off',
          'location_on' => 'location_on',
          'location_searching' => 'location_searching',
          'lock' => 'lock',
          'lock_open' => 'lock_open',
          'lock_outline' => 'lock_outline',
          'looks' => 'looks',
          'looks_3' => 'looks_3',
          'looks_4' => 'looks_4',
          'looks_5' => 'looks_5',
          'looks_6' => 'looks_6',
          'looks_one' => 'looks_one',
          'looks_two' => 'looks_two',
          'loop' => 'loop',
          'loupe' => 'loupe',
          'loyalty' => 'loyalty',
          'mail' => 'mail',
          'map' => 'map',
          'markunread' => 'markunread',
          'markunread_mailbox' => 'markunread_mailbox',
          'memory' => 'memory',
          'menu' => 'menu',
          'merge_type' => 'merge_type',
          'message' => 'message',
          'mic' => 'mic',
          'mic_none' => 'mic_none',
          'mic_off' => 'mic_off',
          'mms' => 'mms',
          'mode_comment' => 'mode_comment',
          'mode_edit' => 'mode_edit',
          'money_off' => 'money_off',
          'monochrome_photos' => 'monochrome_photos',
          'mood' => 'mood',
          'mood_bad' => 'mood_bad',
          'more' => 'more',
          'more_horiz' => 'more_horiz',
          'more_vert' => 'more_vert',
          'mouse' => 'mouse',
          'movie' => 'movie',
          'movie_creation' => 'movie_creation',
          'music_note' => 'music_note',
          'my_location' => 'my_location',
          'nature' => 'nature',
          'nature_people' => 'nature_people',
          'navigate_before' => 'navigate_before',
          'navigate_next' => 'navigate_next',
          'navigation' => 'navigation',
          'network_cell' => 'network_cell',
          'network_locked' => 'network_locked',
          'network_wifi' => 'network_wifi',
          'new_releases' => 'new_releases',
          'nfc' => 'nfc',
          'no_sim' => 'no_sim',
          'not_interested' => 'not_interested',
          'note_add' => 'note_add',
          'notifications' => 'notifications',
          'notifications_active' => 'notifications_active',
          'notifications_none' => 'notifications_none',
          'notifications_off' => 'notifications_off',
          'notifications_paused' => 'notifications_paused',
          'offline_pin' => 'offline_pin',
          'ondemand_video' => 'ondemand_video',
          'open_in_browser' => 'open_in_browser',
          'open_in_new' => 'open_in_new',
          'open_with' => 'open_with',
          'pages' => 'pages',
          'pageview' => 'pageview',
          'palette' => 'palette',
          'panorama' => 'panorama',
          'panorama_fish_eye' => 'panorama_fish_eye',
          'panorama_horizontal' => 'panorama_horizontal',
          'panorama_vertical' => 'panorama_vertical',
          'panorama_wide_angle' => 'panorama_wide_angle',
          'party_mode' => 'party_mode',
          'pause' => 'pause',
          'pause_circle_filled' => 'pause_circle_filled',
          'pause_circle_outline' => 'pause_circle_outline',
          'payment' => 'payment',
          'people' => 'people',
          'people_outline' => 'people_outline',
          'perm_camera_mic' => 'perm_camera_mic',
          'perm_contact_calendar' => 'perm_contact_calendar',
          'perm_data_setting' => 'perm_data_setting',
          'perm_device_information' => 'perm_device_information',
          'perm_identity' => 'perm_identity',
          'perm_media' => 'perm_media',
          'perm_phone_msg' => 'perm_phone_msg',
          'perm_scan_wifi' => 'perm_scan_wifi',
          'person' => 'person',
          'person_add' => 'person_add',
          'person_outline' => 'person_outline',
          'person_pin' => 'person_pin',
          'personal_video' => 'personal_video',
          'phone' => 'phone',
          'phone_android' => 'phone_android',
          'phone_bluetooth_speaker' => 'phone_bluetooth_speaker',
          'phone_forwarded' => 'phone_forwarded',
          'phone_in_talk' => 'phone_in_talk',
          'phone_iphone' => 'phone_iphone',
          'phone_locked' => 'phone_locked',
          'phone_missed' => 'phone_missed',
          'phone_paused' => 'phone_paused',
          'phonelink' => 'phonelink',
          'phonelink_erase' => 'phonelink_erase',
          'phonelink_lock' => 'phonelink_lock',
          'phonelink_off' => 'phonelink_off',
          'phonelink_ring' => 'phonelink_ring',
          'phonelink_setup' => 'phonelink_setup',
          'photo' => 'photo',
          'photo_album' => 'photo_album',
          'photo_camera' => 'photo_camera',
          'photo_library' => 'photo_library',
          'photo_size_select_actual' => 'photo_size_select_actual',
          'photo_size_select_large' => 'photo_size_select_large',
          'photo_size_select_small' => 'photo_size_select_small',
          'picture_as_pdf' => 'picture_as_pdf',
          'picture_in_picture' => 'picture_in_picture',
          'pin_drop' => 'pin_drop',
          'place' => 'place',
          'play_arrow' => 'play_arrow',
          'play_circle_filled' => 'play_circle_filled',
          'play_circle_outline' => 'play_circle_outline',
          'play_for_work' => 'play_for_work',
          'playlist_add' => 'playlist_add',
          'plus_one' => 'plus_one',
          'poll' => 'poll',
          'polymer' => 'polymer',
          'portable_wifi_off' => 'portable_wifi_off',
          'portrait' => 'portrait',
          'power' => 'power',
          'power_input' => 'power_input',
          'power_settings_new' => 'power_settings_new',
          'present_to_all' => 'present_to_all',
          'print' => 'print',
          'public' => 'public',
          'publish' => 'publish',
          'query_builder' => 'query_builder',
          'question_answer' => 'question_answer',
          'queue' => 'queue',
          'queue_music' => 'queue_music',
          'radio' => 'radio',
          'radio_button_checked' => 'radio_button_checked',
          'radio_button_unchecked' => 'radio_button_unchecked',
          'rate_review' => 'rate_review',
          'receipt' => 'receipt',
          'recent_actors' => 'recent_actors',
          'redeem' => 'redeem',
          'redo' => 'redo',
          'refresh' => 'refresh',
          'remove' => 'remove',
          'remove_circle' => 'remove_circle',
          'remove_circle_outline' => 'remove_circle_outline',
          'remove_red_eye' => 'remove_red_eye',
          'reorder' => 'reorder',
          'repeat' => 'repeat',
          'repeat_one' => 'repeat_one',
          'replay' => 'replay',
          'replay_10' => 'replay_10',
          'replay_30' => 'replay_30',
          'replay_5' => 'replay_5',
          'reply' => 'reply',
          'reply_all' => 'reply_all',
          'report' => 'report',
          'report_problem' => 'report_problem',
          'restaurant_menu' => 'restaurant_menu',
          'restore' => 'restore',
          'ring_volume' => 'ring_volume',
          'room' => 'room',
          'rotate_90_degrees_ccw' => 'rotate_90_degrees_ccw',
          'rotate_left' => 'rotate_left',
          'rotate_right' => 'rotate_right',
          'router' => 'router',
          'satellite' => 'satellite',
          'save' => 'save',
          'scanner' => 'scanner',
          'schedule' => 'schedule',
          'school' => 'school',
          'screen_lock_landscape' => 'screen_lock_landscape',
          'screen_lock_portrait' => 'screen_lock_portrait',
          'screen_lock_rotation' => 'screen_lock_rotation',
          'screen_rotation' => 'screen_rotation',
          'sd_card' => 'sd_card',
          'sd_storage' => 'sd_storage',
          'search' => 'search',
          'security' => 'security',
          'select_all' => 'select_all',
          'send' => 'send',
          'settings' => 'settings',
          'settings_applications' => 'settings_applications',
          'settings_backup_restore' => 'settings_backup_restore',
          'settings_bluetooth' => 'settings_bluetooth',
          'settings_brightness' => 'settings_brightness',
          'settings_cell' => 'settings_cell',
          'settings_ethernet' => 'settings_ethernet',
          'settings_input_antenna' => 'settings_input_antenna',
          'settings_input_component' => 'settings_input_component',
          'settings_input_composite' => 'settings_input_composite',
          'settings_input_hdmi' => 'settings_input_hdmi',
          'settings_input_svideo' => 'settings_input_svideo',
          'settings_overscan' => 'settings_overscan',
          'settings_phone' => 'settings_phone',
          'settings_power' => 'settings_power',
          'settings_remote' => 'settings_remote',
          'settings_system_daydream' => 'settings_system_daydream',
          'settings_voice' => 'settings_voice',
          'share' => 'share',
          'shop' => 'shop',
          'shop_two' => 'shop_two',
          'shopping_basket' => 'shopping_basket',
          'shopping_cart' => 'shopping_cart',
          'shuffle' => 'shuffle',
          'signal_cellular_4_bar' => 'signal_cellular_4_bar',
          'signal_cellular_connected_no_internet_4_bar' => 'signal_cellular_connected_no_internet_4_bar',
          'signal_cellular_no_sim' => 'signal_cellular_no_sim',
          'signal_cellular_null' => 'signal_cellular_null',
          'signal_cellular_off' => 'signal_cellular_off',
          'signal_wifi_4_bar' => 'signal_wifi_4_bar',
          'signal_wifi_4_bar_lock' => 'signal_wifi_4_bar_lock',
          'signal_wifi_off' => 'signal_wifi_off',
          'sim_card' => 'sim_card',
          'sim_card_alert' => 'sim_card_alert',
          'skip_next' => 'skip_next',
          'skip_previous' => 'skip_previous',
          'slideshow' => 'slideshow',
          'smartphone' => 'smartphone',
          'sms' => 'sms',
          'sms_failed' => 'sms_failed',
          'snooze' => 'snooze',
          'sort' => 'sort',
          'sort_by_alpha' => 'sort_by_alpha',
          'space_bar' => 'space_bar',
          'speaker' => 'speaker',
          'speaker_group' => 'speaker_group',
          'speaker_notes' => 'speaker_notes',
          'speaker_phone' => 'speaker_phone',
          'spellcheck' => 'spellcheck',
          'star' => 'star',
          'star_border' => 'star_border',
          'star_half' => 'star_half',
          'stars' => 'stars',
          'stay_current_landscape' => 'stay_current_landscape',
          'stay_current_portrait' => 'stay_current_portrait',
          'stay_primary_landscape' => 'stay_primary_landscape',
          'stay_primary_portrait' => 'stay_primary_portrait',
          'stop' => 'stop',
          'storage' => 'storage',
          'store' => 'store',
          'store_mall_directory' => 'store_mall_directory',
          'straighten' => 'straighten',
          'strikethrough_s' => 'strikethrough_s',
          'style' => 'style',
          'subject' => 'subject',
          'subtitles' => 'subtitles',
          'supervisor_account' => 'supervisor_account',
          'surround_sound' => 'surround_sound',
          'swap_calls' => 'swap_calls',
          'swap_horiz' => 'swap_horiz',
          'swap_vert' => 'swap_vert',
          'swap_vertical_circle' => 'swap_vertical_circle',
          'switch_camera' => 'switch_camera',
          'switch_video' => 'switch_video',
          'sync' => 'sync',
          'sync_disabled' => 'sync_disabled',
          'sync_problem' => 'sync_problem',
          'system_update' => 'system_update',
          'system_update_alt' => 'system_update_alt',
          'tab' => 'tab',
          'tab_unselected' => 'tab_unselected',
          'tablet' => 'tablet',
          'tablet_android' => 'tablet_android',
          'tablet_mac' => 'tablet_mac',
          'tag_faces' => 'tag_faces',
          'tap_and_play' => 'tap_and_play',
          'terrain' => 'terrain',
          'text_format' => 'text_format',
          'textsms' => 'textsms',
          'texture' => 'texture',
          'theaters' => 'theaters',
          'thumb_down' => 'thumb_down',
          'thumb_up' => 'thumb_up',
          'thumbs_up_down' => 'thumbs_up_down',
          'time_to_leave' => 'time_to_leave',
          'timelapse' => 'timelapse',
          'timer' => 'timer',
          'timer_10' => 'timer_10',
          'timer_3' => 'timer_3',
          'timer_off' => 'timer_off',
          'toc' => 'toc',
          'today' => 'today',
          'toll' => 'toll',
          'tonality' => 'tonality',
          'toys' => 'toys',
          'track_changes' => 'track_changes',
          'traffic' => 'traffic',
          'transform' => 'transform',
          'translate' => 'translate',
          'trending_down' => 'trending_down',
          'trending_flat' => 'trending_flat',
          'trending_up' => 'trending_up',
          'tune' => 'tune',
          'turned_in' => 'turned_in',
          'turned_in_not' => 'turned_in_not',
          'tv' => 'tv',
          'undo' => 'undo',
          'unfold_less' => 'unfold_less',
          'unfold_more' => 'unfold_more',
          'usb' => 'usb',
          'verified_user' => 'verified_user',
          'vertical_align_bottom' => 'vertical_align_bottom',
          'vertical_align_center' => 'vertical_align_center',
          'vertical_align_top' => 'vertical_align_top',
          'vibration' => 'vibration',
          'video_library' => 'video_library',
          'videocam' => 'videocam',
          'videocam_off' => 'videocam_off',
          'view_agenda' => 'view_agenda',
          'view_array' => 'view_array',
          'view_carousel' => 'view_carousel',
          'view_column' => 'view_column',
          'view_comfy' => 'view_comfy',
          'view_compact' => 'view_compact',
          'view_day' => 'view_day',
          'view_headline' => 'view_headline',
          'view_list' => 'view_list',
          'view_module' => 'view_module',
          'view_quilt' => 'view_quilt',
          'view_stream' => 'view_stream',
          'view_week' => 'view_week',
          'vignette' => 'vignette',
          'visibility' => 'visibility',
          'visibility_off' => 'visibility_off',
          'voice_chat' => 'voice_chat',
          'voicemail' => 'voicemail',
          'volume_down' => 'volume_down',
          'volume_mute' => 'volume_mute',
          'volume_off' => 'volume_off',
          'volume_up' => 'volume_up',
          'vpn_key' => 'vpn_key',
          'vpn_lock' => 'vpn_lock',
          'wallpaper' => 'wallpaper',
          'warning' => 'warning',
          'watch' => 'watch',
          'wb_auto' => 'wb_auto',
          'wb_cloudy' => 'wb_cloudy',
          'wb_incandescent' => 'wb_incandescent',
          'wb_iridescent' => 'wb_iridescent',
          'wb_sunny' => 'wb_sunny',
          'wc' => 'wc',
          'web' => 'web',
          'whatshot' => 'whatshot',
          'widgets' => 'widgets',
          'wifi' => 'wifi',
          'wifi_lock' => 'wifi_lock',
          'wifi_tethering' => 'wifi_tethering',
          'work' => 'work',
          'wrap_text' => 'wrap_text',
          'youtube_searched_for' => 'youtube_searched_for',
          'zoom_in' => 'zoom_in',
          'zoom_out' => 'zoom_out',
        );
        ?>
        <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select">
          <i class="material-icons prefix"><?php if( $icon !=="" ) {
               _show_( $icon ); } else { _show_( 'code' ); } ?></i>
         <input class="mdl-textfield__input" id="h_icon" name="h_avatar" type="text" readonly tabIndex="-1"  placeholder="Select Icon" <?php if( $icon !=="" ) {
               _show_( 'value="'.$icon.'"' ); } ?>>
           <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_icon" style="max-height: 300px !important; overflow-y: auto;"><?php
           foreach ($material_icons as $key => $value) {
             echo '<li class="mdl-menu__item" data-val="'.$key.'"><i class="material-icons">'.$key.'</i></li>'; } ?>
           </ul>
        </div><?php
}

} ?>
