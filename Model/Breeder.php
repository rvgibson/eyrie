<?php
require_once('./Model/Genome.php');
require_once('vendor/autoload.php');
use Intervention\Image\ImageManagerStatic as Image;

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
    $height = round(((rand(min($mother->getHeight(), $father->getHeight()),max($mother->getHeight(), $father->getHeight())))/4));
    $weight = round(((rand(min($mother->getWeight(), $father->getWeight()), max($mother->getWeight(), $father->getWeight())))/10));
    $str = (rand(min($mother->getStr(), $father->getStr()), max($mother->getStr(), $father->getStr())));
    $agi = (rand(min($mother->getAgi(), $father->getAgi()), max($mother->getAgi(), $father->getAgi())));
    $spd = (rand(min($mother->getSpd(), $father->getSpd()), max($mother->getSpd(), $father->getSpd())));
    $con = (rand(min($mother->getCon(), $father->getCon()), max($mother->getCon(), $father->getCon())));
    $int = (rand(min($mother->getInt(), $father->getInt()), max($mother->getInt(), $father->getInt())));
    $genomeMom = $mother->getGenome();
    $genomeDad = $father->getGenome();
    $babyGenome = Breeder::genomeBuilder($genomeMom, $genomeDad);
    $phenotype = Breeder::punnet($babyGenome);
    if($phenotype[8] === "Heavy"){
        $weight = $weight * 1.1;
    } else if($phenotype[8] === "Greyhound"){
        $weight = $weight * .9;
    } else if($phenotype[8] === "Compact"){
        $height = $height * .95;
    }
    $health = $babyGenome->calcHealth();
    $maxTameness = $babyGenome->calcTameness();
    $tameness = round($maxTameness/5);
    $baby = new Pet(NULL, "Unnamed", $sex, $mother->getId(), $father->getId(), NULL, NULL, $babyGenome, 10, $health, $health, $maxTameness, $tameness, 'generate', $str, $agi, $int, $spd, $con, $height, $weight);
    
    return $baby;  
}

