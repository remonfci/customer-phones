<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Response\JsonResponseDefault;
use DDD\Domain\Services\Country\CountryServiceInterface;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class CountryController extends BaseController
{
    public function __construct(
        private CountryServiceInterface $countryService,
    ) {
    }

    public function index(): JsonResponse
    {
        return JsonResponseDefault::create(true, $this->countryService->findAll());
    }
}
