<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UsersController extends BaseController
{
    /**
     * @return Response
     */
    public function fetchAction()
    {
        $this->allowableRoles(['ROLE_ADMIN']);

        $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        if ($restresult === null) {
            return new Response('No users found!', 204);
        }

        foreach ($restresult as $key => $val) {
            $restresult[$key] = [
                'id' => $val->getId(),
                'name' => $val->getUsername(),
                'email' => $val->getEmail()
            ];
        }

        return $this->createApiResponse($restresult, 200);
    }
}
