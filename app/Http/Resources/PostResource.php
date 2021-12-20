<?php

namespace App\Http\Resources;

use App\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $author = $this->author->name ?? "admin";
        $tagIds = $this->tag_id ? json_decode($this->tag_id) : null;
        $comments = $this->countComments() ?? 0;
        $tags = [];

        if ($tagIds) {
            foreach ($tagIds as $key => $value) {
                $tag = (new Tag())->setConnection($request->lang)->whereId($value)->first();
                $tags[] = $tag->name;
            }
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $author,
            'tags' => $tags,
            'views' => $this->views,
            'like' => $this->like,
            'dislike' => $this->dislike,
            'comments' => $comments,
            'createAt' => $this->created_at ? $this->created_at->format(env('DATE_FORMAT')) : 'N/A',
            'updateAt' => $this->updated_at ? $this->created_at->format(env('DATE_FORMAT')) : 'N/A',
        ];
    }
}
