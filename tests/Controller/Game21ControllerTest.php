<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Game21ControllerTest extends WebTestCase
{
    private $postData;

    public function testGame21PlayRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/dice/game21/play');

        $this->assertResponseIsSuccessful();
    }

    public function testGame21SetupRoute()
    {

        $client = static::createClient();

        $client->followRedirects();
        $client->request('POST', '/dice/game21/setup');

        $this->assertResponseIsSuccessful();
    }

    public function testGame21SetupRouteVisitGamePlayFirst()
    {
        $this->postData = ["dice" => 2, "diceType" => 'text', "bet" => 5, "sides" => 6];

        $client = static::createClient();
        $client->request('GET', '/dice/game21/play');
        $client->followRedirects();
        $client->request('POST', '/dice/game21/setup', $this->postData);

        $this->assertResponseIsSuccessful();
    }

    /* public function testGame21PlayerRollRoute()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/dice/game21/player-roll');

        $this->assertResponseIsSuccessful();
    } */

    public function testGame21PlayerRollRouteVisitGamePlayFirst()
    {
        $this->postData = ["dice" => 2, "diceType" => 'text', "bet" => 5, "sides" => 6];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/dice/game21/play');
        $client->request('POST', '/dice/game21/setup', $this->postData);
        $client->request('POST', '/dice/game21/player-roll');

        $this->assertResponseIsSuccessful();
    }

    /* public function testGame21ComputerRollRoute()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/dice/game21/computer-roll');

        $this->assertResponseIsSuccessful();
    } */

    public function testGame21ComputerRollRouteVisitGamePlayFirst()
    {
        $this->postData = ["dice" => 2, "diceType" => 'text', "bet" => 5, "sides" => 6];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/dice/game21/play');
        $client->request('POST', '/dice/game21/setup', $this->postData);
        $client->request('POST', '/dice/game21/computer-roll');

        $this->assertResponseIsSuccessful();
    }

    /* public function testGame21PlayAgainRoute()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/dice/game21/play-again');

        $this->assertResponseIsSuccessful();
    }
 */
    public function testGame21PlayAgainRouteVisitGamePlayFirst()
    {
        $this->postData = ["dice" => 2, "diceType" => 'text', "bet" => 5, "sides" => 6];
        $client = static::createClient();
        $client->request('GET', '/dice/game21/play');
        $client->followRedirects();
        $client->request('POST', '/dice/game21/setup', $this->postData);
        $client->request('POST', '/dice/game21/play-again');

        $this->assertResponseIsSuccessful();
    }

    /* public function testGame21ResetScoreRoute()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/dice/game21/reset-score');

        $this->assertResponseIsSuccessful();
    }
 */
    public function testGame21ResetScoreRouteVisitGamePlayFirst()
    {
        $this->postData = ["dice" => 2, "diceType" => 'text', "bet" => 5, "sides" => 6];

        $client = static::createClient();
        $client->request('GET', '/dice/game21/play');
        $client->followRedirects();
        $client->request('POST', '/dice/game21/setup', $this->postData);
        $client->request('POST', '/dice/game21/reset-score');

        $this->assertResponseIsSuccessful();
    }

   /*  public function testGame21ResetBitCoinsRoute()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/dice/game21/reset-bitcoins');

        $this->assertResponseIsSuccessful();
    } */

    public function testGame21ResetBitCoinsRouteVisitGamePlayFirst()
    {
        $this->postData = ["dice" => 2, "diceType" => 'text', "bet" => 5, "sides" => 6];

        $client = static::createClient();
        $client->request('GET', '/dice/game21/play');
        $client->followRedirects();
        $client->request('POST', '/dice/game21/setup', $this->postData);
        $client->request('POST', '/dice/game21/reset-bitcoins');

        $this->assertResponseIsSuccessful();
    }
}
