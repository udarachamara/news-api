<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'disabled' => $this->disabled,
            'createAt' => $this->created_at ? $this->created_at->format(env('DATE_FORMAT')) : 'N/A',
            'updateAt' => $this->updated_at ? $this->created_at->format(env('DATE_FORMAT')) : 'N/A',
        ];
    }
}
