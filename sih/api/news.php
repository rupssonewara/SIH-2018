<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../include/db.php';
$app = new \Slim\App;


//GetSchemes
$app->get('/GetAllIdeas', function (Request $request, Response $response) {

   $sql = "SELECT Idea.id,Title,Image_url,Category,Cost,Status,UserTable.Name,Submitted_By,Location,implement_time,CreatedOn,Description FROM Idea INNER JOIN UserTable ON UserTable.id=Idea.Submitted_By";

    try{
        $db = new db();

       $db= $db->connect();

        $stmt = $db->query($sql);

        $scheme = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo json_encode($scheme);

    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});



//AddScheme
$app->post('/AddIdea', function (Request $request, Response $response) {

    $title = $request->getParam('Title');
    $description = $request->getParam('Description');
    $image_url = $request->getParam('Image_url');
    $Submitted_By = $request->getParam('Submitted_By');
    $Category = $request->getParam('Category');
    $location= $request->getParam('location');
    $implement_time=$request->getParam('implement_time');
    $Cost=$request->getParam('Cost');


    $sql = "INSERT INTO Idea (Title,Description,Image_url,Submitted_By,Category,location,implement_time,Cost) VALUES (:title,:description,:image_url,:Submitted_By,:Category,:location,:implement_time,:Cost)";


    try{
        $db = new db();

        $db= $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam('title',$title);
        $stmt->bindParam('description',$description);
        $stmt->bindParam('image_url',$image_url);
        $stmt->bindParam('Submitted_By',$Submitted_By);
        $stmt->bindParam('Category',$Category);
        $stmt->bindParam('location',$location);
        $stmt->bindParam('implement_time',$implement_time);
        $stmt->bindParam('Cost',$Cost);


        $stmt->execute();



         $db2 = new db();

        $db2= $db2->connect();

        
        $stmt = $db2->query("SELECT FCM_Token FROM UserTable");

        # code...
     
    
      while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {

       
    # code...


       $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . "AIzaSyAEkS80MITBi57pN7EvTM5r2y3vl7izY9A");
            $data = array(
                'data' => array('data'=>"new_way"),
                'to' =>  $res["FCM_Token"] );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            error_log(json_encode($data));
            $response = curl_exec($ch);


}

  
          echo '{"error": false}';



    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});


//AddMsg
$app->post('/AddMsg', function (Request $request, Response $response) {

    $Sender = $request->getParam('Sender');
    $Recipient = $request->getParam('Recipient');
    $Idea_id = $request->getParam('Idea_id');
    $Content = $request->getParam('Content');
    $Status= $request->getParam('Status');
   

    $sql = "INSERT INTO Message (Sender,Recipient,Idea_id,Content,Status) VALUES (:Sender,:Recipient,:Idea_id,:Content,:Status)";


    try{
        $db = new db();

        $db= $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam('Sender',$Sender);
        $stmt->bindParam('Recipient',$Recipient);
        $stmt->bindParam('Idea_id',$Idea_id);
        $stmt->bindParam('Content',$Content);
        $stmt->bindParam('Status',$Status);


        $stmt->execute();

  
          echo '{"error": false}';



    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});


//UserLogin
$app->post('/UserLogin', function (Request $request, Response $response) {

    $Name = $request->getParam('Name');
    $Password = $request->getParam('Password');
    $FCM_Token = $request->getParam('FCM_Token');


    $sql = "INSERT IGNORE INTO UserTable (Name,Password,FCM_Token) VALUES (:Name,:Password,:FCM_Token) ";


    try{
        $db = new db();

        $db= $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam('Name',$Name);
        $stmt->bindParam('Password',$Password);
        $stmt->bindParam('FCM_Token',$FCM_Token);

      $product = array();



        if($stmt->execute()){

   
        $sql1 = "UPDATE UserTable SET FCM_Token='$FCM_Token',Password='$Password' WHERE Name='$Name'";

            $db = new db();

        $db= $db->connect();

        $stmt = $db->query($sql1);



        $sql2 = "SELECT * FROM UserTable WHERE Name Like '$Name'";

        $db2 = new db();

        $db2= $db2->connect();

        $stmt2= $db2->query($sql2);

        $product = $stmt2->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($product);

    }else{

         $product['error']=true;

        echo json_encode($product);

    }   



     }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});



//SendFaq
$app->post('/SendFaq', function (Request $request, Response $response) {

    $Sender = $request->getParam('Sender');
    $Content = $request->getParam('Content');
    $Idea_id=$request->getParam('Idea_id');
 
   

    $sql = "INSERT INTO Discussion (Sender,Content,Idea_id) VALUES (:Sender,:Content,:Idea_id)";


    try{
        $db = new db();

        $db= $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam('Sender',$Sender);
        $stmt->bindParam('Content',$Content);
        $stmt->bindParam('Idea_id',$Idea_id);


        $stmt->execute();

  
          echo '{"error": false}';



    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});





//GetFaqbyId
$app->get('/GetFaq', function (Request $request, Response $response) {

       $id = $_GET['id'];


   $sql = "SELECT Discussion.Sender,UserTable.Name,Discussion.Content,Discussion.Time FROM Discussion INNER JOIN UserTable ON UserTable.id=Discussion.Sender WHERE Discussion.Idea_id='$id'
   ORDER BY Discussion.id DESC";

    try{
        $db = new db();

       $db= $db->connect();

        $stmt = $db->query($sql);

        $scheme = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo json_encode($scheme);

    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});


//GetAllStates

$app->get('/GetAllStates', function (Request $request, Response $response) {

   $sql = "SELECT * FROM States";

    try{
        $db = new db();

       $db= $db->connect();

        $stmt = $db->query($sql);

        $states = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo json_encode($states);

    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});

//GetComplain
$app->get('/GetComplain', function (Request $request, Response $response) {

   $sql = "SELECT * FROM COMPLAIN WHERE STATUS = 1";

    try{
        $db = new db();

       $db= $db->connect();

        $stmt = $db->query($sql);

        $complain = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo json_encode($complain);

    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});



$app->post('/AddUser', function (Request $request, Response $response) {

    $user = $request->getParam('User');
    $token = $request->getParam('token');
    $eligible = $request->getParam('eligible');


   


   $product= array();

    $sql = "INSERT IGNORE INTO UserTable (Account_ID,FCM_Token,Eligibility) VALUES (:user,:token,:eligible)";


    try{
        $db = new db();

        $db= $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam('user',$user);
        $stmt->bindParam('token',$token);
        $stmt->bindParam('eligible',$eligible);




       
        if($stmt->execute()){

   
        $sql1 = "UPDATE UserTable SET FCM_Token='$token',Eligibility='$eligible' where Account_ID='$user'";

            $db = new db();

        $db= $db->connect();

        $stmt = $db->query($sql1);
      
         $product['error']=false;

        echo json_encode($product);

    }else{

         $product['error']=true;

        echo json_encode($product);

    }

    }catch (PDOException $exception){

        echo '{"error": '.$exception->getMessage().'}';
    }
});


$app->run();
