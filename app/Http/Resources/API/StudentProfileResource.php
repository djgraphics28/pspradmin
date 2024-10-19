<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentProfileResource extends JsonResource
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
            'student_nummber' => $this->student_nummber,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->laast_name,
            'email' => $this->email,
            'contact_number' => $this->contact_number,
            'profile_picture' => $this->hasMedia('avatars') ? $this->getFirstMediaUrl('avatars') : null,
            // Add other user fields as necessary
        ];
    }
}
