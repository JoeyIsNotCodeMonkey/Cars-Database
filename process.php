<?php
include("db.php");


/* display data */
if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $query = "SELECT * FROM cars WHERE id = {$id}";
    $query_car_info = mysqli_query($connection, $query);

    if(!query_car_info) {
        die("Query Failed" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($query_car_info)) {

        echo "<p id='feedback' class='bg-success'></p>";
        echo "<input rel='". $row['id']."' type='text' class='form-control title-input' value='".$row['title']."'>";
        echo "<input type='button' class='btn btn-success update' value='Update'>";
        echo "<input type='button' class='btn btn-danger delete' value='Delete'>";
        echo "<input type='button' class='btn btn-close' value='Close'>";

    }
}
/* display data ended */

/* Update */
if(isset($_POST['updatethis'])) {
    
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    
    $query = "UPDATE cars SET title = '$title' WHERE id = $id";
    
    $result_set = mysqli_query($connection, $query);
    
    if(!$result_set) {
        die("Query Fail" . mysqli_error($connectoin));
    }
}

/* Update ends */

/* Delete */
if(isset($_POST['deletethis'])) {
    
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    
    $id = $_POST['id'];
    
    $query = "DELETE FROM cars WHERE id = $id";
    
    $result_set = mysqli_query($connection, $query);
    
    if(!$result_set) {
        die("Query Fail" . mysqli_error($connectoin));
    }
}

/* Delete ends */
?>



<script>
    $(document).ready(function(){
        var id;
        var title;
        var updatethis = "update";
        var deletethis = "delete";
        
        /* Extract id and title */
        $(".title-input").on('input', function() {
            id = $(this).attr('rel');
            title = $(this).val();
            
        });
        
        /* Update button func */
        $(".update").on('click', function() {
            $.post("process.php", {id: id, title: title, updatethis: updatethis}, function(data) {
                //alert("Updated Successfully");
                $("#feedback").html("Updated Succesfully");
            });
        });
        
        /* Delete button func */
        $(".delete").on('click', function() {
            if(confirm('Are you sure that you want to delete this car?')) {
                id = $(".title-input").attr('rel');
                $.post("process.php", {id: id, deletethis: deletethis}, function(data) {
                    alert("Deleted Successfully");
                    //$("#feedback").html("Updated Succesfully");
                    $("#action-container").hide();
                });
            }
        });
        
        /* Close button func */
        $(".btn-close").on('click', function() {
            $("#action-container").hide();          
        });
    });
</script>