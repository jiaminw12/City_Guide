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
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['emailAddress']) || empty($_POST['date'])|| empty($_POST['gender'])) {
        
        // Create some data that will be the JSON response 
        $response["success"] = 0;
        $response["message"] = "Please fill in all boxes.";
        
        //die will kill the page and not execute any code below, it will also
        //display the parameter... in this case the JSON data our Android
        //app will parse
        die(json_encode($response));
    }
    
    $query = " SELECT username FROM userinfo WHERE username = :user";
    //now lets update what :user should be
    $query_params = array(
        ':user' => $_POST['username']
    );
    
    //Now let's make run the query:
    try {
        // These two statements run the query against your database table. 
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
    
    //fetch is an array of returned data.  If any data is returned,
    //we know that the username is already in use, so we murder our
    //page
    $row = $stmt->fetch();
    if ($row) {
        // For testing, you could use a die and message. 
        //die("This username is already in use");
        
        //You could comment out the above die and use this one:
        $response["success"] = 0;
        $response["message"] = "I'm sorry, this username is already in use";
        die(json_encode($response));
    }
    
    //If we have made it here without dying, then we are in the clear to 
    //create a new user.  Let's setup our new query to create a user.  
    //Again, to protect against sql injects, user tokens such as :user and :pass
    $query = "INSERT INTO userinfo(username, emailAddress, password, date, image, gender) VALUES ( :user, :addr, :pass, :date, :image, :gender ) ";
    
    //Again, we need to update our tokens with the actual data:
    $query_params = array(
        ':user' => $_POST['username'],
        ':addr' => $_POST['emailAddress'],
		':pass' => $_POST['password'],
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
    $response["message"] = "Username Successfully Added!";
    echo json_encode($response);
    
    
} else {
?>
	<h1>Register</h1> 
	<form action="registration.php" method="post"> 
	    User: <input type="text" name="username" value="" /> 
	    <br />
	    Password:
	    <input type="password" name="password" value="" /> 
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
	    <input type="submit" value="Register New User" /> 
	</form>
	<?php
}

?>
