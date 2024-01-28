<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    // Loop through the submitted quantities and update the database
    foreach ($_POST['product_quantity'] as $productId => $newQuantity) {
        // Sanitize input to prevent SQL injection
        $productId = mysqli_real_escape_string($con, $productId);
        $newQuantity = mysqli_real_escape_string($con, $newQuantity);

        // Update the quantity in the database
        $sql = "UPDATE orders SET product_quantity = $newQuantity WHERE id = $productId";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            echo "Error updating item quantity: " . mysqli_error($con);
            exit();
        }
    }

    header("Location: cart.php");
    exit();
} else {
    echo "Invalid request method";
}
?>
