<?php

class HashTable
{
    /** @var array  */
    private $storage = [];

    /** @var int */
    private $hashTableMaxLength;

    /** @var ResolverInterface  */
    private $collisionResolver;

    /**
     * HashTable constructor.
     * @param $hashTableMaxLength
     * @param ResolverInterface $colisionResolver
     */
    public function __construct($hashTableMaxLength, ResolverInterface $colisionResolver)
    {
        $this->hashTableMaxLength = $hashTableMaxLength;
        $this->collisionResolver = $colisionResolver;
    }

    public function write($index, $value)
    {

        if (isset($this->storage[$index]) && !empty($this->storage[$index])) {

            if ($this->collisionResolver instanceof ResolveCollisionsList && !is_object($this->storage[$index])) {

                $this->collisionResolver->resolve(
                    $index,
                    $this->storage,
                    $this->hashTableMaxLength,
                    $this->storage[$index]
                );
            }

            $newIndex = $this->collisionResolver->resolve($index, $this->storage, $this->hashTableMaxLength, $value);

            if (is_object($newIndex)) {
                $this->storage[$index] = $newIndex;
            } else {
                $this->storage[$newIndex] = $value;
            }
        } else {
            $this->storage[$index] = $value;
        }
    }


    public function get($string, $hashTableLength)
    {

        $hash = HashFunction::getIndex($string, $hashTableLength);

        while (true) {
            if (array_key_exists($hash, $this->storage)) {

                $node = $this->storage[$hash];

                if (is_object($node)) {

                    $current = $this->collisionResolver->getHead();

                    while (!empty($current->getNext())) {

                        $lastElement = $current->getNext();

                        if ($lastElement->getValue() == $string) {
                            return $lastElement;
                        }

                        $current = $current->getNext();

                    }
                }

                if ($string == $node) {
                    return $hash;
                }

                $hash++;

            } else {
                return null;
            }
        }

    }

}


