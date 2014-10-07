<?php

namespace Opifer\ManualBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class HelpControllerTest extends WebTestCase
{
    private function adminTestInit()
    {
        $this->loadFixtures([
            'Opifer\CmsBundle\Tests\Fixtures\LoadUserData',
            'Opifer\CmsBundle\Tests\Fixtures\LoadContentData'
        ]);

        $client = $this->createClient([], [
            'PHP_AUTH_USER' => 'admin@email.com',
            'PHP_AUTH_PW'   => 'password',
            'HTTP_HOST' => 'opifer.dev/app_dev.php',
        ]);

        return $client;
    }

    public function testHelp()
    {
        $client = $this->adminTestInit();

        $crawler = $client->request('GET', '/admin/help');

        $this->assertTrue($crawler->filter('.help-article')->count() > 0);

        $articleLink = $crawler->filter('.help-article a')->first()->text();
        $this->assertEquals(1, $crawler->filter('.help-article a:contains("' . $articleLink . '")')->count());

//        $link = $crawler->selectLink($articleLink)->link();
//        $crawler = $client->click($link);
//
//        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}