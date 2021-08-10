<head>

	<link rel="stylesheet" type="text/css" href="../quotes/css/spectrum.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
	<script type="text/javascript" src="../quotes/js/spectrum.js"></script>

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

		#convert td,
		#solution td {
			border: 1px solid black;
			height: 48px;
			width: 48px;
			font-size: 24px;
			vertical-align: middle;
		}

		#dropFloatDDiv table td {
			border: 1px solid black;
			height: 48px;
			width: 48px;
			font-size: 24px;
			vertical-align: middle;
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
		function rearrangeForDropQuote(box_number) {

			var elements = document.getElementsByClassName('draggable-' + box_number);

			const copiedElements = [...elements]

			const removedItemIndex = copiedElements.findIndex(it => !it.innerText)

			for (let index = removedItemIndex; index >= 0; index--) {

				const firstEl = copiedElements[index - 1]

				if (firstEl && firstEl.firstChild) {
					if (elements[index].firstChild) {
						elements[index].firstChild.remove()
					}
					elements[index].appendChild(firstEl.firstChild)
				} else {
					break
				}
			}

			const itemToOpharn = document.getElementsByClassName('draggable-' + box_number).item(0)

			if (itemToOpharn) {
				itemToOpharn.removeAttribute('class')

			}

		}

		function rearrangeForFloatDrop(box_number) {

			var elements = document.getElementsByClassName('draggable-' + box_number);

			const copiedElements = [...elements]

			const removedItemIndex = copiedElements.findIndex(it => !it.innerText)

			for (let index = removedItemIndex; index < copiedElements.length; index++) {

				const firstEl = copiedElements[index + 1]

				if (firstEl && firstEl.firstChild) {
					if (elements[index].firstChild) {
						elements[index].firstChild.remove()
					}
					elements[index].appendChild(firstEl.firstChild)
				} else {
					break
				}

			}

			const itemToOpharn = document.getElementsByClassName('draggable-' + box_number).item(copiedElements.length - 1)

			if (itemToOpharn) {
				itemToOpharn.removeAttribute('class')
			}
		}

		function dropInputFocusedOut(e) {
			e.target.remove();
		}

		function dropInputKeyedUp(e, col, box_number, isFloatDrop) {

			var index = +e.target.id.substring(5);
			var j = index % col;

			var done = false

			while (document.getElementById('td' + j) != null) {

				var td = document.getElementById('td' + j);
				var drag = document.getElementById('drag' + j);
				if (drag != null && drag.parentNode.id.substring(0, 2) != 'td') {
					if (drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td' + index).appendChild(drag);
						index = index + 1;
						while (document.getElementById('td' + index) != null) {
							if (document.getElementById('td' + index).hasChildNodes() == false) {
								document.getElementById('td' + index).click();
								break;
							}
							index++;
						}
						break;
					}
				}
				j += col;
			}

			if (isFloatDrop) {
				rearrangeForFloatDrop(box_number)
			} else {
				rearrangeForDropQuote(box_number)

			}

			e.target.value = "";
		}

		function dropClicked(ev, col, box_number, isFloat) {
			if (ev.target.hasChildNodes()) {
				return false;

			}

			ev.target.innerHTML = "<input id='input" + ev.target.id.substring(2) + "' type='text' style='width:100%; outline:none; border:none; padding:0; margin:0;' onfocusout='dropInputFocusedOut(event)' onkeyup='dropInputKeyedUp(event," + col + "," + box_number + "," + isFloat + ")'>";
			document.getElementById('input' + ev.target.id.substring(2)).focus();
		}

		function allowDrop(ev) {
			ev.preventDefault();
		}

		function drag(ev, box_number) {
			ev.dataTransfer.setData("text", ev.target.id);
			ev.dataTransfer.setData("box_number", box_number);
		}

		function dropForScramble(ev) {
			ev.preventDefault();
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data));
		}

		function drop(ev, dropIndex, isFloatDrop) {
			var box_number = ev.dataTransfer.getData("box_number");

			if (box_number != dropIndex) {
				return ev.preventDefault();
			}

			var data = ev.dataTransfer.getData("text");

			if (ev.target.innerText) {
				var el = document.getElementById(data);

				var targetEl = ev.target.cloneNode(true)

				ev.target.innerText = el.innerText;

				ev.target.id = el.id

				el.innerText = targetEl.innerText;

				el.id = targetEl.id

				return
			}

			var elements = document.getElementsByClassName('draggable-' + box_number);

			const copiedElements = [...elements]

			ev.target.appendChild(document.getElementById(data));

			const removedItemIndex = copiedElements.findIndex(it => !it.innerText)

			if (isFloatDrop) {

				for (let index = removedItemIndex; index < copiedElements.length; index++) {

					const firstEl = copiedElements[index + 1]

					if (firstEl && firstEl.firstChild) {
						if (elements[index].firstChild) {
							elements[index].firstChild.remove()
						}
						elements[index].appendChild(firstEl.firstChild)
					} else {
						break
					}

				}

				const itemToOpharn = document.getElementsByClassName('draggable-' + box_number).item(copiedElements.length - 1)

				if (itemToOpharn) {
					itemToOpharn.removeAttribute('class')
				}

				return
			}

			for (let index = removedItemIndex; index >= 0; index--) {

				const firstEl = copiedElements[index - 1]

				if (firstEl && firstEl.firstChild) {
					if (elements[index].firstChild) {
						elements[index].firstChild.remove()
					}
					elements[index].appendChild(firstEl.firstChild)
				} else {
					break
				}
			}

			const itemToOpharn = document.getElementsByClassName('draggable-' + box_number).item(0)

			if (itemToOpharn) {
				itemToOpharn.removeAttribute('class')

			}
		}

		function viewSolution() {
			document.getElementById("solution").style.display = "table";
			document.getElementById("solution2").style.display = "table";
		}

		function clicked(index, col, box_number, isFloatDrop) {
			var i = index % col;
			var dest = `td${i}`;

			while (document.getElementById(dest).hasChildNodes()) {
				i += col;
				dest = `td${i}`;
			}
			var src = `drag${index}`;
			document.getElementById(dest).appendChild(document.getElementById(src));

			if (isFloatDrop) {
				rearrangeForFloatDrop(box_number)
			} else {
				rearrangeForDropQuote(box_number)

			}
		}

		function clicked_a(index, col, box_number, isFloatDrop) {
			var i = index % col;
			var dest = `td_a${i}`;

			while (document.getElementById(dest).hasChildNodes()) {
				i += col;
				dest = `td_a${i}`;
			}
			var src = `drag_a${index}`;
			document.getElementById(dest).appendChild(document.getElementById(src));

			if (isFloatDrop) {
				rearrangeForFloatDrop(box_number)
			} else {
				rearrangeForDropQuote(box_number)

			}
		}

		function clicked_b(index, col) {
			var i = index % col;
			var dest = `td_b${i}`;

			while (document.getElementById(dest).hasChildNodes()) {
				i += col;
				dest = `td_b${i}`;
			}
			var src = `drag_b${index}`;
			document.getElementById(dest).appendChild(document.getElementById(src));
		}

		function dropClicked_a(ev, col, box_number, isFloat) {
			if (ev.target.hasChildNodes())
				return false;
			ev.target.innerHTML = "<input id='input_a" + ev.target.id.substring(4) + "' type='text' style='width:100%; outline:none; border:none; padding:0; margin:0;' onfocusout='dropInputFocusedOut(event)' onkeyup='dropInputKeyedUp_a(event," + col + "," + box_number + "," + isFloat + ")'>";
			document.getElementById('input_a' + ev.target.id.substring(4)).focus();
		}

		function dropClicked_b(ev, col, box_number, isFloat) {
			if (ev.target.hasChildNodes())
				return false;
			ev.target.innerHTML = "<input id='input_b" + ev.target.id.substring(4) + "' type='text' style='width:100%; outline:none; border:none; padding:0; margin:0;' onfocusout='dropInputFocusedOut(event)' onkeyup='dropInputKeyedUp_b(event," + col + "," + box_number + "," + isFloat + ")'>";
			document.getElementById('input_b' + ev.target.id.substring(4)).focus();
		}

		function dropInputKeyedUp_a(e, col, box_number, isFloat) {
			var index = +e.target.id.substring(7);
			var j = index % col;

			while (document.getElementById('td_a' + j) != null) {

				var td = document.getElementById('td_a' + j);
				var drag = document.getElementById('drag_a' + j);
				if (drag != null && drag.parentNode.id.substring(0, 4) != 'td_a') {
					if (drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_a' + index).appendChild(drag);
						index = index + 1;
						while (document.getElementById('td_a' + index) != null) {
							if (document.getElementById('td_a' + index).hasChildNodes() == false) {
								document.getElementById('td_a' + index).click();
								break;
							}
							index++;
						}
						break;
					}
				}
				j += col;
			}

			if (isFloat) {
				rearrangeForFloatDrop(box_number)
			} else {
				rearrangeForDropQuote(box_number)

			}

			return

			j = index % col;

			while (document.getElementById('td_b' + j) != null) {

				var td = document.getElementById('td_b' + j);
				var drag = document.getElementById('drag_b' + j);
				if (drag != null && drag.parentNode.id.substring(0, 2) != 'td') {
					//console.log(drag.innerText+" "+e.target.value);
					if (drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_a' + index).appendChild(drag);
						index = index + 1;
						while (document.getElementById('td_a' + index) != null) {
							if (document.getElementById('td_a' + index).hasChildNodes() == false) {
								document.getElementById('td_a' + index).click();
								break;
							}
							index++;
						}
						break;
					}
				}
				j += col;
			}

			if (isFloat) {
				rearrangeForFloatDrop(box_number)
			} else {
				rearrangeForDropQuote(box_number)

			}
			e.target.value = "";
		}

		function dropInputKeyedUp_b(e, col, box_number, isFloat) {
			var index = +e.target.id.substring(7);
			var j = index % col;

			while (document.getElementById('td_b' + j) != null) {

				var td = document.getElementById('td_b' + j);
				var drag = document.getElementById('drag_b' + j);
				if (drag != null && drag.parentNode.id.substring(0, 2) != 'td') {
					//console.log(drag.innerText+" "+e.target.value);
					if (drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_b' + index).appendChild(drag);
						index = index + 1;
						while (document.getElementById('td_b' + index) != null) {
							if (document.getElementById('td_b' + index).hasChildNodes() == false) {
								document.getElementById('td_b' + index).click();
								break;
							}
							index++;
						}
						break;
					}
				}
				j += col;
			}

			if (isFloat) {
				rearrangeForFloatDrop(box_number)
			} else {
				rearrangeForDropQuote(box_number)

			}
			return

			j = index % col;

			while (document.getElementById('td_a' + j) != null) {

				var td = document.getElementById('td_a' + j);
				var drag = document.getElementById('drag_a' + j);
				if (drag != null && drag.parentNode.id.substring(0, 2) != 'td') {
					//console.log(drag.innerText+" "+e.target.value);
					if (drag.innerText.toLowerCase() == e.target.value.toLowerCase()) {
						e.target.blur();
						document.getElementById('td_b' + index).appendChild(drag);
						index = index + 1;
						while (document.getElementById('td_b' + index) != null) {
							if (document.getElementById('td_b' + index).hasChildNodes() == false) {
								document.getElementById('td_b' + index).click();
								break;
							}
							index++;
						}
						break;
					}
				}
				j += col;
			}

			if (isFloat) {
				rearrangeForFloatDrop(box_number)
			} else {
				rearrangeForDropQuote(box_number)

			}

			e.target.value = "";
		}

		function checkSolution() {
			var i = 0;
			var quote = document.getElementById('original_quote').value;
			var ans = "";
			while (document.getElementById('td' + i)) {
				var ch = document.getElementById('td' + i).innerText;
				if (ch == String.fromCharCode(160))
					ch = ' ';
				ans += ch;
				i++;
			}
			ans = ans.trim();
			quote = quote.trim();

			if (quote == ans) {
				alert("Congratulations! You have solved it!");
			} else {
				alert("Sorry! It is not quite right!");
			}
		}

		function checkSolution_floatDrop() {
			var i = 0;
			var quote1 = document.getElementById('original_quote1').value;
			var quote2 = document.getElementById('original_quote2').value;
			var ans1 = "";
			var ans2 = "";
			while (document.getElementById('td_a' + i)) {
				var ch = document.getElementById('td_a' + i).innerText;
				if (ch == String.fromCharCode(160))
					ch = ' ';
				ans1 += ch;
				i++;
			}

			i = 0;
			while (document.getElementById('td_b' + i)) {
				var ch = document.getElementById('td_b' + i).innerText;
				if (ch == String.fromCharCode(160))
					ch = ' ';
				ans2 += ch;
				i++;
			}
			ans1 = ans1.trim();
			ans2 = ans2.trim();
			quote1 = quote1.trim();
			quote2 = quote2.trim();

			console.log(quote2);
			if (quote1 == ans1 && quote2 == ans2) {
				alert("Congratulations! You have solved it!");
			} else {
				alert("Sorry! It is not quite right!");
			}
		}
	</script>
