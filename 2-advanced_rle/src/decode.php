<?php
function decode_advanced_rle(string $input_path, string $output_path){
  if (file_exists($input_path) != 1){
    echo "KO\n";
    return(1);
  } else {
    $image = file_get_contents($input_path);
    $taille = strlen($image);
    $count = 0;
    $hexa = "";
    $nombre = 0;
    $cpy = "";
    While($count < $taille){
      $hexa .= $image[$count];
      $count = $count + 1;
    }
    $hexa .= "\0";
    if ($count == 0){
       file_put_contents($output_path,$cpy);
       echo "OK\n";
       return(0);       
    }
    if ($count < 2){
       echo "KO\n";
       return(1);
    }
    $count = 0;
    while ($count < strlen($hexa)-1){
      $nombre = 0;
      $nombre_bis = 0;
      $cc = unpack("C",$hexa[$count])[1];
      if($cc != 0){
        $nombre = unpack("C",$hexa[$count])[1];
        $count ++;
        if ($count+1 >= strlen($hexa)){
           echo "KO\n";
           return(1);
        }
        while ($nombre > $nombre_bis) {
          $cpy .= $hexa[$count];
          $nombre_bis ++;
        }
        $count++;
      } else {
        $count++;
        $nombre = unpack("C",$hexa[$count])[1];
        $count++;
        if ($count+$nombre >= strlen($hexa)){
           echo "KO\n";
           return(1);
        }
        while ($nombre > $nombre_bis) {
          $cpy .= $hexa[$count];
          $nombre_bis ++;
          $count ++;
        }
      }
      //$count++;
    }
    file_put_contents($output_path,$cpy);
    echo "OK\n";
    return(0);
  }
  return(0);
}
?>