<?php

namespace App\Models;

use App\Constants\Models\AuthorColumns;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Author extends BaseModel {

    protected $table = AuthorColumns::TABLE;
    protected $fillable = AuthorColumns::FILLABLE;

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return MorphMany
     */
    public function users(): MorphMany
    {
        return $this->morphMany(User::class, 'favoritable');
    }

}
