<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testNews()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(2, $crawler->filter('h1'));
        $this->assertSame(
            ['Lorem ipsum dolo', 
            'Lorem ipsum dolo', 
            'aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Exce'
        ], $crawler->filter('article')->extract('id'));

        $link = $crawler->selectLink('nim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip e')->link();
        $crawler = $client->click($link);

        $this->assertSame('nim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip e', 
        $crawler->filter('h1')->text());
    }
}