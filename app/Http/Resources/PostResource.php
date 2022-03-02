<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'author' => User::find($this->user_id)->name,
            'category' => $this->whenLoaded('category'),
            'title' => $this->title,
            'body' => $this->body,
            'img_path' => $this->img_path,
            'published_date' => $this->created_at->diffForHumans(),
            'visitors_count' => views(Post::find($this->id))->unique()->count(),
        ];
    }
}
