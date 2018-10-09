<?php
namespace App\Tests\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrdersControllerTest extends WebTestCase
{
    private $token;
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $username
     * @param string $password
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthenticatedClient($username = 'go', $password = '123456')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(
                'username' => $username,
                'password' => $password,
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);

       // $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
//
//    /**
//     * test getPagesAction
//     */
//    public function testGetPages()
//    {
//        $client = $this->createAuthenticatedClient();
//        $client->request('GET', '/api/pages');
//        // ...
//    }

//    public function testGet()
//    {
//        $username = 'go';
//        $password = '123456';
//        $client = static::createClient();
//        $client->request(
//            'POST',
//            '/api/login_check',
//            array(
//                'username' => $username,
//                'password' => $password,
//            )
//        );
//
//        $data = json_decode($client->getResponse()->getContent(), true);
//
//        $client->request(
//            'GET',
//            '/api/orders',
//            array(),
//            array(),
//            array(
//                'Authorization:' => 'Bearer ' . $data['token'],
//                'Content-Type' => "application/json"
//            )
//        );
//        //var_dump($client->getResponse()->getContent());exit();
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//        $this->assertJson($client->getResponse()->getContent());
//    }

    public function testPost()
    {
        //$client = static::createClient();
        $username = 'go';
        $password = '123456';
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(
                'username' => $username,
                'password' => $password,
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);
        $testData = [
            "name" => "new order55",
            "user" => ["id" => 4],
            "items" => [
                ["id" => 1, "qty" => "6"],
                ["id" => 3, "qty" => "3"],
                ["id" => 2, "qty" => 2]]
        ];

       // $client->request('POST', '/order', $testData, array());
        $client->request(
            'POST',
            '/api/orders',
            $testData,
            array(),
            array(
                'Authorization:' => 'Bearer ' . $data['token'],
                'Content-Type' => "application/json"
            )
        );
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertContains('Order saved!', $client->getResponse()->getContent());
    }
}