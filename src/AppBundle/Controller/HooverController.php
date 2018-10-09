<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hoover;
use JMS\Serializer\DeserializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HooverController extends DeviceController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function createHooverAction(Request $request)
    {
        $this->allowableRoles(['ROLE_ADMIN']);

        // validation
        $hoover = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Hoover::class,
            'json',
            DeserializationContext::create()->setGroups(['Default', 'create'])
        );

        $errors = $this->get('validator')->validate($hoover);

        if (count($errors) > 0) {
            var_dump($hoover);
            var_dump($errors);exit();
            return $this->createApiResponse($errors, 422);
        }

        // creation
        $fields = json_decode($request->getContent(), true);
        $hoover = $this->createDevice(new Hoover(), $fields);
        $hoover->setPower($fields['power']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($hoover);
        $em->flush();

        return $this->createApiResponse($hoover, 201);
    }
}
