<?php $page_title = 'The Cow Layer'; ?>
<?php 
 require 'db_credentials.php'; 
   include("./nav.php");
 ?>

<?php 
    $mysqli = NEW MySQLi('localhost','root','','quotes_db');
   
?>

<form action="createTheQuote.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 id="title">Create A Quote</h3> <br>
        
        <table>
          
            <tr>
                <td style="width:100px">Author:</td>
                <td><input type="text"  name="man" maxlength="50" size="50" required title="Please enter an author."></td>
            </tr>
            <tr>
                <td style="width:100px">Topic:</td>
                <td><input type="text"  name="subject" maxlength="50" size="50" required title="Please enter a topic."></td>
            </tr>
           
            <tr>
                <td style="width:100px">Quotation:</td>
                <td><input type="text"  name="quoted" maxlength="300" size="200" required title="Please enter a quote."></td>
            </tr>
         
          
        </table>

        <br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Quote</button>
        </div>
        <br> <br>

    </form>
</div>