<?php

namespace App\Models;

use App\Constants\Models\CategoryColumns;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends BaseModel {

    protected $table = CategoryColumns::TABLE;
    protected $fillable = CategoryColumns::FILLABLE;

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return HasMany
     */
    public function sources(): HasMany
    {
        return $this->hasMany(Source::class);
    }

    /**
     * @return MorphMany
     */
    public function users(): MorphMany
    {
        return $this->morphMany(User::class, 'favoritable');
    }

}
