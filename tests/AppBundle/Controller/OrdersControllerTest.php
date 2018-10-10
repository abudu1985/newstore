<?php
namespace App\Tests\Controller;


class OrdersControllerTest extends ApiControllerTest
{

    /**
     *
     */
    public function testGetAllOrdersAction()
    {
        $token = $this->createUser('ROLE_ADMIN');
        $this->client->request('GET', '/api/orders/'
            , [] , []
            , ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer '. $token]
        );

        $this->assertEquals(200 , $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
    }

    /**
     *
     */
    public function testPostCreateOrder()
    {
        $testData = [
            "name" => "new order55",
            "user" => ["id" => 4],
            "items" => [
                ["id" => 1, "qty" => "6"],
                ["id" => 3, "qty" => "3"],
                ["id" => 2, "qty" => 2]]
        ];

        $token = $this->createUser('ROLE_ADMIN');
        $this->client->request('POST', '/api/orders/'
            , $testData , []
            , ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer '. $token]
        );
        $this->assertJson($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}