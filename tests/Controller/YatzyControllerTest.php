<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class YatzyControllerTest extends WebTestCase
{
    private $postData;

    public function testYatzyPlayRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/dice/yatzy/play');

        $this->assertResponseIsSuccessful();
    }

    public function testYatzyPlayerRollRouteVisitYatzyPlayFirst()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/dice/yatzy/play');
        $client->request('POST', '/dice/yatzy/player-roll');

        $this->assertResponseIsSuccessful();
    }

    public function testYatzyLockDiceRouteVisitYatzyPlayFirst()
    {
        $this->postData = ["lockedDice" => [0]];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/dice/yatzy/play');
        $client->request('POST', '/dice/yatzy/lock-dice', $this->postData);

        $this->assertResponseIsSuccessful();
    }

    public function testLockScoreRouteVisitGamePlayFirst()
    {
        $this->postData = ["lockScore" => 0];
        $client = static::createClient();
        $client->request('GET', '/dice/yatzy/play');
        $client->followRedirects();
        $client->request('POST', '/dice/yatzy/lock-score', $this->postData);

        $this->assertResponseIsSuccessful();
    }

    public function testNewGameVisitGamePlayFirst()
    {
        $client = static::createClient();
        $client->request('GET', '/dice/yatzy/play');
        $client->followRedirects();
        $client->request('POST', '/dice/yatzy/new-game');

        $this->assertResponseIsSuccessful();
    }
}
