<?php
srand((double)microtime()*1000000);   



function sieg($a,$spiel){
    if(
        $spiel[0][0]==$a && $spiel[0][1]==$a && $spiel[0][2]==$a || 
        $spiel[1][0]==$a && $spiel[1][1]==$a && $spiel[1][2]==$a || 
        $spiel[2][0]==$a && $spiel[2][1]==$a && $spiel[2][2]==$a || 
        $spiel[0][0]==$a && $spiel[1][1]==$a && $spiel[2][2]==$a ||
        $spiel[0][2]==$a && $spiel[1][1]==$a && $spiel[2][0]==$a ||
        $spiel[0][0]==$a && $spiel[1][0]==$a && $spiel[2][0]==$a || 
        $spiel[0][2]==$a && $spiel[1][2]==$a && $spiel[2][2]==$a || 
        $spiel[0][1]==$a && $spiel[1][1]==$a && $spiel[2][1]==$a) {
        return $a;
   } else {
       return null;
   }
}




?>

<!DOCTYPE html>
<html>
<head>
    <title>Tic Tac Toe (Web) </title>
    <link rel="stylesheet" type="text/css" href="Tic3b.css">
</head>
<body>
<?php

// Laden des letzen Spielstands
$spiel = unserialize(base64_decode($_POST["1a"]));


// Setzen des letzen Zugs


if (isset($_POST['Neustart'])) unset($spiel);                                             // Wenn Nutzer den Neustart-Button klickt wird das Spielfeld zurückgesetzt
       

        echo "Spieler X ist an der Reihe";
        
        if (isset($_POST['A1'])&&$spiel[0][0]!="O")  {$spiel[0][0]="X" ;}                   // zweite bedingung nicht notwendig(entfernen?)
        if (isset($_POST['A2'])&&$spiel[0][1]!="O")  {$spiel[0][1]="X" ;}
        if (isset($_POST['A3'])&&$spiel[0][2]!="O")  {$spiel[0][2]="X" ;}
        if (isset($_POST['B1'])&&$spiel[1][0]!="O")  {$spiel[1][0]="X" ;}
        if (isset($_POST['B2'])&&$spiel[1][1]!="O")  {$spiel[1][1]="X" ;}
        if (isset($_POST['B3'])&&$spiel[1][2]!="O")  {$spiel[1][2]="X" ;}
        if (isset($_POST['C1'])&&$spiel[2][0]!="O")  {$spiel[2][0]="X" ;}
        if (isset($_POST['C2'])&&$spiel[2][1]!="O")  {$spiel[2][1]="X" ;}
        if (isset($_POST['C3'])&&$spiel[2][2]!="O")  {$spiel[2][2]="X" ;}
    
    // Siegbedingungen für menschlichen Spieler
    // in Funktion auslagern, da doppelt
    
    $sieger=sieg("X", $spiel);
    
    


?>
<?php //echo "$zahl"; ?>
<?php  ?>
<form action="Tic3b.php" method="post"> 

<?php 
    $game=1;
    
    $leere_felder = [];
    // foreach($spiel as $key => $reihe) {
    //     foreach($reihe as $k => $field) {
    //         if(empty($field)) {
    //            $leere_felder[] ... 
    //         }
    //     }
    // }
                                                                                                    // leere Felder zählen und zufall davon auswählen
