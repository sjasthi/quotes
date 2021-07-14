<?php

  function checkQuoteIDInput($start, $end){
    if($start < 0 || $end < 0){
      return false;
    }elseif ($start < $end){
      return true;
    }
    return false;
  }

  function checkPuzzleInput($puzzle){
    if($puzzle == 'Drop' || $puzzle == 'Float' || $puzzle == 'Drop-Float' ||
    $puzzle == 'Scramble' || $puzzle == 'Split' || $puzzle == 'Slider-16' ||
    $puzzle == 'Catch-A-Phrase'){
        return true;
    }
    return false;
  }

  function validResponse($puzzle, $start, $end){
    if(checkPuzzleInput($puzzle)){
      if(checkQuoteIDInput($start, $end)){
        return true;
      }
    }
    return false;
  }

  function DropPrint($quote, $col) {
    $quote = str_replace("\n", " ", $quote);
    $t = parseToCodePoints($quote);
    $noletters = Count($t);
    $spaces = array();

    $fodder = ($col - ($noletters % $col));
    $trash = array("-");

    $nohope = $noletters;
    $noletters = $noletters + $fodder;

    $sample = array();
    $wheeloffortune = array_fill(0, $col, $sample);
    $x = 0;
    $quote_array = array();
    foreach ($t as $axe) {
      $tested = parseToCharacter($axe);
      if (ctype_space($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
        $t = $x % $col;
        array_push($wheeloffortune[$t], $tested);
        array_push($quote_array, $tested);
      } else {
        $t = $x % $col;
        array_push($spaces, $x);
      }
      $x++;
    }
    for ($x = $nohope; $x < $noletters; $x++) {
      array_push($spaces, $x);
    }

    for ($r = 0; $r < $col; $r++) {
      shuffle($wheeloffortune[$r]);
    }
    ?>

    <table id="convert" class="puzzle" border="1" style="width:100%">
    <tbody>

    <?php
    $i = 0;
    for ($y = $noletters - 1; $y > -1; $y--) {
      if ($y % $col == $col - 1) {
        echo "<tr id='$y'>";
      }

      if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
        $alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];
        echo "<td><div>$alpha</div></td>";
      } else {
        echo "<td>&#160</td>";
      }
      if ($y % $col == 0) {
        echo "</tr>";
      }
      $i++;
    }

    $i = 0;

    for ($y = 0; $y < $noletters; $y++) {
      if ($y % $col == 0) {
        echo "<tr id='$y'>";
      }
      if (in_array($y, $spaces) == false) {
        echo "<td></td>";
      } else {
        echo "<td id='td$i' class='black-box' style=\"background-color:#000000;\">&#160</td>";
      }
      if ($y % $col == $col - 1) {
        echo "</tr>";
      }
      $i++;
    }
    echo "</tbody>
      </table>";
  }

  function FloatPrint($quote, $col) {

    $quote = str_replace("\n", " ", $quote);
    $t = parseToCodePoints($quote);
    $noletters = Count($t);
    $spaces = array();

    $fodder = ($col - ($noletters % $col));
    $trash = array(" ");
    for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
      array_push($t, $trash);
    }
    $nohope = $noletters;
    $noletters = $noletters + $fodder;

    $sample = array();
    $wheeloffortune = array_fill(0, $col, $sample);
    $x = 0;

    $quote_array = array();

    foreach ($t as $axe) {

      $tested = parseToCharacter($axe);

      if (ctype_space($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
        $t = $x % $col;
        array_push($wheeloffortune[$t], $tested);
        array_push($quote_array, $tested);
      } else {
        $t = $x % $col;
        array_push($spaces, $x);
      }
      $x++;
    }

    for ($r = 0; $r < $col; $r++) {
      shuffle($wheeloffortune[$r]);
    }
    ?>

    <script type="text/javascript" src="js/html2canvas.js"></script>
    <div class="panel" id="capture">
      <div class="panel-group">
          <br>
          <div id="">
            <table id="convert" class="puzzle" border="1" style="width:100%">
              <tbody>
                <?php
                $i = 0;

                for ($y = 0; $y < $noletters; $y++) {
                  if ($y % $col == 0) {
                    echo "<tr>";
                  }

                  $alpha = $wheeloffortune[$y % $col][$y / $col];
                  if (in_array($y, $spaces) == false) {
                    echo "<td id='td$i'></td>";
                  } else {
                    echo "<td class='black-box' id='td$i' style=\"background-color:#000000;\"> &#160 </td>";
                  }

                  if ($y % $col == $col - 1) {
                    echo "</tr>";
                  }
                  $i++;
                }
                $i = 0;

                for ($y = 0; $y < $noletters; $y++) {
                  if ($y % $col == 0) {
                    echo "<tr>";
                  }

                  if (isset($wheeloffortune[$y % $col][$y / $col])) {
                    $alpha = $wheeloffortune[$y % $col][$y / $col];

                    echo "<td><div>$alpha</div></td>";
                  } else {
                    echo "<td class='black-box' >&#160</td>";
                  }
                  if ($y % $col == $col - 1) {
                    echo "</tr>";
                  }
                  $i++;
                }

                echo "</tbody>
                    </table> ";
                ?>
                  </div>
                </div>
              <br>
          </div>
    <?php
  }

  function FloatDropPrint($quote, $quote2, $col){
    $quote = str_replace("\n", " ", $quote);
    $quote2 = str_replace("\n", " ", $quote2);
    $t = parseToCodePoints($quote);
    $noletters = Count($t);
    $spaces = array();
    $spaces2 = array();

    if (($noletters % $col) != 0)
      $fodder = ($col - ($noletters % $col));
    $trash = array("-");
    for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
      array_push($t, $trash);
    }
    $nohope = $noletters;
    $noletters = $noletters + $fodder;

    $sample = array();
    $wheeloffortune = array_fill(0, $col, $sample);

    $wheeloffortune2 = array_fill(0, $col, $sample);
    $x = 0;
    $quote_array1 = array();
    foreach ($t as $axe) {
      $tested = parseToCharacter($axe);
      if (ctype_space($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
        $tt = $x % $col;
        array_push($quote_array1, $tested);
        array_push($wheeloffortune[$tt], $tested);
      } else {
        array_push($spaces, $x);
      }
      $x++;
    }

    $t2 = parseToCodePoints($quote2);
    $noletters2 = Count($t2);

    if (($noletters2 % $col) != 0)
      $fodder = ($col - ($noletters2 % $col));
    for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
      array_push($t2, $trash);
    }
    $nohope2 = $noletters2;
    $noletters2 = $noletters2 + $fodder;

    $quote_array2 = array();
    $x = 0;
    foreach ($t2 as $axe) {
      $tested = parseToCharacter($axe);

      if (ctype_space($tested) == false && ctype_cntrl($tested) == false && $x < $nohope2) {
        $tt = $x % $col;
        array_push($wheeloffortune2[$tt], $tested);
        array_push($quote_array2, $tested);
      } else {
        array_push($spaces2, $x);
      }
      $x++;
    }

    for ($r = 0; $r < $col; $r++) {
      shuffle($wheeloffortune[$r]);
      shuffle($wheeloffortune2[$r]);
      SwapBoy($wheeloffortune[$r], $wheeloffortune2[$r]);
    }
    ?>

    <div id="output"></div>
    <script type="text/javascript" src="js/html2canvas.js"></script>
      <div class="panel-group">
          <br>
            <table id="convert" class="puzzle" border="1" style="border-collapse:collapse;width:100%;">
              <tbody>

                <?php
                $i = 0;

                for ($y = $noletters - 1; $y > -1; $y--) {
                  if ($y % $col == $col - 1) {
                    echo "<tr>";
                  }

                  if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
                    $alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];
                    echo "<td><div>$alpha</div></td>";
                  } else {
                    echo "<td>&#160</td>";
                    if ($y % $col == 0) {
                      echo "</tr>";
                    }
                  }
                  $i++;
                }
                echo "</tbody>";
                ?>
                  <tbody style="border-top: 4px solid black;">
                <?php
                  $i = 0;

                  for ($y = 0; $y < $noletters; $y++) {
                    if ($y % $col == 0) {
                      echo "<tr>";
                    }

                    $alpha = $wheeloffortune[$y % $col][$y / $col];
                    if (in_array($y, $spaces) == false) {
                      echo "<td></td>";
                    } else {
                      echo "<td id='td_a$i' class='black-box' style=\"background-color:#000000;\"> &#160</td>";
                    }
                    if ($y % $col == $col - 1) {
                      echo "</tr>";
                    }
                    $i++;
                  }
                  echo "</tbody>";
                  ?>

                  <tbody style="border-top: 4px solid black;">

                  <?php
                  $i = 0;

                  for ($y = 0; $y < $noletters2; $y++) {
                    if ($y % $col == 0) {
                      echo "<tr>";
                    }
                    if (in_array($y, $spaces2) == false) {
                      echo "<td></td>";
                    } else {
                      echo "<td id='td_b$i' class='black-box' style=\"background-color:#000000;\"> &#160</td>";
                    }
                    if ($y % $col == $col - 1) {
                      echo "</tr>";
                    }
                    $i++;
                  }
                  echo "</tbody>";
                  ?>

                  <tbody style="border-top: 4px solid black;">

                  <?php
                    $i = 0;

                    for ($y = 0; $y < $noletters2; $y++) {
                      if ($y % $col == 0) {
                        echo "<tr>";
                      }
                      if (isset($wheeloffortune2[$y % $col][$y / $col])) {
                        $alpha = $wheeloffortune2[$y % $col][$y / $col];
                        echo "<td><div>$alpha</div></td>";
                      } else {
                        echo "<td>&#160</td>";
                      }
                      if ($y % $col == $col - 1) {
                        echo "</tr>";
                      }
                      $i++;
                    }
      echo "</tbody>
          </table>
        </div>";
    }

  function SplitPrint($quote, $chunks){
    $quote = str_replace("\n", " ", $quote);
    $t2 = parseToCodePoints($quote);
    $t = array();
  	foreach ($t2 as $axe) {
      if (ctype_cntrl($axe) == false) {
        //this exists so we can strip control characters from the set.
          array_push($t, $axe);
        }
    }
    $noletters = Count($t);
    if ($noletters % $chunks == 0) {
		  $fodder = 0;
    } else $fodder = 1;

    $fodder2 = ($noletters / $chunks) + $fodder;
  	$sample = array();
  	$wheeloffortune = array_fill(0, $fodder2, $sample);
    for ($x = 0; $x < $noletters; $x++) {
      $tested = parseToCharacter($t[$x]);
      array_push($wheeloffortune[$x / $chunks], $tested);
    }
    shuffle($wheeloffortune);
    ?>

    <table border="1" style="width:100%">
    <tbody>

    <?php
      $counter = 0;
      foreach ($wheeloffortune as $value) {
        if ($counter % 5 == 0) {
          echo "<tr>";
        }
        echo "<td style='border:1px solid black;'>";
        foreach ($value as $value2) {
          echo $value2;
        }
        echo "</td>";
        if ($counter % 5 == 4) {
          echo "</tr>";
        }
        $counter++;
      }
      echo "  </tbody></table><br> ";
  }

  function ScramblePrint($quote){
    $quoteClean = str_replace("\n", " ", $quote);
    $words  = ScrambleMaker($quote);
    $arrQuote = parseToCodePoints($quoteClean);
    $arrWord = parseToCodePoints($words);

    if ($words == '') die;
    ?>
    <script src="scramble.js"></script>
    <script>
      function drag_scramble(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
      }

      function drop_scramble(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
      }

      function allowDrop_scramble(ev) {
        ev.preventDefault();
      }
    </script>
    <div id="cardPile">
    <?php
      $x = 0;
      foreach ($arrQuote as $key => $val) {
        $val = parseToCharacter($val);
        if ($val == ' ') {
          echo '<div class="blank-box" style="border: 1px solid #fff;"></div>';
        } else {
          $val2 = parseToCharacter($arrWord[$x]);
          $x++;
    ?>
    <div class="blank-box">
      <div id="card">
        <span><?php echo $val2; ?></span>
      </div>
    </div>
    <?php
        }
      }
    ?>
    </div>
    <div id="cardSlots">
      <?php
        foreach ($arrQuote as $key => $val) {
          $val = parseToCharacter($val);
          if ($val == ' ') {
            echo '<div style="border: 1px solid #fff;"></div>';
          } else {
      ?>
      <div></div>
      <?php
          }
        }
      ?>
      </div>
      <?php
  }

  function slider16Print($quote, $width, $height){
    $quote = str_replace("\n", " ", $quote);
    $arr = parseToCodePoints($quote);
    $minCharCount = $width * $height;
    $charCount = strlen($quote);
    $displayArr;

    if($charCount < $minCharCount){
      //Case: slider size exceeds the number of available characters
      //Slider will be generated in a 4*4 slider by default
      $tileLength = number_format($charCount/15);
      echo "<div id='gameBoard' style='width:400px; height:400px; border:1px solid black; color:green'>".$charCount." ".$tileLength;
      $i=0;
      for($i = 0;$i<$charCount; $i++){
        if($i == 0){
          echo '<div style="display:block"><div style="border: 1px solid black; width:25px; height:25px; fontWeight:6px; display:inline"">'.$quote[$i]." ".$quote[($i+1)]." ".$quote[($i+2)].'</div></div>';
        }else if(($i-2)>0){
          if(($i)%3 == 0){
            echo '<div style="display:block; background-color:black;">';
            if(($i+2)==$charCount || ($i + 2)>$charCount){
              if(($i + 1)==$charCount || ($i+1)>$charCount){
                //End of quote
                echo '<div style="border: 1px solid black; background-color:black; width:25px; height:25px; fontWeight:6px; ">'.$quote[$i].'</div></div>';
              }else{
                echo '<div style="border: 1px solid black; width:25px; height:25px; fontWeight:6px; "">'.$quote[$i]." ".$quote[($i+1)].'</div></div>';
              }
            }else{
              echo '<div style="border: 1px solid black; width:25px; height:25px; fontWeight:6px; "">'.$quote[$i]." ".$quote[($i+1)]." ".$quote[($i+2)].'</div></div>';
            }
          }
        }


    }


    }

  }

