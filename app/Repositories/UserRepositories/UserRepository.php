<?php

namespace App\Repositories\UserRepositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     * @param $persistentClass
     * @param string[] $defaultOrder
     */
    public function __construct($persistentClass, array $defaultOrder = ['id' => 'desc'])
    {
        parent::__construct($persistentClass, $defaultOrder);
    }

    /**
     * @param User $user
     * @return Collection|mixed
     */
    public function listFavouriteCategories(User $user): mixed
    {
        return $user->favoriteCategories()->get();
    }

    /**
     * @param User $user
     * @param int $categoryId
     * @return void
     */
    public function addFavouriteCategory(User $user, int $categoryId): void
    {
        $user->favoriteCategories()->attach($categoryId);
    }

    /**
     * @param User $user
     * @param int $categoryId
     * @return void
     */
    public function removeFavouriteCategory(User $user, int $categoryId): void
    {
        $user->favoriteCategories()->detach($categoryId);
    }

    /**
     * @param User $user
     * @return Collection|mixed
     */
    public function listFavouriteAuthors(User $user): mixed
    {
        return $user->favoriteAuthors()->get();
    }

    /**
     * @param User $user
     * @param int $categoryId
     * @return void
     */
    public function addFavouriteAuthor(User $user, int $authorId): void
    {
        $user->favoriteAuthors()->attach($authorId);
    }

    /**
     * @param User $user
     * @param int $authorId
     * @return void
     */
    public function removeFavouriteAuthor(User $user, int $authorId): void
    {
        $user->favoriteAuthors()->detach($authorId);
    }

}
