<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Genome
 *
 * @author pioden
 */
class Genome {
    private $colorMother,
            $colorFather,
            $eyesMother,
            $eyesFather,
            $earsMother,
            $earsFather,
            $coatMother,
            $coatFather,
            $patternMother,
            $patternFather,
            $markingsMother,
            $markingsFather,
            $tailMother,
            $tailFather,
            $skinMother,
            $skinFather,
            $buildMother,
            $buildFather,
            $beakMother,
            $beakFather,
            $feetMother,
            $feetFather,
            $healthMother,
            $healthFather,
            $mutationsMother,
            $mutationsFather;
    
    public function __construct($colorMother, $colorFather, $eyesMother, $eyesFather, $earsMother, $earsFather, $coatMother, $coatFather, $patternMother, $patternFather, $markingsMother, $markingsFather, $tailMother, $tailFather, $skinMother, $skinFather, $buildMother, $buildFather, $beakMother, $beakFather, $feetMother, $feetFather, $healthMother, $healthFather, $mutationsMother, $mutationsFather) {
        $this->colorMother = $colorMother;
        $this->colorFather = $colorFather;
        $this->eyesMother = $eyesMother;
        $this->eyesFather = $eyesFather;
        $this->earsMother = $earsMother;
        $this->earsFather = $earsFather;
        $this->coatMother = $coatMother;
        $this->coatFather = $coatFather;
        $this->patternMother = $patternMother;
        $this->patternFather = $patternFather;
        $this->markingsMother = $markingsMother;
        $this->markingsFather = $markingsFather;
        $this->tailMother = $tailMother;
        $this->tailFather = $tailFather;
        $this->skinMother = $skinMother;
        $this->skinFather = $skinFather;
        $this->buildMother = $buildMother;
        $this->buildFather = $buildFather;
        $this->beakMother = $beakMother;
        $this->beakFather = $beakFather;
        $this->feetMother = $feetMother;
        $this->feetFather = $feetFather;
        $this->healthMother = $healthMother;
        $this->healthFather = $healthFather;
        $this->mutationsMother = $mutationsMother;
        $this->mutationsFather = $mutationsFather;
    }
    
    public function getColorMother() {
        return $this->colorMother;
    }

    public function getColorFather() {
        return $this->colorFather;
    }

    public function getEyesMother() {
        return $this->eyesMother;
    }

    public function getEyesFather() {
        return $this->eyesFather;
    }

    public function getEarsMother() {
        return $this->earsMother;
    }

    public function getEarsFather() {
        return $this->earsFather;
    }

    public function getCoatMother() {
        return $this->coatMother;
    }

    public function getCoatFather() {
        return $this->coatFather;
    }

    public function getPatternMother() {
        return $this->patternMother;
    }

    public function getPatternFather() {
        return $this->patternFather;
    }

    public function getMarkingsMother() {
        return $this->markingsMother;
    }

    public function getMarkingsFather() {
        return $this->markingsFather;
    }

    public function getTailMother() {
        return $this->tailMother;
    }

    public function getTailFather() {
        return $this->tailFather;
    }

    public function getSkinMother() {
        return $this->skinMother;
    }

    public function getSkinFather() {
        return $this->skinFather;
    }

    public function getBuildMother() {
        return $this->buildMother;
    }

    public function getBuildFather() {
        return $this->buildFather;
    }

    public function getBeakMother() {
        return $this->beakMother;
    }

    public function getBeakFather() {
        return $this->beakFather;
    }

    public function getFeetMother() {
        return $this->feetMother;
    }

    public function getFeetFather() {
        return $this->feetFather;
    }

    public function getHealthMother() {
        return $this->healthMother;
    }

    public function getHealthFather() {
        return $this->healthFather;
    }

    public function getMutationsMother() {
        return $this->mutationsMother;
    }

    public function getMutationsFather() {
        return $this->mutationsFather;
    }

    public function setColorMother($colorMother) {
        $this->colorMother = $colorMother;
    }

    public function setColorFather($colorFather) {
        $this->colorFather = $colorFather;
    }

    public function setEyesMother($eyesMother) {
        $this->eyesMother = $eyesMother;
    }

    public function setEyesFather($eyesFather) {
        $this->eyesFather = $eyesFather;
    }

    public function setEarsMother($earsMother) {
        $this->earsMother = $earsMother;
    }

    public function setEarsFather($earsFather) {
        $this->earsFather = $earsFather;
    }

    public function setCoatMother($coatMother) {
        $this->coatMother = $coatMother;
    }

    public function setCoatFather($coatFather) {
        $this->coatFather = $coatFather;
    }

    public function setPatternMother($patternMother) {
        $this->patternMother = $patternMother;
    }

    public function setPatternFather($patternFather) {
        $this->patternFather = $patternFather;
    }

    public function setMarkingsMother($markingsMother) {
        $this->markingsMother = $markingsMother;
    }

    public function setMarkingsFather($markingsFather) {
        $this->markingsFather = $markingsFather;
    }

    public function setTailMother($tailMother) {
        $this->tailMother = $tailMother;
    }

    public function setTailFather($tailFather) {
        $this->tailFather = $tailFather;
    }

    public function setSkinMother($skinMother) {
        $this->skinMother = $skinMother;
    }

    public function setSkinFather($skinFather) {
        $this->skinFather = $skinFather;
    }

    public function setBuildMother($buildMother) {
        $this->buildMother = $buildMother;
    }

    public function setBuildFather($buildFather) {
        $this->buildFather = $buildFather;
    }

    public function setBeakMother($beakMother) {
        $this->beakMother = $beakMother;
    }

    public function setBeakFather($beakFather) {
        $this->beakFather = $beakFather;
    }

    public function setFeetMother($feetMother) {
        $this->feetMother = $feetMother;
    }

    public function setFeetFather($feetFather) {
        $this->feetFather = $feetFather;
    }

    public function setHealthMother($healthMother) {
        $this->healthMother = $healthMother;
    }

    public function setHealthFather($healthFather) {
        $this->healthFather = $healthFather;
    }

    public function setMutationsMother($mutationsMother) {
        $this->mutationsMother = $mutationsMother;
    }

    public function setMutationsFather($mutationsFather) {
        $this->mutationsFather = $mutationsFather;
    }

    public function calcHealth(){
        $health = 100;
        return $health;
    }
    
    public function calcTameness(){
       $tameness = 
        $this->colorMother->getTameness() +
        $this->colorFather->getTameness() +
        $this->eyesMother->getTameness() +
        $this->eyesFather->getTameness() +
        $this->earsMother->getTameness() +
        $this->earsFather->getTameness() +
        $this->coatMother->getTameness() +
        $this->coatFather->getTameness() +
        $this->patternMother->getTameness() +
        $this->patternFather->getTameness() +
        $this->markingsMother->getTameness() +
        $this->markingsFather->getTameness() +
        $this->tailMother->getTameness() +
        $this->tailFather->getTameness() +
        $this->skinMother->getTameness() +
        $this->skinFather->getTameness() +
        $this->buildMother->getTameness() +
        $this->buildFather->getTameness() +
        $this->beakMother->getTameness() +
        $this->beakFather->getTameness() +
        $this->feetMother->getTameness() +
        $this->feetFather->getTameness();  
      return $tameness;  
    }

}
