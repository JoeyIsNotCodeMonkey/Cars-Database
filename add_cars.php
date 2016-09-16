<?php
include("db.php");

if(isset($_POST['car_name'])) {
    //echo "data received";
    $car_name = $_POST['car_name'];
    $query = "INSERT INTO cars(title) VALUES('$car_name')";
    $query_car_name = mysqli_query($connection, $query);
}
?>