<div class="booked-settings-wrap wrap"><?php
	
	if (get_transient('booked_show_new_tags',false)):
		$show_new_tags = true;
	else:
		$show_new_tags = false;
	endif;
	
	$calendars = get_terms('booked_custom_calendars','orderby=slug&hide_empty=0');
	$booked_none_assigned = true;
	$default_calendar_id = false;
								
	if (!empty($calendars)):
	
		if (!current_user_can('manage_booked_options')):
		
			$booked_current_user = wp_get_current_user();
			$calendars = booked_filter_agent_calendars($booked_current_user,$calendars);
			
			if (empty($calendars)):
				$booked_none_assigned = true;
			else:
				$first_calendar = array_slice($calendars, 0, 1);
				$default_calendar_id = array_shift($first_calendar)->term_id;
				$booked_none_assigned = false;
			endif;
		
		else:
			$booked_none_assigned = false;
		endif;
		
	endif;
	
	if (!current_user_can('manage_booked_options') && $booked_none_assigned):
		
		echo '<div style="text-align:center;">';
			echo '<br><br><h3>'.__('There are no calendars assigned to you.','booked').'</h3>';
			echo '<p>'.__('Get in touch with the Administration of this site to get a calendar assigned to you.','booked').'</p>';
		echo '</div>';
		
	else:
	
		settings_errors(); ?>
	
		<div class="topSavingState savingState"><i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;<?php _e('Updating, please wait...','booked'); ?></div>
	
		<div class="booked-settings-title"><?php _e('Appointment Settings','booked'); ?><a class="booked-header-tiny-link" href="<?php echo get_admin_url(); ?>admin.php?page=booked-welcome"><?php echo sprintf(__('What\'s new in %s?','booked'),BOOKED_VERSION); ?></a></div>
	
		<div id="booked-admin-panel-container">
	
			<div id="data-ajax-url"><?php echo get_admin_url(); ?></div>
			
			<?php $booked_settings_tabs = array(
				array(
					'access' => 'admin',
					'slug' => 'general',
					'content' => '<i class="fa fa-gear"></i>&nbsp;&nbsp;'.__('General','booked')),
				array(
					'access' => 'admin',
					'slug' => 'user-emails',
					'content' => '<i class="fa fa-envelope"></i>&nbsp;&nbsp;'.__('User Emails','booked')),
				array(
					'access' => 'admin',
					'slug' => 'admin-emails',
					'content' => '<i class="fa fa-envelope-o"></i>&nbsp;&nbsp;'.__('Admin Emails','booked')),
				array(
					'access' => 'agent',
					'slug' => 'defaults',
					'content' => '<i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.__('Time Slots','booked').'<span class="savingState">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh fa-spin"></i></span>'),
				array(
					'access' => 'agent',
					'slug' => 'custom-timeslots',
					'content' => '<i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.__('Custom Time Slots','booked').'<span class="savingState">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh fa-spin"></i></span>'),
				array(
					'access' => 'agent',
					'slug' => 'custom-fields',
					'content' => '<i class="fa fa-pencil"></i>&nbsp;&nbsp;'.__('Custom Fields','booked')),
				array(
					'access' => 'admin',
					'slug' => 'export-appointments',
					'content' => '<i class="fa fa-external-link-square"></i>&nbsp;&nbsp;'.__('Export','booked')),
				array(
					'access' => 'admin',
					'slug' => 'shortcodes',
					'content' => '<i class="fa fa-code"></i>&nbsp;&nbsp;'.__('Shortcodes','booked')),
			);
			
			$tab_counter = 1;
			
			$new_items_in_tabs = array();
				
			foreach($booked_settings_tabs as $tab_data):
				if ($tab_data['access'] == 'admin' && current_user_can('manage_booked_options') || $tab_data['access'] == 'agent'):
					if ($tab_counter == 1): ?><ul class="booked-admin-tabs bookedClearFix"><?php endif;
					?><li<?php if ($tab_counter == 1): ?> class="active"<?php endif; ?>><a href="#<?php echo $tab_data['slug']; ?>"><?php echo $tab_data['content']; ?><?php if (in_array($tab_data['slug'],$new_items_in_tabs)): booked_new_tag($show_new_tags); endif; ?></a></li><?php
					$tab_counter++;
				endif;
			endforeach;
			
			?></ul>
	
			<div class="form-wrapper">
				
				<?php foreach($booked_settings_tabs as $tab_data):
					
					if ($tab_data['access'] == 'admin' && current_user_can('manage_booked_options') || $tab_data['access'] == 'agent'):
					
						switch ($tab_data['slug']):
						
							case 'general': ?>
							
								<form action="options.php" class="booked-settings-form" method="post">
	
									<?php settings_fields('booked_plugin-group'); ?>
					
									<div id="booked-general" class="tab-content">
											
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Booking Type', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('You have the option to choose between "Registered" and "Guest" booking. Registered booking will require all appointments to be booked by a registered user (default). Guest booking will allow anyone with a name and email address to book an appointment.','booked'); ?></p>
					
												<?php $option_name = 'booked_booking_type';
												$booking_type = get_option($option_name,'registered'); ?>
												<div class="select-box">
													<select data-condition="booking_type" name="<?php echo $option_name; ?>">
														<option value="registered"<?php echo ($booking_type == 'registered' ? ' selected="selected"' : ''); ?>><?php _e('Registered Booking','booked'); ?></option>
														<option value="guest"<?php echo ($booking_type == 'guest' ? ' selected="selected"' : ''); ?>><?php _e('Guest Booking','booked'); ?></option>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
										
										<?php $selected_value = get_option('booked_require_guest_email_address',false); ?>
										<div class="condition-block booking_type" id="condition-guest" style="<?php if ($booking_type == 'guest'): ?>display:block; <?php endif; ?>">
											<div class="section-row">
												<div class="section-head">
												
												<?php $section_title = __('Guest Booking Options', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
											
												<p style="margin:1.2em 0 10px;">
													<input style="margin:-4px 5px 0 0;" id="booked_require_guest_email_address" name="booked_require_guest_email_address" value="true"<?php if ($selected_value): echo ' checked="checked"'; endif; ?> type="checkbox">
													<label class="checkbox-radio-label" for="booked_require_guest_email_address"><strong><?php _e('Require Email Address','booked'); ?></strong> &mdash; <?php _e('Require your guests to enter their email address.','booked'); ?></label>
												</p>
												
												</div>
											</div>
										</div>
										
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Appointment Booking Redirect', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												
												<?php $option_name = 'booked_appointment_redirect_type'; $selected_value = get_option($option_name,false);
													
												$booked_redirect_type = $selected_value;
												
												$detected_page_error = false;
												$detected_page = booked_get_profile_page();
												if (!$detected_page):
													$detected_page_error = true;
												endif; ?>
												
												<p style="margin:1.2em 0 10px;"><input style="margin:-4px 5px 0 0;" data-condition="redirect_type" id="redirect_type_none" name="<?php echo $option_name; ?>" value=""<?php if (!$selected_value): echo ' checked="checked"'; endif; ?> type="radio">
												<label class="checkbox-radio-label" for="redirect_type_none"><?php _e('<strong>No Redirect</strong> &mdash; Refresh the calendar list after booking.','booked'); ?></label></p>
												
												<div class="condition-block booking_type" id="condition-registered" style="<?php if ($booking_type == 'registered'): ?>display:block; <?php endif; ?>">
													<p style="margin:0 0 10px;">
														<input style="margin:-4px 5px 0 0;" data-condition="redirect_type" id="redirect_type_detect" name="<?php echo $option_name; ?>" value="booked-profile"<?php if ($selected_value == 'booked-profile'): echo ' checked="checked"'; endif; ?> type="radio">
														<label class="checkbox-radio-label" for="redirect_type_detect"><?php _e('<strong>Auto-Detect Profile Page</strong> &mdash; Auto-detect the page with the [booked-profile] shortcode.','booked'); ?><?php if (!$detected_page_error && $detected_page): ?>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;<strong><?php echo sprintf(__('Detected Page: %s','booked'),'<a href="'.get_permalink($detected_page).'">'.get_permalink($detected_page).'</a>'); ?></strong><?php endif; ?></label>
													</p>
												</div>
												
												<?php if ($detected_page_error): ?>
												<div style="margin:0 0 10px;">
													<div class="condition-block redirect_type" id="condition-booked-profile" style="<?php if ($booked_redirect_type == 'booked-profile'): ?>display:block; <?php endif; ?>line-height:30px; padding:0 0 0 30px; margin:-5px 0 10px;"><?php echo sprintf(__( '%s We were not able to auto-detect. You need to %s with the %s shortcode.','booked' ),'<strong style="color:#DB5933;">'.__('Important:','booked').'</strong>','<strong><a href="'.get_admin_url().'post-new.php?post_type=page">'.__('create a page','booked').'</a></strong>','<code>[booked-profile]</code>'); ?></div>
												</div>
												<?php endif; ?>
												
												
												<p style="margin:0;">
													<input style="margin:-4px 5px 0 0;" data-condition="redirect_type" id="redirect_type_page" name="<?php echo $option_name; ?>" value="page"<?php if ($selected_value == 'page'): echo ' checked="checked"'; endif; ?> type="radio">
													<label class="checkbox-radio-label" for="redirect_type_page"><?php _e('<strong>Choose Specific Page</strong> &mdash; Choose a redirect page.','booked'); ?></label>
												</p>
												
												<?php $option_name = 'booked_appointment_success_redirect_page';
					
												$pages = get_posts(array(
													'post_type' => 'page',
													'orderby'	=> 'name',
													'order'		=> 'asc',
													'posts_per_page' => -1
												));
					
												$selected_value = get_option($option_name); ?>
												<div style="padding:15px 0 0 0;" class="condition-block redirect_type select-box<?php if ($booked_redirect_type == 'page'): ?> default<?php endif; ?>" id="condition-page">
													<select name="<?php echo $option_name; ?>">
														<option value=""<?php echo (!$selected_value ? ' selected="selected"' : ''); ?>><?php echo __('Choose a page','booked').'...'; ?></option>
														<?php if(!empty($pages)) :
															
															foreach($pages as $p) :
																$entry_id = $p->ID;
																$entry_title = get_the_title($entry_id); ?>
																<option value="<?php echo $entry_id; ?>"<?php echo ($selected_value == $entry_id ? ' selected="selected"' : ''); ?>><?php echo $entry_title; ?></option>
															<?php endforeach;
					
														endif; ?>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
										
										<?php //if (!is_plugin_active('booked-woocommerce-payments/booked-woocommerce-payments.php')): ?>
											<div class="condition-block booking_type<?php if ($booking_type == 'registered'): ?> default<?php endif; ?>" id="condition-registered">
										<?php //endif; ?>
					
											<div class="section-row">
												<div class="section-head">
													<?php $section_title = __('Login Redirect', 'booked'); ?>
													<h3><?php echo esc_attr($section_title); ?></h3>
													<p><?php _e('If you would like the login form to redirect somewhere else (instead of reloading the same page), you can choose a page here.','booked'); ?></p>
						
													<?php $option_name = 'booked_login_redirect_page';
						
													$pages = get_posts(array(
														'post_type' => 'page',
														'orderby'	=> 'name',
														'order'		=> 'asc',
														'posts_per_page' => -1
													));
						
													$selected_value = get_option($option_name); ?>
													<div class="select-box">
														<select name="<?php echo $option_name; ?>">
															<option value=""><?php _e('Redirect to the same page','booked'); ?></option>
															<?php if(!empty($pages)) :
																foreach($pages as $p) :
																	$entry_id = $p->ID;
																	$entry_title = get_the_title($entry_id); ?>
																	<option value="<?php echo $entry_id; ?>"<?php echo ($selected_value == $entry_id ? ' selected="selected"' : ''); ?>><?php echo $entry_title; ?></option>
																<?php endforeach;
						
															endif; ?>
														</select>
													</div><!-- /.select-box -->
												</div><!-- /.section-body -->
											</div><!-- /.section-row -->
											
											<div class="section-row">
												<div class="section-head">
													<?php $section_title = __('Custom Login Tab Content', 'booked'); ?>
													<h3><?php echo esc_attr($section_title); ?></h3>
													<p><?php _e('If you would like the login form to include a custom message (above the login form), you can add that here.','booked'); ?></p>
						
													<?php $option_name = 'booked_custom_login_message';
													$custom_content_value = get_option($option_name);
													
													wp_editor( $custom_content_value, $option_name, array('textarea_name' => $option_name,'media_buttons' => false,'editor_height' => 250,'teeny' => true) );
													
													?>
												</div><!-- /.section-body -->
											</div><!-- /.section-row -->
					
										<?php //if (!is_plugin_active('booked-woocommerce-payments/booked-woocommerce-payments.php')): ?>
											</div>
										<?php //endif; ?>
					
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Time Slot Intervals', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('Choose the intervals you need for your appointment time slots. This will only affect the way default time slots are entered.','booked'); ?></p>
					
												<?php $option_name = 'booked_timeslot_intervals';
												$selected_value = get_option($option_name);
					
												$interval_options = array(
													'120' 				=> __('Every 2 hours','booked'),
													'60' 				=> __('Every 1 hour','booked'),
													'30' 				=> __('Every 30 minutes','booked'),
													'15' 				=> __('Every 15 minutes','booked'),
													'10' 				=> __('Every 10 minutes','booked'),
													'5' 				=> __('Every 5 minutes','booked')
												); ?>
					
												<div class="select-box">
													<select name="<?php echo $option_name; ?>">
														<?php foreach($interval_options as $current_value => $option_title):
															echo '<option value="'.$current_value.'"' . ($selected_value == $current_value ? ' selected' : ''). '>' . $option_title . '</option>';
														endforeach; ?>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
					
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Appointment Buffer', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('To prevent appointments from getting booked too close to the current date and/or time, you can set an appointment buffer. Available appointments time slots will be pushed up to a new date and time depending on which buffer amount you choose below.','booked'); ?></p>
					
												<?php $option_name = 'booked_appointment_buffer';
												$selected_value = get_option($option_name);
					
												$interval_options = array(
													'0' 				=> __('No buffer','booked'),
													'1' 				=> __('1 hour','booked'),
													'2' 				=> __('2 hours','booked'),
													'3' 				=> __('3 hours','booked'),
													'4' 				=> __('4 hours','booked'),
													'5' 				=> __('5 hours','booked'),
													'6' 				=> __('6 hours','booked'),
													'12' 				=> __('12 hours','booked'),
													'24' 				=> __('24 hours','booked'),
													'48' 				=> __('2 days','booked'),
													'72' 				=> __('3 days','booked'),
													'96' 				=> __('5 days','booked'),
													'144' 				=> __('6 days','booked'),
													'168' 				=> __('1 week','booked'),
													'336' 				=> __('2 weeks','booked'),
													'504' 				=> __('3 weeks','booked'),
													'672' 				=> __('4 weeks','booked'),
													'840' 				=> __('5 weeks','booked'),
													'1008' 				=> __('6 weeks','booked'),
													'1176' 				=> __('7 weeks','booked'),
													'1344' 				=> __('8 weeks','booked'),
												); ?>
					
												<div class="select-box">
													<select name="<?php echo $option_name; ?>">
														<?php foreach($interval_options as $current_value => $option_title):
															echo '<option value="'.$current_value.'"' . ($selected_value == $current_value ? ' selected' : ''). '>' . $option_title . '</option>';
														endforeach; ?>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
										
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Prevent Appointments Before Date', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('To prevent appointments from getting booked before a certain date, you can choose that date below.','booked'); ?></p>
					
												<?php $option_name = 'booked_prevent_appointments_before';
												$selected_value = get_option($option_name); ?>
					
												<div class="select-box">
													<input type="text" placeholder="<?php _e("Choose a date","booked"); ?>..." class="booked_prevent_appointments_before" name="<?php echo $option_name; ?>" value="<?php echo $selected_value; ?>">
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
										
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Prevent Appointments After Date', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('To prevent appointments from getting booked after a certain date, you can choose that date below.','booked'); ?></p>
					
												<?php $option_name = 'booked_prevent_appointments_after';
												$selected_value = get_option($option_name); ?>
					
												<div class="select-box">
													<input type="text" placeholder="<?php _e("Choose a date","booked"); ?>..." class="booked_prevent_appointments_after" name="<?php echo $option_name; ?>" value="<?php echo $selected_value; ?>">
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
					
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Cancellation Buffer', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('To prevent appointments from getting cancelled too close to the appointment time, you can set a cancellation buffer.','booked'); ?></p>
					
												<?php $option_name = 'booked_cancellation_buffer';
												$selected_value = get_option($option_name);
					
												$interval_options = array(
													'0' 				=> __('No buffer','booked'),
													'0.25' 				=> __('15 minutes','booked'),
													'0.50' 				=> __('30 minutes','booked'),
													'0.75' 				=> __('45 minutes','booked'),
													'1' 				=> __('1 hour','booked'),
													'2' 				=> __('2 hours','booked'),
													'3' 				=> __('3 hours','booked'),
													'4' 				=> __('4 hours','booked'),
													'5' 				=> __('5 hours','booked'),
													'6' 				=> __('6 hours','booked'),
													'12' 				=> __('12 hours','booked'),
													'24' 				=> __('24 hours','booked'),
													'48' 				=> __('2 days','booked'),
													'72' 				=> __('3 days','booked'),
													'96' 				=> __('5 days','booked'),
													'144' 				=> __('6 days','booked'),
													'168' 				=> __('1 week','booked'),
													'336' 				=> __('2 weeks','booked'),
													'504' 				=> __('3 weeks','booked'),
													'672' 				=> __('4 weeks','booked'),
													'840' 				=> __('5 weeks','booked'),
													'1008' 				=> __('6 weeks','booked'),
													'1176' 				=> __('7 weeks','booked'),
													'1344' 				=> __('8 weeks','booked'),
												); ?>
					
												<div class="select-box">
													<select name="<?php echo $option_name; ?>">
														<?php foreach($interval_options as $current_value => $option_title):
															echo '<option value="'.$current_value.'"' . ($selected_value == $current_value ? ' selected' : ''). '>' . $option_title . '</option>';
														endforeach; ?>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
					
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Appointment Limit', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('To prevent users from booking too many appointments, you can set an appointment limit.','booked'); ?></p>
					
												<?php $option_name = 'booked_appointment_limit';
												$selected_value = get_option($option_name);
					
												$interval_options = array(
													'0' 				=> __('No limit','booked'),
													'1' 				=> __('1 appointment','booked'),
													'2' 				=> __('2 appointments','booked'),
													'3' 				=> __('3 appointments','booked'),
													'4' 				=> __('4 appointments','booked'),
													'5' 				=> __('5 appointments','booked'),
													'6' 				=> __('6 appointments','booked'),
													'7' 				=> __('7 appointments','booked'),
													'8' 				=> __('8 appointments','booked'),
													'9' 				=> __('9 appointments','booked'),
													'10' 				=> __('10 appointments','booked'),
													'15' 				=> __('15 appointments','booked'),
													'20' 				=> __('20 appointments','booked'),
													'25' 				=> __('25 appointments','booked'),
													'50' 				=> __('50 appointments','booked'),
												); ?>
					
												<div class="select-box">
													<select name="<?php echo $option_name; ?>">
														<?php foreach($interval_options as $current_value => $option_title):
															echo '<option value="'.$current_value.'"' . ($selected_value == $current_value ? ' selected' : ''). '>' . $option_title . '</option>';
														endforeach; ?>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
					
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('New Appointment Default', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('Would you like your appointment requests to go into a pending list or should they be approved immediately?','booked'); ?></p>
					
												<?php $option_name = 'booked_new_appointment_default';
												$selected_value = get_option($option_name);
					
												$interval_options = array(
													'draft' 	=> __('Set as Pending','booked'),
													'publish' 	=> __('Approve Immediately','booked')
												); ?>
					
												<div class="select-box">
													<select name="<?php echo $option_name; ?>">
														<?php foreach($interval_options as $current_value => $option_title):
															echo '<option value="'.$current_value.'"' . ($selected_value == $current_value ? ' selected' : ''). '>' . $option_title . '</option>';
														endforeach; ?>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
					
										<div class="section-row cf">
											<div class="section-head">
					
												<h3><?php _e('Display Options', 'booked'); ?></h3><?php // TODO - WIP ?>
					
												<br>
												
												<?php $option_name = 'booked_hide_default_calendar';
												$hide_default_calendar_button = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_default_calendar_button ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Hide "Default" in the calendar switcher','booked'); ?></label><br><br>
												
												<?php $option_name = 'booked_hide_weekends';
												$hide_weekends = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_weekends ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Hide weekends in the calendar','booked'); ?></label><br><br>
												
												<?php $option_name = 'booked_hide_google_link';
												$hide_google_calendar_button = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_google_calendar_button ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Hide "Add to Calender" button in the Profile appointment list','booked'); ?></label><br><br>
					
												<?php $option_name = 'booked_hide_end_times';
												$hide_hide_end_times = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_hide_end_times ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Hide end times (show only start times)','booked'); ?></label><br><br>
												
												<?php $option_name = 'booked_hide_available_timeslots';
												$hide_hide_end_times = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_hide_end_times ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Hide the number of available time slots','booked'); ?></label><br><br>
												
												<?php $option_name = 'booked_hide_unavailable_timeslots';
												$hide_unavailable_timeslots = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_unavailable_timeslots ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Hide the already booked time slots (cannot be used with "Public Appointments")','booked'); ?></label><br><br>
												
												<?php $option_name = 'booked_public_appointments';
												$public_appointments = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $public_appointments ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Public Appointments (show names under booked appointments)','booked'); ?></label><br><br>
												
											</div>
										</div>
										
										<div class="section-row cf">
											<div class="section-head">
					
												<h3><?php _e('Other Options', 'booked'); ?></h3><?php // TODO - WIP ?>
					
												<br>
												
												<?php $option_name = 'booked_dont_allow_user_cancellations';
												$dont_allow_user_cancellations = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $dont_allow_user_cancellations ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Do not allow users to cancel their own appointments.','booked'); ?></label><br><br>
												
												<?php $option_name = 'booked_redirect_non_admins';
												$hide_hide_end_times = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_hide_end_times ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Redirect users (except Admins and Booking Agents) from the "/wp-admin/" URL.','booked'); ?></label><br><br>
												
												<?php $option_name = 'booked_hide_admin_bar_menu';
												$hide_hide_end_times = get_option($option_name,false); ?>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>"<?php echo $hide_hide_end_times ? ' checked="checked"' : ''; ?> type="checkbox">
												<label class="checkbox-radio-label" for="<?php echo $option_name; ?>"><?php _e('Hide "Appointments" menu from Admin Bar.','booked'); ?></label>
					
											</div>
										</div><!-- /.section-row -->
					
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Front-End Color Settings', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3><?php // TODO - WIP ?>
											</div><!-- /.section-head -->
											<div class="section-body">
					
												<?php
												$color_options = array(
													array(
														'name' => 'booked_light_color',
														'title' => 'Light Color',
														'val' => get_option('booked_light_color','#365769'),
														'default' => '#365769'
													),
													array(
														'name' => 'booked_dark_color',
														'title' => 'Dark Color',
														'val' => get_option('booked_dark_color','#264452'),
														'default' => '#264452'
					
													),
													array(
														'name' => 'booked_button_color',
														'title' => 'Primary Button Color',
														'val' => get_option('booked_button_color','#56C477'),
														'default' => '#56C477'
					
													),
												);
					
												foreach($color_options as $color_option):
					
													echo '<label class="booked-color-label" for="'.$color_option['name'].'">'.$color_option['title'].'</label>';
													echo '<input data-default-color="'.$color_option['default'].'" type="text" name="'.$color_option['name'].'" value="'.$color_option['val'].'" id="'.$color_option['name'].'" class="booked-color-field" />';
					
												endforeach;
												?>
					
											</div><!-- /.section-body -->
										</div>
					
										<div class="section-row submit-section" style="padding:0;">
											<?php @submit_button(); ?>
										</div><!-- /.section-row -->
					
									</div>
					
									<div id="booked-user-emails" class="tab-content">
					
										<div class="section-row">
											<div class="section-head">
												<p style="padding:13px 19px 12px; border-left:3px solid #aaa; background:#f5f5f5; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; box-shadow:0 1px 3px rgba(0,0,0,0.10); margin:0; font-size:15px; line-height:1.6;"><?php _e('If you <strong>do not</strong> want to send email notifications for any of the following actions, just remove the email Subject or Content text (or both) and an email will not be sent for that notification.','booked'); ?></p>
											</div>
										</div>
					
										<div class="section-row">
											<div class="section-head"><?php
					
												$option_name = 'booked_email_logo';
												$booked_email_logo = get_option($option_name);
												$section_title = __('Email Content - Logo Image', 'booked'); ?>
					
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('Choose an image for your custom emails. Keep it 600px or less for best results.','booked'); ?></p>
					
												<input id="<?php echo $option_name; ?>" name="<?php echo $option_name; ?>" value="<?php echo $booked_email_logo; ?>" type="hidden" />
												<input id="booked_email_logo_button" class="button" name="booked_email_logo_button" type="button" value="<?php _e('Upload Logo','booked'); ?>" />
					
												<img src="<?php echo $booked_email_logo; ?>" id="booked_email_logo-img">
											</div>
										</div>
					
										<div class="section-row">
											<div class="section-head">
												<?php $option_name = 'booked_registration_email_content';
					
	$default_content = 'Hey %name%!
	
	Thanks for registering at '.get_bloginfo('name').'. You can now login to manage your account and appointments using the following credentials:
	
	Username: %username%
	Password: %password%
	
	Sincerely,
	Your friends at '.get_bloginfo('name');
					
												$email_content_registration = get_option($option_name,$default_content);
												$section_title = __('Email Content - Registration', 'booked'); ?>
					
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('The email content that is sent to the user upon registration (using the Booked registration form). Some tokens you can use:','booked'); ?></p>
												<ul class="cp-list">
													<li><strong>%name%</strong> &mdash; <?php _e("To display the person's name.","booked"); ?></li>
													<li><strong>%email%</strong> &mdash; <?php _e("To display the person's email address.","booked"); ?></li>
													<li><strong>%username%</strong> &mdash; <?php _e("To display the username for login.","booked"); ?></li>
													<li><strong>%password%</strong> &mdash; <?php _e("To display the password for login.","booked"); ?></li>
												</ul><br>
					
												<?php
					
												$subject_var = 'booked_registration_email_subject';
												$subject_default = 'Thank you for registering!';
												$current_subject_value = get_option($subject_var,$subject_default); ?>
					
												<input style="margin:0" name="<?php echo $subject_var; ?>" value="<?php echo $current_subject_value; ?>" type="text" class="field">
												<?php wp_editor( $email_content_registration, $option_name, array('textarea_name' => $option_name,'media_buttons' => false,'editor_height' => 350,'teeny' => true) ); ?>
							
											</div>
										</div><!-- /.section-row -->
					
										<div class="section-row" data-controller="cp_fes_controller" data-controlled_by="fes_enabled">
											<div class="section-head">
												<?php $option_name = 'booked_appt_confirmation_email_content';
					
	$default_content = 'Hey %name%!
	
	This is just an email to confirm your appointment. For reference, here\'s the appointment information:
	
	Date: %date%
	Time: %time%
	
	Sincerely,
	Your friends at '.get_bloginfo('name');
					
												$email_content_approval = get_option($option_name,$default_content);
												$section_title = __('Email Content - Appointment Confirmation', 'booked'); ?>
					
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('The email content that is sent to the user upon appointment creation. Some tokens you can use:','booked'); ?></p>
												<ul class="cp-list">
													<li><strong>%name%</strong> &mdash; <?php _e("To display the person's name.","booked"); ?></li>
													<li><strong>%email%</strong> &mdash; <?php _e("To display the person's email address.","booked"); ?></li>
													<li><strong>%calendar%</strong> &mdash; <?php _e("To display the calendar name (if one is used) for this appointment.","booked"); ?></li>
													<li><strong>%date%</strong> &mdash; <?php _e("To display the appointment date.","booked"); ?></li>
													<li><strong>%time%</strong> &mdash; <?php _e("To display the appointment time.","booked"); ?></li>
													<li><strong>%customfields%</strong> &mdash; <?php _e("To display all custom field values associated with this appointment.","booked"); ?></li>
												</ul><br>
					
												<?php
					
												$subject_var = 'booked_appt_confirmation_email_subject';
												$subject_default = 'Your appointment confirmation from '.get_bloginfo('name').'.';
												$current_subject_value = get_option($subject_var,$subject_default); ?>
					
												<input style="margin:0" name="<?php echo $subject_var; ?>" value="<?php echo $current_subject_value; ?>" type="text" class="field">
												<?php wp_editor( $email_content_approval, $option_name, array('textarea_name' => $option_name,'media_buttons' => false,'editor_height' => 350,'teeny' => true) ); ?>
											</div>
										</div><!-- /.section-row -->
					
										<div class="section-row" data-controller="cp_fes_controller" data-controlled_by="fes_enabled">
											<div class="section-head">
												<?php $option_name = 'booked_approval_email_content';
					
	$default_content = 'Hey %name%!
	
	The appointment you requested at '.get_bloginfo('name').' has been approved! Here\'s your appointment information:
	
	Date: %date%
	Time: %time%
	
	Sincerely,
	Your friends at '.get_bloginfo('name');
					
												$email_content_approval = get_option($option_name,$default_content);
												$section_title = __('Email Content - Appointment Approval', 'booked'); ?>
					
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('The email content that is sent to the user upon appointment approval. Some tokens you can use:','booked'); ?></p>
												<ul class="cp-list">
													<li><strong>%name%</strong> &mdash; <?php _e("To display the person's name.","booked"); ?></li>
													<li><strong>%email%</strong> &mdash; <?php _e("To display the person's email address.","booked"); ?></li>
													<li><strong>%calendar%</strong> &mdash; <?php _e("To display the calendar name (if one is used) for this appointment.","booked"); ?></li>
													<li><strong>%date%</strong> &mdash; <?php _e("To display the appointment date.","booked"); ?></li>
													<li><strong>%time%</strong> &mdash; <?php _e("To display the appointment time.","booked"); ?></li>
													<li><strong>%customfields%</strong> &mdash; <?php _e("To display all custom field values associated with this appointment.","booked"); ?></li>
												</ul><br>
					
												<?php
					
												$subject_var = 'booked_approval_email_subject';
												$subject_default = 'Your appointment has been approved!';
												$current_subject_value = get_option($subject_var,$subject_default); ?>
					
												<input style="margin:0" name="<?php echo $subject_var; ?>" value="<?php echo $current_subject_value; ?>" type="text" class="field">
												<?php wp_editor( $email_content_approval, $option_name, array('textarea_name' => $option_name,'media_buttons' => false,'editor_height' => 350,'teeny' => true) ); ?>
											</div>
										</div><!-- /.section-row -->
					
										<div class="section-row" data-controller="cp_fes_controller" data-controlled_by="fes_enabled">
											<div class="section-head">
												<?php $option_name = 'booked_cancellation_email_content';
					
	$default_content = 'Hey %name%!
	
	The appointment you requested at '.get_bloginfo('name').' has been cancelled. For reference, here\'s the appointment information:
	
	Date: %date%
	Time: %time%
	
	Sincerely,
	Your friends at '.get_bloginfo('name');
					
												$email_content_approval = get_option($option_name,$default_content);
												$section_title = __('Email Content - Appointment Cancellation', 'booked'); ?>
					
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('The email content that is sent to the user upon appointment cancellation. Some tokens you can use:','booked'); ?></p>
												<ul class="cp-list">
													<li><strong>%name%</strong> &mdash; <?php _e("To display the person's name.","booked"); ?></li>
													<li><strong>%email%</strong> &mdash; <?php _e("To display the person's email address.","booked"); ?></li>
													<li><strong>%calendar%</strong> &mdash; <?php _e("To display the calendar name (if one is used) for this appointment.","booked"); ?></li>
													<li><strong>%date%</strong> &mdash; <?php _e("To display the appointment date.","booked"); ?></li>
													<li><strong>%time%</strong> &mdash; <?php _e("To display the appointment time.","booked"); ?></li>
													<li><strong>%customfields%</strong> &mdash; <?php _e("To display all custom field values associated with this appointment.","booked"); ?></li>
												</ul><br>
					
												<?php
					
												$subject_var = 'booked_cancellation_email_subject';
												$subject_default = 'Your appointment has been cancelled.';
												$current_subject_value = get_option($subject_var,$subject_default); ?>
					
												<input style="margin:0" name="<?php echo $subject_var; ?>" value="<?php echo $current_subject_value; ?>" type="text" class="field">
												<?php wp_editor( $email_content_approval, $option_name, array('textarea_name' => $option_name,'media_buttons' => false,'editor_height' => 350,'teeny' => true) ); ?>
												
											</div>
										</div><!-- /.section-row -->
					
										<div class="section-row submit-section" style="padding:0;">
											<?php @submit_button(); ?>
										</div><!-- /.section-row -->
					
									</div><!-- /templates -->
					
									<div id="booked-admin-emails" class="tab-content">
					
										<div class="section-row">
											<div class="section-head">
												<p style="padding:13px 19px 12px; border-left:3px solid #aaa; background:#f5f5f5; -moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; box-shadow:0 1px 3px rgba(0,0,0,0.10); margin:0; font-size:15px; line-height:1.6;"><?php _e('If you <strong>do not</strong> want to send email notifications for any of the following actions, just remove the email Subject or Content text (or both) and an email will not be sent for that notification.','booked'); ?></p>
											</div>
										</div>
										
										<div class="section-row">
											<div class="section-head">
												<?php $section_title = __('Which Administrator or Booking Agent user should receive the notification emails by default?', 'booked'); ?>
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('By default, Booked uses the <strong>Settings > General > E-mail Address</strong> setting. Also, each custom calendar can have their own user notification setting, this is just the default.','booked'); ?></p>
					
												<?php $option_name = 'booked_default_email_user';
					
												$all_users = get_users();
												$allowed_users = array();
												foreach ( $all_users as $user ):
												    $wp_user = new WP_User($user->ID);
												    if ( !in_array( 'subscriber', $wp_user->roles ) ):
												        array_push($allowed_users, $user);
												    endif;
												endforeach;
					
												$selected_value = get_option($option_name); ?>
												<div class="select-box">
													<select name="<?php echo $option_name; ?>">
														<option value=""><?php _e('Choose a default user for notifications','booked'); ?> ...</option>
														<?php if(!empty($allowed_users)) :
															foreach($allowed_users as $u) :
																$user_id = $u->ID;
																$username = $u->data->user_login;
																$email = $u->data->user_email; ?>
																<option value="<?php echo $email; ?>"<?php echo ($selected_value == $email ? ' selected="selected"' : ''); ?>><?php echo $email; ?> (<?php echo $username; ?>)</option>
															<?php endforeach;
					
														endif; ?>
													</select>
												</div><!-- /.select-box -->
											</div><!-- /.section-body -->
										</div><!-- /.section-row -->
					
										<div class="section-row">
											<div class="section-head">
												<?php $option_name = 'booked_admin_appointment_email_content';
					
	$default_content = 'You have a new appointment request! Here\'s the appointment information:
	
	Customer: %name%
	Date: %date%
	Time: %time%
	
	Log into your website here: '.get_admin_url().' to approve this appointment.
	
	(Sent via the '.get_bloginfo('name').' website)';
					
												$email_content_registration = get_option($option_name,$default_content);
												$section_title = __('New Appointment Request', 'booked'); ?>
					
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('The email content that is sent (to the selected admin users above) upon appointment request. Some tokens you can use:','booked'); ?></p>
												<ul class="cp-list">
													<li><strong>%name%</strong> &mdash; <?php _e("To display the person's name.","booked"); ?></li>
													<li><strong>%email%</strong> &mdash; <?php _e("To display the person's email address.","booked"); ?></li>
													<li><strong>%calendar%</strong> &mdash; <?php _e("To display the calendar name (if one is used) for this appointment.","booked"); ?></li>
													<li><strong>%date%</strong> &mdash; <?php _e("To display the appointment date.","booked"); ?></li>
													<li><strong>%time%</strong> &mdash; <?php _e("To display the appointment time.","booked"); ?></li>
													<li><strong>%customfields%</strong> &mdash; <?php _e("To display all custom field values associated with this appointment.","booked"); ?></li>
												</ul><br>
					
												<?php
					
												$subject_var = 'booked_admin_appointment_email_subject';
												$subject_default = 'You have a new appointment request!';
												$current_subject_value = get_option($subject_var,$subject_default); ?>
					
												<input style="margin:0" name="<?php echo $subject_var; ?>" value="<?php echo $current_subject_value; ?>" type="text" class="field">
												<?php wp_editor( $email_content_registration, $option_name, array('textarea_name' => $option_name,'media_buttons' => false,'editor_height' => 350,'teeny' => true) ); ?>
												
											</div>
										</div><!-- /.section-row -->
					
										<div class="section-row">
											<div class="section-head">
												<?php $option_name = 'booked_admin_cancellation_email_content';
					
	$default_content = 'One of your customers has cancelled their appointment. Here\'s the appointment information:
	
	Customer: %name%
	Date: %date%
	Time: %time%
	
	(Sent via the '.get_bloginfo('name').' website)';
					
												$email_content_registration = get_option($option_name,$default_content);
												$section_title = __('Appointment Cancellation', 'booked'); ?>
					
												<h3><?php echo esc_attr($section_title); ?></h3>
												<p><?php _e('The email content that is sent (to the selected admin users above) upon cancellation. Some tokens you can use:','booked'); ?></p>
												<ul class="cp-list">
													<li><strong>%name%</strong> &mdash; <?php _e("To display the person's name.","booked"); ?></li>
													<li><strong>%email%</strong> &mdash; <?php _e("To display the person's email address.","booked"); ?></li>
													<li><strong>%calendar%</strong> &mdash; <?php _e("To display the calendar name (if one is used) for this appointment.","booked"); ?></li>
													<li><strong>%date%</strong> &mdash; <?php _e("To display the username for login.","booked"); ?></li>
													<li><strong>%time%</strong> &mdash; <?php _e("To display the password for login.","booked"); ?></li>
													<li><strong>%customfields%</strong> &mdash; <?php _e("To display all custom field values associated with this appointment.","booked"); ?></li>
												</ul><br>
					
												<?php
					
												$subject_var = 'booked_admin_cancellation_email_subject';
												$subject_default = 'An appointment has been cancelled.';
												$current_subject_value = get_option($subject_var,$subject_default); ?>
					
												<input style="margin:0" name="<?php echo $subject_var; ?>" value="<?php echo $current_subject_value; ?>" type="text" class="field">
												<?php wp_editor( $email_content_registration, $option_name, array('textarea_name' => $option_name,'media_buttons' => false,'editor_height' => 250,'teeny' => true) ); ?>
												
											</div>
										</div><!-- /.section-row -->
					
										<div class="section-row submit-section" style="padding:0;">
											<?php @submit_button(); ?>
										</div><!-- /.section-row -->
					
									</div><!-- /templates -->
					
								</form>
	
														
							<?php break;
								
							case 'defaults': ?>
							
								<div id="booked-defaults" class="tab-content">
									
									<?php if (!$booked_none_assigned && count($calendars) >= 1):
				
										?><div id="booked-timeslotsSwitcher">
											<p><strong><?php _e('Editing time slots for:','booked'); ?></strong></p>
											<?php
					
											echo '<select name="bookedTimeslotsDisplayed">';
											if (current_user_can('manage_booked_options')): echo '<option value="">'.__('Default Calendar','booked').'</option>'; endif;
					
											foreach($calendars as $calendar):
					
												?><option value="<?php echo $calendar->term_id; ?>"><?php echo $calendar->name; ?></option><?php
					
											endforeach;
					
											echo '</select>';
					
										?></div><?php
										
									endif; ?>
						
									<div id="bookedTimeslotsWrap">
										<?php if (current_user_can('manage_booked_options')):
											booked_render_timeslots();
										else:
											$first_calendar = reset($calendars);
											booked_render_timeslots($first_calendar->term_id);
										endif; ?>
									</div>
					
									<?php $timeslot_intervals = get_option('booked_timeslot_intervals',60); ?>
					
									<div id="timepickerTemplate" class="bookedClearFix">
										<div class="timeslotTabs bookedClearFix">
											<a class="addTimeslotTab active" href="#Single"><?php _e('Add Single','booked'); ?></a>
											<a class="addTimeslotTab" href="#Bulk"><?php _e('Add Bulk','booked'); ?></a>
										</div>
										<div class="tsTabContent tsSingle">
											<?php echo booked_render_single_timeslot_form($timeslot_intervals); ?>
										</div>
										<div class="tsTabContent tsBulk">
											<?php echo booked_render_bulk_timeslot_form($timeslot_intervals); ?>
										</div>
										<span class="cancel button"><?php _e('Cancel','booked'); ?></span>
									</div>
										
								</div><!-- /templates -->
														
							<?php break;
								
							case 'custom-timeslots': ?>
							
								<div id="booked-custom-timeslots" class="tab-content">
	
									<form action="" id="customTimeslots">
					
										<div id="customTimeslotsWrapper">
											<div id="customTimeslotsContainer">
					
												<?php
													
												// Any custom time slots saved already?
												$booked_custom_timeslots_encoded = get_option('booked_custom_timeslots_encoded');
												$booked_custom_timeslots_decoded = json_decode($booked_custom_timeslots_encoded,true);
												$available_calendar_ids = array();
												
												foreach($calendars as $this_calendar):
													$available_calendar_ids[] = $this_calendar->term_id;
												endforeach;
					
												if (!empty($booked_custom_timeslots_decoded)):
					
													$custom_timeslots_array = booked_custom_timeslots_reconfigured($booked_custom_timeslots_decoded);
													foreach($custom_timeslots_array as $key => $timeslot):
														$date_string = date_i18n('Ymd',strtotime($timeslot['booked_custom_start_date']));
														$new_custom_timeslots_array[$date_string.$key] = $timeslot;
													endforeach;
													
													$custom_timeslots_array = $new_custom_timeslots_array;
													
													ksort($custom_timeslots_array);
													$current_timeslot_month_year = false;
													
													foreach($custom_timeslots_array as $this_timeslot):
													
														$this_timeslot_month_year = ( $this_timeslot['booked_custom_start_date'] ? date_i18n('F, Y',strtotime($this_timeslot['booked_custom_start_date'])) : '<span style="color:#dd0000;">'.__('No "Start date" has been set for these:').'</span>' );
													
														if (!$current_timeslot_month_year || $current_timeslot_month_year != $this_timeslot_month_year):
															$current_timeslot_month_year = $this_timeslot_month_year;
															echo '<h3 class="booked-ct-date-heading">'.$current_timeslot_month_year.'</h3>';
														endif;
					
														?><div class="booked-customTimeslot"<?php if (!current_user_can('manage_booked_options') && $this_timeslot['booked_custom_calendar_id'] && !in_array($this_timeslot['booked_custom_calendar_id'],$available_calendar_ids)): echo ' style="display:none;"'; endif; ?>>
					
															<?php
															
															if (in_array($this_timeslot['booked_custom_calendar_id'],$available_calendar_ids)):
																
																if (!empty($calendars)):
						
																	echo '<select name="booked_custom_calendar_id">';
												
																		if (current_user_can('manage_booked_options')): echo '<option value="">'.__('Default Calendar','booked').'</option>'; endif;
						
																		foreach($calendars as $calendar):
																		
																			?><option<?php if ($this_timeslot['booked_custom_calendar_id'] == $calendar->term_id): echo ' selected="selected"'; endif; ?> value="<?php echo $calendar->term_id; ?>"><?php echo $calendar->name; ?></option><?php
						
																		endforeach;
						
																	echo '</select>';
						
																endif;
																
															else:
															
																?><input type="hidden" name="booked_custom_calendar_id" value="<?php echo $this_timeslot['booked_custom_calendar_id']; ?>"><?php
															
															endif; ?>
					
															<input type="text" placeholder="<?php _e("Start date","booked"); ?>..." class="booked_custom_start_date" name="booked_custom_start_date" value="<?php echo $this_timeslot['booked_custom_start_date']; ?>">
															<input type="text" placeholder="<?php _e("Optional End date","booked"); ?>..." class="booked_custom_end_date" name="booked_custom_end_date" value="<?php echo $this_timeslot['booked_custom_end_date']; ?>">
					
															<?php if (is_array($this_timeslot['booked_this_custom_timelots'])): ?>
																<input type="hidden" name="booked_this_custom_timelots" value="<?php echo htmlentities(stripslashes(json_encode($this_timeslot['booked_this_custom_timelots']))); ?>">
															<?php else : ?>
																<input type="hidden" name="booked_this_custom_timelots" value="<?php echo htmlentities(stripslashes($this_timeslot['booked_this_custom_timelots'])); ?>">
															<?php endif; ?>
					
															<input id="vacationDayCheckbox" name="vacationDayCheckbox" type="checkbox" value="1"<?php if ($this_timeslot['vacationDayCheckbox']): echo ' checked="checked"'; endif; ?>>
															<label for="vacationDayCheckbox"><?php _e('Disable appointments','booked'); ?></label>
					
															<a href="#" class="deleteCustomTimeslot"><i class="fa fa-close"></i></a>
					
															<?php
					
															if (is_array($this_timeslot['booked_this_custom_timelots'])):
																$timeslots = $this_timeslot['booked_this_custom_timelots'];
															else:
																$timeslots = json_decode($this_timeslot['booked_this_custom_timelots'],true);
															endif;
					
															echo '<div class="customTimeslotsList">';
					
															if (!empty($timeslots)):
					
																echo '<div class="cts-header"><span class="slotsTitle">'.__('Spaces Available','booked').'</span>'.__('Time Slot','booked').'</div>';
					
																foreach ($timeslots as $timeslot => $count):
					
																	$time = explode('-',$timeslot);
																	$time_format = get_option('time_format');
					
																	echo '<span class="timeslot" data-timeslot="'.$timeslot.'">';
																		echo '<span class="slotsBlock"><span class="changeCount minus" data-count="-1"><i class="fa fa-minus-circle"></i></span><span class="count"><em>'.$count.'</em> ' . _n('Space Available','Spaces Available',$count,'booked') . '</span><span class="changeCount add" data-count="1"><i class="fa fa-plus-circle"></i></span></span>';
					
																		if ($time[0] == '0000' && $time[1] == '2400'):
																			echo '<span class="start"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;' . strtoupper(__('All day','booked')) . '</span>';
																		else :
																			echo '<span class="start"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;' . date_i18n($time_format,strtotime('2014-01-01 '.$time[0])) . '</span> &ndash; <span class="end">' . date_i18n($time_format,strtotime('2014-01-01 '.$time[1])) . '</span>';
																		endif;
					
																		echo '<span class="delete"><i class="fa fa-remove"></i></span>';
																	echo '</span>';
					
																endforeach;
															endif;
					
															echo '</div>';
					
															?>
					
															<button class="button addSingleTimeslot"><?php _e('+ Single Time Slot','booked'); ?></button>
															<button class="button addBulkTimeslots"><?php _e('+ Bulk Time Slots','booked'); ?></button>
					
														</div><?php
					
													endforeach;
												endif;
					
												?>
					
											</div>
										</div>
					
										<div class="section-row submit-section bookedClearFix" style="padding:0;">
											<button class="button addCustomTimeslot"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php _e('Add Date(s)','booked'); ?></button>
											<input id="booked-saveCustomTimeslots" type="button" disabled="true" class="button saveCustomTimeslots" value="<?php _e('Save Custom Time Slots','booked'); ?>">
											<div class="cts-updater savingState"><i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;<?php _e('Saving','booked'); ?>...</div>
										</div><!-- /.section-row -->
					
									</form>
					
									<input type="hidden" style="width:100%;" id="custom_timeslots_encoded" name="custom_timeslots_encoded" value="<?php echo htmlentities(stripslashes(stripslashes($booked_custom_timeslots_encoded))); ?>">
					
									<div style="border:1px solid #FFBA00;" class="booked-customTimeslotTemplate">
					
										<?php if (!empty($calendars)):
					
											echo '<select name="booked_custom_calendar_id">';
												if (current_user_can('manage_booked_options')): echo '<option value="">'.__('Default Calendar','booked').'</option>'; endif;
					
												foreach($calendars as $calendar):
					
													?><option value="<?php echo $calendar->term_id; ?>"><?php echo $calendar->name; ?></option><?php
					
												endforeach;
					
											echo '</select>';
					
										endif; ?>
					
										<input type="text" placeholder="<?php _e("Start date","booked"); ?>..." class="booked_custom_start_date" name="booked_custom_start_date" value="">
										<input type="text" placeholder="<?php _e("Optional End date","booked"); ?>..." class="booked_custom_end_date" name="booked_custom_end_date" value="">
										<input type="hidden" name="booked_this_custom_timelots" value="">
					
										<input id="vacationDayCheckbox" name="vacationDayCheckbox" type="checkbox" value="1">
										<label for="vacationDayCheckbox"><?php _e('Disable appointments','booked'); ?></label>
					
										<a href="#" class="deleteCustomTimeslot"><i class="fa fa-close"></i></a>
					
										<div class="customTimeslotsList"></div>
					
										<button class="button addSingleTimeslot"><?php _e('+ Single Time Slot','booked'); ?></button>
										<button class="button addBulkTimeslots"><?php _e('+ Bulk Time Slots','booked'); ?></button>
					
									</div>
					
									<div id="booked-customTimePickerTemplates">
										<div class="customSingle">
											<?php echo booked_render_single_timeslot_form($timeslot_intervals,'custom'); ?>
											<button class="button-primary addSingleTimeslot_button"><?php _e('Add','booked'); ?></button>
											<button class="button cancel"><?php _e('Close','booked'); ?></button>
										</div>
										<div class="customBulk">
											<?php echo booked_render_bulk_timeslot_form($timeslot_intervals,'custom'); ?>
											<button class="button-primary addBulkTimeslots_button"><?php _e('Add','booked'); ?></button>
											<button class="button cancel"><?php _e('Close','booked'); ?></button>
										</div>
									</div>
					
								</div>
														
							<?php break;
								
							case 'custom-fields': ?>
							
								<div id="booked-custom-fields" class="tab-content">
									
									<div class="section-row">
										<div class="section-head">
					
											<div class="booked-cf-block">
												
												<?php if (!empty($calendars)):
													
													echo '<div id="booked-cfSwitcher" style="margin:0 0 30px;">';
														echo '<select name="bookedCustomFieldsDisplayed">';
									
															if (current_user_can('manage_booked_options')): echo '<option value="">'.__('Default Calendar','booked').'</option>'; endif;
					
															foreach($calendars as $calendar):
															
																?><option value="<?php echo $calendar->term_id; ?>"><?php echo $calendar->name; ?></option><?php
					
															endforeach;
					
														echo '</select>';
													echo '</div>';
				
												endif; ?>
												
												<div id="booked_customFields_Wrap">
												
													<?php if (current_user_can('manage_booked_options')):
														booked_render_custom_fields();
													else:
														$first_calendar = reset($calendars);
														booked_render_custom_fields($first_calendar->term_id);
													endif; ?>
												
												</div>
												
											</div>
					
											<ul id="booked-cf-sortable-templates">
					
												<li id="bookedCFTemplate-single-line-text-label" class="ui-state-default"><i class="main-handle fa fa-bars"></i>
													<small><?php _e('Single Line Text','booked'); ?></small>
													<p><input class="cf-required-checkbox" type="checkbox" name="required" id="required"> <label for="required"><?php _e('Required Field','booked'); ?></label></p>
													<input type="text" name="single-line-text-label" value="" placeholder="Enter a label for this field..." />
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
												<li id="bookedCFTemplate-paragraph-text-label" class="ui-state-default"><i class="main-handle fa fa-bars"></i>
													<small><?php _e('Paragraph Text','booked'); ?></small>
													<p><input class="cf-required-checkbox" type="checkbox" name="required" id="required"> <label for="required"><?php _e('Required Field','booked'); ?></label></p>
													<input type="text" name="paragraph-text-label" value="" placeholder="Enter a label for this field..." />
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
												<li id="bookedCFTemplate-checkboxes-label" class="ui-state-default"><i class="main-handle fa fa-bars"></i>
													<small><?php _e('Checkboxes','booked'); ?></small>
													<p><input class="cf-required-checkbox" type="checkbox" name="required" id="required"> <label for="required"><?php _e('Required Field','booked'); ?></label></p>
													<input type="text" name="checkboxes-label" value="" placeholder="Enter a label for this checkbox group..." />
													<ul id="booked-cf-checkboxes"></ul>
													<button class="cfButton button" data-type="single-checkbox"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php _e('Checkbox','booked'); ?></button>
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
												<li id="bookedCFTemplate-radio-buttons-label" class="ui-state-default"><i class="main-handle fa fa-bars"></i>
													<small><?php _e('Radio Buttons','booked'); ?></small>
													<p><input class="cf-required-checkbox" type="checkbox" name="required" id="required"> <label for="required"><?php _e('Required Field','booked'); ?></label></p>
													<input type="text" name="radio-buttons-label" value="" placeholder="Enter a label for this radio button group..." />
													<ul id="booked-cf-radio-buttons"></ul>
													<button class="cfButton button" data-type="single-radio-button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php _e('Radio Button','booked'); ?></button>
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
												<li id="bookedCFTemplate-drop-down-label" class="ui-state-default"><i class="main-handle fa fa-bars"></i>
													<small><?php _e('Drop Down','booked'); ?></small>
													<p><input class="cf-required-checkbox" type="checkbox" name="required" id="required"> <label for="required"><?php _e('Required Field','booked'); ?></label></p>
													<input type="text" name="drop-down-label" value="" placeholder="Enter a label for this drop-down group..." />
													<ul id="booked-cf-drop-down"></ul>
													<button class="cfButton button" data-type="single-drop-down"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php _e('Option','booked'); ?></button>
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
												<li id="bookedCFTemplate-plain-text-content" class="ui-state-default"><i class="main-handle fa fa-bars"></i>
													<small><?php _e('Text Content','booked'); ?></small>
													<textarea name="plain-text-content"></textarea>
													<small class="help-text"><?php _e('HTML allowed','booked'); ?></small>
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
					
												<li id="bookedCFTemplate-single-checkbox" class="ui-state-default "><i class="sub-handle fa fa-bars"></i>
													<?php do_action('booked_before_custom_checkbox'); ?>
													<input type="text" name="single-checkbox" value="" placeholder="Enter a label for this checkbox..." />
													<span class="cf-delete"><i class="fa fa-close"></i></span>
													<?php do_action('booked_after_custom_checkbox'); ?>
												</li>
												<li id="bookedCFTemplate-single-radio-button" class="ui-state-default "><i class="sub-handle fa fa-bars"></i>
													<input type="text" name="single-radio-button" value="" placeholder="Enter a label for this radio button..." />
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
												<li id="bookedCFTemplate-single-drop-down" class="ui-state-default "><i class="sub-handle fa fa-bars"></i>
													<input type="text" name="single-drop-down" value="" placeholder="Enter a label for this option..." />
													<span class="cf-delete"><i class="fa fa-close"></i></span>
												</li>
					
												<?php do_action('booked_custom_fields_add_template') ?>
											</ul>
					
										</div>
									</div>
					
									<input id="booked_custom_fields" name="booked_custom_fields" value="<?php echo $custom_fields; ?>" type="hidden" class="field" style="width:100%;">
					
									<div class="section-row submit-section bookedClearFix" style="padding:0;">
										<input id="booked-cf-saveButton" type="button" class="button button-primary" value="<?php _e('Save Custom Fields','booked'); ?>">
										<div class="cf-updater savingState"><i class="fa fa-refresh fa-spin"></i>&nbsp;&nbsp;<?php _e('Saving','booked'); ?>...</div>
									</div><!-- /.section-row -->
					
								</div><!-- /templates -->
														
							<?php break;
								
							case 'shortcodes': ?>
							
								<div id="booked-shortcodes" class="tab-content">
	
									<div class="section-row" style="margin-bottom:-50px;">
										<div class="section-head">
					
											<h3><?php echo __('Display the Default Calendar', 'booked'); ?></h3>
											<p><?php _e('You can use this shortcode to display the front-end booking calendar. Use the "calendar" attribute to display a specific calendar. Use the "year" and/or "month" attributes to display a specific month and/or year. You can also use the "switcher" variable to add a calendar switcher dropdown above the calendar. Your users can then switch between each calendar you\'ve created.','booked'); ?></p>
											<p><strong><?php _e('Example','booked'); ?>:</strong> <code>[booked-calendar year="2016" month="7" calendar="12" switcher="true"]</code></p>
											<p><?php _e('This will display the calendar with the ID of 12, and it will start the calendar at July, 2016 when loaded. It will also display the dropdown switcher with the current calendar preselected.','booked'); ?></p>
											<p><input value="[booked-calendar]" type="text" readonly="readonly" class="field"></p>
					
										</div>
					
										<?php
					
										if (!empty($calendars)):
					
											?><div class="section-head">
												<h3><?php echo __('Display a Custom Calendar', 'booked'); ?></h3>
												<p style="margin:0 0 10px;">&nbsp;</p><?php
					
												foreach($calendars as $calendar):
					
													?><p style="margin:0 0 10px;"><strong style="font-size:14px;"><?php echo $calendar->name; ?></strong></p>
													<input value="[booked-calendar calendar=<?php echo $calendar->term_id; ?>]" readonly="readonly" type="text"class="field"><?php
					
												endforeach;
					
											?></div><?php
					
										endif;
					
										?>
					
										<div class="section-head">
					
											<h3><?php echo __('Display the Login / Register Form', 'booked'); ?></h3>
											<p><?php _e("If the Registration tab doesn't show up, be sure to allow registrations from the Settings > General page.","booked"); ?></p>
											<p><input value="[booked-login]" type="text" readonly="readonly" class="field"></p>
					
										</div>
										
										<div class="section-head">
					
											<h3><?php echo __('Display User Profile', 'booked'); ?></h3>
											<p><?php _e("You can use this shortcode to display the profile content on any page. If a user is not logged in, they will see the login form instead.","booked"); ?></p>
											<p><input value="[booked-profile]" type="text" readonly="readonly" class="field"></p>
					
										</div>
					
										<div class="section-head">
					
											<h3><?php echo __("Display User's Appointments", 'booked'); ?></h3>
											<p><?php _e("You can use this shortcode to display just the currently logged in user's upcoming appointments.","booked"); ?></p>
											<p><input value="[booked-appointments]" type="text" readonly="readonly" class="field"></p>
					
										</div>
					
									</div>
					
								</div>
	
														
							<?php break;
								
							case 'export-appointments': ?>
							
								<form action="" class="booked-export-form" method="post">
					
									<div id="booked-export-appointments" class="tab-content">
										
										<div class="section-row">
											<div class="section-head">
												<h3><?php _e('Export Appointments','booked'); ?></h3>
												<p><?php _e('You can export all appointments or specify what you want by choosing from the below options.','booked'); ?></p>	
												<br>
												<div class="select-box">
													<label class="booked-color-label" for="appointment_time"><?php _e('Appointment Dates','booked'); ?>:</label>
													<select name="appointment_time">
														<option value="" selected="selected"><?php _e('Upcoming &amp; Past','booked'); ?></option>
														<option value="upcoming"><?php _e('Only Upcoming','booked'); ?></option>
														<option value="past"><?php _e('Only Past','booked'); ?></option>
													</select>
												</div>
												
												<br>
												<div class="select-box">
													<label class="booked-color-label" for="appointment_type"><?php _e('Approved and/or Pending','booked'); ?>:</label>
													<select name="appointment_type">
														<option value="any" selected="selected"><?php _e('Approved &amp; Pending','booked'); ?></option>
														<option value="publish"><?php _e('Only Approved','booked'); ?></option>
														<option value="draft"><?php _e('Only Pending','booked'); ?></option>
													</select>
												</div>
												
												<?php if (!empty($calendars)): ?>
												
													<br>					
													<div class="select-box">
														<label class="booked-color-label" for="calendar_id"><?php _e('Calendar','booked'); ?>:</label>
														<select name="calendar_id">
															<option value="" selected="selected"><?php _e('All Calendars','booked'); ?></option>
															<?php
															foreach($calendars as $calendar):
																?><option value="<?php echo $calendar->term_id; ?>"><?php echo $calendar->name; ?></option><?php
															endforeach;
															?>
														</select>
													</div>
							
												<?php endif; ?>
												
											</div>
										</div>
										
										<div class="section-row submit-section" style="padding:0;">
											<p class="submit">
												<button class="button-primary"><i class="fa fa-external-link-square"></i>&nbsp;&nbsp;<?php _e('Export Appointments to CSV','booked'); ?></button>
											</p>
										</div>
										
									</div>
									
									<input type="hidden" name="booked_export_appointments_csv" value="1">
								
								</form>
							
							<?php break;
						
						endswitch;
					
					endif;
					
				endforeach;
				
				?>
	
			</div>
	
		</div>

	<?php endif; ?>

</div>