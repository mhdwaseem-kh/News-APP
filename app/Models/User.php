<?php

namespace App\Models;

use App\Constants\Models\FavoriteColumns;
use App\Constants\Models\UserColumns;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        UserColumns::NAME,
        UserColumns::EMAIL,
        UserColumns::PASSWORD,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        UserColumns::PASSWORD,
        UserColumns::REMEMBER_TOKEN,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            UserColumns::EMAIL_VERIFIED_AT => 'datetime',
            UserColumns::PASSWORD => 'hashed',
        ];
    }

    /**
     * Interact with the user's password.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value)
        );
    }


    /**
     * Get all the favorite Categories that are assigned this User.
     * @return MorphToMany
     */
    public function favoriteCategories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'favoritable', FavoriteColumns::TABLE);
    }

    /**
     * Get all the favorite Authors that are assigned this tag.
     * @return MorphToMany
     */
    public function favoriteAuthors(): MorphToMany
    {
        return $this->morphedByMany(Author::class, 'favoritable', FavoriteColumns::TABLE);
    }
}
