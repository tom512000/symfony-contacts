<?php

namespace App\Tests\Controller\Hello;

use App\Tests\Support\ControllerTester;
use Codeception\Attribute\DataProvider;
use Codeception\Attribute\Examples;
use Codeception\Example;

class ManyTimesCest
{
    public function defaultNumberOfTimesIsThree(ControllerTester $I): void
    {
        $I->amOnPage('/hello/bob');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Hello many times');
        $I->see('Hello many times Bob!', 'h1');
        $I->seeNumberOfElements('p:contains("Hello Bob!")', 3);
    }

    public function timesParameterIsNotANumberLeadsToNotFoundHttpResponse(ControllerTester $I): void
    {
        $I->amOnPage('/hello/bob/six');
        $I->seeResponseCodeIs(404);
    }

    #[DataProvider('nameProvider')]
    public function nameParameterIsShownWithTitleCase(ControllerTester $I, Example $example): void
    {
        $I->amOnPage("/hello/{$example['input']}/6");
        $I->seeResponseCodeIsSuccessful();
        $I->seeNumberOfElements("p:contains('Hello {$example['expected']}!')", 6);
    }

    protected function nameProvider(): array
    {
        return [
            'lower case' => [
                'input' => 'joe',
                'expected' => 'Joe',
            ],
            'expected case' => [
                'input' => 'Jack',
                'expected' => 'Jack',
            ],
            'upper case' => [
                'input' => 'WILLIAM',
                'expected' => 'William',
            ],
            'inverted expected case' => [
                'input' => 'aVERELL',
                'expected' => 'Averell',
            ],
        ];
    }

    #[Examples(2)]
    #[Examples(6)]
    #[Examples(10)]
    public function timesParameterLeadsToRightNumberOfParagraphs(ControllerTester $I, Example $example): void
    {
        $I->amOnPage("/hello/bob/{$example[0]}");
        $I->seeResponseCodeIsSuccessful();
        $I->seeNumberOfElements('p:contains("Hello Bob!")', $example[0]);
    }

    #[Examples(0)]
    #[Examples(11)]
    #[Examples(666)]
    public function outOfBoundsTimesParameterRedirectsToThreeTimes(ControllerTester $I, Example $example): void
    {
        $I->stopFollowingRedirects();
        $I->amOnPage("/hello/bob/{$example[0]}");
        $I->seeResponseCodeIsRedirection();
        $I->followRedirect();
        $I->seeCurrentRouteIs('app_hello_manytimes', ['name' => 'bob', 'times' => 3]);
    }
}
