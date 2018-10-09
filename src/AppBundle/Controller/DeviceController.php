<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeviceController extends BaseController
{
    /**
     * @param Device $device
     * @param array $fields
     * @return Device
     */
    protected function createDevice(Device $device, array $fields): Device
    {
        $device->setColor($fields['color']);
        $device->setPrice($fields['price']);
        $device->setFirm($fields['firm']);

        return $device;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getOneAction(int $id)
    {
        $device = $this->getDoctrine()->getRepository('AppBundle:Device')->findOneById($id);
        if (!$device instanceof Device) {
            throw new BadRequestHttpException('Device not found.');
        }
        return $this->createFormatedResponse($device);
    }

    /**
     * @return Response
     *
     *
     */
    public function getAllAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Device')->findAll();
        return $this->createApiResponse($restresult, 200);
    }

    /**
     * get all devices related to "type" for example /devices/mobile  or /devices/hoover
     */
    public function findAllByAliesAction(string $alies)
    {
        if(is_numeric($alies)){
            throw new NotFoundHttpException('No devices that type found.');
        }
        $devices = $this->getDoctrine()->getRepository('AppBundle:Device')->findAllByAlies($alies);
        if (!count($devices)) {
            throw new BadRequestHttpException('Devices not found.');
        }
        return $this->createReFormatedResponse($devices);
    }
}
