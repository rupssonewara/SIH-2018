<?php
require '../include/DB_CONNECT.php';
 
// connecting to db
$db = new DB_CONNECT();
$product = array();


// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

$sql = "SELECT msg_id, Sender,To,Idea_id,Idea.Title,Content,Created_On FROM Message INNER JOIN Idea_On idea.id= Message.Idea_id";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "msg_id: " . $row["msg_id"]. "  Sender: " . $row["Sender"]. "To:" . $row["To"]. "Idea_id:" . $row["Idea_id"]. "Title:". $row["Title"]."Content:" . $row["Content"]. "Created_On: " . $row["Created_On"]. "<br>";
    }
} else {
    echo "0 results";
}
$db->close();
?>