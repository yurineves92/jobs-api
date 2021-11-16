<?php

namespace App\Http\Resources;

use App\Models\Job;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class JobUserAppliedResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'job' => Job::where('id', $this->job_id)->get(['id', 'title']),
            'user' => User::where('id', $this->user_id)->get(['id', 'name', 'email']),
            'created_at' => $this->created_at->format('d/m/Y H:i:s')
        ];
    }
}
