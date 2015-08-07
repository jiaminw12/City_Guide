<?php
header('Content-type: text/html; charset=utf-8');
require("config.inc.php");

//if posted data is not empty
if (!empty($_POST)) {
   
    if (empty($_POST['comment_id']) || empty($_POST['attr_id']) || empty($_POST['comment_title']) || empty($_POST['comment_text'])|| empty($_POST['rating']) || empty($_POST['user_id'])) {
        
        // Create some data that will be the JSON response 
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        die(json_encode($response));
    }
	
	$date = date('Y-m-d H:i:s');
	
    $query = "UPDATE comment SET comment_title = :comment_title, comment_text=:comment_text, rating = :rating, date_created=now() WHERE user_id = :user_id AND comment_id = :comment_id AND  attr_id = :attr_id";
    
    //Again, we need to update our tokens with the actual data:
    $query_params = array(
		':comment_id' => $_POST['comment_id'],
		':attr_id' => $_POST['attr_id'],
        ':comment_title' => $_POST['comment_title'],
        ':comment_text' => $_POST['comment_text'],
		':rating' => $_POST['rating'],
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
    
    $response["success"] = 1;
    $response["message"] = "Comment Successfully Updated!";
    echo json_encode($response);
    
    
} else {
?>
	<h1>Update Comment</h1> 
	<form action="updateComment.php" method="post">
    	comment_id <input type="text" name="comment_id" value="" />
	    <br />
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
        user id:
	    <input type="text" name="user_id" value="" /> 
	    <br />
	    <input type="submit" value="Submit Comment" /> 
	</form>
	<?php
}

?>
