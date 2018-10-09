<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Device;

class DeviceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findOneById(int $id): ?Device
    {
        return $this->createQueryBuilder('d')
            ->where('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllByAlies(string $alies): ?array
    {
        return $this->createQueryBuilder('d')
            ->where('d INSTANCE OF :discr')
            ->setParameter('discr', $alies)
            ->getQuery()
            ->getResult();
    }

    public function getTotCost($arr)
    {
        $totalQty = 0;
        $totalPrice = 0;
        $items = [];
        $itemObj = [];
        $result = [];
        foreach ($arr as $val) {
            if (isset($val['qty']) && is_numeric($val['qty'])) {
                $totalQty += $val['qty'];
            } else {
                throw new \Exception('Wrong data for quantity!');
            }

            $query = $this->createQueryBuilder('d')
                ->select('SUM(d.price) as price, d.id as id, d.firm as firm')
                ->where('d.id = (:ids)')
                ->setParameter('ids', $val['id'])
                ->getQuery();

            $r = $query->getOneOrNullResult();
            if ($r) {
                $id = $r['id'];
                $firm = $r['firm'];
                $price = $r['price'];

                $totalPrice += $val['qty'] * $price;

                $itemObj['item']['id'] = $id;
                $itemObj['item']['firm'] = $firm;
                $itemObj['item']['price'] = $price;

                $itemObj['qty'] = $val['qty'];

                $itemObj['price'] = $val['qty'] * $price;

                $items[] = $itemObj;

            } else {
                throw $this->createNotFoundException(
                    'No item found for id ' . $val['id']
                );
            }
        }
        $result['tp'] = $totalPrice;
        $result['tq'] = $totalQty;
        $result['itm'] = $items;
        return $result;
    }
}