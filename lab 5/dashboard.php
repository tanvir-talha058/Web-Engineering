<?php
require_once 'config.php';
requireLogin();

// Get user's biodata records
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM biodata WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Biodata System</title>
    <link rel="stylesheet" href="auth_styles.css">
    <link rel="stylesheet" href="biodata_styles.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <div class="user-info">
                <span>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        
        <div class="dashboard-actions">
            <a href="biodata_form.php" class="btn btn-success">Create New Biodata</a>
            <a href="view_biodata.php" class="btn btn-info">View All Biodata</a>
        </div>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <div class="biodata-list">
            <h2>Your Biodata Records</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <div class="table-container">
                    <table class="biodata-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></td>
                                    <td>
                                        <a href="view_biodata.php?id=<?php echo $row['id']; ?>" class="btn-small btn-info">View</a>
                                        <a href="edit_biodata.php?id=<?php echo $row['id']; ?>" class="btn-small btn-warning">Edit</a>
                                        <a href="delete_biodata.php?id=<?php echo $row['id']; ?>" 
                                           class="btn-small btn-danger" 
                                           onclick="return confirm('Are you sure you want to delete this biodata?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-records">
                    <p>No biodata records found. <a href="biodata_form.php">Create your first biodata</a>.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
