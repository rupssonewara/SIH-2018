<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response

 session_start();

$response = array();

// include db connect class

require '../include/DB_CONNECT.php';

// connecting to db
$db = new DB_CONNECT();
$conn = $db->connect();

// check for post data
if (isset($_POST["User"],$_POST["Password"])) {
    $user = $_POST['User'];
    $pass= $_POST['Password'];
	$product = array();


    // get a product from products table
    $result = mysqli_query($conn,"INSERT INTO User (Name,Password) VALUES ('$user','$pass')";


    if (!empty($result)) {
        // check for empty result

               $product["error"] = "false";

               $_SESSION['user'] = $user;
               header("Location:http://hosting619.96.lt/SIH-2018/Web_Portal/loggedin.php");
               
        } else {

                 echo '<script type="text/javascript">';
                 echo 'alert("Password do not match.\\nTry again.");';
                 echo 'window.location.href = "../SIH-2018/Web_Portal/index.php";';
                 echo '</script>';

        }
    } else {
         $product["error"] = "result empty";

            echo json_encode($product);
    }
}
 else {
    // required field is missing
    $response["error"] = "true";
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
