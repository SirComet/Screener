<?php
	//This code does not work yet!
	error_reporting(E_ALL); 
	ini_set('display_errors',1);

//working with sessions
//session_start();
//if ($_SESSION['auth'] == true) {
    // Connect to the database
    require("DBConnect.php");
	//session_start();	
	//$userId=$_SESSION['id'];
	$userId=$_GET["userId"];
	$return_arr = array();

	if ($result = $conn->query("
		SELECT Class.ClassName, Video.Title, Video.URL FROM User
		INNER JOIN EnrolledIn ON
		User.Id = EnrolledIn.UserId
		INNER JOIN ClassVideo ON
		EnrolledIn.ClassId = ClassVideo.ClassId
		INNER JOIN Video ON
		ClassVideo.VideoId = Video.Id
		INNER JOIN Class ON
		EnrolledIn.ClassId = Class.Id
		WHERE User.Id = '$userId'
		ORDER BY Class.ClassName;
		")) 
	{
		$last_class="null";
		$class_count=0;
		while ($row = mysqli_fetch_assoc($result)) {
			/*
			$className=$row['ClassName'];
			//If the class is new, increment the slot for classes
			if ($className != $last_class){
				$class_count=$class_count+1;
				$last_class=$className;
				$row_data['name']=$className;
			}
			//Otherwise, continue previous class
			else
			
			$row_data[$class_count]['Title'] = $row['Title'];
			$row_data[$class_count]['URL'] = $row['URL'];

			array_push($return_arr, $row_data);
			*/
			$return_arr[] = $row;
		}
	
		/* free result set */
		$result->close();
	}

	mysqli_close($conn);
	echo json_encode($return_arr);
//}
?>
