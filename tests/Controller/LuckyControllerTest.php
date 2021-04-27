<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LuckyControllerTest extends WebTestCase
{
    public function testLuckyRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/lucky/number');

        $this->assertResponseIsSuccessful();
    }
}
