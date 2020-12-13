<?php
$nav_selected = "REPORTS";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");

// aggregate by author
$author_query = "SELECT `author`, count(*) AS quote_count FROM `quote_table` GROUP BY `author`";

// aggregate by topic
$topic_query = "SELECT `topic`, count(*) AS quote_count FROM `quote_table` GROUP BY `topic`";


// set the encoding so that we can read Unicode data
mysqli_set_charset($db, "utf8");

//store the result in GLOBALS
$GLOBALS['author_summary'] = mysqli_query($db, $author_query);
$GLOBALS['topic_summary'] = mysqli_query($db, $topic_query);
?>

<!DOCTYPE html>

<html>

<head>
  <title>Quotes > Summary</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles/main_style.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
</head>

<body class="body_background">
  <div id="wrap">
    <div class="container">
      <h3>Quotes Summary</h3>
      <table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered" width="100%">

        <thead>
          <tr>
            <th>Author</th>
            <th>Count</th>
          </tr>
        </thead>

        <tbody>

          <?php
          // retrive the result set from GLOBALS
          $result = $GLOBALS['author_summary'];

          if ($result->num_rows > 0) {
            // output data of each
            while ($row = $result->fetch_assoc()) {

              $author = $row["author"];
              $count = $row["quote_count"];

              echo "<tr>
                             <td> $author </td>
                             <td> $count </td>
                          </tr>";
            }
          }
          ?>

        </tbody>
      </table>

    </div>

  </div>

  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <!--Data Table-->
  <script type="text/javascript" charset="utf8" src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


  <script type="text/javascript" language="javascript">
    $(document).ready(function() {

      $('#info').DataTable({
        dom: 'lBfrtip',
        lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        paging: true,
        pagingType: "full_numbers",
        buttons: [
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5'
        ]
      });

      $('#info thead tr').clone(true).appendTo('#info thead');
      $('#info thead tr:eq(1) th').each(function(i) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');

        $('input', this).on('keyup change', function() {
          if (table.column(i).search() !== this.value) {
            table
              .column(i)
              .search(this.value)
              .draw();
          }
        });
      });

      var table = $('#info').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        retrieve: true
      });

    });

    $(document).ready(function() {

      var table = $('#info').DataTable({
        retrieve: true,
        "scrollY": "200px",
        "paging": false
      });

      $('a.toggle-vis').on('click', function(e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column($(this).attr('data-column'));

        // Toggle the visibility
        column.visible(!column.visible());
      });
    });

    function updateValue(element, column, id) {
      var value = element.innerText

      $.ajax({
        type: 'post',
        url: 'editable_list.php',
        data: {
          value: value,
          column: column,
          id: id
        },
        success: function(php_result) {
          console.log(php_result);

        }

      })
    }
  </script>

</body>

</html>

<?php include("./footer.php"); ?>