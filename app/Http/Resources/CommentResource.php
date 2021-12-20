<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'commentBy' => $this->comment_by ?? "anonymous user",
            'content' => $this->content ?? "",
            'createAt' => $this->created_at ? $this->created_at->format(env('DATE_FORMAT')) : 'N/A',
            'updateAt' => $this->updated_at ? $this->created_at->format(env('DATE_FORMAT')) : 'N/A',
        ];
    }
}
