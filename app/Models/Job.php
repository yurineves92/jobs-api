<?php

namespace App\Models;

use App\Concerns\Filterable;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company', 'title', 'description', 'salary', 'location', 'post_date', 'category_id', 'user_id'
    ];

    protected $dates = [
        'post_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Relations
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function jobsApplied()
    {
        return $this->hasMany('App\Models\JobUserApplied');
    }

    public function replyUserJobs()
    {
        return $this->hasMany('App\Models\ReplyUserJob');
    }
}
