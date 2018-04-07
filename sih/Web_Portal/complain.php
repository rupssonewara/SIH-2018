<link href="css/complain_style.css" rel="stylesheet">

<!-- <?php
  //  session_start();

  // if(!isset($_SESSION['user']))
  // {

  //      echo '<script type="text/javascript">';
  //      echo 'alert("Access Denied. Login to view this Page.");';
  //      echo 'window.location.href = "../web pages/login.php";';
  //      echo '</script>';
  //    }

?> -->

	<meta charset="utf-8" />
	<title>Ideas</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	        <style type="text/css">
	            tr.header
	            {
	                font-weight:bold;
	            }
	            tr.alt
	            {
	                background-color: #777777;
	            }
	        </style>
	        <script type="text/javascript">
	            $(document).ready(function(){
	               $('.striped tr:even').addClass('alt');
	            });
	        </script>


<?php

// Check connection
require '../include/DB_CONNECT.php';

$db= new DB_CONNECT();

$con=$db->connect();



$query = mysqli_query($con,"SELECT * FROM Idea WHERE Status = 0");
        ?>

<div class="table-title">
	<h3>Verification</h3>
</div>
<span class="btn btn-primary"><a href="location_wise_graph.html">View GRAPH</a></span>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">S.No.</th>
<th class="text-left">Idea Title</th>
<th class="text-left">Location</th>
<th class="text-left">Action</th>
</tr>
</thead>

<tbody class="table-hover">
	<?php
	  $count=1;
							while ($row = mysqli_fetch_array($query)) {
									echo "<tr>";
									echo "<td>".$count."</td>";
									echo "<td>".$row[Title]."</td>";
									echo "<td>".$row[Location]."</td>";
									$count++;
									$id = $row[id];
									?>
							<td>
								<form action='http://hosting619.96.lt/sih/api/Verify_Idea.php' method='POST' > <input type = 'image' src="assets/accept.png" alt="submit">
									<input type="hidden" value="<?php echo $id; ?>" name="id">
									<input type="hidden" value="1" name="decision">
								</form>


								<form action='http://hosting619.96.lt/sih/api/Verify_Idea.php' method='POST'> <input type='image' src="assets/decline.png" alt="submit">
									<input type="hidden" value="<?php echo $id; ?>" name="id">
									<input type="hidden" value="2" name="decision">

								</form> </td>
									</tr>
								<?php
																		}

					 ?>

</tbody>
</table>
