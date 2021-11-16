<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => $this->company,
            'title' => $this->title,
            'description' => $this->description,
            'salary' => $this->salary,
            'location' => $this->location,
            'category' => $this->category_id,
            'user' => $this->user_id,
            'post_date' => $this->post_date->format('d/m/Y H:i:s'),
            'created_at' => $this->created_at->format('d/m/Y H:i:s')
        ];
    }
}
