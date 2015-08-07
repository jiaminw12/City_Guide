<?php
header('Content-type: text/html; charset=utf-8');
require("config.inc.php");

if (!empty($_POST)) {
	
	if (empty($_POST['username'])) {
        
        // Create some data that will be the JSON response
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        //die will kill the page and not execute any code below, it will also
        //display the parameter... in this case the JSON data our Android
        //app will parse
        die(json_encode($response));
    }
	
    //gets user's info based off of a username.
    $query = " SELECT * FROM userinfo WHERE username = :username";
    
    $query_params = array(
        ':username' => $_POST['username']
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
    $response["userprofile"]   = array();
    
    foreach ($rows as $row) {
        $usr             = array();
		$usr["user_id"]  = $row["user_id"];
		$usr["username"]  = $row["username"];
        $usr["emailAddress"] = $row["emailAddress"];
		$usr["date"]  = $row["date"];
		$usr["image"] = $row["image"];
		$usr["gender"] = $row["gender"];
		
        //update our repsonse JSON data
        array_push($response["userprofile"], $usr);
    }
	
    $response["success"] = 1;
    
    // echoing JSON response
    echo json_encode($response);
	} 

}else {
?>
	<h1>Get User</h1> 
	<form action="getUser.php" method="post"> 
	    username: <input type="text" name="username" value="" />
	    <br />
	    <input type="submit" value="Submit" /> 
	</form>
	<?php
}

?>
