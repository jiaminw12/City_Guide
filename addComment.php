<?php

require("config.inc.php");

//if posted data is not empty
if (!empty($_POST)) {
	
    if (empty($_POST['attr_id']) || empty($_POST['comment_title']) || empty($_POST['comment_text']) || empty($_POST['rating']) || empty($_POST['username'])) {
         
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        die(json_encode($response));
    }
	
    //GET USERNAME
    $query = " SELECT user_id FROM userinfo WHERE username = :username";
    //now lets update what :user should be
    $query_params = array(
        ':username' => $_POST['username']
    );
    
    //Now let's make run the query:
    try {
        // These two statements run the query against your database table. 
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
		echo $result;
    }
    catch (PDOException $ex) {
        // For testing, you could use a die and message. 
        //die("Failed to run query: " . $ex->getMessage());
        
        //or just use this use this one to product JSON data:
        $response["success"] = 0;
        $response["message"] = "Database Error_username. Please Try Again!";
        die(json_encode($response));
    }
    
    //fetch is an array of returned data.  If any data is returned,
    //we know that the username is already in use, so we murder our
    //page
    $row = $stmt->fetch();
    if ($row) {
        $GLOBALS['userid'] = $row['user_id'];
    }
	
	//INSERT
    $query = "INSERT INTO comment(attr_id, comment_title, comment_text, rating, user_id) VALUES ( :attr, :commentTitle,  :commentText, :rate, :userID)";
    
    //Again, we need to update our tokens with the actual data:
    $query_params = array(
		':attr' => $_POST['attr_id'],
		':commentTitle' => $_POST['comment_title'],
		':commentText' => $_POST['comment_text'],
		':rate' => $_POST['rating'],
        ':userID' => $GLOBALS['userid']
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
    
    $response["success"] = 1;
    $response["message"] = "Comment Successfully Added!";
    echo json_encode($response);
   
} else {
?>
	<h1>Comment</h1> 
	<form action="addComment.php" method="post"> 
	    attr_id <input type="text" name="attr_id" value="" /> 
	    <br />
        comment_title:
	    <input type="text" name="comment_title" value="" /> 
        <br />
	    comment_text:
	    <input type="text" name="comment_text" value="" /> 
        <br />
	    rating:
	    <input type="text" name="rating" value="" /> 
        <br />
        username:
	    <input type="text" name="username" value="" /> 
	    <br />
	    <input type="submit" value="Submit Comment" /> 
	</form>
	<?php
}

?>
