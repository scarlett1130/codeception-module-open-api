<?php

declare(strict_types=1);

namespace MeetMatt\RestCoverage\Test\Suite\Functional;

use MeetMatt\RestCoverage\Test\Support\FunctionalTester;

class GetPetsCest
{
    public function getReturnsListOfPets(FunctionalTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');

        $I->sendGet('/pets', ['tags' => ['cat'], 'limit' => 1]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(
            [
                'id' => 3,
                'name' => 'Simba',
                'tag' => 'cat'
            ],
        );
    }
}
