<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Vimeo\Laravel\Facades\Vimeo;
class UserResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $row=[
            'type' => 'users',
            'id' => $this->id,
            'attributes' => [
                'type' => $this->type,
                'name' => $this->name,
                'email' => $this->email,
                'mobile' => $this->mobile,
                'image' => $this->image,
                'last_logged_in_at' => $this->last_logged_in_at,
                'last_ip' => $this->last_ip,
                'created_at' =>date('Y-m-d',strtotime($this->created_at)),
            ],
            'relationships' => [

            ],
            'token'=>token(),
        ];

        return $row;
    }
}
