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
	
    $query = "SELECT comment.comment_id, comment.comment_title, comment.comment_text, comment.rating, comment.date_created, comment.attr_id, attraction.attr_title, userinfo.username, userinfo.image FROM comment INNER JOIN userinfo ON comment.user_id = userinfo.user_id INNER JOIN  attraction ON comment.attr_id = attraction.attr_id WHERE username = :username ORDER BY comment.date_created DESC"; 
    
    $query_params = array(
        ':username' => $_POST['username']
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
			$com["comment_id"] = $row["comment_id"];
			$com["comment_title"] = $row["comment_title"];
			$com["comment_text"] = $row["comment_text"];
			$com["rating"] = $row["rating"];
			$com["date_created"] = $row["date_created"];
			$com["image"] = $row["image"];
			$com["username"] = $row["username"];
			$com["attr_title"] = $row["attr_title"];
			$com["attr_id"] = $row["attr_id"];
			
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

<h1>Comment By User</h1>
<form action="getCommentByUser.php" method="post">
  username
  <input type="text" name="username" value="" />
  <br />
  <input type="submit" value="Submit" />
</form>
<?php
}

?>
