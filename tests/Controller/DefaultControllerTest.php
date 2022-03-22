<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     * @group("default")
     */
    public function testIndex($url, $code): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertSame($code, $client->getResponse()->getStatusCode());
    }

    public function urlProvider(): array
    {
        return [
            ['/', 200],
            ['/contact', 200],
        ];
    }
}
