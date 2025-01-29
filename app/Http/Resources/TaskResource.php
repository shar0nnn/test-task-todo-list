<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'name' => $this->name,
            'description' => $this->description,
            'is_completed' => (bool)$this->is_completed,
            'created_at' => $this->created_at->format('d:m:Y'),
        ];
    }
}