function getIntegerEquiv($char){
  switch($char){
      case '1':
        return 1;
      case '2':
        return 2;
      case '3':
        return 3;
      case '4':
        return 4;
      case '5':
        return 5;
      case '6':
        return 6;
      case '7':
        return 7;
      case '8':
        return 8;
      case '9':
        return 9;
      case '0':
        return 0;
    }
  }

  function toTensPlace($number, $tensPlace){
    switch($tensPlace){
      case 2:
        $number *= 10;
        break;
      case 3:
        $number *= 100;
        break;
      case 4:
        $number *= 1000;
        break;
      case 5:
        $number *= 10000;
        break;
      case 6:
        $number *= 100000;
      case 7:
        $number *= 1000000;
      case 8:
        $number *= 10000000;
      case 9:
        $number *= 100000000;
      case 10:
        $number *= 1000000000;
      default:
        break;
    }
    return $number;
  }

function parseInt($string){
  $chars = str_split($string);
  $tensPlace = strlen($string);
  $integer = 0;
  $number = 0;
  for($i = 0; $i<strlen($string); $i++){
      $number = getIntegerEquiv($chars[$i]);
      if($number == 0){
        $tensPlace--;
      }else {
        $number = toTensPlace($number, $tensPlace);
        $integer += $number;
        $tensPlace--;
      }
  }
  return $integer;
}
?>