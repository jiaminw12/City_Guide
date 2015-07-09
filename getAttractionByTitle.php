<?php

require("config.inc.php");

$id = null;

if (!empty($_POST)) {
	
	if (empty($_POST['attr_title'])) {
        
        // Create some data that will be the JSON response
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        //die will kill the page and not execute any code below, it will also
        //display the parameter... in this case the JSON data our Android
        //app will parse
        die(json_encode($response));
    }
	
    $query = " SELECT attr_id FROM attraction WHERE attr_title = :attr_title";
    
    $query_params = array(
        ':attr_title' => $_POST['attr_title']
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
		
        //update our repsonse JSON data
        array_push($response["attractions"], $att);
    }
	
    $response["success"] = 1;
    
    // echoing JSON response
    echo json_encode($response);
	} 

}else {
?>
	<h1>Get Attraction By Title</h1> 
	<form action="getAttractionByTitle.php" method="post"> 
	    Attr_Title: <input type="text" name="attr_title" value="" /> 
	    <br />
	    <input type="submit" value="Submit" /> 
	</form>
	<?php
}
?>
