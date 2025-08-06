<?php
require_once 'config.php';
requireLogin();

if (isset($_GET['id'])) {
    $biodata_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    $delete_query = "DELETE FROM biodata WHERE id = $biodata_id AND user_id = $user_id";
    
    if ($conn->query($delete_query) === TRUE) {
        if ($conn->affected_rows > 0) {
            $_SESSION['message'] = "Biodata deleted successfully!";
        } else {
            $_SESSION['error'] = "Biodata not found or you don't have permission to delete it.";
        }
    } else {
        $_SESSION['error'] = "Error deleting biodata: " . $conn->error;
    }
}

header('Location: dashboard.php');
exit();
?>
