<?php

declare(strict_types=1);

namespace Functional;

use App\Services\ApiService;
use DDD\Domain\ValueObject\Country\Morocco;
use DDD\Domain\ValueObject\Filter\CustomerFilter;
use Illuminate\Http\Request;

class CustomerPhoneTest extends WebTestCase
{
    public function testSuccessfulRetrievalValidStateCustomerPhones()
    {
        $request = Request::create(
            env('API_URL') . 'customers',
            'GET',
            ['state' => CustomerFilter::VALID_STATE]
        );
        $response = json_decode(app()->handle($request)->getContent(), true);
        $this->assertEquals(ApiService::SUCCESS_HTTP_RESPONSE_STATUS_CODE, $response['code']);

        foreach ($response['data'] as $datum) {
            $this->assertTrue($datum['phone']['isValid']);
        }
    }

    public function testSuccessfulRetrievalInvalidStateCustomerPhones()
    {
        $request = Request::create(
            env('API_URL') . 'customers',
            'GET',
            ['state' => CustomerFilter::INVALID_STATE]
        );
        $response = json_decode(app()->handle($request)->getContent(), true);
        $this->assertEquals(ApiService::SUCCESS_HTTP_RESPONSE_STATUS_CODE, $response['code']);

        foreach ($response['data'] as $datum) {
            $this->assertFalse($datum['phone']['isValid']);
        }
    }

    public function testSuccessfulRetrievalCustomerPhonesFilteredByCountry()
    {
        $country = new Morocco();
        $request = Request::create(
            env('API_URL') . 'customers',
            'GET',
            ['countryCode' => $country->getCode()]
        );
        $response = json_decode(app()->handle($request)->getContent(), true);
        $this->assertEquals(ApiService::SUCCESS_HTTP_RESPONSE_STATUS_CODE, $response['code']);

        foreach ($response['data'] as $datum) {
            $this->assertEquals('Morocco', $datum['phone']['country']['name']);
        }
    }

    public function testSuccessfulRetrievalCustomerPhonesFilteredByCountryAndInvalidState()
    {
        $country = new Morocco();
        $request = Request::create(
            env('API_URL') . 'customers',
            'GET',
            ['state' => CustomerFilter::INVALID_STATE, 'countryCode' => $country->getCode()]
        );
        $response = json_decode(app()->handle($request)->getContent(), true);
        $this->assertEquals(ApiService::SUCCESS_HTTP_RESPONSE_STATUS_CODE, $response['code']);

        foreach ($response['data'] as $datum) {
            $this->assertEquals('Morocco', $datum['phone']['country']['name']);
            $this->assertFalse($datum['phone']['isValid']);
        }
    }
}
