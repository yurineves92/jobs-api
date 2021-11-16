<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\User;
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
            'category' => Category::where('id', $this->category_id)->get(['id', 'name']),
            'user' => User::where('id', $this->user_id)->get(['id', 'name', 'email']),
            'post_date' => $this->post_date->format('d/m/Y H:i:s'),
            'created_at' => $this->created_at->format('d/m/Y H:i:s')
        ];
    }
}
