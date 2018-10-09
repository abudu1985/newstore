<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mobile;
use JMS\Serializer\DeserializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MobileController extends DeviceController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function createMobileAction(Request $request)
    {
        $this->allowableRoles(['ROLE_ADMIN']);

        // validation
        $mobile = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Mobile::class,
            'json',
            DeserializationContext::create()->setGroups(['Default', 'create'])
        );

        $errors = $this->get('validator')->validate($mobile);

        if (count($errors) > 0) {
            return $this->createApiResponse($errors, 422);
        }

        // creation
        $fields = json_decode($request->getContent(), true);
        $mobile = $this->createDevice(new Mobile(), $fields);
        $mobile->setMemory($fields['memory']);
        $mobile->setRam($fields['ram']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($mobile);
        $em->flush();

        return $this->createApiResponse($mobile, 201);
    }
}
