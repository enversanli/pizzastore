<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'no' => $this->no,
            'product' => $this->product,
            'address' => $this->address,
            'piece' => $this->piece,
            'image' => $this->image,
            'total' => $this->total,
            'created_at' => $this->created_at
        ];
    }
}
