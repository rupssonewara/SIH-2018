<!DOCTYPE html>
<html lang="en">
<head>
  <title>SIH</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="script/script.js"></script>
  
  
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" id="b">
  <div class="container-fluid" >
    
      <a class="navbar-brand" href="#" id="c">CRYSTOPE</a>
   
	 <ul class="nav navbar-nav navbar-right">
      <li ><a href data-toggle="modal" data-target="#login"><span id="c" class="glyphicon glyphicon-user"></span> Login</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search" id="myInput">

        <div class="input-group-btn">
          <button class="btn btn-default" type="button" id="search">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</nav><br><br><br>

 <div class="col-md-3" >
  <div class="sidenav">
  <h3 id="filters">FILTERS</h3>
  <div class="form-group">
      <label for="branch" id="location">Location</label>
      <select class="form-control" id="n" >
        <option>Delhi</option>
        <option>Mumbai</option>
        <option>Raipur</option>
        <option>Bhilai</option>
      </select>
      </div>
	  
	    <div class="form-group">
      <label for="branch" id="location">Implentation Time</label>
      <select class="form-control" id="n" >
        <option>1-2 months</option>
        <option>2-3 months</option>
        <option>3-4 months</option>
        <option>6-12 months</option>
      </select>
      </div>

      <div class="form-group">
      <label for="branch" id="category">Category</label>
      <select class="form-control" id="n" >
      	<option>All</option>
        <option>River</option>
        <option>Agriculture</option>
        <option>Rain Water Harvesting</option>
        <option>Water Recycling</option>
        <option>Ground Water Harvesting</option>
      </select>
      </div>
	  
	  <div class="form-group">
    <label for="gender" id="m">Implentation Cost</label><br>
    <input type="radio" required name="gender" value="male" id="m" > ₹1000-2000<br>
    <input type="radio" required name="gender" value="female" id="m" > ₹2000-5000<br>
    <input type="radio" required name="gender" value="other" id="m"> ₹5000-10000<br> 
	<input type="radio" required name="gender" value="other" id="m"> ₹5000-10000<br> 
    </div>


    		  <button class="btn btn-primary"> APPLY FILTER </button>

    		<div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=False&ui=true&settings=Manual&from=';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script>


  </div>

</div>

 

<div class="col-md-9" >
<?php
         
		  require '../include/DB_CONNECT.php';
		  $db =new DB_CONNECT();
		  $conn = $db->connect();
		  $sql = "SELECT Idea.id,Title,Image_url,Category,Cost,UserTable.Name,Location,Implement_time FROM Idea INNER JOIN UserTable ON UserTable.id=Idea.Submitted_By";
          $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
		$title = array();
		$count = 1;
        while($row = mysqli_fetch_array($result)) { ?>
  <div class="col-md-4" >
	<div class="thumbnail" id="th" >
		<h4 id="title">
		<?php 
		$title[$count] = $row['Title'];
		echo $row['Title'];
		$count = $count+1;
		 ?></h4>
		
        <a href data-toggle="modal"  data-target="#myModal" data-id="<?php echo $row['id']; ?>" style="text-decoration:none">
          <img src="<?php echo $row['Image_url'] ?>" alt="Lights" id="postimg" >
         
		 <div class="caption">
		 
            <div class="col-md-12">
			<span class="glyphicon glyphicon-th-list "></span>
            <li style="display:inline">	<?php echo $row['Category'] ?>	</li><br>			
			</div>
			
		   <div class="col-md-6">
		   <img src="assets/rs1.png" style="width:14%">
           <li style="display:inline">	<?php echo $row['Cost'] ?>	</li><br>
		    <span class="glyphicon glyphicon-user"></span>
           <li style="display:inline">	<?php echo $row['Name'] ?>	</li><br>
		   <span class="glyphicon glyphicon-map-marker"></span>
           <li style="display:inline">	<?php echo $row['Location'] ?>	</li><br>

          </div>
		  <div class="col-md-6">
		   <span class="glyphicon glyphicon-time"></span>
           <li style="display:inline">	<?php echo $row['Implement_time'] ?>	</li><br>
		   <span class="glyphicon glyphicon-calendar"></span>
           <li style="display:inline">	<?php echo $row['On'] ?>	</li>
           <li style="display:inline"> 

           	<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fhosting619.96.lt%2Fsih%2FWeb_Portal%2Ftry_final.php&layout=button_count&size=small&mobile_iframe=true&width=69&height=20&appId" width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>

           </li>
		  
          </div>
		  
        </a>
      </div>
	 
    </div>
</div>
	<?php } }?>


