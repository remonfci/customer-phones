<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ApiException;
use DDD\Domain\ValueObject\Paging;
use Illuminate\Http\Request;

final class ApiService
{
    public const SUCCESS_HTTP_RESPONSE_STATUS_CODE = 200;

    public function get(string $prefix, array $parameters, Paging $paging = null)
    {
        try {
            if ($paging) {
                $parameters = array_merge($parameters, ['page' => $paging->getPage(), 'limit' => $paging->getLimit()]);
            }

            $request = Request::create(
                env('API_URL') . $prefix,
                'GET',
                $parameters
            );

            $response = json_decode(app()->handle($request)->getContent(), true);
            if ($this->isValidResponse($response)) {
                return $response['data'];
            }

            throw new ApiException('Invalid response data!');
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
    }

    private function isValidResponse(array $response): bool
    {
        if (! empty($response['code'])
            && $response['code'] == self::SUCCESS_HTTP_RESPONSE_STATUS_CODE
            && isset($response['data'])) {
            return true;
        }

        return false;
    }
}
