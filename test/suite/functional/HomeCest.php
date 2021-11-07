<?php

declare(strict_types=1);

namespace MeetMatt\RestCoverage\Test\Suite\Functional;

use MeetMatt\RestCoverage\Test\Support\FunctionalTester;

class HomeCest
{
    public function getHomeReturnsBob(FunctionalTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');

        $I->sendGet('/');

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(
            [
                'name' => 'Bob',
                'age'  => 40
            ]
        );
    }
}
