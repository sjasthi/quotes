<head>

<link rel="stylesheet" type="text/css" href="../css/spectrum.css">
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> 
<script type="text/javascript" src="../js/spectrum.js"></script>

<style>

	.title {
		text-align: center;
		color: darkgoldenrod;
	}

	.words {
		height: 50px;
		text-align: center;
	}

	h1,
	h2,
	h3 {
		text-align: center;
	}

	table {
		border-collapse: separate;
		table-layout: fixed;
		width: 100px;
		height: 200px;
		text-align: center;
	}

	table td,

	table th {
		font-size: 20px;
		padding: 10px;
	}

	.answerkey td {
		width: 200px;
		height: 200px;
		border: 1px solid black;
		padding: none
	}

	#solution {
		display: none;
	}

	#solution2 {
		display: none;
	}
</style>
<script>
	function allowDrop(ev) {
		ev.preventDefault();
		}

	function drag(ev) {
		ev.dataTransfer.setData("text", ev.target.id);
	}

	function drop(ev) {
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		ev.target.appendChild(document.getElementById(data));
	}

	function viewSolution() {
		document.getElementById("solution").style.display = "table";
		document.getElementById("solution2").style.display = "table";
	}

	function clicked(index,col) {
		var i = index%col;
		var dest = `td${i}`;
				
		while(document.getElementById(dest).hasChildNodes()) {
			i += col;
			dest = `td${i}`;
		}
		var src = `drag${index}`;
		document.getElementById(dest).appendChild(document.getElementById(src));
	}

	function clicked_a(index,col) {
		var i = index%col;
		var dest = `td_a${i}`;
				
		while(document.getElementById(dest).hasChildNodes()) {
			i += col;
			dest = `td_a${i}`;
		}
		var src = `drag_a${index}`;
		document.getElementById(dest).appendChild(document.getElementById(src));
	}

	function clicked_b(index,col) {
		var i = index%col;
		var dest = `td_b${i}`;
				
		while(document.getElementById(dest).hasChildNodes()) {
			i += col;
			dest = `td_b${i}`;
		}
		var src = `drag_b${index}`;
		document.getElementById(dest).appendChild(document.getElementById(src));
	}

</script>
</head>
<body>
	
	<?php

        include("word_processor.php");
		include("telugu_parser.php");
		include("usefultool.php");


		function ScrambleMaker($quote) {
			$words = explode(" ", $quote );
				foreach($words  as $x => $val){
					$newWords[$x] = mb_str_shuffle($val);
				}
				return implode(" ",$newWords);
		}

		function str_split_unicode($str, $l = 0) {
	    if ($l > 0) {
		        $ret = array();
		        $len = mb_strlen($str, "UTF-8");
			        for ($i = 0; $i < $len; $i += $l) {
			            $ret[] = mb_substr($str, $i, $l, "UTF-8");
			        }
			        return $ret;
		    }
		    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		    //return preg_split("/\pL\pM*|./u", $str, -1, PREG_SPLIT_NO_EMPTY);
		}

		function mb_str_shuffle($str) {
		    $tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		    shuffle($tmp);
		    return join("", $tmp);
		}
