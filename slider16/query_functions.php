<?php
function user_exists($email, $hash){
	global $db;

	if ($hash == 'NEW') {
		$sql = "SELECT * FROM users WHERE email='$email'";
	}
	else {
		$sql = "SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'";
	}

	$result = mysqli_query($db, $sql);

	if (DEBUG_MODE == 'ONxx') {
		echo 'DEBUG MODE: ' . dirname(__FILE__).'.user_exists()<br/>';
		echo 'SQL: ' .$sql . '<br/>';
		print_r($result);
		echo '<br/>';
		}

    if($result) {
        return $result;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function login_exists($email, $password){
	global $db;

	$sql = "SELECT * FROM users WHERE email='$email' AND hash='$password'";

	$result = mysqli_query($db, $sql);

	if (DEBUG_MODE == 'ONxx') {
		echo 'DEBUG MODE: ' . dirname(__FILE__).'.user_exists()<br/>';
		echo 'SQL: ' .$sql . '<br/>';
		print_r($result);
		echo '<br/>';
		}

    if($result) {
        return $result;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

  function find_all_users() {
    global $db;

    $sql = "select id, first_name, last_name, email, role, active ";
    $sql .= "from users ";
    //$sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


function find_user_by_id($id) {
    global $db;

    $sql = "select id, first_name, last_name, email, role, active ";
    $sql .= "from users ";
    $sql .= "where id='" . $id . "' ";
    //$sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;

}

function validate_user($user) {
    $errors = [];

    // menu_name
    if(is_blank($user['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($user['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $user['position'];
    if($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $user['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}



function insert_user($first_name, $last_name, $email, $password, $hash, $role='USER', $active=0) {
    global $db;


    $sql = "INSERT INTO users ";
    $sql .= " (first_name, last_name, email, role, active, hash, CreatedTime) ";
    $sql .= "VALUES (";
    $sql .= "'" . $first_name . "',";
    $sql .= "'" . $last_name . "',";
    $sql .= "'" . $email . "',";
	$sql .= "'" . $role . "',";
	$sql .= "'" . $active . "',";
	$sql .= "'" . $hash .  "'";
	$sql .= "'0000-00-00 00:00:00'";
    $sql .= ")";

	echo $sql;

    $result = mysqli_query($db, $sql);
	echo '$result is: ';
	print_r($result);
    // For INSERT statements, $result is true/false
    if($result) {
        return true;
    } else {
        // INSERT failed
        echo 'Insert Error: ' . mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_user($user) {
    global $db;

    $sql = "UPDATE users SET ";
    $sql .= "username='" . $user['username'] . "', ";
    $sql .= "user_email='" . $user['user_email'] . "', ";
    $sql .= "role='" . $user['role'] . "' ";
    $sql .= "WHERE user_id='" . $user['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

function activate_user($email) {
    global $db;

    $sql = "UPDATE users SET ";
    $sql .= "active='1'";
    $sql .= "WHERE email='" . $email . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}



function delete_user_old($id) {
    global $db;

    $sql = "DELETE FROM users ";
    $sql .= " WHERE users.id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_user($id) {
    global $db;

    if ($id < 0) {return true;}	// Don't let the interface take out any special rows hidden with item_ids < 0

    $sql = "DELETE FROM users";
    $sql .= " WHERE id='" . $id . "'";
    $sql .= " LIMIT 1";

    $result = mysqli_query($db, $sql);


    // For DELETE statements, $result is true/false
    if($result) {
        mysqli_commit($db);
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

/**
 * A function to get the given preference value from the database.
 * 
 * @param $name The name of the preference.
 * @return string|null The value of the preference from the database, or null if there is no such preference 
 *  or something went wrong.
 */
function get_preference($name) {
	try {
		// connect to the database
		$pdo = pdo_connect_to_db();

		$stmt = $pdo->prepare("SELECT value FROM preferences WHERE NAME=:name");
		$stmt->bindParam(':name', $name);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result['value'];
		}
	} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
	}
	return null;
}

/**
 * A function to get a given quote from the database.
 * 
 * @param $quote_id The id of the quote.
 * @return string|null The quote, if it exists, or null if there is no quote with the given id
 *  or something went wrong.
 */
function get_quote($quote_id) {
	try {
		// connect to the database
		$pdo = pdo_connect_to_db();

		$stmt = $pdo->prepare("SELECT quote FROM quote_table where id=:quote_id");
		$stmt->bindParam(':quote_id', $quote_id);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result['quote'];
		}
	} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
	}
	return null;
}

/**
 * A function to create a quote record in the database.
 * 
 * @param $author The author of the quote
 * @param $topic The topic of the quote.
 * @param $quote The quote.
 * @return boolean True if the quote was successfully added to the database, false otherwise.
 */
function create_quote($author, $topic, $quote) {
	try {
		// connect to the database
		$pdo = pdo_connect_to_db();

		$stmt = $pdo->prepare("INSERT INTO quote_table (author, topic, quote)
			VALUES (:author, :topic, :quote)");
		$stmt->bindParam(':author', $author);
		$stmt->bindParam(':topic', $topic);
		$stmt->bindParam(':quote', $quote);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return true;
		}
	} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
	}
	return false;
}

/**
 * A function to get all preferences from the database.
 * 
 * @return string|null The preference data from the database, or null if there are no preferences
 *  or something went wrong.
 */
function get_preferences() {
	try {
		// connect to the database
		$pdo = pdo_connect_to_db();

		$stmt = $pdo->prepare("SELECT * FROM preferences");
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
	} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
	}
	return null;
}

function update_preference($name, $value) {
    try {
		// connect to the database
		$pdo = pdo_connect_to_db();

		$stmt = $pdo->prepare("UPDATE preferences SET value=:value WHERE name=:name");
		$stmt->bindParam(':value', $value);
		$stmt->bindParam(':name', $name);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return true;
		}
	} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
	}
	return false;
}

/**
 * A function to get the last several quotes from the datbase.
 * 
 * @param $quotes_to_show The number of quotes to show
 * @return array|null An associative array of the most recent quotes, or null if something went wrong.
 */
function get_recent_quotes($quotes_to_show) {
    try {
		// connect to the database
		$pdo = pdo_connect_to_db();

		$stmt = $pdo->prepare("SELECT id, author, topic FROM quote_table ORDER BY id DESC LIMIT " . $quotes_to_show);
        $stmt->execute();

		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    return $result;
		}
	} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
	}
	return null;
}

/**
 * A function to get the quotes from the datbase.
 * 
 * @return array|null An associative array of the most recent quotes, or null if something went wrong.
 */
function get_quotes() {
    try {
		// connect to the database
		$pdo = pdo_connect_to_db();

		$stmt = $pdo->prepare("SELECT * FROM quote_table");
        $stmt->execute();

		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    return $result;
		}
	} catch(PDOException $e) {
		error_log("Error: " . $e->getMessage(), 0);
	}
	return null;
}