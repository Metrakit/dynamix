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
    
    public function votesCount() {
        $count = 0;
        foreach ($this->votes->all() as $vote) {
            $count = $count + ($vote->is_positive?1:-1);
        }
        return ($count==0?'':$count);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function children() {
        return $this->morphMany('Comment', 'commentable');
    }

    public function user () {
        //To adapt for other user system
        return AuthUser::find($this->user_id);
    }
}