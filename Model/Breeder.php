<?php
include_once('./Model/Genome.php');

class Breeder {
    
    public static function breedPets ($mother, $father){
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
    $phenotype = punnet($babyGenome);
    if($phenotype[8] === "Heavy"){
        $weight = $weight * 1.1;
    } else if($phenotype[8] === "Greyhound"){
        $weight = $weight * .9;
    } else if($phenotype[8] === "Compact"){
        $height = height * .95;
    }
    $health = $babyGenome->calcHealth();
    $maxTameness = $babyGenome->calcTameness();
    $baby = new Pet("Unnamed", $sex, $mother, $father, 0, 0, $babyGenome, 10, $maxHealth, $maxHealth, $maxTameness, $maxTameness/4, 'generate', $str, $agi, $int, $spd, $con, $height, $weight);
    
    return $baby;  
}
    
    public static function punnet($genome){
        $phenotype = array();
        $g = array_values((array) $genome);
        
        for ($i = 0; $i < count($g); $i += 2){
            if ($g[$i]->getDominance() < $g[$i+1]->getDominance()){
                array_push($phenotype, $g[$i]->getName());
            } else if ($g[$i]->getDominance() > $g[$i+1]->getDominance()){
                array_push($phenotype, $g[$i+1]->getName());
            } else {
                    if($g[$i]->getCode() === $g[$i+1]->getCode()) {
                        array_push($phenotype, $g[$i]->getName());
                    }
                    else {
                    array_push($phenotype, ( $g[$i]->getCode() . $g[$i+1]->getCode()));}
            }   
        } 
        return $phenotype;     
    }

    public static function imageBuilder($phenotype){
        $folderPath = '../imagebuilder/coat_wild/build_wild/';
        $color = $phenotype[0];
        $eyes = $phenotype[1];
        $ears = $phenotype[2];
        $coat = $phenotype[3];
        $pattern = $phenotype[4];
        $marking = $phenotype [5];
        $tail = $phenotype[6];
        $skin = $phenotype[7];
        $build = $phenotype[8];
        $beak = $phenotype[9];
        $feet = $phenotype[10];
        $health = $phenotype[11];
        $mutations = $phenotype[12];
        $beakColor = 'Med';
        
        
        //$imgBaseLines = imagecreatefrompng($folderPath . 'WBaseLines.png');
        //$imgEarLines = imagecreatefrompng($folderPath . 'WEars.png');
        //$imgFeetLines = imagecreatefrompng($folderPath . 'WPaws.png');
        //$imgBeakLines = imagecreatefrompng('./imagebuilder/beak/WBeak.png');
        $imgColor = imagecreatefrompng('red.png');
//        $imgPattern = $color . '/' . $pattern . '_' . $color. '.png';
//        $imgMarking = $color . '/' . $marking . '_' . $color . '.png';
//        $imgBeak = 'beak/W' . $beakColor . '.png';
//        $imgEyes = 'eyes/' . $eyes;
//        $imgFeet = $color . '/Foot' . $feet . '_' . $color . '.png';
//        $imgEars = $color . '/Ear' .$ears . '_' . $color . '.png';
//        $imgSkin = 'skin/' . $skin . '.png';
//        $imgBaseShading = $folderPath . 'shading/Base.png';
//        $imgFeetShading = $folderPath . 'shading/FeetPaws.png';
//        $imgSkinShading = $folderPath . 'shading/Skin.png';
//        $imgBeakShading = $folderPath . 'shading/BeakWild.png';
//        $imgEarShading = $folderPath . 'shading/EarsWild.png';
//        
       
        //codominance encoding
        switch ($phenotype[0]){
            case 'BW':
                $color = 'storm';
                break;
            case 'WB':
                $color = 'storm';
                break; 
            case 'GN':
                $color = 'ash';
                break;
            case 'NG':
                $color = 'ash';
                break;
            case 'HR':
                $color = 'rose';
                break;
            case 'RH':
                $color = 'rose';
                break;
            case 'JD':
                $color = 'martin';
                break;
            case 'DJ':
                $color = 'martin';
                break;
            default:
                $color = $phenotype[0];
                break;
        }
        
        switch ($pattern){
            
        }
        
        switch ($marking){
            
        }
        
        switch ($coat){
            
        }
        
      //color specific elements
        
        //light 
        if ($color === 'white' || $color === 'grey' || $color === 'champagne' || $color === 'rose'){
           $beakColor = 'Light'; 
           if($skin === 'black'){
               $skin = 'grey';
           }
        }
        //med 
        else if ($color === 'storm' || $color === 'tawny' || $color === 'flame' || $color === 'wild' || $color === 'ash'){
            $beakColor = 'Med';
        }
        //dark 
        else{
            $beakColor = 'Dark';
        }
        
        
        //create image
      $cvs = imagecreatetruecolor(600, 600);
      imagesavealpha($cvs, true);
      
      $trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);

            //fill the image with a transparent background
            imagefill($cvs, 0, 0, $trans_background);
//      imagecopyresized($cvs, $imgSkin, 0, 0, 0, 0, 600, 600, 2400, 2400);
        imagecopy($cvs, $imgColor, 0, 0, 0, 0,  2400, 2400);
//      imagecopyresized($cvs, $imgFeet, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgBeak, 0, 0, 0, 0, 600, 600, 2400, 2400);
//     imagecopyresized($cvs, $imgEars, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgEyes, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgPattern, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgMarking, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgSkinShading, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgBaseShading, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgFeetShading, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgBeakShading, 0, 0, 0, 0, 600, 600, 2400, 2400);
//      imagecopyresized($cvs, $imgEarShading, 0, 0, 0, 0, 600, 600, 2400, 2400);
      //imagecopyresized($cvs, $imgBaseLines, 0, 0, 0, 0, 600, 600, 2400, 2400);
     // imagecopyresized($cvs, $imgEarLines, 0, 0, 0, 0, 600, 600, 2400, 2400);  
      //imagecopyresized($cvs, $imgFeetLines, 0, 0, 0, 0, 600, 600, 2400, 2400);
      //imagecopyresized($cvs, $imgBeakLines, 0, 0, 0, 0, 600, 600, 2400, 2400); 
     
      //
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
    
    
    
            
            
}
