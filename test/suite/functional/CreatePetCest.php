<?php

declare(strict_types=1);

namespace MeetMatt\RestCoverage\Test\Suite\Functional;

use MeetMatt\RestCoverage\Test\Support\FunctionalTester;

class CreatePetCest
{
    public function postReturnsCreatedPet(FunctionalTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');

        $I->sendPost('/pets', [
            'name' => 'Hachiko',
            'tag'  => 'dog'
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(
            [
                'id' => 5,
                'name' => 'Hachiko',
                'tag' => 'dog'
            ],
        );
    }
}
