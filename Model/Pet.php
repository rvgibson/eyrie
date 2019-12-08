<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pet
 *
 * @author pioden
 */
class Pet {
    private $id, 
            $name, 
            $sex,
            $mother,
            $father,
            $age,
            $breedTimer,
            $genome,
            $energy,
            $maxHealth,
            $health,
            $maxTameness,
            $tameness,
            $imagePath,
            $str,
            $agi,
            $int,
            $spd,
            $con,
            $height,
            $weight,
            $hunger;
    
    
    public function __construct($id, $name, $sex, $mother, $father, $age, $breedTimer, $genome, $energy, $maxHealth, $health, $maxTameness, $tameness, $imagePath, $str, $agi, $int, $spd, $con, $height, $weight) {
        $this->id = $id;
        $this->name = $name;
        $this->sex = $sex;
        $this->mother = $mother;
        $this->father = $father;
        $this->age = $age;
        $this->breedTimer = $breedTimer;
        $this->genome = $genome;
        $this->energy = $energy;
        $this->maxHealth = $maxHealth;
        $this->health = $health;
        $this->maxTameness = $maxTameness;
        $this->tameness = $tameness;
        $this->imagePath = $imagePath;
        $this->str = $str;
        $this->agi = $agi;
        $this->int = $int;
        $this->spd = $spd;
        $this->con = $con;
        $this->height = $height;
        $this->weight = $weight;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSex() {
        return $this->sex;
    }

    public function getMother() {
        return $this->mother;
    }

    public function getFather() {
        return $this->father;
    }

    public function getAge() {
        return $this->age;
    }

    public function getBreedTimer() {
        return $this->breedTimer;
    }

    public function getGenome() {
        return $this->genome;
    }

    public function getEnergy() {
        return $this->energy;
    }

    public function getMaxHealth() {
        return $this->maxHealth;
    }

    public function getHealth() {
        return $this->health;
    }

    public function getMaxTameness() {
        return $this->maxTameness;
    }

    public function getTameness() {
        return $this->tameness;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    public function getStr() {
        return $this->str;
    }

    public function getAgi() {
        return $this->agi;
    }

    public function getInt() {
        return $this->int;
    }

    public function getSpd() {
        return $this->spd;
    }

    public function getCon() {
        return $this->con;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function setMother($mother) {
        $this->mother = $mother;
    }

    public function setFather($father) {
        $this->father = $father;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setBreedTimer($breedTimer) {
        $this->breedTimer = $breedTimer;
    }

    public function setGenome($genome) {
        $this->genome = $genome;
    }

    public function setEnergy($energy) {
        $this->energy = $energy;
    }

    public function setMaxHealth($maxHealth) {
        $this->maxHealth = $maxHealth;
    }

    public function setHealth($health) {
        $this->health = $health;
    }

    public function setMaxTameness($maxTameness) {
        $this->maxTameness = $maxTameness;
    }

    public function setTameness($tameness) {
        $this->tameness = $tameness;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }

    public function setStr($str) {
        $this->str = $str;
    }

    public function setAgi($agi) {
        $this->agi = $agi;
    }

    public function setInt($int) {
        $this->int = $int;
    }

    public function setSpd($spd) {
        $this->spd = $spd;
    }

    public function setCon($con) {
        $this->con = $con;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    function getHunger() {
        return $this->hunger;
    }

    function setHunger($hunger) {
        $this->hunger = $hunger;
    }

}


