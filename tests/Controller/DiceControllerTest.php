<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DiceControllerTest extends WebTestCase
{
    public function testThrowDiceRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/dice/throw');

        $this->assertResponseIsSuccessful();
    }
}
