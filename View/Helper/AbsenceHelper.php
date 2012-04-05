<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Collection of methods useful for displaying absences
 */
class AbsenceHelper extends AppHelper {

/**
 * Intelligently formats a date range
 */
	public function formatDateRange($start, $end, $options = array()) {
		// set up the date formats
		if (isset($options['short']) && $options['short']) {
			$start_date_format = $end_date_format = 'm/d/y g:i a';
		} else {
			$start_date_format = $end_date_format = 'D, M j Y g:i a';
		}
		$start_timestamp = strtotime($start);
		$end_timestamp = strtotime($end);
		$same_day = date('dmY', $start_timestamp) === date('dmY', $end_timestamp);
		if ($same_day) {
			$end_date_format = 'g:i a';
		}
		return date($start_date_format, $start_timestamp) . ' - ' . date($end_date_format, $end_timestamp);
	}
}
