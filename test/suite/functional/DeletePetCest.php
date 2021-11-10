<?php

declare(strict_types=1);

namespace MeetMatt\RestCoverage\Test\Suite\Functional;

use MeetMatt\RestCoverage\Test\Support\FunctionalTester;

class DeletePetCest
{
    public function deleteReturnsSuccess(FunctionalTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');

        $I->sendDelete('/api/pets/4');

        $I->seeResponseCodeIs(204);
        $I->seeResponseEquals(null);
    }
}
