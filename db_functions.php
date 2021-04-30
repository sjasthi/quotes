<?php
require_once "./db_credentials.php";

function get_preference($name) {
    // connect to the database
	$pdo = pdo_connect_to_db();

    $stmt = $pdo->prepare("SELECT VALUE FROM pref WHERE NAME=:name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	} else {
		return null;
	}
}

function get_quote($quote_id) {
    // connect to the database
	$pdo = pdo_connect_to_db();

    $stmt = $pdo->prepare("SELECT * FROM quote_table where id=:quote_id");
    $stmt->bindParam(':quote_id', $quote_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['quote'];
	} else {
		return null;
	}
}