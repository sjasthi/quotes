<?php
$page_title = 'Create a Quote';
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
if (isset($_POST["quote"])) {
    require_once "./initialize.php";
    $success = create_quote($_POST["author"], $_POST["topic"], $_POST["quote"]);
    
    if ($success) {
        redirect_to('./admin.php?create=Success');
    } else {
        redirect_to('./admin.php?create=Failure');
    }
}

include("./nav.php");
?>

<form action="createQuote.php" method="POST" enctype="multipart/form-data">
    <br>
    <h3 id="title">Create A Quote</h3> <br>

    <table>

        <tr>
            <td style="width:100px">Author:</td>
            <td><input type="text" name="author" class="form-control" maxlength="50" size="50" required title="Please enter an author."></td>
        </tr>
        <tr>
            <td style="width:100px">Topic:</td>
            <td><input type="text" name="topic" class="form-control" maxlength="50" size="50" required title="Please enter a topic."></td>
        </tr>

        <tr>
            <td style="width:100px">Quotation:</td>
            <td><input type="text" name="quote" class="form-control" maxlength="300" size="200" required title="Please enter a quote."></td>
        </tr>


    </table>

    <br><br>
    <div align="center" class="text-left">
        <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Quote</button>
    </div>
    <br> <br>

</form>
</div>