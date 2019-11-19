<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author pioden
 */
class User {
    public $id,
           $username,
           $barn, 
           $food,
           $medicine,
           $money;
    
   function __construct($id, $username, $barn, $food, $medicine, $money) {
       $this->id = $id;
       $this->username = $username;
       $this->barn = $barn;
       $this->food = $food;
       $this->medicine = $medicine;
       $this->money = $money;
   }
   
   function getId() {
       return $this->id;
   }

   function getUsername() {
       return $this->username;
   }

   function getBarn() {
       return $this->barn;
   }

   function getFood() {
       return $this->food;
   }

   function getMedicine() {
       return $this->medicine;
   }

   function getMoney() {
       return $this->money;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setUsername($username) {
       $this->username = $username;
   }

   function setBarn($barn) {
       $this->barn = $barn;
   }

   function setFood($food) {
       $this->food = $food;
   }

   function setMedicine($medicine) {
       $this->medicine = $medicine;
   }

   function setMoney($money) {
       $this->money = $money;
   }



}
