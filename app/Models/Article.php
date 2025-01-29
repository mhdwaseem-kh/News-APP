<?php

namespace App\Models;

use App\Constants\Models\ArticleColumns;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends BaseModel {

    protected $table = ArticleColumns::TABLE;
    protected $fillable = ArticleColumns::FILLABLE;


    /**
     * @return BelongsTo
     */
    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
