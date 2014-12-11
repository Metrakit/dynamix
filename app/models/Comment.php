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
    
    public function votesPositives() {
        $count = $this->votes()->where('is_positive',1)->count();
        return ($count==0?'':$count);
    }
    public function votesNegatives() {
        $count = $this->votes()->where('is_positive',0)->count();
        return ($count==0?'':$count);
    }


    public function userHasVotePositive($user_id) {
        //check if comment vote for this user exist
        $vote = $this->votes()->where('user_id', $user_id)->where('is_positive', true)->first();
        if (!empty($vote)) {
            return true;
        }
        return false;
    }
    public function userHasVoteNegative($user_id) {
        //check if comment vote for this user exist
        $vote = $this->votes()->where('user_id', $user_id)->where('is_positive', false)->first();
        if (!empty($vote)) {
            return true;
        }
        return false;
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