<link rel="stylesheet" href="batch.css">

<?php

  function checkQuoteIDInput($start, $end){
    if($start < 0 || $end < 0){
      return false;
    }elseif ($start <= $end){
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

  function DropPrint($quote, $col, $gentype) {
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
    $solutionTable = $wheeloffortune;
    for ($r = 0; $r < $col; $r++) {
      shuffle($wheeloffortune[$r]);
    }
    ?>

    <div style='border:1px solid black; border-radius: 5px;'>
      <div style='background-color:rgb(55,95,145); color: white; border-bottom: 1px solid black'>
        <h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 40px'>Puzzle</h2>
      </div><br>
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
    if($gentype == 'B' || $gentype == 'C'){
      echo "<br><br><div>
            <div style='background-color:rgb(55,155,95); color: white; border-top: 1px solid black; border-bottom: 1px solid black'>
              <br><br>
              <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:-40px; height: 40px'>Solution</h2></div>
              <br><br>";
      echo "<div><table id='convert' class='puzzle' border='1' style='width:100%'>";
      for ($y = $noletters - 1; $y > -1; $y--) {
        if ($y % $col == $col - 1) {
          echo "<tr id='$y'>";
        }

        if (isset($solutionTable[$col - 1 - $y % $col][$y / $col])) {
          $alpha = $solutionTable[$col - 1 - $y % $col][$y / $col];
          echo "<td><div>$alpha</div></td>";
        } else {
          echo "<td>&#160</td>";
        }

        if ($y % $col == 0) {
          echo "</tr>";
        }
      }
      echo "</table></div>";
      }
      if($gentype == 'C'){
        echo "<br><br><div>
              <div style='background-color:rgb(185,125,0); color:white; border-top: 1px solid black; border-bottom: 1px solid black;'>
                <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:0px; height: 40px'>Original Quote</h2>
              </div><br>
            <div>".$quote."</div>
           </div>";
      }
      echo "</div></div>";
  }

  function FloatPrint($quote, $col, $gentype) {

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

    $solutionTable = $wheeloffortune;
    for ($r = 0; $r < $col; $r++) {
      shuffle($wheeloffortune[$r]);
    }
    ?>

    <div style='border:1px solid black; border-radius: 5px;'>
      <div style='background-color:rgb(55,95,145); color: white; border-bottom: 1px solid black'>
        <h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 40px'>Puzzle</h2>
      </div><br>
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
                }

            echo "</tbody>
                </table> ";

              if($gentype == 'B' || $gentype == 'C'){
                echo "<br><br>
                  <div>
                    <div style='background-color:rgb(55,155,95); color: white; border-top: 1px solid black; border-bottom: 1px solid black'>
                      <br><br>
                      <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:-40px; height: 40px'>Solution</h2>
                    </div>
                    <br><br>";
                echo "<div><table id='convert' class='puzzle' border='1' style='width:100%'>";
                for ($y = $noletters - 1; $y > -1; $y--) {
                  if ($y % $col == $col - 1) {
                    echo "<tr id='$y'>";
                  }

                  if (isset($solutionTable[$col - 1 - $y % $col][$y / $col])) {
                    $alpha = $solutionTable[$col - 1 - $y % $col][$y / $col];
                    echo "<td><div>$alpha</div></td>";
                  } else {
                    echo "<td>&#160</td>";
                  }

                  if ($y % $col == 0) {
                    echo "</tr>";
                  }
                }
                echo "</table></div>";
                }
                if($gentype == 'C'){
                  echo "<br><br><div>
                        <div style='background-color:rgb(185,125,0); color:white; border-top: 1px solid black; border-bottom: 1px solid black;'>
                          <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:0px; height: 40px'>Original Quote</h2>
                        </div><br>
                      <div>".$quote."</div>
                     </div></div></div>";
                }
               ?>
          </div>
        </div>
    <?php
  }

  function FloatDropPrint($quote, $quote2, $col, $gentype){
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

    $solutionTable1 = $wheeloffortune;
    $solutionTable2 = $wheeloffortune2;
    for ($r = 0; $r < $col; $r++) {
      shuffle($wheeloffortune[$r]);
      shuffle($wheeloffortune2[$r]);
      SwapBoy($wheeloffortune[$r], $wheeloffortune2[$r]);
    }
    ?>

    <div id="output"></div>
    <script type="text/javascript" src="js/html2canvas.js"></script>
    <div id="container" style="border: 1px solid black;; border-radius: 5px;">
      <div style='background-color:rgb(55,95,145); color: white; border-bottom: 1px solid black'>
        <h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 40px'>Puzzle</h2>
      </div><br>
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

if($gentype == 'B' || $gentype == 'C'){
      echo "<br><br>
        <div>
          <div style='background-color:rgb(55,155,95); color: white; border-top: 1px solid black; border-bottom: 1px solid black'>
            <br><br>
            <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:-40px; height: 40px'>Solution</h2>
          </div>
            <br><br>";
      ?>
      <br>
      <table id="convert" class="puzzle" border="1" style="border-collapse:collapse;width:100%;">
        <tbody>

      <?php
      $i = 0;

      for ($y = $noletters - 1; $y > -1; $y--) {
        if ($y % $col == $col - 1) {
          echo "<tr>";
        }

        if (isset($solutionTable1[$col - 1 - $y % $col][$y / $col])) {
          $alpha = $solutionTable1[$col - 1 - $y % $col][$y / $col];
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

          $alpha = $solutionTable1[$y % $col][$y / $col];
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
            if (isset($solutionTable2[$y % $col][$y / $col])) {
              $alpha = $solutionTable2[$y % $col][$y / $col];
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
    //Section C:
    if($gentype == 'C'){
      echo "<br><br><div>
              <div style='background-color:rgb(185,125,0); color:white; border-top: 1px solid black; border-bottom: 1px solid black;'>
              <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:0px; height: 40px'>Original Quote</h2>
              </div><br>
              <div style='text-align:left; padding-left: 20px;'><p style='color:rgb(185,125,0)'>Drop Quote: </p>".$quote."</div><br>
              <div style='text-align:left; padding-left: 20px;'><p style='color:rgb(185,125,0)'>Float Quote: </p>".$quote2."</div><br>
          </div></div></div>";
}

 ?>
</div></div></div>
      <?php
    }

  function SplitPrint($quote, $chunks, $gentype){
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
    $solutionTable= array_fill(0, $fodder2, $sample);
  	$wheeloffortune = array_fill(0, $fodder2, $sample);
    for ($x = 0; $x < $noletters; $x++) {
      $tested = parseToCharacter($t[$x]);
      array_push($wheeloffortune[$x / $chunks], $tested);
    }
    $solutionTable = $wheeloffortune;
    shuffle($wheeloffortune);
    ?>

    <div id="container" style="border: 1px solid black;; border-radius: 5px;">
      <div style='background-color:rgb(55,95,145); color: white; border-bottom: 1px solid black'>
        <h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 40px'>Puzzle</h2>
      </div><br>
      <div class="panel-group">
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
      echo "  </tbody>
      </table>
      </div><div>";

      if($gentype == 'B' || $gentype == 'C'){
        ?>
        <br><br>
        <div>
          <div style='background-color:rgb(55,155,95); color: white; border-top: 1px solid black; border-bottom: 1px solid black'>
          <br><br>
            <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:-40px; height: 40px'>Solution</h2>
          </div>
          <br><br>
          <table border="1" style="width:100%">
            <tbody>

        <?php
          $counter = 0;
          foreach ($solutionTable as $value) {
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
          echo " </tbody></table></div></div>";
      }
      if($gentype == 'C'){
        echo "<br><br><div>
                <div style='background-color:rgb(185,125,0); color:white; border-top: 1px solid black; border-bottom: 1px solid black;'>
                <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:0px; height: 40px'>Original Quote</h2>
                </div><br>
                <div>".$quote."</div>
            </div></div>";
          }
        echo "</div></div>";
      }

  //Helper function used by ScramblePrint
  function createSolutionArrayScramble($str){
    $words = explode(" ", $str);
    $str = implode("", $words);
    $t = parseToCodePoints($str);
    $arr = array();
    foreach ($t as $ch) {
      array_push($arr, parseToCharacter($ch));
    }
    return join("", $arr);
  }

  function ScramblePrint($quote, $gentype){
    $quoteClean = str_replace("\n", " ", $quote);
    $words  = ScrambleMaker($quote);
    $arrQuote = parseToCodePoints($quoteClean);
    $arrWord = parseToCodePoints($words);
    $solutionArr = parseToCodePoints(createSolutionArrayScramble($quoteClean));

    if ($words == '') die;
    ?>
    <script src="scramble.js"></script>

    <div style='border:1px solid black; border-radius: 5px;'>
      <div style='background-color:rgb(55,95,145); color: white; border-bottom: 1px solid black'>
        <h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 40px'>Puzzle</h2>
      </div>
    <br><br>
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
            echo '<div style=" border: 1px solid #fff; "></div>';
          } else {
      ?>
      <div></div>
      <?php
          }
        }
      ?>
      </div>
      <?php
      if($gentype == 'B' || $gentype == 'C'){
       ?>
        <div>
          <div style='background-color:rgb(55,155,95); color: white; border-top: 1px solid black; border-bottom: 1px solid black'>
          <br><br>
            <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:-40px; height: 40px'>Solution</h2>
          </div>
          <br><br>
          <div id="cardPile">
          <?php
            $x = 0;
            foreach ($arrQuote as $key => $val) {
              $val = parseToCharacter($val);
              if ($val == ' ') {
                echo '<div class="blank-box" style="border: 1px solid #fff;"></div>';
              } else {
                $val2 = parseToCharacter($solutionArr[$x]);
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
          <br><br>
        </div>
      <?php
    }
      if($gentype == 'C'){
        echo "<div>
                <div style='background-color:rgb(185,125,0); color:white; border-top: 1px solid black; border-bottom: 1px solid black;'>
                  <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:0px; height: 40px'>Original Quote</h2>
                </div><br>
                <div>".$quote."</div><br>
              </div>";
      }
      ?>
    </div>
      <?php
  }

  //Helper method used by Slider16() that creates the "board" to be displayed for
  //Slider16 Puzzle
  function createSolutionArraySlider($quote, $type, $solutionID){
    $quote = str_replace("\n", " ", $quote);
    $charTotal = strlen($quote);
    $displayArr = array("","","","","","","","","","","","","","","","");
    $charsPerTile = number_format($charTotal/15);
    $quoteIndex = 0;

    //Begin to fill the game array with characters from the quote
    for($i=1;$i<16;$i++){
      for($j=0;$j<$charsPerTile;$j++){
        if($quoteIndex<$charTotal){
          $displayArr[$i] .= $quote[$quoteIndex++];
        }
      }
    }

    //Check whether there is at least 1 character each tile. Characters will be redistributed in the event
    //there is an empty tile or there are characters remaining that have not been "assigned" a tile

    //Condition: Characters left after initial loop
    if($quoteIndex < $charTotal){
      $remaining = ($charTotal - $quoteIndex) + strlen($displayArr[12]) + strlen($displayArr[13])
      + strlen($displayArr[14]) + strlen($displayArr[15]);
      $charsToDivide = $displayArr[12]."".$displayArr[13]."".$displayArr[14]."".$displayArr[15];
      $charsPerTile = number_format($remaining/4);
      while($quoteIndex < $charTotal){
        $charsToDivide .= $quote[$quoteIndex++];
      }
      $quoteIndex = 0;
      $displayArr[12] = '';
      $displayArr[13] = '';
      $displayArr[14] = '';
      $displayArr[15] = '';
      for($i=12;$i<16;$i++){
        for($j=0;$j<$charsPerTile;$j++){
          if($quoteIndex<$remaining){
            $displayArr[$i] .= $charsToDivide[$quoteIndex++];
          }
        }
      }
    }
    //Condition: Last 2 tiles are empty
    if($displayArr[14] == ''){
      $quoteIndex = 0;
      $remaining = strlen($displayArr[12]) + strlen($displayArr[13]);
      $charsToDivide = $displayArr[12]."".$displayArr[13];
      $charsPerTile = number_format($remaining/4);
      $displayArr[12] = '';
      $displayArr[13] = '';
      $check = $remaining;
      for($i=12;$i<16;$i++){
        for($j=0;$j<$charsPerTile;$j++){
          if($quoteIndex<$remaining){
            $displayArr[$i] .= $charsToDivide[$quoteIndex++];
            if($check % 4 >= 0 && $check > 4){
              $displayArr[$i] .= $charsToDivide[$quoteIndex++];
            }
          $check--;
          }
        }
      }
    //Condition: last tile is empty
    }else if($displayArr[15] == ''){
      $quoteIndex = 0;
      $remaining = strlen($displayArr[13]) + strlen($displayArr[14]);
      $charsToDivide = $displayArr[13]."".$displayArr[14];
      $charsPerTile = number_format($remaining/3);
      $displayArr[13] = '';
      $displayArr[14] = '';
      $check = $remaining;
      for($i=13;$i<16;$i++){
        for($j=0;$j<$charsPerTile;$j++){
          if($quoteIndex<$remaining){
            $displayArr[$i] .= $charsToDivide[$quoteIndex++];
            if($check % 3 >= 0 && $check > 3){
              $displayArr[$i] .= $charsToDivide[$quoteIndex++];
            }
          $check--;
          }
        }
      }
    }
    return $displayArr;
  }

  function slider16Print($quote, $type, $solutionID){
    $displayArr = createSolutionArraySlider($quote, $type, $solutionID);
    echo "<div style='border:1px solid black; border-radius: 5px;'><div style='background-color:rgb(55,95,145); color: white; border-bottom: 1px solid black'><h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 35px'>Puzzle</h2></div>";
    echo "<br><table style='width:300px; margin-left:auto;margin-right:auto;margin-bottom:10px; background-color:white'><tbody>";
    echo '<tr><td>'.$displayArr[0].'</td><td style="border:1px solid black;">'.$displayArr[2].'</td><td style="border:1px solid black;">'.$displayArr[1].'</td><td style="border:1px solid black;">'.$displayArr[3].'</td></tr>';
    //Section A
    for($i=4;$i<sizeof($displayArr);$i+=4){
      echo '<tr><td style="border:1px solid black;">'.$displayArr[$i+1].'</td><td style="border:1px solid black;">'.$displayArr[$i+3].'</td><td style="border:1px solid black;">'.$displayArr[$i].'</td><td style="border:1px solid black;">'.$displayArr[$i+2].'</td></tr>';
    }
    echo"</tbody></table><br>";
    if($type == "B" || $type == "C"){
      //Section B
      echo "<div><div style='background-color:rgb(55,155,95); color: white;
      border-top: 1px solid black; border-bottom: 1px solid black'><h2 style='text-align:left;
      margin-left:20px; margin-top:auto; margin-bottom:auto; height: 35px'>Solution</h2></div>";
      $id = "solution-table-".$solutionID;
      echo "<br><table id='".$id."' style='width:300px; margin-left:auto;margin-right:auto;background-color:white;'><tbody>";
      echo '<tr><td>'.$displayArr[0].'</td><td style="border:1px solid black;">'.$displayArr[1].'</td><td style="border:1px solid black;">'.$displayArr[2].'</td><td style="border:1px solid black;">'.$displayArr[3].'</td></tr>';
      for($i=4;$i<sizeof($displayArr);$i+=4){
            echo '<tr><td style="border:1px solid black;">'.$displayArr[$i].'</td><td style="border:1px solid black;">'.$displayArr[$i+1].'</td><td style="border:1px solid black;">'.$displayArr[$i+2].'</td><td style="border:1px solid black;">'.$displayArr[$i+3].'</td></tr>';
      }
      echo"</tbody></table></div><br>";
      if($type == "C"){
        //Section C
        echo "<div><div style='background-color:rgb(185,125,0); color:white; border-top: 1px solid black; border-bottom: 1px solid black;'><h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 35px'>Original Quote</h2></div><br>";
        for($i =0;$i<sizeof($displayArr);$i++){
          echo $displayArr[$i];
        }
        echo "</div><br>";
      }
    }
    echo"</div>";
}

function phrasePrint($quote, $width, $height, $tableID ,$gentype){
  $myfile = fopen("fillers.txt", "r") or die("Unable to open file!");
  $filler = fread($myfile, filesize("fillers.txt"));
  fclose($myfile);

  if($width > 26 || $width < 0){
    //Max column width is set to the number of letters in the English alphabet
    $tablesize = 27 * 30;
  }else {
    $tablesize = $width * 30;
  }

  $quote = str_replace(" ", "", $quote);
  $filler = str_replace(",", "", $filler);
  $arrFiller =  parseToCodePoints($filler);
  $arrQuote = parseToCodePoints($quote);
  $tableID = "game".$tableID;
  $cellID = 1;
  $index = 0;
  $columnHeader = 'A';
  $solutionArr = array();
  $solArr = array();
  echo "<div id='phraseContainer'>";
    echo "<div style='border:1px solid black; border-radius: 5px;'><div style='background-color:rgb(55,95,145); color: white; border-bottom: 1px solid black'>
    <h2 style='text-align:left; margin-left:20px; margin-top:auto; margin-bottom:auto; height: 35px'>Puzzle</h2></div>
          <div><br>
            <table id='".$tableID."' style='margin:auto;'><tr><td style='width:50px'> </td>";
            array_push($solArr, " ");
            for($i = 0;$i<$width;$i++){
              echo "<td style='width:50px; border:1px solid black;'> ".$columnHeader." </td>";
              array_push($solArr, $columnHeader++);
            }
            echo "</tr>";
            for($i = 0;$i<$height;$i++){
              echo "<tr>";
              echo "<td style='width:50px; border-left:1px solid black;
              border-right:1px solid black; border-bottom:1px solid black;";
              if($i == 0){
                echo "border-top: 1px solid black;";
              }
              echo "'>".($i+1)."</td>";
              array_push($solArr,$i+1);
              for($j=0;$j<$width;$j++){
                $random = mt_rand(0, strlen($quote));
                if($random%3 == 0 && $index < sizeof($arrQuote)){
                  $char = parseToCharacter($arrQuote[$index++]);
                  echo "<td class='solutionCell' style='width:50px; border-left:1px solid black;
                  border-right:1px solid black; border-bottom:1px solid black;
                  '> ".$char. "</td>";
                  $celldata = "-".$char;
                  array_push($solutionArr, $celldata);
                  array_push($solArr, $celldata);
                }else{
                  $char = parseToCharacter($arrFiller[mt_rand(0,(sizeof($arrFiller) - 1))]);
                  echo "<td id='".$cellID++."' style='width:50px; border-left:1px solid black;
                  border-right:1px solid black; border-bottom:1px solid black;
                  '> ".$char. "</td>";
                  array_push($solutionArr, $char);
                  array_push($solArr, $char);
                }
              }
              echo "</tr>";
            }
  echo "</table></div>";

  if($gentype == "B" || $gentype == "C"){
    echo "<br><br><div><div style='background-color:rgb(55,155,95); color: white;
    border-top: 1px solid black; border-bottom: 1px solid black'><h2 style='text-align:left;
    margin-left:20px; margin-top:auto; margin-bottom:auto; height: 35px'>Solution</h2></div>
    <br>";
    echo " <table style='margin:auto;'>";
            $arrSol = parseToCodePoints(implode("",$solArr));
            $index = 0;
            $markSolution = false;
            for ($i=0; $i < sizeof($solArr); $i++) {
              echo "<tr>";
                for($j=0; $j<=$width;$j++){
                  if($index < sizeof($arrSol)){
                    if(parseToCharacter($arrSol[$index]) == "-"){
                      $markSolution=true;
                      $index++;
                      $j--;
                    }else if($markSolution){
                      $char = parseToCharacter($arrSol[$index++]);
                      echo '<td style="border:1px solid black; width:50px;
                      background-color:green;">'.$char.'</td>';
                      $markSolution=false;
                    }else if(is_integer(getIntegerEquiv(parseToCharacter($arrSol[$index])))
                      && is_integer(getIntegerEquiv(parseToCharacter($arrSol[$index+1])))) {
                      $char = parseToCharacter($arrSol[$index++]);
                      $char2 = parseToCharacter($arrSol[$index++]);
                      echo '<td style="border:1px solid black; width:50px;">'.$char.''.$char2.'</td>';
                    }else{
                      $char = parseToCharacter($arrSol[$index++]);
                      if($char == "\\"){
                        $j--;
                      }else{
                        echo '<td style="border:1px solid black; width:50px;">'.$char.'</td>';
                      }
                    }
                  }
                }
              echo "</tr>";
            }
            echo "</table>
                </div>";
      }
      if($gentype == 'C'){
        echo "<br><br><div>
                <div style='background-color:rgb(185,125,0); color:white; border-top: 1px solid black; border-bottom: 1px solid black;'>
                  <h2 style='text-align:left; margin-left:20px; margin-bottom:auto; margin-top:0px; height: 40px'>Original Quote</h2>
                </div><br>
                <div>".$quote."</div><br>
              </div>";
      }
  echo "</div>";
//END OF PHRASEPRINT
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
      default:
        return " ";
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
        break;
      case 7:
        $number *= 1000000;
        break;
      case 8:
        $number *= 10000000;
        break;
      case 9:
        $number *= 100000000;
        break;
      case 10:
        $number *= 1000000000;
        break;
      default:
        break;
    }
    return $number;
  }

function parseInt($string){
  //todo: validate string input
  $chars = str_split($string);
  $tensPlace = strlen($string);
  $INTEGER = 0;
  $add = 0;
  for($i = 0; $i<strlen($string); $i++){
      $add = getIntegerEquiv($chars[$i]);
      if(is_integer($add)){
        if($add == 0){
          $tensPlace--;
        }else {
          $add = toTensPlace($add, $tensPlace);
          $INTEGER += $add;
          $tensPlace--;
        }
      }
  }
  return $INTEGER;

}
?>
