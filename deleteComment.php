<?php

require("config.inc.php");

//if posted data is not empty
if (!empty($_POST)) {
   
   if (empty($_POST['comment_id']) || empty($_POST['attr_id']) || empty($_POST['user_id']) || empty($_POST['comment_title'])) {
        
        // Create some data that will be the JSON response 
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        die(json_encode($response));
    }
	
    $query = "DELETE FROM comment WHERE comment_title = :comment_title AND user_id = :user_id AND attr_id = :attr_id AND comment_id = :comment_id";
    
    //Again, we need to update our tokens with the actual data:
    $query_params = array(
        ':comment_title' => $_POST['comment_title'],
		':comment_id' => $_POST['comment_id'],
		':attr_id' => $_POST['attr_id'],
		':user_id' => $_POST['user_id']
    );
    
    //time to run our query, and create the user
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        // For testing, you could use a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one:
        $response["success"] = 0;
        $response["message"] = "Database Error. Please Try Again!";
        die(json_encode($response));
    }
    
    //If we have made it this far without dying, we have successfully added
    //a new user to our database.  We could do a few things here, such as 
    //redirect to the login page.  Instead we are going to echo out some
    //json data that will be read by the Android application, which will login
    //the user (or redirect to a different activity, I'm not sure yet..)
    $response["success"] = 1;
    $response["message"] = "Details Successfully Deleted!";
    echo json_encode($response);
    
    
} else {
?>
	<h1>Delete Comment</h1> 
	<form action="deleteComment.php" method="post">
    	comment_title <input type="text" name="comment_title" value="" />
	    <br /> 
    	comment_id <input type="text" name="comment_id" value="" />
	    <br /> 
	    attr_id <input type="text" name="attr_id" value="" />
	    <br />
        user id:
	    <input type="text" name="user_id" value="" /> 
	    <br />
	    <input type="submit" value="Submit Comment" /> 
	</form>
	<?php
}

?>