</head>

<body>

	<?php
	include("usefultool.php");

	function ScrambleMaker($quote)
	{
		$words = explode(" ", $quote);
		//foreach($words  as $x => $val){
		//	$newWords[$x] = mb_str_shuffle2($val);
		//}
		return mb_str_shuffle2(implode("", $words));
	}

	function str_split_unicode($str, $l = 0)
	{
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

	function mb_str_shuffle2($str)
	{
		$t = parseToCodePoints($str);
		$arr = array();
		foreach ($t as $ch) {
			array_push($arr, parseToCharacter($ch));
		}
		shuffle($arr);
		return join("", $arr);
	}

	function mb_str_shuffle($str)
	{
		$tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		print_r($tmp);
		echo "<br>";
		shuffle($tmp);
		return join("", $tmp);
	}

	function SplitMaker($quote, $chunks)
	{
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
			<br> ";
			}

			function DropM($quote, $col)
			{


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
				} ?>


				<br>
				<input type="hidden" id="original_quote" value="<?php echo $quote; ?>">
				<button id="submitSolution" onclick="checkSolution()">Submit</button>
				<div id="output"></div>
				<script type="text/javascript" src="js/html2canvas.js"></script>
				<div class="panel" id="capture">
					<div class="panel-group">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-sm-12">
										<div align="center">
											<h2>Puzzle</h2>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div>
								<table id="convert" class="puzzle" border="1" style="width:100%">
									<tbody>
										<?php
										$i = 0;

										$box_number = 1;

										for ($y = $noletters - 1; $y > -1; $y--) {
											if ($y % $col == $col - 1) {
												echo "<tr id='$y'>";
											}


											if ($box_number > 15) {
												$box_number = 1;
											}

											if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
												$alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];
												echo "<td class='draggable-$box_number'><div draggable='true' ondragstart='drag(event,$box_number)' id='drag$i' onclick='clicked($i,$col,$box_number)'>$alpha</div></td>";
											} else {
												echo "<td>&#160</td>";
											}

											++$box_number;

											if ($y % $col == 0) {
												echo "</tr>";
											}
											$i++;
										}


										?>

										<?php
										$i = 0;

										$box_number = 1;

										for ($y = 0; $y < $noletters; $y++) {
											if ($y % $col == 0) {
												echo "<tr id='$y'>";
											}

											if ($box_number > 15) {
												$box_number = 1;
											}

											if (in_array($y, $spaces) == false) {
												echo "<td id='td$i' onclick='dropClicked(event,$col,$box_number)' ondrop='drop(event,$box_number)' ondragover='allowDrop(event)'></td>";
											} else {
												echo "<td id='td$i' class='black-box' style=\"background-color:#000000;\">&#160</td>";
											}

											++$box_number;

											if ($y % $col == $col - 1) {
												echo "</tr>";
											}
											$i++;
										}
										echo "<tbody> 
										</table>
										</body> <br> <h1>";
										echo "</h1>";
										?>
										<div class="panel panel-primary body">
											<div class="panel-heading">
												<div class="row">
													<div class="col-sm-12">
														<div align="center">
															<h2>Puzzle Options</h2>
														</div>
													</div>
												</div>
											</div>

											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12">
														<div class="col-sm-16">
															<div class="row">
																<div class="col-sm-16">
																	<h3>Choose Option</h3>
																</div>
																<br>
																<div align="center">
																	<div class="row">
																		<div class="col-sm-6">
																			<label>Square Color</label>
																		</div>
																		<div class="col-sm-6">
																			<input type="color" id="squarePicker">
																		</div>
																	</div>
																	<br>

																	<div class="row">
																		<div class="col-sm-6">
																			<label>Letter Color</label>
																		</div>
																		<div class="col-sm-6">
																			<input type="color" id="colorPicker">
																		</div>
																	</div>
																	<br>

																	<div class="row">
																		<div class="col-sm-6">
																			<label>Line Color</label>
																		</div>
																		<div class="col-sm-6">
																			<input type="color" id="linePicker">
																		</div>
																	</div>
																	<br>

																	<div class="row">
																		<div class="col-sm-6">
																			<label>Fill Color</label>
																		</div>
																		<div class="col-sm-6">
																			<input type="color" id="fillPicker">
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
														<div align="center">
															<h2>Solution</h2>
														</div>
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
							echo "<td>" . $quote_array[$i] . "</td>";
							$i++;
						} else {
							echo "<td class='black-box' style=\"background-color:#000000;\">&#160</td>";
						}

						if ($y % $col == $col - 1) {
							echo "</tr>";
						}
					}
				}

				function FloatMaker($quote, $col) {

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

					<br>
					<input type="hidden" id="original_quote" value="<?php echo $quote; ?>">
					<button id="submitSolution" onclick="checkSolution()">Submit</button>
					<div id="output"></div>
					<script type="text/javascript" src="js/html2canvas.js"></script>
					<div class="panel" id="capture">
						<div class="panel-group">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-12">
											<div align="center">
												<h2>Puzzle</h2>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div id="">
									<table id="convert" class="puzzle" border="1" style="width:100%">
										<tbody>
											<?php
											$i = 0;
											$box_number = 1;

											for ($y = 0; $y < $noletters; $y++) {
												if ($y % $col == 0) {
													echo "<tr>";
												}

												if ($box_number > 15) {
													$box_number = 1;
												}

												$alpha = $wheeloffortune[$y % $col][$y / $col];
												if (in_array($y, $spaces) == false) {
													echo "<td id='td$i' onclick='dropClicked(event,$col,$box_number,true)' ondrop='drop(event,$box_number,true)' ondragover='allowDrop(event)'></td>";
												} else {
													echo "<td class='black-box' id='td$i' style=\"background-color:#000000;\"> &#160 </td>";
												}

												++$box_number;

												if ($y % $col == $col - 1) {
													echo "</tr>";
												}
												$i++;
											}

											$i = 0;

											$box_number = 1;

											for ($y = 0; $y < $noletters; $y++) {
												if ($y % $col == 0) {
													echo "<tr>";
												}
												if ($box_number > 15) {
													$box_number = 1;
												}

												if (isset($wheeloffortune[$y % $col][$y / $col])) {
													$alpha = $wheeloffortune[$y % $col][$y / $col];

													echo "<td class='draggable-$box_number'><div draggable='true' ondragstart='drag(event,$box_number)' onclick='clicked($i,$col,$box_number,true)' id='drag$i'>$alpha</div></td>";
												} else {
													echo "<td class='black-box' >&#160</td>";
												}
												if ($y % $col == $col - 1) {
													echo "</tr>";
												}

												++$box_number;


												$i++;
											}

											echo "</tbody>
									</table>
								<br> <h1>";
											echo "</h1>";
											?>
											<div class="panel panel-primary body">
												<div class="panel-heading">
													<div class="row">
														<div class="col-sm-12">
															<div align="center">
																<h2>Puzzle Options</h2>
															</div>
														</div>
													</div>
												</div>

												<div class="panel-body">
													<div class="row">
														<div class="col-sm-12" align="center">
															<div class="col-sm-16">
																<div class="row">
																	<div class="col-sm-16">
																		<h3>Choose Option</h3>
																	</div>
																	<br>
																	<div align="center">
																		<div class="row">
																			<div class="col-sm-6">
																				<label>Square Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="squarePicker">
																			</div>
																		</div>
																		<br>

																		<div class="row">
																			<div class="col-sm-6">
																				<label>Letter Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="colorPicker">
																			</div>
																		</div>
																		<br>

																		<div class="row">
																			<div class="col-sm-6">
																				<label>Line Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="linePicker">
																			</div>
																		</div>
																		<br>

																		<div class="row">
																			<div class="col-sm-6">
																				<label>Fill Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="fillPicker">
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
															<div align="center">
																<h2>Solution</h2>
															</div>
														</div>
													</div>
												</div>
												<div class="panel-body">
													<?php
													echo $quote;
													?>
													<br>
													<button id="btnSolution" onclick="viewSolution()">Solution</button><br>
													<table id="solution" border="1" style="width:100%; display:none">
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
							echo "<td>" . $quote_array[$i] . "</td>";
							$i++;
						} else {
							echo "<td class='black-box' style=\"background-color:#000000;\">&#160</td>";
						}

						if ($y % $col == $col - 1) {
							echo "</tr>";
						}
					}

				}

				function FloatDrop($quote, $quote2, $col, $touched)
				{

					if (!$touched) {

						return;
					}

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
					} ?>

					<br>
					<input type="hidden" id="original_quote1" value="<?php echo $quote; ?>">
					<input type="hidden" id="original_quote2" value="<?php echo $quote2; ?>">
					<button id="submitSolution" onclick="checkSolution_floatDrop()">Submit</button>
					<button id="captureTable" onclick="takeshot()">Generate </button>
					<div id="output"></div>
					<script type="text/javascript" src="js/html2canvas.js"></script>
					<div class="panel" id="capture">
						<div class="panel-group">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-12">
											<div align="center">
												<h2>Puzzle</h2>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div id="dropFloatDDiv">
									<table id="convert" class="puzzle" border="1" style="border-collapse:collapse;width:100%;">
										<tbody>

											<?php
											$i = 0;

											$box_number = 1;

											for ($y = $noletters - 1; $y > -1; $y--) {
												if ($y % $col == $col - 1) {
													echo "<tr>";
												}

												if ($box_number > 15) {
													$box_number = 1;
												}

												if (isset($wheeloffortune[$col - 1 - $y % $col][$y / $col])) {
													$alpha = $wheeloffortune[$col - 1 - $y % $col][$y / $col];

													echo "<td class='draggable-$box_number'><div draggable='true' ondragstart='drag(event,$box_number)' onclick='clicked_a($i,$col,$box_number)' id='drag_a$i'>$alpha</div></td>";
												} else {
													echo "<td>&#160</td>";
													if ($y % $col == 0) {
														echo "</tr>";
													}
												}
												++$box_number;

												$i++;
											}

											?>
											<!--<table border="1" style="width:100%">-->
										<tbody style="border-top: 4px solid black;">
											<tr>
												<?php
												$i = 0;

												$box_number = 1;

												for ($y = 0; $y < $noletters; $y++) {
													if ($y % $col == 0) {
														echo "<tr>";
													}

													if ($box_number > 15) {
														$box_number = 1;
													}

													$alpha = $wheeloffortune[$y % $col][$y / $col];
													if (in_array($y, $spaces) == false) {
														echo "<td id='td_a$i' ondrop='drop(event,$box_number)' onclick='dropClicked_a(event,$col,$box_number)' ondragover='allowDrop(event)'></td>";
													} else {
														echo "<td id='td_a$i' class='black-box' style=\"background-color:#000000;\"> &#160</td>";
													}
													if ($y % $col == $col - 1) {
														echo "</tr>";
													}
													++$box_number;

													$i++;
												}
												echo "</tbody>";
												?>
												<!--<table border="1" style="width:100%">-->
										<tbody style="border-top: 4px solid black;">
											<tr>
												<?php
												$i = 0;

												$box_number = 1;

												for ($y = 0; $y < $noletters2; $y++) {
													if ($y % $col == 0) {
														echo "<tr>";
													}

													if ($box_number > 15) {
														$box_number = 1;
													}

													if (in_array($y, $spaces2) == false) {
														echo "<td id='td_b$i' onclick='dropClicked_b(event,$col,$box_number,true)' ondrop='drop(event,$box_number,true)' ondragover='allowDrop(event)'></td>";
													} else {
														echo "<td id='td_b$i' class='black-box' style=\"background-color:#000000;\"> &#160</td>";
													}
													if ($y % $col == $col - 1) {
														echo "</tr>";
													}
													++$box_number;

													$i++;
												}
												//echo "  </tbody>";
												?>
												<!--<table border="1" style="width:100%">-->
										<tbody style="border-top: 4px solid black;">
											<?php
											$i = 0;

											$box_number = 1;

											for ($y = 0; $y < $noletters2; $y++) {
												if ($y % $col == 0) {
													echo "<tr>";
												}

												if ($box_number > 15) {
													$box_number = 1;
												}

												if (isset($wheeloffortune2[$y % $col][$y / $col])) {
													$alpha = $wheeloffortune2[$y % $col][$y / $col];
													echo "<td class='draggable-$box_number'><div draggable='true' ondragstart='drag(event,$box_number,true)' onclick='clicked_b($i,$col)' id='drag_b$i'>$alpha</div></td>";
												} else {
													echo "<td>&#160</td>";
												}
												if ($y % $col == $col - 1) {
													echo "</tr>";
												}
												++$box_number;

												$i++;
											}
											echo "<tbody> 
								</table>
								</body> <br> <h1>";
											echo "</h1>";
											?>

											<div class="panel panel-primary body">
												<div class="panel-heading">
													<div class="row">
														<div class="col-sm-12">
															<div align="center">
																<h2>Puzzle Options</h2>
															</div>
														</div>
													</div>
												</div>

												<div class="panel-body">
													<div class="row">
														<div class="col-sm-12" align="center">
															<div class="col-sm-16">
																<div class="row">
																	<div class="col-sm-16">
																		<h3>Choose Option</h3>
																	</div>
																	<br>
																	<div align="center">
																		<div class="row">
																			<div class="col-sm-6">
																				<label>Square Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="squarePicker" name="squareColor">
																			</div>
																		</div>
																		<br>

																		<div class="row">
																			<div class="col-sm-6">
																				<label>Letter Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="colorPicker" name="letterColor">
																			</div>
																		</div>
																		<br>

																		<div class="row">
																			<div class="col-sm-6">
																				<label>Line Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="linePicker" name="lineColor">
																			</div>
																		</div>
																		<br>
																		<div class="row">
																			<div class="col-sm-6">
																				<label>Fill Color</label>
																			</div>
																			<div class="col-sm-6">
																				<input type="color" id="fillPicker">
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
															<div align="center">
																<h2>Solution</h2>
															</div>
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
													<table id="solution" border="1" style="border-collapse:collapse; width:100%">
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
							echo "<td>" . $quote_array1[$i] . "</td>";
							$i++;
						} else {
							echo "<td class='black-box' style=\"background-color:#000000;\">&#160</td>";
						}
						if ($y % $col == $col - 1) {
							echo "</tr>";
						}
					}
				?>
			</tbody>
			<br>
			<!--<table id="solution2" border="1" style="width:100%">-->

			<tbody style="border-top: 4px solid black;">
			<?php
					$i = 0;
					for ($y = 0; $y < $noletters2; $y++) {
						if ($y % $col == 0) {
							echo "<tr>";
						}
						if (in_array($y, $spaces2) == false) {
							echo "<td>" . $quote_array2[$i] . "</td>";
							$i++;
						} else {
							echo "<td class='black-box' style=\"background-color:#000000;\">&#160</td>";
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
				$(document).ready(function() { // <-- use correct syntax
					$('#squarePicker').change(function() { // <-- use change event
						$('#convert').css('background-color', $(this).val());
						$('#solution').css('background-color', $(this).val());
					});
				})

				$(document).ready(function() { // <-- use correct syntax
					$('#colorPicker').change(function() { // <-- use change event
						$('#convert').css('color', $(this).val());
						$('#solution').css('color', $(this).val());
					});
				})

				$(document).ready(function() { // <-- use correct syntax
					$('#linePicker').change(function() { // <-- use change event
						$('td').css('border-color', $(this).val());
					});
				})

				$(document).ready(function() { // <-- use correct syntax
					$('#fillPicker').change(function() { // <-- use change event
						$('.black-box').css('background-color', $(this).val());
					});
				})
			</script>
</body>

</html>