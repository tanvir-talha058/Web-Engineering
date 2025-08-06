<?php
require_once 'config.php';
requireLogin();

if (isset($_GET['id'])) {
    $biodata_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    // Verify the biodata belongs to the logged-in user
    $query = "SELECT id FROM biodata WHERE id = $biodata_id AND user_id = $user_id";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        header("Location: biodata_form.php?id=$biodata_id");
        exit();
    }
}

header('Location: dashboard.php');
exit();
?>
