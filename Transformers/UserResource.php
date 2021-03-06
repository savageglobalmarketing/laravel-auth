<?php

namespace SavageGlobalMarketing\Auth\Transformers;

//use SavageGlobalMarketing\Acl\Transformers\SimpleRoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
			'email' => $this->email,
			'email_verified_at' => $this->email_verified_at,
            // 'tokens' => TokenResource::collection($this->tokens)
            // 'roles' => SimpleRoleResource::collection($this->roles)
            // 'permissions' =>
		];
    }
}
