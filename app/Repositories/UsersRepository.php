<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * 建構子
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 新增處理
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function create(array $data)
    {
        try {
            $result = $this->user::create($data);
            return $result;

        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
