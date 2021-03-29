<?php
function encode_rle(string $str){
    $cpy = "\0";
    for($nbr = 0;$nbr != strlen($str);$nbr++){
        if($str[$nbr] >= 'a' && $str[$nbr] <= 'z' || $str[$nbr] >= 'A' && $str[$nbr] <= 'Z') {
            $chiffre = 1;
            if ($nbr+1 == strlen($str)){
               $cpy .= $chiffre;
               $cpy .= $str[$nbr];
               $cpy .= "\0";
               //$cpy = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $cpy);
               $cpy = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $cpy);
               echo "$cpy";
               return ("$cpy\n");
            }
            while ($str[$nbr] == $str[$nbr+1]) {
                $nbr++;
                $chiffre++;
                if ($nbr+1 == strlen($str)){
                   $cpy .= $chiffre;
                   $cpy .= $str[$nbr];
                   $cpy .= "\0";
                   //$cpy = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $cpy);
                   $cpy = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $cpy);
                   echo "$cpy";
                   return ("$cpy\n");
               }
            }
            $cpy .= $chiffre;
            $cpy .= $str[$nbr];
        } else {
            echo "$$$";
            return ("$$$\n");
        }
    }
}
?>