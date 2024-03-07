<?php

declare(strict_types=1);

use App\Services\Application\Http\Controller\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function (): void {
        Route::prefix('application')->group(
            function (): void {
                Route::post('/add', [ApplicationController::class, 'addApplication']);
            }
        );
    }
);

Route::middleware('auth:api')->group(
    function (): void {
        Route::prefix('v1')->group(
            function (): void {
                Route::prefix('application')->group(
                    function (): void {
                        Route::get('/listStatus', [ApplicationController::class, 'getListStatusApplications']);
                        Route::get('/getById/{id}', [ApplicationController::class, 'getApplicationById']);

                        Route::put('/update/{id}', [ApplicationController::class, 'updateApplication']);
                        Route::delete('/delete/{id}', [ApplicationController::class, 'deleteApplication']);
                    }
                );
            }
        );
    }
);
