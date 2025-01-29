<?php

namespace App\Services\UserServices;


use App\Constants\Models\UserColumns;
use App\Models\User;
use App\Repositories\UserRepositories\UserRepository;
use App\Services\BaseService;
use Exception;


class UserService extends BaseService
{


    /**
     * UserService constructor.
     * @param UserRepository $repository
     * @throws Exception
     */
    public function __construct(protected UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function addUser(array $data)
    {
        return $this->create([
            UserColumns::EMAIL => $data[UserColumns::EMAIL],
            UserColumns::NAME => $data[UserColumns::NAME],
            UserColumns::PASSWORD => $data[UserColumns::PASSWORD],
        ]);
    }


    /**
     * @param User $user
     * @return mixed
     */
    public function listFavouriteCategories(User $user): mixed
    {
        return $this->repository->listFavouriteCategories(user: $user);
    }

    /**
     * @param User $user
     * @param int $categoryId
     * @return void
     */
    public function addFavouriteCategory(User $user, int $categoryId): void
    {
        $this->repository->addFavouriteCategory(user: $user, categoryId: $categoryId);
    }

    /**
     * @param User $user
     * @param int $categoryId
     * @return void
     */
    public function removeFavouriteCategory(User $user, int $categoryId): void
    {
        $this->repository->removeFavouriteCategory(user: $user, categoryId: $categoryId);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function listFavouriteAuthors(User $user): mixed
    {
        return $this->repository->listFavouriteAuthors(user: $user);
    }

    /**
     * @param User $user
     * @param int $authorId
     * @return void
     */
    public function addFavouriteAuthor(User $user, int $authorId): void
    {
        $this->repository->addFavouriteAuthor(user: $user, authorId: $authorId);
    }

    /**
     * @param User $user
     * @param int $authorId
     * @return void
     */
    public function removeFavouriteAuthor(User $user, int $authorId): void
    {
        $this->repository->removeFavouriteAuthor(user: $user, authorId: $authorId);
    }


}
