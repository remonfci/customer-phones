<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Response\JsonResponseDefault;
use DDD\Domain\Services\Customer\CustomerServiceInterface;
use DDD\Domain\ValueObject\Filter\CustomerFilter;
use DDD\Domain\ValueObject\Paging;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CustomerController extends BaseController
{
    public function __construct(
        private CustomerServiceInterface $customerService,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $state = $request->get('state');

        $filter = new CustomerFilter(
            ((int) $request->get('countryCode')) ?: null,
            (is_numeric($state)) ? (int) $state : null
        );

        $customers = $this->customerService->findAll(
            $filter,
            new Paging((int) $request->get('page'), (int) $request->get('limit'))
        );

        return JsonResponseDefault::create(true, $customers);
    }
}
