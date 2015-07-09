<?php

require("config.inc.php");

//initial query
$query = "SELECT attraction.attr_id, attraction.attr_title, category.category_title FROM attraction INNER JOIN category ON attraction.category_id = category.category_id ORDER BY category.category_id";

//execute query
try {
    $stmt   = $db->prepare($query);
    $result = $stmt->execute();
}
catch (PDOException $ex) {
    $response["success"] = 0;
    $response["message"] = "Database Error!";
    die(json_encode($response));
}

// Finally, we can retrieve all of the found rows into an array using fetchAll 
$rows = $stmt->fetchAll();

if ($rows) {
    $response["attractions"]   = array();
    
    foreach ($rows as $row) {
        $att             = array();
		$att["attr_id"] = $row["attr_id"];
		$att["attr_title"]  = $row["attr_title"];
		$att["category_title"] = $row["category_title"];
        
        
        //update our repsonse JSON data
        array_push($response["attractions"], $att);
    }
	
    $response["success"] = 1;
    
    // echoing JSON response
    echo json_encode($response);
    
    
} else {
    $response["success"] = 0;
    $response["message"] = "No Post Available!";
    die(json_encode($response));
}

?>
