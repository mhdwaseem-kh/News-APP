<?php

namespace App\Http\Resources\ArticleResources;

use App\Constants\Models\ArticleColumns;
use App\Constants\Models\AuthorColumns;
use App\Constants\Models\CategoryColumns;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class ArticleResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'title' => $this[ArticleColumns::TITLE],
            'content' => $this[ArticleColumns::CONTENT],
            'image' => $this[ArticleColumns::IMAGE],
            'published_at' => $this[ArticleColumns::PUBLISHED_AT],
            'category' => $this->category[CategoryColumns::NAME],
            'author' => $this->author[AuthorColumns::NAME],
        ]);
    }
}
