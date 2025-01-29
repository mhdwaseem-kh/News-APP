<?php

namespace App\Models;

use App\Constants\Models\FavoriteColumns;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends BaseModel {

    protected $table = FavoriteColumns::TABLE;
    protected $fillable = FavoriteColumns::FILLABLE;


    /**
     * @return MorphTo
     */
    public function favoritable(): MorphTo
    {
        return $this->morphTo();
    }

}
