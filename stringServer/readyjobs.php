<?php
	$conn = mysqli_connect('localhost', 'root', 'kengo', 'recess');

	if(!$conn) {
		die ('Connection failed: ' . mysqli_connect_error());
	}
	echo('Connected sucessfully. </br>');

	$ready = fopen('/var/www/html/stringServer/ready_jobs.txt', 'r+') or die ('Unable to open ready jobs.');
	while(!feof($ready)){
		$info = fgets($ready);
		$info_array = explode(',', $info);

		$sql = "INSERT INTO processed_jobs VALUES(0, $info_array[0], '$info_array[1]', '$info_array[2]', '$info_array[3]')";

		if (mysqli_query($conn, $sql)) {
    		echo "New record created successfully<br/>";
    	} else {
      		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    	}
	}

	ftruncate($ready, 0);
	fclose($ready);

	$black_list = fopen('/var/www/html/stringServer/blacklist.txt', 'r+') or die ('Unable to open blacklist.');
	while (!feof($black_list)){
		$info = fgets($black_list);
		$info_array = explode(',', $info);

		$sql = "INSERT INTO blacklist VALUES (0, $info_array[0], '$info_array[1]')";
	    if (mysqli_query($conn, $sql)) {
    		echo "New record created successfully<br/>";
    	} else {
      		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    	}
	}
	
  mysqli_close($conn);
  ftruncate($black_list,0);
  fclose($black_list);


?>