<?php

class CommentVote extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comment_votes';
    public $timestamps = false;

	/**
     * A CommentVote has one comment
     *
     * @return mixed
     */
	public function comment() {
        return $this->hasOne('Comment');
    }

}