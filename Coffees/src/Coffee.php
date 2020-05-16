<?php


namespace Tudublin;


class Coffee
{

    const CREATE_TABLE_SQL =
        <<<HERE
CREATE TABLE IF NOT EXISTS coffee (
    id integer PRIMARY KEY AUTO_INCREMENT,
    title text,
    category text,
    price float,
    voteTotal integer,
    numVotes integer 
)
HERE;

    private $id;
    private $title;
    private $category;
    private $price;
    private $voteTotal;
    private $numVotes;

    public function getVoteAverage()
    {
        if ($this->numVotes < 1){
            return 0;
        }
        return intval($this->voteTotal / $this->numVotes);
    }

    public function getStarImage()
    {
        if($this->getVoteAverage() > 85){
            return 'stars5.png';
        }
        if($this->getVoteAverage() > 70){
            return 'stars4.png';
        }
        if($this->getVoteAverage() > 50){
            return 'stars3.png';
        }
        if($this->getVoteAverage() > 40){
            return 'stars2.png';
        }
        if($this->getVoteAverage() > 15){
            return 'stars1.png';
        }

        return 'starsHalf.png';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function getVoteTotal()
    {
        return $this->voteTotal;
    }

    public function setVoteTotal($voteTotal)
    {
        $this->voteTotal = $voteTotal;
    }

    public function getNumVotes()
    {
        return $this->numVotes;
    }


    public function setNumVotes($numVotes)
    {
        $this->numVotes = $numVotes;
    }



}