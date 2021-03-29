<?php
include ('src/encode.php');
include ('src/decode.php');

if($argc != 3){
             echo "$$$";
             return("$$$\n");
    } else {
             if ($argv[1] == "encode") {
                encode_rle($argv[2]);
             } else if ($argv[1] == "decode") {
                decode_rle($argv[2]);
             } else {
               echo "$$$";
               return("$$$\n");
             }
    }
?>
