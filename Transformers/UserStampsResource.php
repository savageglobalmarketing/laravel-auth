<?php

namespace SavageGlobalMarketing\Auth\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStampsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'uuid' => $this->uuid,
			'name' => $this->name,
			'email' => $this->email
		];
    }
}