</div >






<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 1300px; height: 500px;">

    <!-- Modal content-->
    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Description</h4> 
	      </div>
    
    <div class="modal-body" style="height: 500px;">
        <div class= "container">

			<div class="col-md-6" id="img">
					
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					  <!-- Indicators -->
					  <ol class="carousel-indicators">
					    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					    <li data-target="#myCarousel" data-slide-to="1"></li>
					    <li data-target="#myCarousel" data-slide-to="2"></li>
					  </ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner">
					    <div class="item active">
					      <img src="http://www.gramvikas.org/gallery/Watershed-Kalahandi.jpg" alt="Watershed">
					    </div>

					    <div class="item">
					      <img src="assets/water2.jpg" alt="Chicago">
					    </div>

					    <div class="item">
					      <img src="assets/water3.jpg" alt="New York">
					    </div>


					  </div>

						  <!-- Left and right controls -->
						  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#myCarousel" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right"></span>
						    <span class="sr-only">Next</span>
						  </a>
					</div>

			</div> 

	<div class="col-md-6" id="desc">

<!-- 		<?php

				
		//   		$db =new DB_CONNECT();
		//   		$conn = $db->connect();

		// 		$select_id = '<div id="myLink"></div>';
		// 		echo gettype($select_id);
				
		// 		$id = $select_id ;
		// 		echo gettype($id);

		//   $sql = "SELECT Idea.id,Title,Image_url,Category,Cost,UserTable.Name,Location,Implement_time FROM Idea INNER JOIN UserTable ON UserTable.id=Idea.Submitted_By WHERE Idea.id LIKE '$id' ";
  //         $result = mysqli_query($conn, $sql);

  //         echo $idNum;

  //   if (mysqli_num_rows($result) > 0) {
  //   // output data of each row
  //   	echo "True";
    
		// while($row = mysqli_fetch_array($result)) {
		// 	echo $row['Title']; 
		//}} ?> -->

		<h3> Mavic Pro </h1>
		<p> by D </p>
		<div class="col-md-6">
			<span class="glyphicon glyphicon-list-alt"></span>
           <li style="display:inline">Category</li><br>
		   <img src="assets/rs2.png" style="width:11%">
           <li style="display:inline">cost</li><br>
		  
          </div>
		  <div class="col-md-6">
			<span class="glyphicon glyphicon-map-marker"></span>
           <li style="display:inline">location</li><br>
		   <span class="glyphicon glyphicon-time"></span>
           <li style="display:inline">imp time</li><br>
		   <span class="glyphicon glyphicon-calendar"></span>
           <li style="display:inline">post time</li>
		   
          </div>
		  <br><br>
		  <button class="btn btn-primary" type="button" id="faq">Ask Questions</button>
		  <button class="btn btn-primary" type="button" id="recom">Recommendations</button>
		  <button class="btn btn-primary" type="button" id="analysis">Analysis</button>
		  
			 
			<hr id="line">
			<p> The DJI Mavic Pro is a small yet powerful drone that turns the sky into your creative canvas easily and without worry, helping you make every moment an aerial moment. Its compact size hides a high degree of complexity that makes it one of DJI’s most sophisticated flying cameras ever. 24 high-performance computing cores, an all-new transmission system with a 4.3mi (7km) range, 5 vision sensors, and a 4K camera stabilized by a 3-axis mechanical gimbal, are at your command with just a push of your thumb or a tap of your finger. 
				<div id="myLink"></div>	</p>
	</div>


