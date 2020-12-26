<?php

namespace SavageGlobalMarketing\Auth\Transformers;

use SavageGlobalMarketing\Auth\Transformers\UserStampsResource as UserStampsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'uuid' => $this->uuid,
			'name' => $this->name,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'deleted_at' => $this->deleted_at,
			'creator' => UserStampsResource::make($this->creator),
			'editor' => UserStampsResource::make($this->editor),
			'destroyer' => UserStampsResource::make($this->destroyer),
		];
    }
}
