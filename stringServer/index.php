<?php
	$conn = mysqli_connect('localhost', 'root', 'kengo', 'recess')or die ('Unable to connect to database.');
	$query = "SELECT * FROM processed_jobs";
	$info = mysqli_query($conn, $query);

	$jobs = 0;
	$time = 0;
	while($row = mysqli_fetch_array($info)){
		$jobs++;
		$time += $row['processing_duration'];
	}

	$completed = mysqli_num_rows($info);

	$query1 = "SELECT * FROM blacklist";
	$data = mysqli_query($conn, $query1);

	$failed = mysqli_num_rows($data);

	$completion = $completed/($completed + $failed)*100;
	$average = $jobs/$time;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-light navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
    			<a class="nav-link" href="index.php">Home</a>
    		</li>
    		<li class="nav-item dropdown">
    		    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Job ratings
    		    </a>
    		    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    		    	<a class="dropdown-item" href="highest.php">Highest success</a>
    		    	<a class="dropdown-item" href="lowest.php">Lowest success</a>
    		    </div>
    		</li>
    		<li class="nav-item">
    			<a class="nav-link" href="ready.php">Ready Jobs</a>
    		</li>
		</ul>
	</nav>
	<div class="container-fluid">
		<h1 class="kengo">Average tasks per minute:</h1>
		<span class="new">
			<p><strong style="font-size: 850%; color: #a08383;"><?php echo round($average) ?></strong>/min</p>
		</span><br><br>
		<p class="new"><strong style="font-size: 150%; color: #a08383;"><?php echo round($completion) ?>%</strong> Job completion accuracy.</p>
	</div>
</body>
</html>