<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        $row = [
            'type' => 'posts',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'created_by' => $this->created_by,
                'created_at' =>date('Y-m-d g:i a',strtotime($this->created_at)),
            ],
            'relationships' => [
                'creator' => new TinyUserResource($this->creator),
            ]
        ];
        return $row;
    }
}
