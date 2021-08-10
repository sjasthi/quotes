<?php
$page_title = 'Import Quotes';
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";

include("./nav.php");

// connect to the database
	$pdo = pdo_connect_to_db();

try {

	if (($handle = fopen("quotes_mass_import.csv", "r")) !== FALSE) {
		while (($row = fgetcsv($handle)) !== FALSE) {
			$success = $pdo->query('INSERT INTO quote_table (author, topic, quote)
			VALUES ("'.$row[0].'","'.$row[1].'","'.$row[2].'")');
		}
		fclose($handle);
	}
} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
}

if ($success) {
        redirect_to('./admin.php?import=Success');
    } else {
        redirect_to('./admin.php?import=Failure');
    }

?>
