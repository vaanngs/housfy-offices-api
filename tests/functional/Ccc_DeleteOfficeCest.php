<?php

declare(strict_types=1);

namespace Tests;

use Codeception\Util\HttpCode;

class Ccc_DeleteOfficeCest
{
    public function _before(FunctionalTester $I)
    {
    }


    /**
     * @param FunctionalTester $I
     */
    public function shouldDeleteAnOffice(FunctionalTester $I)
    {
        $I->sendDelete('/v1/offices', [
            'uuid' => '002e4d13-a119-4cf4-a67b-11ef08c46088',
        ]);

        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
