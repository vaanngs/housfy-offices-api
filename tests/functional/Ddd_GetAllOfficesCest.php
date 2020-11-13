<?php

declare(strict_types=1);

namespace Tests;

use Codeception\Util\HttpCode;

class Ddd_GetAllOfficesCest
{
    private $json_decode;

    public function _before(FunctionalTester $I)
    {
    }


    /**
     * @param FunctionalTester $I
     */
    public function shouldReturnAllOffices(FunctionalTester $I)
    {
        $I->sendGET('/v1/offices');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        $response          = $I->grabResponse();
        $this->json_decode = json_decode($response, true);

        $this->testEachOffice($I);
    }


    /**
     * @param FunctionalTester $I
     */
    private function testEachOffice(FunctionalTester $I)
    {
        $I->seeResponseMatchesJsonType([
            'uuid'    => 'string',
            'name'    => 'string',
            'address' => [
                'postalcode'   => 'string',
                'province'     => 'string',
                'city'         => 'string',
                'address_line' => 'string',
            ],
        ], '$.*');

        $I->assertCount(3, $this->json_decode[0]);
    }
}
