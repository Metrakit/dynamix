<?php

class NavLink extends Eloquent {

	/**
	 * Parameters
	 */
	protected $table = 'navigation_links';

    public function trackable() {
        return $this->morphTo();
    }

    public static function getNotAllowed () {
        $notAllowed = array();

        /*  //get all Nav with a page as resource
        $navs = Nav::where('navigable_type','=',get_class())->get();
        $allowed = array();
        foreach ( $navs as $nav ) {
            $allowed[] = $nav->navigable->id;
        }

        //get all Pages
        $navlink = NavLink::all();

        //store each resources
        foreach ( $navlink as  $navl ) {
            if ( !in_array( $navl->id, $allowed ) ) {
                $notAllowed[] = $navl;
            }
        }*/

        return $notAllowed;
    }

    public function url() {
        return $this->url;
    }


}