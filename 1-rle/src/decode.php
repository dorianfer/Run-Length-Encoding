<?php
function decode_rle(string $str){
    $cpy = "\0";
    $nbr_cpy = 0;
    for($nbr = 0;$nbr != strlen($str);$nbr++){
        $stockage = 0;
        if($str[$nbr] >= "1" && $str[$nbr] <= "9") {
            $stockage = $str[$nbr];
            if($nbr+1 == strlen($str)){
                echo "$$$";
                return ("$$$\n");
            }
            while($str[$nbr + 1] >= "0" && $str[$nbr + 1] <= "9") {
                $stockage = $stockage * 10 + $str[$nbr + 1];
                $nbr++;
                if($nbr+1 == strlen($str)){
                    echo "$$$";
                    return ("$$$\n");
                }
            }
        } else {
            echo "$$$";
            return ("$$$\n");
        }
        $nbr++;
        if ($str[$nbr] >= 'a' && $str[$nbr] <= 'z' || $str[$nbr] >= 'A' && $str[$nbr] <= 'Z') {
            if ($nbr+1 == strlen($str)){
                 while($stockage != 0) {
                    $cpy[$nbr_cpy] = $str[$nbr];
                    $nbr_cpy++;
                    $cpy[$nbr_cpy] = "\0";
                    $stockage = $stockage - 1;
                }
                $cpy[$nbr_cpy] = "\0";
                $cpy = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $cpy);
                echo "$cpy\n";
                return "$cpy\n";

            }
            if ($str[$nbr + 1] >= 'a' && $str[$nbr + 1] <= 'z' || $str[$nbr + 1] >= 'A' && $str[$nbr + 1] <= 'Z') {
                echo "$$$";
                return ("$$$\n");
            } else {
                while($stockage != 0) {
                    $cpy[$nbr_cpy] = $str[$nbr];
                    $nbr_cpy++;
                    $cpy[$nbr_cpy] = "\0";
                    $stockage = $stockage - 1;
                }
            }
        } else {
            echo "$$$";
            return ("$$$\n");
        }   
    }
    $cpy[$nbr_cpy] = "\0";
    $cpy = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $cpy);
    echo "$cpy\n";
    return "$cpy\n";
}
?>
