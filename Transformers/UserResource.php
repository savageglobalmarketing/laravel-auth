<?php

namespace Maxcelos\Auth\Transformers;

//use Maxcelos\Acl\Transformers\SimpleRoleResource;
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
			'is_admin' => $this->is_admin,
			'is_accountant' => $this->is_accountant,
            'tokens' => TokenResource::collection($this->tokens)
            //'roles' => SimpleRoleResource::collection($this->roles)
		];
    }
}
