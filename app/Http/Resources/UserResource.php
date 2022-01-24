<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'idUser'=>$this->id,
            'name'=>$this->name,
            'username'=>$this->user_name,
            'telephone'=>$this->telephone,
            'registrationDate'=>$this->registration_date,
            'expiryDate'=>$this->expiry_date
        ];
    }
}
