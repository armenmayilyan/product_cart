<?php


namespace App\Repository;


use App\Contracts\UserInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserInterface
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $email
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     */
    public function getByEmail($email)
    {
        return $this->model->query()->where('email', $email)->first();
    }
}
