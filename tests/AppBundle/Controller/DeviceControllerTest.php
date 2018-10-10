<?php
namespace App\Tests\Controller;


class DeviceControllerTest extends ApiControllerTest
{
    /**
     *
     */
    public function testGetAllDevicesAction()
    {
        $token = $this->createUser('ROLE_ADMIN');
        $this->client->request('GET', '/api/devices/'
            , [] , []
            , ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer '. $token]
        );

        $this->assertEquals(200 , $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
    }

    /**
     *
     */
    public function testPostCreateDeviceMobile()
    {
        $testData = [
                "memory" => 216,
                "ram"    => 116,
                "price"  => 2300,
                "color"  => "orw",
                "firm"   => "LG"
        ];

        $token = $this->createUser('ROLE_ADMIN');
        $this->client->request('POST', '/api/devices/mobile'
            ,[] , []
            , ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer '. $token], json_encode($testData)
        );
        $this->assertJson($this->client->getResponse()->getContent());
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode(), $this->client->getResponse()->getContent());
    }
}