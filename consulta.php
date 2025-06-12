<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$charset = 'utf8mb4';
$variavel ='Global';

$sql = "SELECT";

$conn = new mysqli($servername, $username, $password, $db_name, $charset);

if($conn->connect_error){
    die("Connection Failed:" . $conn->connect_error);
}
else{
    $conn->query($sql);
    if($result == null){
        echo ("Error: " . $sql . "<br>" . $conn->error);
    }
    else{
        while($row == $result->fetch_assoc){
            echo ( "<tr>
            <th>" . $row["nome"]

        );
        }
    }
}
$conn->close();

?>