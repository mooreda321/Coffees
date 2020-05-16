<?php

namespace Tudublin;


use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;

class CoffeeController extends Controller
{
    private $coffeeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->coffeeRepository = new CoffeeRepository();
    }
    public function coffeeList()
    {
        $coffees = $this->coffeeRepository->findAll();

        $templates = 'list.html.twig';
        $args = [
            'coffees' => $coffees
        ];
        $html = $this->twig->render($templates,$args);
        print $html;
    }

    public function error($errorMessage)
    {
        $template = 'error.html.twig';
        $args = [
            'errorMessage' => $errorMessage
        ];
        $html = $this->twig->render($template,$args);
        print $html;
    }

    public function createForm()
    {
        $template = 'newCoffeeForm.html.twig';
        $args = [];
        $html = $this->twig->render($template,$args);
        print $html;

    }

    public function processUpdateMovie()
    {
        $id = filter_input(INPUT_POST, 'id');
        $title = filter_input(INPUT_POST , 'title');
        $category = filter_input(INPUT_POST , 'category');
        $price = filter_input(INPUT_POST , 'price');
        $voteTotal = filter_input(INPUT_POST , 'voteTotal');
        $numVotes = filter_input(INPUT_POST , 'numVotes');


        $m = new Coffee();
        $m->setId($id);
        $m->setTitle($title);
        $m->setCategory($category);
        $m->setPrice($price);
        $m->setNumVotes($voteTotal);
        $m->setVoteTotal($numVotes);

        $success = $this->coffeeRepository->update($m);

        if($success){
            $this->coffeeList();
        }else{
            $message = 'there was a problem trying to edit coffee with ID = ' .$id;
            $this->error($message);
        }
    }

    public function processNewMovie()
    {
        $title = filter_input(INPUT_POST, 'title');
        $category = filter_input(INPUT_POST, 'category');
        $price = filter_input(INPUT_POST, 'price');

        $m = new Coffee();
        $m->setTitle($title);
        $m->setCategory($category);
        $m->setPrice($price);
        $m->setNumVotes(0);
        $m->setVoteTotal(0);

        $this->coffeeRepository->create($m);

        $this->coffeeList();
    }

    public function edit()
    {
        $id = filter_input(INPUT_GET, 'id');
        $movie = $this->coffeeRepository->find($id);

        if($coffee){
            $this->editForm($coffee);
        }else {
            $message = 'there was a problem trying to edit Coffee with ID = ' . $id;
            $this->error($message);
        }
    }

    public function editForm($movie)
    {
        $templates = 'editCoffeeForm.html.twig';
        $args = [
            'coffee' => $coffee
        ];
        $html = $this->twig->render($templates,$args);
        print $html;

    }

    public function delete()
    {
        $id = filter_input(INPUT_GET,'id');
        $success = $this->coffeeRepository->delete($id);

        if($success){
            $this->coffeeList();
        }else {
            $message = 'there was a problem trying to delete the Coffee with ID = ' . $id;
            $this->error($message);
        }
    }

}