<?php
namespace MeetMatt\RestCoverage\Test\Support;

use Codeception\Actor;
use Codeception\Module\Asserts;
use Codeception\Module\REST;

/**
 * @mixin Asserts
 * @mixin REST
 *
 * @SuppressWarnings(PHPMD)
*/
class FunctionalTester extends Actor
{
    use _generated\FunctionalTesterActions;
}
