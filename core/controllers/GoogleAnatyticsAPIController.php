<?php

class GoogleAnalyticsAPIController extends BaseController {

	protected $url = 'http://metra-concept.fr';
	protected $daysAgo = '30daysAgo';

	public function getSessionsPerDay () {
		$site_id = Analytics::getSiteIdByUrl($this->url);

		if (!empty($site_id)) {
			$stats = Analytics::query($site_id, $this->daysAgo, 'yesterday', 'ga:sessions', array('dimensions' => 'ga:year,ga:month,ga:day') )->rows;

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


	public function getSessionsCount () {
		$site_id = Analytics::getSiteIdByUrl($this->url);

		if (!empty($site_id)) {
			$stats = Analytics::query($site_id, $this->daysAgo, 'yesterday', 'ga:sessions')->rows;
		   
		    return $stats[0][0];
		}
		return null;
	}

	public function getUserCount () {
		return $this->getSimpleData('ga:users');
	}

	public function getPageSeenCount () {
		return $this->getSimpleData('ga:pageviews');
	}

	public function getTimeBySession () {
		return $this->getSimpleData('ga:sessionDuration');
	}

	public function getRebound () {
		$site_id = Analytics::getSiteIdByUrl($this->url);

		if (!empty($site_id)) {
			$stats = Analytics::query($site_id, $this->daysAgo, 'yesterday', 'ga:bounceRate')->rows;
		   
		    return round( (float) $stats[0][0], 2).'%';
		}
		return null;
	}

	public function getNewOnReturningVisitor () {
		$site_id = Analytics::getSiteIdByUrl($this->url);

		if (!empty($site_id)) {
			$stats = Analytics::query($site_id, $this->daysAgo, 'yesterday', 'ga:percentNewSessions ')->rows;
		   
		    $tempsStats = array();
		    foreach ( $stats as $stat ) {
		        $o = new stdClass();
		        $o->label = Lang::get('admin.newVisitor');
		        $o->value = round( (float) $stat[0], 2);
		        $tempStats[] = $o;
		    }
		    $o = new stdClass();
	        $o->label = Lang::get('admin.returningVisitor');
	        $o->value = round( 100-(float) $stat[0], 2);
	        $tempStats[] = $o;
		    return $stats = json_encode($tempStats);
		}
		return null;
	}


	private function getSimpleData ( $metrics ) {
		$site_id = Analytics::getSiteIdByUrl($this->url);

		if (!empty($site_id)) {
			$stats = Analytics::query($site_id, $this->daysAgo, 'yesterday', $metrics)->rows;
		   
		    return $stats[0][0];
		}
		return null;
	}

}