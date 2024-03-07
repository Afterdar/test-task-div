<?php

declare(strict_types=1);

namespace App\Services\User\Http\Controller;

use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\Database\Repository\UserRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $userRegisterRequest): JsonResponse
    {
        $registerUser = $this->userRepository->registerUser($userRegisterRequest);

        if ($registerUser === false)
        {
            throw new Exception('Произошла ошибка регистрации пользователя');
        }

        return ResponseBuilder::success(['Пользователь зарегистрирован']);
    }

    public function updateUser(UpdateUserRequest $updateUserRequest): JsonResponse
    {
        $user = auth()->user();

        $userUpdate = $this->userRepository->updateUser($updateUserRequest, $user['id']);

        if ($userUpdate === false)
        {
            throw new Exception('Произошла ошибка обновления пользователя');
        }

        return ResponseBuilder::success(['Пользователь успешно обновлен']);
    }
}
