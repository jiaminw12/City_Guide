<?php

require("config.inc.php");

//if posted data is not empty
if (!empty($_POST)) {
    //If the username or password is empty when the user submits
    //the form, the page will die.
    //Using die isn't a very good practice, you may want to look into
    //displaying an error message within the form instead.  
    //We could also do front-end form validation from within our Android App,
    //but it is good to have a have the back-end code do a double check.
    if (empty($_POST['user_id']) || empty($_POST['username']) || empty($_POST['emailAddress']) || empty($_POST['date'])|| empty($_POST['gender'])) {
        
        // Create some data that will be the JSON response 
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        //die will kill the page and not execute any code below, it will also
        //display the parameter... in this case the JSON data our Android
        //app will parse
        die(json_encode($response));
    }
	
    //If we have made it here without dying, then we are in the clear to 
    //create a new user.  Let's setup our new query to create a user.  
    //Again, to protect against sql injects, user tokens such as :user and :pass
    $query = "UPDATE userinfo SET username = :user, date = :date, image = :image, gender = :gender WHERE emailAddress = :addr AND user_id = :id";
    
    //Again, we need to update our tokens with the actual data:
    $query_params = array(
		':id' => $_POST['user_id'],
        ':user' => $_POST['username'],
        ':addr' => $_POST['emailAddress'],
		':date' => $_POST['date'],
		':image' => $_POST['image'],
		':gender' => $_POST['gender']
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
    $response["message"] = "Details Successfully Updated!";
    echo json_encode($response);
    
    
} else {
?>
	<h1>Update User</h1> 
	<form action="updateUser.php" method="post"> 
    	ID: <input type="text" name="user_id" value="" /> 
	    <br />
	    User: <input type="text" name="username" value="" /> 
	    <br />
	    EmailAddress:
	    <input type="email" name="emailAddress" value="" /> 
        <br />
        Date:
	    <input type="text" name="date" value="" /> 
        <br />
        Image:
	    <input type="text" name="image" value="" /> 
         <br />
        Gender:
	    <input type="text" name="gender" value="" /> 
	    <br />
	    <input type="submit" value="Update New User" /> 
	</form>
	<?php
}

?>
