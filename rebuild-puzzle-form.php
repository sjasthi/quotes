<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<form id="columnnumber_form" method="post">

<input type="submit" name="generate" id="generate" value="Generate" id="generate">
<!-- Width dropdown selector, default value is 10 -->
<label for="width">Columns:</label>
    <select name="width" id="width" autocomplete="off">

        <?php
        if (isset($_POST['width'])) {
            $width = $_POST['width'];
        } else {
            $width = get_preference('DEFAULT_COLUMN_COUNT');
            if (is_null($width)) {
                // if no datbase preference for width exists, default value is 16
                $width = "12";
            }
        }
        for ($i = 8; $i <= 13; $i++) {
            echo '<option value="' . $i . '"' . (($i == $width) ? ' selected' : '' ) .'>' . $i . '</option>';
        }
        ?>
    </select>

        <?php
            echo '<input type="hidden" name="ident" value="'.$_POST["ident"].'"> ';
            echo $width;
        ?>

</form>