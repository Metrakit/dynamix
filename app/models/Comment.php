<?php

class Comment extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
     * A Comment has many votes
     *
     * @return mixed
     */
	public function votes() {
        return $this->hasMany('CommentVote');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}