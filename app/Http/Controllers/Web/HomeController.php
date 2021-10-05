<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Services\ApiService;
use DDD\Domain\ValueObject\Filter\CustomerFilter;
use DDD\Domain\ValueObject\Paging;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __construct(
        private ApiService $apiService
    ) {
    }

    public function __invoke(Request $request): View
    {
        $state = $request->get('state');

        $filter = new CustomerFilter(
            (int) $request->get('countryCode'),
            (is_numeric($state)) ? (int) $state : null
        );

        $paging = new Paging((int) $request->get('page'), (int) $request->get('limit'));

        $customers = $this->apiService->get('customers', $filter->__toArray(), $paging);
        $countries = $this->apiService->get('countries', $filter->__toArray());

        return view('customersPhoneNumbers', compact('customers', 'countries', 'filter', 'paging'));
    }
}
