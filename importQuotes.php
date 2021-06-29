<?php
$page_title = 'Import Quotes';
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
if (isset($_POST["quote"])) {
    require_once "./initialize.php";

    $success = import_quotes($_POST["author"], $_POST["topic"], $_POST["quote"]);
    
    if ($success) {
        redirect_to('./admin.php?create=Success');
    } else {
        redirect_to('./admin.php?create=Failure');
    }
}

include("./nav.php");
?>

<form action="importQuotes.php" method="POST" enctype="multipart/form-data">
    <br>
    <h3 id="title">Import Quotes</h3> <br>

    <table>

        <tr>
            <td style="width:50px">File:</td>
            <td><input type="file" name="mass_import_quotes" value="C:\Users\rkinsella\Documents\XAMPP\htdocs\quotes\quotes_mass_import" class="form-control" maxlength="50" size="50" </td>
        </tr>
        


    </table>

    <br><br>
    <div align="center" class="text-left">
        <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Import Quotes</button>
    </div>
    <br> <br>

</form>
</div>