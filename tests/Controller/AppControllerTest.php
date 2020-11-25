<?php

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient();
        $this->client->followRedirects();
    }

    public function testSendMailAfterPostCreated()
    {
        $crawler = $this->client->request('POST', "/");
        $buttonCrawlerNode = $crawler->selectButton('SAVE');
        $form = $buttonCrawlerNode->form([], 'POST');
        $form['post[name]']->setValue('post test');

        $this->client->submit($form);


       $this->assertEmailCount(1);

        //$transport = self::$container->get('messenger.transport.async');
        //$this->assertCount(1, $transport->get());

    }

}