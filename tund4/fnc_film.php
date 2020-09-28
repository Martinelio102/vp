<?php
$database = "if20_martin_ilm_3";

function readfilms () { 
  //var_dump($GLOBALS)
  //loeme andmebaasist
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
  //valmistame ette SQL käsu
  //$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
  $stmt = $conn->prepare("SELECT * FROM film");
  echo $conn->error;
  //seome tulemuse mingi muutujaga
  $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
  $stmt->execute();
 $filmshtml="\t <ol> \n";
//võtan, kuni on
  while($stmt->fetch()){
  $filmshtml .=  "\t \t <li>" .$titlefromdb;
  $filmshtml .= "\t \t \t <ul> \n";
  $filmshtml .=  "\t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
  $filmshtml .= "\t \t \t  <li>Kestus: " .$durationfromdb ." minutit </li> \n";
  $filmshtml .=  "\t \t \t  <li>Žanr: " .$genrefromdb ."</li> \n";
  $filmshtml .=  "\t \t \t  <li>Tootja/Stuudio: " .$studiofromdb ."</li> \n";
  $filmshtml .=  "\t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
  $filmshtml .= "\t \t \t  </ul> \n";
  $filmshtml .= "\t \t \t </li> \n";
  }
  $filmshtml .= "\t </ol> \n";

  $stmt->close();
  $conn->close();
  return $filmshtml; 
}//readfilms lõppeb

function writefilm($title, $year, $duration, $genre, $studio, $director) {
$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
$stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
echo $conn->error;
$stmt->bind_param("siisss",$title, $year, $duration, $genre, $studio, $director);
$stmt->execute();
$stmt->close();
$conn->close();
}//writefilm lõppeb	
