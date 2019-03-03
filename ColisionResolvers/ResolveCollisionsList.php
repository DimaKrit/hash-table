<?php

require_once __DIR__ . '/ResolverInterface.php';
require_once __DIR__ . '/SeparateNode.php';

class ResolveCollisionsList implements ResolverInterface
{

    private $head = null;

    public function resolve($index, $hranilishche, $size, $value = null)
    {

        if ($index >= $size) {
            throw Exception('Our table is full');
        }

        if (isset($hranilishche[$index])) {
            $newElement = new SeparateNode();
            $newElement->setValue($value);

            if (!empty($this->head)) {

                $lastElement = $this->head;

                while (!empty($lastElement->getNext())) {
                    $lastElement = $lastElement->getNext();
                }
                $lastElement->setNext($newElement);

            } else {
                $this->head = $newElement;
            }

            return $this->head;

        }
    }

    public function getHead(){
        return $this->head;
    }

}