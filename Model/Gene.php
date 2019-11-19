<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gene
 *
 * @author pioden
 */
class Gene {
    private $name,
            $code,
            $tamenessValue, 
            $dominance;
    
    public function __construct($name, $code, $tamenessValue, $dominance) {
        $this->name = $name;
        $this->code = $code;
        $this->tamenessValue = $tamenessValue;
        $this->dominance = $dominance;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getTamenessValue() {
        return $this->tamenessValue;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setTamenessValue($tamenessValue) {
        $this->tamenessValue = $tamenessValue;
    }
    public function getDominance() {
        return $this->dominance;
    }

    public function setDominance($dominance) {
        $this->dominance = $dominance;
    }
    function getCode() {
        return $this->code;
    }

    function setCode($code) {
        $this->code = $code;
    }






}
