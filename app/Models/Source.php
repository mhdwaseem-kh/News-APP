<?php

namespace App\Models;

use App\Constants\Models\SourceColumns;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends BaseModel {

    protected $table = SourceColumns::TABLE;
    protected $fillable = SourceColumns::FILLABLE;

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


}
