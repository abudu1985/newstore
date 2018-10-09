<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use AppBundle\Entity\Orders;
use AppBundle\Entity\User as User;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdersController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $this->allowableRoles(['ROLE_ADMIN']);

        $data = $this->getDoctrine()
            ->getRepository(Device::class)
            ->getTotCost($request->request->get('items'));

        $name = $request->request->get('name');
        if(empty($name)) {
            return new Response('Field name can not be empty!', 400);
        }

        $orderItems = json_encode($data['itm']);

        $createDate = new DateTime(date('Y-m-d', time()));

        $u = $request->request->get('user');
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($u['id']);

        if(empty($user)) {
            throw new NotFoundHttpException("User with id: #" . $u['id'] . " not found!");
        }

        $order = new Orders();
        $order->setName($name);
        $order->setCreateDate($createDate);
        $order->setTotalQty($data['tq']);
        $order->setTotalPrice( $data['tp']);
        $order->setOrderItems($orderItems);
        $order->setOrderUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        $restresult = [
            'id' => $order->getId(),
            'name' => $order->getName(),
            'total_qty' => $order->getTotalQty(),
            'total_price' => $order->getTotalPrice(),
            'user' => $order->getOrderUser()->getPublicInfo(),
            'items' => json_decode($order->getOrderItems())
        ];

        return new Response(json_encode($restresult), 200, array(
            'Content-Type' => 'application/json'
        ));
    }

    /**
     * @return Response
     */
    public function fetchAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Orders')->findAll();
        if ($restresult === null) {
            return new Response('No users found!', 204);
        }

        foreach ($restresult as $key => $val) {
            $restresult[$key] = [
                'id' => $val->getId(),
                'name' => $val->getName(),
                'total_qty' => $val->getTotalQty(),
                'total_price' => $val->getTotalPrice(),
                'user' => $val->getOrderUser()->getPublicInfo(),
                'items' => json_decode($val->getOrderItems())
            ];
        }

        return new Response(json_encode($restresult), 200, array(
            'Content-Type' => 'application/json'
        ));
    }
}
