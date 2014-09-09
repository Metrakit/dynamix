<?php

class GoogleAnalyticsAPIController extends BaseController {

	protected $url = 'http://metra-concept.fr';

	public function getSessionsPerDay () {
		$site_id = Analytics::getSiteIdByUrl($this->url);

		if (!empty($site_id)) {
			$stats = Analytics::query($site_id, '60daysAgo', 'yesterday', 'ga:sessions', array('dimensions' => 'ga:year,ga:month,ga:day') )->rows;

		    $keys = array('year','month','day','sessions');
		    $tempsStats = array();
		    foreach ( $stats as $stat ) {
		        $o = new stdClass();
		        $o->date = $stat[0].'-'.$stat[1].'-'.$stat[2];
		        $o->sessions = (int) $stat[3];
		        $tempStats[] = $o;
		    }
		    return $stats = json_encode($tempStats);
		}
		return null;
	}
}