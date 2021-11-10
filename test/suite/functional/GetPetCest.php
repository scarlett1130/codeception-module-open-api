<?php

declare(strict_types=1);

namespace MeetMatt\RestCoverage\Test\Suite\Functional;

use MeetMatt\RestCoverage\Test\Support\FunctionalTester;

class GetPetCest
{
    public function getByIdReturnsPet(FunctionalTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');

        $I->sendGet('/api/pets/1');

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(
            [
                'id' => 1,
                'name' => 'Baxter',
                'tag' => 'dog'
            ],
        );
    }

    public function getByIdReturnsNotFound(FunctionalTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');

        $I->sendGet('/api/pets/5');

        $I->seeResponseCodeIs(404);
        $I->seeResponseContainsJson(
            [
                'code' => 404,
                'message' => 'pet not found',
            ],
        );
    }
}
