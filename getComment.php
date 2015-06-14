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
	
    $query = " SELECT comment.comment_title, comment.comment_text, comment.rating, comment.date_created, userinfo.username, userinfo.image FROM comment INNER JOIN userinfo ON comment.user_id = userinfo.user_id WHERE attr_id = :attr_id"; 
    
    $query_params = array(
        ':attr_id' => $_POST['attr_id']
    );
    
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        $response["success"] = 0;
        $response["message"] = "Database Error. Please Try Again!";
        die(json_encode($response));
        
    }
    
	$rows = $stmt->fetchAll();

	if ($rows) {
		
		$response["comments"]   = array();
    
    	foreach ($rows as $row) {
        	$com             = array();
			$com["comment_title"] = $row["comment_title"];
			$com["comment_text"] = $row["comment_text"];
			$com["rating"] = $row["rating"];
			$com["date_created"] = $row["date_created"];
			$com["image"] = $row["image"];
			$com["username"] = $row["username"];
			
        	array_push($response["comments"], $com);
			}
    } else {
		$response["comments"]   = array();
		$response["success"] = 0;
        $response["message"] = "null";
        die(json_encode($response));
	}
	
	$response["success"] = 1;
    echo json_encode($response);
	
}else {
?>

<h1>Comment</h1>
<form action="getComment.php" method="post">
  attr_id
  <input type="text" name="attr_id" value="" />
  <br />
  <input type="submit" value="Submit Comment" />
</form>
<?php
}

?>
