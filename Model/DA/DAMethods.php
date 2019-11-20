<?php


class DAMethods {
    
        static function genome_parse($genomeString){
        $split = str_split($genomeString, 1);
        $genomeArray = array(
            array('color', $split[0]),
            array('color', $split[1]),
            array('eyes', $split[2]), 
            array('eyes', $split[3]),
            array('ears', $split[4]),
            array('ears', $split[5]),
            array('coat', $split[6]), 
            array('coat', $split[7]),
            array('pattern', $split[8]), 
            array('pattern', $split[9]),
            array('marking', $split[10]),
            array('marking', $split[11]),
            array('tail', $split[12]),
            array('tail', $split[13]),
            array('skin', $split[14]),
            array('skin', $split[15]),
            array('build', $split[16]),
            array('build', $split[17]),
            array('beak', $split[18]),
            array('beak', $split[19]),
            array('feet', $split[20]),
            array('feet', $split[21]),
            array('health', $split[22]),
            array('health', $split[23]),
            array('mutations', $split[24]),
            array('mutations', $split[25])
        );
        return $genomeArray;
    }
}
