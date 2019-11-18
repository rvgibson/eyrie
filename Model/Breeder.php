<?php
include('./Model/Genome.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Breeder
 *
 * @author pioden
 */
class Breeder {
    
    public function breedPets ($mother, $father){
    $sex;
    $r = random_int(0, 100); 
    if($r >= 50)
        {
        $sex = "F";
    }else {
        $sex = "M";
    }
    $height = ((rand(min($mother->getHeight(), $father->getHeight()),max($mother->getHeight(), $father->getHeight())))/7);
    $weight = ((rand(min($mother->getWeight(), $father->getWeight()), max($mother->getWeight(), $father->getWeight())))/7);
    $str = (rand(min($mother->getStr(), $father->getStr()), max($mother->getStr(), $father->getStr())));
    $agi = (rand(min($mother->getAgi(), $father->getAgi()), max($mother->getAgi(), $father->getAgi())));
    $spd = (rand(min($mother->getSpd(), $father->getSpd()), max($mother->getSpd(), $father->getSpd())));
    $con = (rand(min($mother->getCon(), $father->getCon()), max($mother->getCon(), $father->getCon())));
    $int = (rand(min($mother->getInt(), $father->getInt()), max($mother->getInt(), $father->getInt())));
    $babyGenome = genomeBuilder($mother->getGenome(), $father->getGenome());
    $MaxHealth = calcHealth($babyGenome());
    $maxTameness = calcTameness($babyGenome());
    $babyImage = punnet($babyGenome);
    $baby = new Pet("Unnamed", $sex, $mother, $father, 0, 0, $babyGenome, 10, $maxHealth, $maxHealth, $maxTameness, $tameness, $babyImage, $str, $agi, $int, $spd, $con, $height, $weight);
    
    return $baby;  
}
    
    public function punnet($genome){
        
        $phenotype = array();
        $g = (array) $genome;
        
        for ($i = 0; $i <=26; $i += 2){
            if ($g[i]->getDominance() > $g[i+1]->getDominance()){
                array_push($phenotype, g[i]);
            } else if ($g[i]->getDominance() < $g[i+1]->getDominance()){
                array_push($phenotype, $g[i+1]);
            } else {
                    array_push($phenotype, ($g[i] . $g[i+1]));
            }   
        }
//        
        
    }

    public function imageBuilder($phenotype){
        
    }
    
    public function genomeBuilder($m, $d){
            $mom = (array) $m;
            $dad = (array) $d;
            
            $g = array();
            
            for ($i = 0; $i <=26; $i+=2){
                $s = rand(0, 1);
                $r = rand(0, 1);
                if ($s == 0){
                    $g[$i] = $mom[$i];
                }
                else if ($s == 1) {
                    $g[$i] = $mom[$i+1];
                    }
                if ($r == 0) {
                    $g[$i+1] = $dad[$i];
                }
                else if ($r == 1) {
                    $g[$i+1] = $dad[$i+1];
                }
            }  
            
            $genome = new Genome($g[0], $g[1], $g[2], $g[3], $g[4], $g[5], $g[6], $g[7], $g[8], $g[9], $g[10], $g[11], $g[12], $g[13], $g[14], $g[15], $g[16], $g[17], $g[18], $g[19], $g[20], $g[21], $g[22], $g[23], $g[24], $g[25]);
            return $genome;
    }
    
    public function calcHealth($genome){
        $health;
        return $health;
    }
    
    public function calcTameness($genome){
        $tameness;
        return $tameness;
    }
    
            
            
}
