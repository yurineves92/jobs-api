<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobUserAppliedResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'job_id' => $this->job_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y H:i:s')
        ];
    }
}
