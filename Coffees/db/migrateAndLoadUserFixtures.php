<?php

require_once __DIR__ . '/../config/dbConstants.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Tudublin\UserRepository;
use Tudublin\User;

$userRepository = new UserRepository();
$userRepository->dropTable();
$userRepository->createTable();

$userRepository->deleteAll();

$u1 = new User();
$u1->setUsername('darragh');
$u1->setPassword('moore');

$u2 = new User();
$u2->setUsername('admin');
$u2->setPassword('admin');
$u2->setRole('ROLE_ADMIN');

$u3 = new User();
$u3->setUsername('test');
$u3->setPassword('test1');
$u3->setRole('ROLE_ADMIN');

$userRepository->create($u1);
$userRepository->create($u2);
$userRepository->create($u3);

$users = $userRepository->findAll();
print '<pre>';
var_dump($users);

