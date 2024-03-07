<?php

declare(strict_types=1);

namespace App\Services\Application\Http\Controller;

use App\Http\Requests\Application\StatusApplicationRequest;
use App\Http\Requests\Application\AddApplicationRequest;
use App\Http\Requests\Application\UpdateApplicationRequest;
use App\Services\Application\Database\Repository\ApplicationRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ApplicationController extends BaseController
{
    private ApplicationRepository $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function addApplication(AddApplicationRequest $addApplicationRequest): JsonResponse
    {
        $addApplication = $this->applicationRepository->addApplication($addApplicationRequest);

        if ($addApplication === false) {
            throw new Exception('Произошла ошибка создания заявки');
        }

        return ResponseBuilder::success(['Заявка успешно создана']);
    }

    public function updateApplication(int $id, UpdateApplicationRequest $updateApplicationRequest): JsonResponse
    {
        $updateApplication = $this->applicationRepository->updateApplication($id, $updateApplicationRequest);

        if ($updateApplication === false)
        {
            throw new Exception('Заявка не найдена, неверный id');
        }

        return ResponseBuilder::success(['Заявка успешно обработана']);
    }

    public function deleteApplication (int $id): JsonResponse
    {
        $deleteApplication = $this->applicationRepository->delete($id);

        if ($deleteApplication === 0)
        {
            throw new Exception('Заявка не найдена, неверный id');
        }

        return ResponseBuilder::success(['Заявка успешно удалена']);
    }

    public function getListStatusApplications (StatusApplicationRequest $getListStatusApplications): JsonResponse
    {
        $applications = $this->applicationRepository->getListStatusApplications($getListStatusApplications);

        return ResponseBuilder::success($applications->toArray());
    }

    public function getApplicationById (int $id): JsonResponse
    {
        $application = $this->applicationRepository->find($id);

        if ($application === null)
        {
            throw new Exception('Заявка не найдена, неверный id');
        }

        return ResponseBuilder::success($application->toArray());
    }
}
