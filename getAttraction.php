<?php

require("config.inc.php");

if (!empty($_POST)) {
	
	if (empty($_POST['attr_id'])) {
        
        // Create some data that will be the JSON response
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        //die will kill the page and not execute any code below, it will also
        //display the parameter... in this case the JSON data our Android
        //app will parse
        die(json_encode($response));
    }
	
    //gets user's info based off of a username.
    $query = " SELECT * FROM attraction WHERE attr_id = :attr_id";
    
    $query_params = array(
        ':attr_id' => $_POST['attr_id']
    );
    
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        // For testing, you could use a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one to product JSON data:
        $response["success"] = 0;
        $response["message"] = "Database Error. Please Try Again!";
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
        $att["attr_description"] = $row["attr_description"];
		$att["price_adult"]  = $row["price_adult"];
		$att["price_child"] = $row["price_child"];
		$att["address"]  = $row["address"];
		$att["latitude"] = $row["latitude"];
		$att["longitude"]  = $row["longitude"];
		$att["opening_hrs"] = $row["opening_hrs"];
		$att["category_id"] = $row["category_id"];
		$att["attr_image"]  = $row["attr_image"];
		$att["attr_link"] = $row["attr_link"];
		$att["attr_POI"] = $row["attr_POI"];
		$att["location_id"]  = $row["location_id"];
        
        //update our repsonse JSON data
        array_push($response["attractions"], $att);
    }
	
    $response["success"] = 1;
    
    // echoing JSON response
    echo json_encode($response);
	} 

}else {
?>
	<h1>Get Attraction</h1> 
	<form action="getAttraction.php" method="post"> 
	    ID: <input type="text" name="attr_id" value="" /> 
	    <br />
	    <input type="submit" value="Submit" /> 
	</form>
	<?php
}

?>