=======
		function ScrambleMaker2($quote) {
			echo "inside scramble maker";
			echo $quote;

			// create a word processor object based on the string
			$word_processor = new $WordProcessor();
			echo $word_processor;
			$word_processor.setWord($quote,"Telugu");

			// rely on the word processor methods to get the array of logical characters, length and so on.
			// only when you use word processor functions, it works for both English and other languages
			$newWords = $word_processor.getLogicalChars();
			echo $newWords;
			return $newWords;

			// $words = explode(" ", $quote );
			// 	foreach($words  as $x => $val){
			// 		$newWords[$x] = str_shuffle($val);
			// 	}
			// 	return implode(" ",$newWords);
		}


		

		function SplitMaker($quote, $chunks) {

		
			$quote = str_replace("\n", " ", $quote);
			$t2 = parseToCodePoints($quote);
			$t = array();
			foreach ($t2 as $axe) {
				if (ctype_cntrl($axe) == false) //this exists so we can strip control characters from the set.
				{
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
			<button id="captureTable" onclick="takeshot()">Generate</button> 
			<div id="output"></div>
			<script type="text/javascript" src="js/html2canvas.js"></script>
			
			<table border="1" style="width:100%">
			<tbody>
				
			<?php
			$counter = 0;

			foreach ($wheeloffortune as $value) {
				if ($counter % 5 == 0) {
					echo "<tr>";
				}
				echo "<td>";
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
			<br> ";
		}

		function DropM($quote, $col) {
			$quote = str_replace("\n", " ", $quote);
			$t = parseToCodePoints($quote);
			$noletters = Count($t);
			$spaces = array();

			$fodder = ($col - ($noletters % $col));
			$trash = array("-");
			for ($arrayfod2 = 0; $arrayfod2 < $fodder; $arrayfod2++) {
			}

			$nohope = $noletters;
			$noletters = $noletters + $fodder;

			$sample = array();
			$wheeloffortune = array_fill(0, $col, $sample);
			$x = 0;
			$quote_array = array();
			foreach ($t as $axe) {
				$tested = parseToCharacter($axe);
				if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
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
			} ?>


				<br>
				<button id="captureTable" onclick="takeshot()">Generate </button>
				<div id="output"></div>
				<script type="text/javascript" src="js/html2canvas.js"></script>
					<div class="panel" id="capture">
						<div class="panel-group">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-12">
											<div align="center"><h2>Puzzle</h2></div>
										</div>
									</div>
								</div>
								<br>
								<div id="">
									<table  id="convert" class = "puzzle" border="1" style="width:100%">
									<tbody>
									<?php
										$i = 0;
										for ($y = $noletters - 1; $y > -1; $y--) {
											if ($y % $col == $col - 1) {
												echo "<tr>";
											}

											if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
												$alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];
												echo "<td><div draggable='true' ondragstart='drag(event)' id='drag$i' onclick='clicked($i,$col)'>$alpha</div></td>";
											} else {
												echo "<td>&#160</td>";
												}

											if ($y % $col == 0) {
												echo "</tr>";
											}
											$i++;
										}


									?>
									
									<tr>
									<?php
										$i=0;
										for ($y = 0; $y < $noletters; $y++) {
											if ($y % $col == 0) {
												echo "<tr>";
											}

											if (in_array($y, $spaces) == false) {
												echo "<td id='td$i' ondrop='drop(event)' ondragover='allowDrop(event)'></td>";
											} else {
												echo "<td id='td$i' style=\"background-color:#000000;\">&#160</td>";
												}

											if ($y % $col == $col - 1) {
												echo "</tr>";
											}
											$i++;
										}
										echo "<t/body> 
										</table>
										</body> <br> <h1>";							
										echo "</h1>";
									?>
									<div class="panel panel-primary body">
										<div  class="panel-heading">
											<div class="row">
												<div class="col-sm-12">
													<div align="center"><h2>Puzzle Options</h2></div>
												</div>
											</div>
										</div>

										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12" align="center">
													<div class="col-sm-16" >
														<div class="row">
															<div class="col-sm-16" >
																<h3>Choose Option</h3>
															</div>
															<br>
															<div align="center" >
																<div class="row">
																	<div class="col-sm-6" >
																		<label>Square Color</label>
																	</div>
																	<div class="col-sm-6" >
																		<input type="color" id="squarePicker">
																	</div>
																</div>
																<br>

																<div class="row">
																	<div class="col-sm-6" >
																		<label>Letter Color</label>
																	</div>
																	<div class="col-sm-6" >
																		<input type="color" id="colorPicker">
																	</div>
																</div>
																<br>

																<div class="row">
																	<div class="col-sm-6" >
																		<label>Line Color</label>
																	</div>
																	<div class="col-sm-6" >
																		<input type="color" id="linePicker">
																	</div>
																</div>
																<br>
															</div>
														</div>
													</div>											
												</div>
											</div>
										</div>
									</div>										
									<br>

									<div class="panel panel-primary solutionSection">
										<div class="panel-heading ">
											<div class="row">
												<div class="col-sm-12">
													<div align="center"><h2>Solution</h2></div>
												</div>
											</div>
										</div>

										<div class="panel-body">
											<?php
												echo $quote;
											?>
											<br>

											<button id="btnSolution" onclick="viewSolution()">Solution</button><br>
											<table id="solution" border="1" style="width:100%">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<tbody>			
					<tr>
					<?php
						$i = 0;
						for ($y = 0; $y < $noletters; $y++) {
							if ($y % $col == 0) {
								echo "<tr>";
							}

							if (in_array($y, $spaces) == false) {
								echo "<td>".$quote_array[$i]."</td>";
								$i++;
							} else {
								echo "<td style=\"background-color:#000000;\">&#160</td>";
								}

							if ($y % $col == $col - 1) {
								echo "</tr>";
							}	
						}
		}

		function FloatM($quote, $col){
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

					if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
						$t = $x % $col;
						array_push($wheeloffortune[$t], $tested);
						array_push($quote_array,$tested);
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

			<br>
			<button id="captureTable" onclick="takeshot()">Generate</button> 
			<div id="output"></div>
			<script type="text/javascript" src="js/html2canvas.js"></script>		  
				<div class="panel panel-primary" id="capture">
					<div class="panel-group">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-sm-12">
										<div align="center"><h2>Puzzle</h2></div>
									</div>
								</div>
							</div>
							<br>
							<div id="">
								<table  id="convert" class = "puzzle" border="1" style="width:100%">
								<tbody>
								<?php
									$i=0;
									for ($y = 0; $y < $noletters; $y++) {
										if ($y % $col == 0) {
											echo "<tr>";
										}
										$alpha = $wheeloffortune[$y % $col][$y / $col];
										if (in_array($y, $spaces) == false) {
										echo "<td id='td$i' ondrop='drop(event)' ondragover='allowDrop(event)'></td>";
										} else {
											echo "<td id='td$i' style=\"background-color:#000000;\"> 
											&#160
											</td>";
										}

										if ($y % $col == $col - 1) {
											echo "</tr>";
										}
										$i++;
									}
									
								?>
								<tr>
								<?php
									$i=0;
									for ($y = 0; $y < $noletters; $y++) {
										if ($y % $col == 0) {
											echo "<tr>";
										}
										if (isset($wheeloffortune[$y % $col][$y / $col])) {
											$alpha = $wheeloffortune[$y % $col][$y / $col];

											echo "<td><div draggable='true' ondragstart='drag(event)' onclick='clicked($i,$col)' id='drag$i'>$alpha</div></td>";
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
									</body> <br> <h1>";
									echo "</h1>";
								?>
								<div class="panel panel-primary body">
									<div  class="panel-heading">
										<div class="row">
											<div class="col-sm-12">
												<div align="center"><h2>Puzzle Options</h2></div>
											</div>
										</div>
									</div>

									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12" align="center">
												<div class="col-sm-16" >
													<div class="row">
														<div class="col-sm-16" >
															<h3>Choose Option</h3>
														</div>
														<br>
														<div align="center" >
															<div class="row">
																<div class="col-sm-6" >
																	<label>Square Color</label>
																</div>
																<div class="col-sm-6" >
																	<input type="color" id="squarePicker">
																</div>
															</div>
															<br>

															<div class="row">
																<div class="col-sm-6" >
																	<label>Letter Color</label>
																</div>
																<div class="col-sm-6" >
																	<input type="color" id="colorPicker">
																</div>
															</div>
															<br>

															<div class="row">
																<div class="col-sm-6" >
																	<label>Line Color</label>
																</div>
																<div class="col-sm-6" >
																	<input type="color" id="linePicker">
																</div>
															</div>
															<br>
														</div>
													</div>
												</div>											
											</div>
										</div>
									</div>
								</div>								
								<br>

								<div class="panel panel-primary solutionSection">
									<div class="panel-heading ">
										<div class="row">
											<div class="col-sm-12">
												<div align="center"><h2>Solution</h2></div>
											</div>
										</div>
									</div>

									<div class="panel-body">
										<?php
										echo $quote;
										?>
										<br>

										<button id="btnSolution" onclick="viewSolution()">Solution</button><br>
										<table id="solution" border="1" style="width:100%">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<tbody>
				<tr>
				<?php
					$i = 0;
					for ($y = 0; $y < $noletters; $y++) {
						if ($y % $col == 0) {
							echo "<tr>";
						}
								
						if (in_array($y, $spaces) == false) {
							echo "<td>".$quote_array[$i]."</td>";
							$i++;
						} else {
							echo "<td style=\"background-color:#000000;\">&#160</td>";
							}
								
						if ($y % $col == $col - 1) {
							echo "</tr>";
						}	
					}		
		}

		function FloatDrop($quote, $quote2, $col) {

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
				if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope) {
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

				if (ctype_space($tested) == false && ctype_punct($tested) == false && ctype_cntrl($tested) == false && $x < $nohope2) {
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
			} ?>

			<br>
			<button id="captureTable" onclick="takeshot()">Generate </button>
			<div id="output"></div>
			<script type="text/javascript" src="js/html2canvas.js"></script>
			<div class="panel" id="capture">
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-sm-12">
									<div align="center"><h2>Puzzle</h2></div>
								</div>
							</div>
						</div>
						<br>
						<div id="">
							<table  id="convert" class = "puzzle" border="1" style="width:100%">
							<tbody>

							<?php
								$i=0;
								for ($y = $noletters - 1; $y > -1; $y--) {
									if ($y % $col == $col - 1) {
										echo "<tr>";
									}

									if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
										$alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];

										echo "<td><div draggable='true' ondragstart='drag(event)' onclick='clicked_a($i,$col)' id='drag_a$i'>$alpha</div></td>";
									} else {
										echo "<td>&#160</td>";
										if ($y % $col == 0) {
											echo "</tr>";
										}
									}
									$i++;
								}

							?>
							<table border="1" style="width:100%">
							<tbody>
							<tr>
							<?php
								$i=0;
								for ($y = 0; $y < $noletters; $y++) {
									if ($y % $col == 0) {
										echo "<tr>";
									}
									$alpha = $wheeloffortune[$y % $col][$y / $col];
									if (in_array($y, $spaces) == false) {
										echo "<td id='td_a$i' ondrop='drop(event)' ondragover='allowDrop(event)'></td>";
									} else {
										echo "<td id='td_a$i' style=\"background-color:#000000;\"> &#160</td>";
										}
										if ($y % $col == $col - 1) {
											echo "</tr>";
										}
										$i++;
								}
								echo "</tbody>";
							?>
							<table border="1" style="width:100%">
							<tbody>
							<tr>
							<?php
								$i=0;
								for ($y = 0; $y < $noletters2; $y++) {
									if ($y % $col == 0) {
										echo "<tr>";
									}
									if (in_array($y, $spaces2) == false) {
										echo "<td id='td_b$i' ondrop='drop(event)' ondragover='allowDrop(event)'></td>";
									} else {
										echo "<td id='td_b$i' style=\"background-color:#000000;\"> &#160</td>";
										}
										if ($y % $col == $col - 1) {
											echo "</tr>";
										}
									$i++;
								}
								//echo "  </tbody>";
							?>
							<table border="1" style="width:100%">
							<tbody>
							<?php
								$i=0;
								for ($y = 0; $y < $noletters2; $y++) {
									if ($y % $col == 0) {
										echo "<tr>";
									}
									if (isset($wheeloffortune2[$y % $col][$y / $col])) {
										$alpha = $wheeloffortune2[$y % $col][$y / $col];
										echo "<td><div draggable='true' ondragstart='drag(event)' onclick='clicked_b($i,$col)' id='drag_b$i'>$alpha</div></td>";
									} else {
										echo "<td>&#160</td>";
										}
									if ($y % $col == $col - 1) {
										echo "</tr>";
									}
									$i++;
								}
								echo "<t/body> 
								</table>
								</body> <br> <h1>";			
								echo "</h1>";
							?>

							<div class="panel panel-primary body">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-12">
											<div align="center"><h2>Puzzle Options</h2></div>
										</div>
									</div>
								</div>

								<div class="panel-body">
									<div class="row">
										<div class="col-sm-12" align="center">
											<div class="row">
												<div class="col-sm-6" >
													<label>Letter Square Color</label>
													<input type="color" id="squarePicker" name="squareColor">
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-sm-6" >
													<label>Letter Color</label>
													<input type="color" id="colorPicker" name="letterColor">
												</div>
											</div>
											<br>

											<div class="row">
												<div class="col-sm-6" >
													<label>Line Color</label>
													<input type="color" id="linePicker" name="lineColor">
												</div>
											</div>
											<br>										
										</div>
									</div>
								</div>
							</div>
							<br>

							<div class="panel panel-primary solutionSection">
								<div class="panel-heading ">
									<div class="row">
										<div class="col-sm-12">
											<div align="center"><h2>Solution</h2></div>
										</div>
									</div>
								</div>

								<div class="panel-body">
									<?php
										echo $quote;
										echo " / "; 
										echo $quote2;
									?>
									<br>
									<button id="btnSolution" onclick="viewSolution()">Solution</button><br>
									<table id="solution" border="1" style="width:100%">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<tbody>
			<?php
				$i = 0;
				for ($y = 0; $y < $noletters; $y++) {
					if ($y % $col == 0) {
						echo "<tr>";
					}
					if (in_array($y, $spaces) == false) {
						echo "<td>".$quote_array1[$i]."</td>";
						$i++;
					} else {
						echo "<td style=\"background-color:#000000;\">&#160</td>";
						}
						if ($y % $col == $col - 1) {
							echo "</tr>";
						}	
				}
			?>
			</tbody>
			<table id="solution2" border="1" style="width:100%">

			<tbody>
			<?php		
				$i = 0;
				for ($y = 0; $y < $noletters2; $y++) {
					if ($y % $col == 0) {
						echo "<tr>";
					}
					if (in_array($y, $spaces2) == false) {
						echo "<td>".$quote_array2[$i]."</td>";
						$i++;
					} else {
						echo "<td style=\"background-color:#000000;\">&#160</td>";
						}
					if ($y % $col == $col - 1) {
						echo "</tr>";
						}	
				}
				echo "</tbody>
				</table></body>";
				}
			?>

	<script> 	
		$(document).ready(function(){ // <-- use correct syntax
			$('#squarePicker').change(function(){ // <-- use change event
				$('td').css('background-color', $(this).val());
			}); 
		})

		$(document).ready(function(){ // <-- use correct syntax
			$('#colorPicker').change(function(){ // <-- use change event
				$('table').css('color', $(this).val());
			}); 
		})

		$(document).ready(function(){ // <-- use correct syntax
			$('#linePicker').change(function(){ // <-- use change event
				$('td').css('border-color', $(this).val());
			}); 
		})

	</script>
</body>
</html>