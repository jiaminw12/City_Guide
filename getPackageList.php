<?php
header('Content-type: text/html; charset=utf-8');
require("config.inc.php");

if (!empty($_POST)) {
	
	if (empty($_POST['traveller_id'])) {
        
        // Create some data that will be the JSON response
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing.";
        
        die(json_encode($response));
    }
	
	$value = $_POST['traveller_id'];
	
    $query = "SELECT package.package_title, traveller.traveller_id,  GROUP_CONCAT(DISTINCT attraction.attr_title SEPARATOR ', ' ) attr_title FROM attraction INNER JOIN package ON attraction.package_id = package.package_id INNER JOIN traveller on traveller.traveller_id = package.traveller_iD GROUP BY attraction.package_id ORDER BY traveller.traveller_id ASC"; 
    
    $query_params = array(
        ':traveller_id' => $_POST['traveller_id']
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
		
		$response["packages"]   = array();
    
    	foreach ($rows as $row) {
        	$com             = array();
			if ($row["traveller_id"] == $value){
				
			  $com["package_title"] = $row["package_title"];
			  $com["attr_title"] = $row["attr_title"];
			  array_push($response["packages"], $com);
			}
		}
    } else {
		$response["packages"]   = array();
		$response["success"] = 0;
        $response["message"] = "null";
        die(json_encode($response));
	}
	
	$response["success"] = 1;
    echo json_encode($response);
	
}else {
?>

<h1>Get Package List</h1>
<form action="getPackageList.php" method="post">
  traveller id
  <input type="text" name="traveller_id" value="" />
  <br />
  <input type="submit" value="Submit" />
</form>
<?php
}

?>
