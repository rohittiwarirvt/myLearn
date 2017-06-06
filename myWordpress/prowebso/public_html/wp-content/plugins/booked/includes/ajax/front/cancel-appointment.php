<?php
	
$appt_id = $_POST['appt_id'];
$title = get_post_meta($appt_id,'_appointment_title',true);
$timeslot = get_post_meta($appt_id,'_appointment_timeslot',true);
$timestamp = get_post_meta($appt_id,'_appointment_timestamp',true);
$cf_meta_value = get_post_meta($appt_id,'_cf_meta_value',true);
$timeslots = explode('-',$timeslot);
$time_format = get_option('time_format');
$date_format = get_option('date_format');
$hide_end_times = get_option('booked_hide_end_times',false);

$timestamp_start = strtotime(date_i18n('Y-m-d',$timestamp).' '.$timeslots[0]);
$timestamp_end = strtotime(date_i18n('Y-m-d',$timestamp).' '.$timeslots[1]);
$current_timestamp = current_time('timestamp');

if ($timeslots[0] == '0000' && $timeslots[1] == '2400'):
	$timeslotText = esc_html__('All day','booked');
else :
	$timeslotText = date_i18n($time_format,$timestamp_start).(!$hide_end_times ? '&ndash;'.date_i18n($time_format,$timestamp_end) : '');
endif;

$appt = get_post( $appt_id );
$appt_author = $appt->post_author;

$appointment_calendar_id = get_the_terms( $appt_id,'booked_custom_calendars' );
if (!empty($appointment_calendar_id)):
	foreach($appointment_calendar_id as $calendar):
		$calendar_id = $calendar->term_id;
		break;
	endforeach;
else:
	$calendar_id = false;
endif;
		
if (!empty($calendar_id)): $calendar_term = get_term_by('id',$calendar_id,'booked_custom_calendars'); $calendar_name = $calendar_term->name; else: $calendar_name = false; endif;

$day_name = date('D',$timestamp);
$timeslotText = apply_filters('booked_emailed_timeslot_text',$timeslotText,$timestamp,$timeslot,$calendar_id);

if (get_current_user_id() == $appt_author):

	// Send an email to the Admin?
	if ($timestamp_start >= $current_timestamp):

		$email_content = get_option('booked_admin_cancellation_email_content');
		$email_subject = get_option('booked_admin_cancellation_email_subject');
		if ($email_content && $email_subject):
			$admin_email = booked_which_admin_to_send_email($calendar_id);
			$user_name = booked_get_name( $appt_author );
			$user_data = get_userdata( $appt_author );
			$email = $user_data->user_email;
			$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
			$replacements = array($user_name,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
			$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_subject = str_replace($tokens,$replacements,$email_subject);
			do_action( 'booked_admin_cancellation_email', $admin_email, $email_subject, $email_content );
		endif;
	
	endif;
	
	do_action('booked_appointment_cancelled',$appt_id);
	wp_delete_post($appt_id,true);

endif;