<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

abstract class BaseController extends Controller
{
    const ENTITY_DIRECTORY = "AppBundle\Entity";

    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->serialize($data);

        return new Response($json, $statusCode, array(
            'Content-Type' => 'application/json'
        ));
    }

    protected function serialize($data, $format = 'json')
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        return $this->container->get('jms_serializer')
            ->serialize($data, $format, $context);
    }

    protected function createFormatedResponse($data, $format = 'json')
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $json = $serializer->serialize($data, $format, SerializationContext::create()->setGroups(array('Default', 'list')));


        // that for adding type of device
            $arr = (array)json_decode($json);
            $pieces = explode(self::ENTITY_DIRECTORY, get_class($data));
            $arr['device_type'] = preg_replace('/[^A-Za-z\-]/', '',$pieces[1]);
            $json = json_encode($arr);


        return new Response($json, 201, array(
            'Content-Type' => 'application/json'
        ));
    }

    protected function createReFormatedResponse($data, $format = 'json')
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $json = $serializer->serialize($data, $format, SerializationContext::create()->setGroups(array('Default', 'list')));

        return new Response($json, 201, array(
            'Content-Type' => 'application/json'
        ));
    }

    /**
     * @param $array
     * @return bool
     */
    protected function allowableRoles($array)
    {
        $user = $this->getUser();
        $a = array_intersect($array, $user->getRoles());
        if (count($a) == 0) {
            throw new AccessDeniedException();
           // return false;
        } else {
            return true;
        }
    }

}
