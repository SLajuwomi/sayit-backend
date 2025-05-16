<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User
 *
 * @property int $id
 * @property string $screen_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * This method defines the structure of the user data when it's returned
     * via an API response. It ensures only necessary and safe data is exposed.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'screen_name' => $this->screen_name,
            'email' => $this->email,
            'created_at' => $this->created_at?->toIso8601String(), // Format timestamp for consistency
            'updated_at' => $this->updated_at?->toIso8601String(), // Format timestamp for consistency
        ];
    }
}