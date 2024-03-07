<?php

declare(strict_types=1);

namespace App\Services\Application\Database\Repository;

use App\Http\Requests\Application\StatusApplicationRequest;
use App\Http\Requests\Application\AddApplicationRequest;
use App\Http\Requests\Application\UpdateApplicationRequest;
use App\Services\Application\Database\Models\Application;
use Carbon\Carbon;
use Gerfey\Repository\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ApplicationRepository extends Repository
{
    protected $entity = Application::class;

    public function addApplication(AddApplicationRequest $addApplicationRequest): bool
    {
        return $this->createQueryBuilder()
            ->insert([
                'name' => $addApplicationRequest['name'],
                'email' => $addApplicationRequest['email'],
                'message' => $addApplicationRequest['message'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    public function updateApplication(int $id, UpdateApplicationRequest $updateApplicationRequest): bool
    {
        $application = $this->createQueryBuilder()
            ->where('id', '=', $id)
            ->first();

        if ($application === false)
        {
            return false;
        }


        $updateApplication = $application->fill([
            'status' => $updateApplicationRequest['status'],
            'comment' => $updateApplicationRequest['comment'],
            'updated_at' => Carbon::now(),
        ]);

        return $updateApplication->save();
    }

    public function getListStatusApplications(StatusApplicationRequest $activeApplicationRequest): array|Collection
    {
        return $this->createQueryBuilder()
            ->where('status', '=', $activeApplicationRequest['status'])
            ->orderByDesc('updated_at')
            ->get();
    }
}
