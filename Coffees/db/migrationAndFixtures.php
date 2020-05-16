<?php

require_once __DIR__ . '/../config/dbConstants.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Tudublin\Coffee;
use Tudublin\CoffeeRepository;

$coffeeRepository = new CoffeeRepository();
$faker = Faker\Factory::create();

$coffeeRepository->dropTable();
$coffeeRepository->createTable();


$coffeeRepository->deleteAll();


$m1 = new Coffee();
$m1->setId(1);
$m1->setTitle('Flat White');
$m1->setCategory('Main Stream');
$m1->setPrice('5.00');
$m1->setVoteTotal(5);
$m1->setNumVotes(1);


$coffeeRepository->create($m1);


for($id = 2; $id < 10; $id++) {

    $title = $faker->sentence(2);
    $category = $faker->randomElement(['Main Stream', 'Basic', 'Milky', 'Peculiar']);
    $price = $faker->randomFloat(2, 5, 30);
    $voteTotal = $faker->numberBetween(50, 150);
    $numVotes = $faker->numberBetween(0, 25);

    $m = new Coffee();
    $m->setId($id);
    $m->setTitle($title);
    $m->setCategory($category);
    $m->setPrice($price);
    $m->setNumVotes($numVotes);
    $m->setVoteTotal($voteTotal);

    $coffeeRepository->create($m);
}

// (5) test objects are there
$coffees = $coffeeRepository->findAll();
print '<pre>';
var_dump($coffees);


