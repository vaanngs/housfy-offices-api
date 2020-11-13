<?php

declare(strict_types=1);

namespace Tests;

use Codeception\Util\HttpCode;

class Bbb_UpdateOfficeCest
{
    private $json_decode;

    public function _before(FunctionalTester $I)
    {
    }


    /**
     * @param FunctionalTester $I
     */
    public function shouldUpdateAnOffice(FunctionalTester $I)
    {
        $I->sendPut('/v1/offices', [
            'uuid'    => '002e4d13-a119-4cf4-a67b-11ef08c46088',
            'name'    => 'Housfy Madrid',
            'address' => [[
                'postalcode'   => '02741',
                'province'     => 'Madrid',
                'city'         => 'Madrid',
                'address_line' => 'C/ Gran vía, 109',
            ]],
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
    }
}
