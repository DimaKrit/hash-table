<?php

require_once __DIR__ . '/ColisionResolvers/ResolverInterface.php';
require_once __DIR__ . '/ColisionResolvers/ResolveCollisionsPlus1.php';
require_once __DIR__ . '/ColisionResolvers/ResolveCollisionsList.php';
require_once __DIR__.'/HashFunction.php';
require_once __DIR__.'/HashTable.php';

$hashTableLength = 125;

//$hashTable = new HashTable($hashTableLength, new ResolveCollisionsPlus1());
//
//$hash = HashFunction::getIndex('Ada', $hashTableLength);
//$hashTable->write($hash, 'Ada');
//
//$hash = HashFunction::getIndex('eeee', $hashTableLength);
//$hashTable->write($hash, 'eee');
//
//$hash = HashFunction::getIndex('aDa', $hashTableLength);
//$hashTable->write($hash, 'aDa');
//
//$result = $hashTable->get('Ada', $hashTableLength);


$hashTable = new HashTable($hashTableLength, new ResolveCollisionsList());

$hash = HashFunction::getIndex('eeee', $hashTableLength);
$hashTable->write($hash, 'eee');

$hash = HashFunction::getIndex('hhhh', $hashTableLength);
$hashTable->write($hash, 'hhhh');

$hash = HashFunction::getIndex('aDa', $hashTableLength);
$hashTable->write($hash, 'aDa');
$hashTable->write($hash, 'aDA');
$hashTable->write($hash, 'Ada');
$hashTable->write($hash, 'aDa');
$hashTable->write($hash, 'AdA');


$result = $hashTable->get('aDa', $hashTableLength);

die(var_dump($result));
