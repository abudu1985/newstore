<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    protected $client;
    protected $em;

    /**
     *
     */
    protected function setUp()
    {
        $this->client = static::createClient();
        $this->client->enableProfiler();
        $this->em = $this->client->getContainer()
            ->get('doctrine.orm.entity_manager');
        $this->em->getConnection()->beginTransaction();
        $this->em->getConnection()->setAutoCommit(false);
    }

    /**
     * @param $role
     * @return mixed
     *
     */
    protected function createUser($role)
    {

        $data = array('username' => 'go', 'roles' => [$role]);
        return $this->client->getContainer()
            ->get('lexik_jwt_authentication.encoder')
            ->encode($data);
    }

    /**
     *
     */
    public function testHello()
    {
        $this->assertEquals(true, true);
    }
}