<?php
function encode_advanced_rle(string $input_path, string $output_path){
  if (file_exists($input_path) != 1){
    echo "KO\n";
    return(1);
  } else {
    $taille_in = strlen($input_path);
    $taille_out = strlen($output_path);
    //if (strtoupper($input_path[$taille_in - 1]) == 'P' && strtoupper($input_path[$taille_in - 2]) == 'M' && strtoupper($input_path[$taille_in - 3]) == 'B' && $input_path[$taille_in - 4] == '.' && strtoupper($output_path[$taille_out - 1]) == 'E' && strtoupper($output_path[$taille_out - 2]) == 'L' && strtoupper($output_path[$taille_out - 3]) == 'R' && $output_path[$taille_out - 4] == '.'){
      //$nom = "BLK.BMP";
      $image = file_get_contents($input_path);
      $taille = strlen($image);
      $count = 0;
      $hexa = "";
      $nombre = 0;
      $cpy = "";
      $bool = "0";
      While($count < $taille){
        $hexa .= $image[$count];
        //$hexa .= " ";
        $count = $count + 1;
      }
      $hexa .= "\0";
      if ($count == 1){
         $nombre++;
         $cpy .= chr(0);
         $cpy .= chr($nombre);
         $cpy .= $hexa[0];
         file_put_contents($output_path,$cpy);
         echo "OK\n";
         return 0;
      } else if ($count == 0){
        file_put_contents($output_path,$cpy);
        echo "OK\n";
        return 0;
      }
      $count = 0;
      while ($count < strlen($hexa)&& $bool=="0"){
        $nombre = 0;
        $nombre_bis = 0;
        //if ($hexa[$count] == $hexa[$count+3] && $hexa[$count+1] == $hexa[$count+4]){
        if ($hexa[$count] == $hexa[$count+1]){
          //$nombre++;
          /*if ($count+2 >= strlen($hexa)){
            $count = $count - 3;
            $bool = "1";
          }*/
          
          //while($hexa[$count] == $hexa[$count+3] && $hexa[$count+1] == $hexa[$count+4] && $bool == "0"){
          while ($hexa[$count] == $hexa[$count+1] && $nombre < 254 && $bool == "0"){
            $nombre++;
            $count = $count + 1;
            if ($count+2 >= strlen($hexa)){
              $count = $count - 3;
              $bool = "1";
            }
          }
          if ($bool == "1"){
            $count = $count + 3;
          }
          $nombre++;
          if ($nombre < 10){
            //$cpy .= 0;
            //$cpy .= "0".$nombre;
            //$cpy .= " ";
            $cpy .= chr($nombre);
          } else {
            $cpy .= chr($nombre);
            //$cpy .= " ";
          }
          $cpy .= $hexa[$count];
          //$cpy .= $hexa[$count + 1];
          //$cpy .= " ";
          $count++;
        } else {
          //$cpy .= "00";
          //$cpy .= " ";
          $cpy .= chr("0");
          $count_vieux = $count;
          do{
            $nombre++;
            $count = $count + 1;
            if ($count+2 > strlen($hexa)){
              $count = $count - 3;
              $bool = "1";
            }
          //} while ($hexa[$count] != $hexa[$count+3] || $hexa[$count+1] != $hexa[$count+4] && $bool == "0" && $nombre <= 255);
          } while ($hexa[$count] != $hexa[$count+1] && $bool == "0"); 
          if ($bool == "1"){
            $count = $count + 3;
          }
          if ($nombre < 10){
            //$cpy .= chr(0);
            $cpy .= chr($nombre);
            //$cpy .= " ";
          } else {
            $cpy .= chr($nombre);
            //$cpy .= " ";
          }
          do{
            if ($count > $count_vieux){
              $cpy .= $hexa[$count_vieux];
              //$cpy .= $hexa[$count_vieux+1];
              //$cpy .= " ";
            }
            $nombre_bis++;
            $count_vieux = $count_vieux + 1;
          //} while ($hexa[$count_vieux] != $hexa[$count_vieux+3] || $hexa[$count_vieux+1] != $hexa[$count_vieux+4]);
          //} while ($hexa[$count_vieux] != $hexa[$count_vieux+1] && $bool == "0" && $nombre_bis <= 255);
          } while ($nombre_bis <= $nombre);
        }
        //$count = $count + 1;
      }
      //echo $cpy;
      file_put_contents($output_path,$cpy);
      //$v = chr(0).chr(1)."A";
      //file_put_contents($output_path,$v);
      echo "OK\n";
      file_get_contents($output_path);
      return(0);
    /*} else {
      echo "KO\n";
      return(1);
    }*/
  }
}
?>