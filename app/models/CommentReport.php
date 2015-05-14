<?php

class CommentReport extends Eloquent {
	
	/**
	 * Table name
	 */
	protected $table = 'comment_report';

	public function user() {
        return AuthUser::find($this->user_id);
    }

    public function comment() {
        return $this->hasOne('Comment');
    }
	
}