</div>

		 <!-- RECOMMENDATIONS -->

		 <!-- ###############################		ITEM1		###################### -->
		<div class="ml_recom"> 
			<div class="col-md-4" >
				<div class="thumbnail" id="th">
					<h4>TITLE</h4>
        			<a href="assets/SIH1.jpg" target="_blank" style="text-decoration:none">
          			<img src="assets/SIH1.jpg" alt="Lights" style="width:100%">
          
		 		<div class="caption">
		 
		        	<div class="col-md-6">
						<span class="glyphicon glyphicon-list-alt"></span>
			        	<li style="display:inline">Category</li><br>
						<img src="assets/rs1.png" style="width:16%">
			        	<li style="display:inline">cost</li><br>
					    <span class="glyphicon glyphicon-user"></span>
			        	<li style="display:inline">User</li>
		  			</div>

					<div class="col-md-6">
						<span class="glyphicon glyphicon-map-marker"></span>
				        <li style="display:inline">location</li><br>
						<span class="glyphicon glyphicon-time"></span>
				        <li style="display:inline">imp time</li><br>
						<span class="glyphicon glyphicon-calendar"></span>
				        <li style="display:inline">post time</li>
		  			</div>
		  
        			</a>
      			</div>
	 
    			</div>
			</div>
		</div>

		 <!-- ###############################		ITEM2		###################### -->
		<div class="ml_recom"> 
			<div class="col-md-4" >
				<div class="thumbnail" id="th">
					<h4>TITLE</h4>
        			<a href="assets/SIH1.jpg" target="_blank" style="text-decoration:none">
          			<img src="assets/SIH1.jpg" alt="Lights" style="width:100%">
          
		 		<div class="caption">
		 
		        	<div class="col-md-6">
						<span class="glyphicon glyphicon-list-alt"></span>
			        	<li style="display:inline">Category</li><br>
						<img src="assets/rs1.png" style="width:16%">
			        	<li style="display:inline">cost</li><br>
					    <span class="glyphicon glyphicon-user"></span>
			        	<li style="display:inline">User</li>
		  			</div>

					<div class="col-md-6">
						<span class="glyphicon glyphicon-map-marker"></span>
				        <li style="display:inline">location</li><br>
						<span class="glyphicon glyphicon-time"></span>
				        <li style="display:inline">imp time</li><br>
						<span class="glyphicon glyphicon-calendar"></span>
				        <li style="display:inline">post time</li>
		  			</div>
		  
        			</a>
      			</div>
	 
    			</div>
			</div>
		</div>

		<!-- ##################  END OF RECOMMENDATIONS ################ -->
		 

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
      

</body>

<!-- Modal login -->
<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 400px; height: 300px;">

    <!-- Modal content-->
    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h3 class="modal-title" ">LOGIN</h3>
	      </div>
    
    <div class="modal-body" >
        
             <div class="log" >
			<label for="Username">Username</label>
            <input class="form-control" name="u" id="user" type="text" required placeholder="Username.."><br>
			<label for="Username">Password</label>
            <input class="form-control" name="u" id="user" type="text" required placeholder="Password.."><br>
			<h6 id="user">New User? <button class="btn btn-primary" type="button" id="registerbtn">Register here</button></h6> 
            </div>
        

		 <!-- REGISTRATION -->

		 <!-- ###############################		ITEM1		###################### -->
		<div class="register" > 
			<label for="Fullname">Username</label>
            <input class="form-control"  type="text" required placeholder="Username.."><br>
			
			<label for="Password">Password</label>
            <input class="form-control"  type="password" required placeholder="Password.."><br>
			<label for="Confirm">Confirm Password</label>
            <input class="form-control"  type="password" required placeholder="Confirm Password.."><br>
			<button type="submit"  class="btn btn-default" onsubmit="showInput();" >Register</button>
			
		</div>
        
    </div>
	<!-- ##################  END OF RECOMMENDATIONS ################ -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</html>