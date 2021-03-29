<?php
include ('src/encode.php');
include ('src/decode.php');

if($argc != 4){
             echo "KO\n";
             return(1);
    } else {
             if ($argv[1] == "encode") {
                encode_advanced_rle($argv[2], $argv[3]);
             } else if ($argv[1] == "decode") {
                decode_advanced_rle($argv[2], $argv[3]);
             } else {
               echo "KO\n";
               return(1);
             }
    }
?>
