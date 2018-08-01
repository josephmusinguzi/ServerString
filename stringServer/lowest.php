<?php
 $con = mysqli_connect("localhost","root","kengo","recess");
 $query = "SELECT * FROM blacklist";
 $data = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($data)){
   $arr[] = $row['user_id'];
 }
 $values = array_count_values($arr);
 arsort($values);
 $popular_with_count = array_slice($values,0,10,true);
 $popular = array_keys($popular_with_count);
 $popular_count = array_values($popular_with_count);
 foreach($popular as $i) {
   $query1 = "SELECT * FROM processed_jobs WHERE user_id = $i";
   $data1 = mysqli_query($con,$query1);
   $success_count[] = mysqli_num_rows($data1); 
 }
//  foreach($failedcount as $i)
//  {
//    echo $i." ";
//  }
 for($i=0;$i<10;$i++)
 {
   $average[] = $popular_count[$i]/($success_count[$i]+$popular_count[$i])*100;
 }  
 
?>
<!DOCTYPE html>

<!DOCTYPE html>
<html>
<head>
	<title>Least success</title>
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
		<h1 class="kengo">Least successful jobs.</h1>
	</div>
	<div class="text-center">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Student ID</th>
					<th scope="col">Failures</th>
					<th scope="col">Successes</th>
					<th scope="col">Percentage</th>
				</tr>
			</thead>
			<tbody>
                <?php
                    echo '
                    <tr>
                      <th scope="row">1</th>
                      <td>'.$popular[0].'</td>
                      <td>'.$popular_count[0].'</td>
                      <td>'.$success_count[0].'</td>
                      <td>'.round($average[0]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>'.$popular[1].'</td>
                      <td>'.$popular_count[1].'</td>
                      <td>'.$success_count[1].'</td>
                      <td>'.round($average[1]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>'.$arr[2].'</td>
                      <td>'.$popular_count[2].'</td>
                      <td>'.$success_count[2].'</td>
                      <td>'.round($average[2]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>'.$popular[3].'</td>
                      <td>'.$popular_count[3].'</td>
                      <td>'.$success_count[3].'</td>
                      <td>'.round($average[3]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>'.$popular[4].'</td>
                      <td>'.$popular_count[4].'</td>
                      <td>'.$success_count[4].'</td>
                      <td>'.round($average[4]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td>'.$popular[5].'</td>
                      <td>'.$popular_count[5].'</td>
                      <td>'.$success_count[5].'</td>
                      <td>'.round($average[5]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td>'.$popular[6].'</td>
                      <td>'.$popular_count[6].'</td>
                      <td>'.$success_count[6].'</td>
                      <td>'.round($average[6]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td>'.$popular[7].'</td>
                      <td>'.$popular_count[7].'</td>
                      <td>'.$success_count[7].'</td>
                      <td>'.round($average[7]).'%</td>
                    </tr>
                    <tr>
                      <th scope="row">9</th>
                      <td>'.$popular[9].'</td>
                      <td>'.$popular_count[9].'</td>
                      <td>'.$success_count[9].'</td>
                      <td>'.round($average[9]).'%</td>
                    </tr>';
                ?>
			</tbody>
		</table>
	</div>
</body>
</html>