public static function genomeBuilder($m, $d){
            $mom = (array) $m;
            $dad = (array) $d;
            $momIndexed = array_keys($mom);
            $dadIndexed = array_keys($dad);
            
            $g = array();
            
            for ($i = 0; $i <26; $i+=2){
                $s = rand(0, 1);
                $r = rand(0, 1);
                if ($s == 0){
                    $g[$i] = $mom[$momIndexed[$i]];
                }
                else if ($s == 1) {
                    $g[$i] = $mom[$momIndexed[$i+1]];
                    }
                if ($r == 0) {
                    $g[$i+1] = $dad[$dadIndexed[$i]];
                }
                else if ($r == 1) {
                    $g[$i+1] = $dad[$dadIndexed[$i+1]];
                }
            }  
            $genome = new Genome($g[0], $g[1], $g[2], $g[3], $g[4], $g[5], $g[6], $g[7], $g[8], $g[9], $g[10], $g[11], $g[12], $g[13], $g[14], $g[15], $g[16], $g[17], $g[18], $g[19], $g[20], $g[21], $g[22], $g[23], $g[24], $g[25]);
            return $genome;
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
    
    public static function make_starter_pet($sex){
        $color = get_genes_by_type('color');
        $eyes = get_genes_by_type('eyes');
        $ears = get_genes_by_type('ears');
        $coat = get_genes_by_type('coat');
        $pattern = get_genes_by_type('pattern');
        $markings = get_genes_by_type('marking');
        $tail = get_genes_by_type('tail');
        $skin = get_genes_by_type('skin');
        $build = get_genes_by_type('build');
        $beak = get_genes_by_type('beak');
        $feet = get_genes_by_type('feet');
        $height = rand(90, 200);
        $weight = rand(130, 350);
        $str = rand(10, 30);
        $agi = rand(10, 30);
        $intl = rand(10,30);
        $spd = rand(10, 30);
        $con = rand(10, 30);
        $age = getdate(time() - (30 * 24 * 60 * 60));
        $agefmt = $age['year'] .'-'. $age['mon'] .'-'. $age['mday'].' '. $age['hours'].':'.$age['minutes'].':'.$age['seconds'];
        $breed = $agefmt;
        
        //get random genes
        
            $colorMother = array_rand($color, 1);
            $colorFather = array_rand($color, 1);
            $eyesMother = array_rand($eyes, 1);
            $eyesFather = array_rand($eyes, 1);
            $earsMother = array_rand($ears, 1);
            $earsFather = array_rand($ears, 1);
            $coatMother = array_rand($coat, 1);
            $coatFather = array_rand($coat, 1);
            $patternMother = array_rand($pattern, 1);
            $patternFather =array_rand($pattern, 1);
            $markingsMother = array_rand($markings, 1);
            $markingsFather = array_rand($markings, 1);
            $tailMother = array_rand($tail, 1);
            $tailFather = array_rand($tail, 1);
            $skinMother = array_rand($skin, 1);
            $skinFather = array_rand($skin, 1);
            $buildMother = array_rand($build, 1);
            $buildFather = array_rand($build, 1);
            $beakMother = array_rand($beak, 1);
            $beakFather = array_rand($beak, 1);
            $feetMother = array_rand($feet, 1);
            $feetFather = array_rand($feet, 1);
            
       $genome = new Genome($color[$colorMother], $color[$colorFather],
               $eyes[$eyesMother], $eyes[$eyesFather],
               $ears[$earsMother], $ears[$earsFather],
               $coat[$coatMother], $coat[$coatFather],
               $pattern[$patternMother], $pattern[$patternFather],
               $markings[$markingsMother], $markings[$markingsFather],
               $tail[$tailMother], $tail[$tailFather],
               $skin[$skinMother], $skin[$skinFather],
               $build[$buildMother], $build[$buildFather],
               $beak[$beakMother], $beak[$beakFather],
               $feet[$feetMother], $feet[$feetFather],
               new Gene('health', 'W', 0, 0), new Gene('health', 'W', 0, 0), new Gene('mutation', 'W', 0, 0), new Gene('mutation', 'W', 0, 0)); 
       $griffin = new Pet(NULL, 'Unnamed', $sex, 0, 0, $agefmt, $breed, $genome, 10, 10, 10, $genome->calcTameness(), $genome->calcTameness()/4, 'generate', $str, $agi, $intl, $spd, $con, $height, $weight); 
       return $griffin;
    }

    public static function imageBuilder($phenotype, $id){
        $saveurl = $id.'.png';
        $pullPath = '__DIR__ . ' . '\imagebuilder\Eyrie';
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
        
        
       
       
        //codominance encoding
        switch ($phenotype[0]){
            case 'BW':
                $color = 'Storm';
                break;
            case 'WB':
                $color = 'Storm';
                break; 
            case 'GN':
                $color = 'Ash';
                break;
            case 'NG':
                $color = 'Ash';
                break;
            case 'HR':
                $color = 'Rose';
                break;
            case 'RH':
                $color = 'Rose';
                break;
            case 'JD':
                $color = 'Martin';
                break;
            case 'DJ':
                $color = 'Martin';
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
        if ($color === 'White' || $color === 'Grey' || $color === 'Champagne' || $color === 'Rose'){
           $beakColor = 'Light'; 
           if($skin === 'Black'){
               $skin = 'Grey';
           }
        }
        //med 
        else if ($color === 'Storm' || $color === 'Tawny' || $color === 'Flame' || $color === 'Wild' || $color === 'Ash'){
            $beakColor = 'Med';
        }
        //dark 
        else{
            $beakColor = 'Dark';
        }

        Image::configure(array('driver' => 'gd'));
        //create image
            Image::canvas(600, 600)

                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Color_' . $color . '.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Line_Base.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Color_Feet_' . $color . '_' . $feet .'.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Color_Beak_' . $beak . '_' . $beakColor . '.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Eyes_Wild.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Color_Skin_' . $skin . '.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Line_Base.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Line_Feet_' . $feet . '.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Line_Beak_' . $beak . '.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Color_Ears_Wild_' . $color . '.png')
                    ->insert(__DIR__ . '\imagebuilder\Eyrie\Line_Ears_Wild.png')
                    ->save(__DIR__ . '\griffin_images\g_' . $id . '.png');
    
        
     }
               
}
