<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'type' => 'notifications',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'entity_type' => $this->entity_type,
                'entity_id' => $this->entity_id,
                'seen_at' => $this->seen_at,
                'created_at' =>date('Y-m-d g:i a',strtotime($this->created_at)),
            ],
        ];
    }

}
