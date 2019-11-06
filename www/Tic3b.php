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

function ki_next_move($spiel){

    $ki_spiel=$spiel;
           
    for($e=0;$e<=2;$e++){
        for($f=0;$f<=2;$f++){
            if(($ki_spiel[$e][$f])!=null){
                continue;
            } 
            $ki_spiel[$e][$f]="O";

            $win=sieg("O",$ki_spiel);
            if($win=="O"){
                return $ki_spiel;
            }
            
            $ki_spiel[$e][$f]=null;

        }
    }


    while(true){                                                                                
        $zufallszahl1 = rand(0, 8);
        $spalte=intdiv($zufallszahl1, 3);
        $zeile=$zufallszahl1%3;
        //var_dump($spiel[$zeile][$spalte]);
        if ($spiel[$spalte][$zeile]==null){ 
            $spiel[$spalte][$zeile]="O"; 
            //var_dump($spiel[$spalte][$zeile]);

            break;
        }    
    }

    return $spiel;

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


if (isset($_POST['Neustart'])) unset($spiel);                            
       

        echo "Spieler X ist an der Reihe<br>";
        
        if (isset($_POST['A1'])&&$spiel[0][0]!="O")  {$spiel[0][0]="X" ;}                   
        if (isset($_POST['A2'])&&$spiel[0][1]!="O")  {$spiel[0][1]="X" ;}
        if (isset($_POST['A3'])&&$spiel[0][2]!="O")  {$spiel[0][2]="X" ;}
        if (isset($_POST['B1'])&&$spiel[1][0]!="O")  {$spiel[1][0]="X" ;}
        if (isset($_POST['B2'])&&$spiel[1][1]!="O")  {$spiel[1][1]="X" ;}
        if (isset($_POST['B3'])&&$spiel[1][2]!="O")  {$spiel[1][2]="X" ;}
        if (isset($_POST['C1'])&&$spiel[2][0]!="O")  {$spiel[2][0]="X" ;}
        if (isset($_POST['C2'])&&$spiel[2][1]!="O")  {$spiel[2][1]="X" ;}
        if (isset($_POST['C3'])&&$spiel[2][2]!="O")  {$spiel[2][2]="X" ;}
    
    
    $sieger=sieg("X", $spiel);
    
    


?>
<?php //echo "$zahl"; ?>
<?php  ?>
<form action="Tic3b.php" method="post"> 

<?php 
    $game=1;
    
    $spiel=ki_next_move($spiel);
                                                                                               

    //Siegbedingung für KI
    $sieger=sieg("X", $spiel);
    if (!$sieger){ 
        $sieger=sieg("O", $spiel);
    }

    
    if($sieger=="X") { $game=0; }
    elseif($sieger=="O") { $game=0;}
    $message = null;

    if($sieger=="X"||$sieger=="O") {
        $message = $sieger ." hat gewonnen";
    }
   
    if($game==0) {                                                                                                
        $disabled = "disabled";
    } else  {
        $disabled = "";
    }

   

?>
<!-- Senden des neuen Zugs -->

<input type="submit" id="button01"  name="A1" value="<?php echo $spiel[0][0] ?>" <?php echo !empty($spiel[0][0]) ? "disabled" : $disabled ; ?>>
<input type="submit" id="button02"  name="A2" value="<?php echo $spiel[0][1] ?>" <?php echo !empty($spiel[0][1]) ? "disabled" : $disabled ;?>>
<input type="submit" id="button03" name="A3" value="<?php echo $spiel[0][2] ?>"  <?php echo !empty($spiel[0][2]) ? "disabled" : $disabled ;?>> <br><br>
<input type="submit" id="button04"  name="B1" value="<?php echo $spiel[1][0] ?>" <?php echo !empty($spiel[1][0]) ? "disabled" : $disabled ;?>>
<input type="submit" id="button05"  name="B2" value="<?php echo $spiel[1][1] ?>" <?php echo !empty($spiel[1][1]) ? "disabled" : $disabled ;?>>
<input type="submit" id="button06" name="B3" value="<?php echo $spiel[1][2] ?>"  <?php echo !empty($spiel[1][2]) ? "disabled" : $disabled ;?>> <br><br>
<input type="submit" id="button07"  name="C1" value="<?php echo $spiel[2][0] ?>" <?php echo !empty($spiel[2][0]) ? "disabled" : $disabled ;?>>
<input type="submit" id="button08"  name="C2" value="<?php echo $spiel[2][1] ?>" <?php echo !empty($spiel[2][1]) ? "disabled" : $disabled ;?>>
<input type="submit" id="button09" name="C3"  value="<?php echo $spiel[2][2] ?>" <?php echo !empty($spiel[2][2]) ? "disabled" : $disabled ;?>>

<br>
<br>
<input type="submit" name="Neustart" value="Neustart" id="button10">
<br>
<?php

?>
<!-- Senden des letzten Spielstands -->
<input type="hidden" name="1a" value="<?php echo base64_encode(serialize($spiel))?>">


    <?php 
    if(!empty($message)) {
        echo "<input name='text' id='text' value=' $message' readonly> ";
        echo "<br>";
    }
 
    ?>
</form>

</body>
</html>