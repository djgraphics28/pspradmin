<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorProfileResource extends JsonResource
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
            'name' => $this->name,
            'position' => $this->position,
            'title' => $this->title,
            'email' => $this->email,
            'profile_picture' => $this->hasMedia('avatars') ? $this->getFirstMediaUrl('avatars') : null,
            // Add other user fields as necessary
        ];
    }
}
