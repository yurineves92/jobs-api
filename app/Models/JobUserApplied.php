<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobUserApplied extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resume', 'job_id', 'user_id'
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
    public function users(){
        return $this->belongsTo('App\User');
    }

    public function jobs(){
        return $this->belongsTo('App\Models\Jobs');
    }
}