while(true) {                                                                                       // KI hat 100 Versuche um ein Feld zu erwischen, was noch nicht belegt ist
      $zufallszahl1 = rand(1,9);        
      //$leere_felder = [1,2,3];
//$leere_felder[rand(1,count($leere_felder)-1]                                                      // Es wird eine Zufallszahl erzeugt, die sich zwischen eins und neun befindet
      if ($zufallszahl1==1 && $spiel[0][0]!="X" && $spiel[0][0]!="O"){ $spiel[0][0]="O"; break;}    // Diese Zufallszahl entspricht einer Position im Array bzw Spielfeld und das Programm überprüft
      if ($zufallszahl1==2 && $spiel[0][1]!="X" && $spiel[0][1]!="O"){ $spiel[0][1]="O"; break;}    // ob diese Position schon belegt ist und wenn nicht wird als Wert des Arrays an der Position
      if ($zufallszahl1==3 && $spiel[0][2]!="X" && $spiel[0][2]!="O"){ $spiel[0][2]="O"; break;}    // "O" gesetzt.
      if ($zufallszahl1==4 && $spiel[1][0]!="X" && $spiel[1][0]!="O"){ $spiel[1][0]="O"; break;}    // Wenn das Feld schon belegt ist, erhält das Programm die Anweisung erneut zu würfeln
      if ($zufallszahl1==5 && $spiel[1][1]!="X" && $spiel[1][1]!="O"){ $spiel[1][1]="O"; break;}    
      if ($zufallszahl1==6 && $spiel[1][2]!="X" && $spiel[1][2]!="O"){ $spiel[1][2]="O"; break;}
      if ($zufallszahl1==7 && $spiel[2][0]!="X" && $spiel[2][0]!="O"){ $spiel[2][0]="O"; break;}
      if ($zufallszahl1==8 && $spiel[2][1]!="X" && $spiel[2][1]!="O"){ $spiel[2][1]="O"; break;}
      if ($zufallszahl1==9 && $spiel[2][2]!="X" && $spiel[2][2]!="O"){ $spiel[2][2]="O"; break;}
    }
    //Siegbedingung für KI
    $sieger=sieg("X", $spiel);
    if (!$sieger){ 
        $sieger=sieg("O", $spiel);
    }
// echo"<pre>";
//     var_dump($sieger);
//     echo"</pre>";
 
    
    if($sieger=="X") { $game=0; }
    elseif($sieger=="O") { $game=0;}
    $message = null;

    if($sieger=="X"||$sieger=="O") {
        $message = $sieger ." hat gewonnen";
    }
    // echo"<pre>";
    // var_dump($game);
    // echo"</pre>";
    if($game==0) {                                                                                                // $game==0 beschreibt den Endzustand des Spiels, also wenn entweder ein Spieler gewonnen hat, oder das Spielfeld belegt ist
        $disabled = "disabled";
    } else  {
        $disabled = "";
    }
    // echo"<pre>";
    // var_dump($disabled);
    // echo"</pre>";
    // ermittle, wenn es keinen Gewinner gibt

   

?>
<!-- Senden des neuen Zugs -->
<div>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 70px;" name="A1" value="<?php echo $spiel[0][0] ?>" <?php echo !empty($spiel[0][0]) ? "disabled" : $disabled ; ?>>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 35px;" name="A2" value="<?php echo $spiel[0][1] ?>" <?php echo !empty($spiel[0][1]) ? "disabled" : $disabled ;?>>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 0px;" name="A3" value="<?php echo $spiel[0][2] ?>"  <?php echo !empty($spiel[0][2]) ? "disabled" : $disabled ;?>> <br> <br>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 70px;" name="B1" value="<?php echo $spiel[1][0] ?>" <?php echo !empty($spiel[1][0]) ? "disabled" : $disabled ;?>>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 35px;" name="B2" value="<?php echo $spiel[1][1] ?>" <?php echo !empty($spiel[1][1]) ? "disabled" : $disabled ;?>>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 0px;" name="B3" value="<?php echo $spiel[1][2] ?>"  <?php echo !empty($spiel[1][2]) ? "disabled" : $disabled ;?>> <br><br>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 70px;" name="C1" value="<?php echo $spiel[2][0] ?>" <?php echo !empty($spiel[2][0]) ? "disabled" : $disabled ;?>>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 35px;" name="C2" value="<?php echo $spiel[2][1] ?>" <?php echo !empty($spiel[2][1]) ? "disabled" : $disabled ;?>>
<input type="submit" style="width: 30px; height:30px; margin:0; padding:10px; position: absolute; left: 0px;" name="C3"  value="<?php echo $spiel[2][2] ?>" <?php echo !empty($spiel[2][2]) ? "disabled" : $disabled ;?>>
</div>
<br>
<br>
<input type="submit" name="Neustart" value="Neustart">
<br>
<?php

?>
<!-- Senden des letzten Spielstands -->
<input type="hidden" name="1a" value="<?php echo base64_encode(serialize($spiel))?>">
<input type="hidden" name="zahl1" value="<?php echo base64_encode(serialize($zahl))?>">

    <?php 
    if(!empty($message)) {
        echo $message;
    }
    ?>
</form>

</body>
</html>