<?php

namespace Tests;

use Codeception\Util\HttpCode;

class Aaa_CreateOfficeCest
{

    private $json_decode;

    public function _before(FunctionalTester $I)
    {
    }


    /**
     * @param FunctionalTester $I
     */
    public function shouldCreateAnOffice(FunctionalTester $I)
    {
        $I->sendPost('/v1/offices', [
            'name' => 'Housfy Madrid' . uniqid(),
            'address' => [[
                'postalcode'   => '02742',
                'province'     => 'Madrid',
                'city'         => 'Madrid',
                'address_line' => 'C/ Gran vía, 109'
            ]]
        ]);

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();

        $response          = $I->grabResponse();
        $this->json_decode = json_decode($response, true);

        $this->testNewOffice($I);
    }


    /**
     * @param FunctionalTester $I
     */
    private function testNewOffice(FunctionalTester $I)
    {
        $I->seeResponseMatchesJsonType([
            'uuid' => 'string',
            'name' => 'string',
            'address' => [
                'postalcode'   => 'string',
                'province'     => 'string',
                'city'         => 'string',
                'address_line' => 'string',
            ]
        ]);

        $I->assertCount(3, $this->json_decode);
    }
}
