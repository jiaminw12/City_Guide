<?php

require("config.inc.php");

//if posted data is not empty
if (!empty($_POST)) {
    
    if (empty($_POST['attr_id']) || empty($_POST['tag_id']) || empty($_POST['created_date']) || empty($_POST['username'])) {
        
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        die(json_encode($response));
    }
	
	$select_query = mysql_query("SELECT * FROM planner WHERE username = '$username'") or die (mysql_error());
	
$result = mysql_num_rows($select_query);

if(!$result){
    $query = mysql_query("INSERT INTO planner (attr_id, tag_id, created_date, username) VALUES ('$attr_id', '$tag_id', '$created_date', '$username')");
        if($query){
            $response["success"] = 1;
        	$response["message"] = "Success!";
        }
        else
        {
            die(json_encode($response));
        }
} else{
    $query2 = mysql_query("UPDATE planner SET tag_id='$tag_id' WHERE attr_id = '$attr_id' AND username='$username'");
	if($query2){
            $response["success"] = 1;
        	$response["message"] = "Success!";
        }
        else
        {
           die(json_encode($response));
        }
	}
	
    
} else {
?>
	<h1>Update User</h1> 
	<form action="updatePlannerList.php" method="post"> 
	    attr_id: <input type="text" name="attr_id" value="" /> 
	    <br />
	    tag_id:
	    <input type="text" name="tag_id" value="" /> 
        <br />
        created_date:
	    <input type="text" name="created_date" value="" /> 
        <br />
        username:
	    <input type="text" name="username" value="" /> 
        <br />
	    <input type="submit" value="Update Planner List" /> 
	</form>
	<?php
}

?>
