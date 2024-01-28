<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the item ID from the URL
    $id = $_GET['id'];

    // Delete the item from the database
    $sql = "DELETE FROM orders WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error deleting item: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method";
}
?>
