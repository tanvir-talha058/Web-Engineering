<?php
require_once 'config.php';
requireLogin();

$biodata = null;
if (isset($_GET['id'])) {
    $biodata_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    $query = "SELECT * FROM biodata WHERE id = $biodata_id AND user_id = $user_id";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        $biodata = $result->fetch_assoc();
    } else {
        header('Location: dashboard.php');
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Biodata - Biodata System</title>
    <link rel="stylesheet" href="biodata_styles.css">
    <link rel="stylesheet" href="auth_styles.css">
    <style>
        .biodata-view {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .biodata-view h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #3498db;
        }
        .biodata-view table {
            width: 100%;
            border-collapse: collapse;
        }
        .biodata-view td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        .biodata-view td:first-child {
            font-weight: bold;
            color: #555;
            width: 30%;
            background-color: #f8f9fa;
        }
        .action-buttons {
            text-align: center;
            margin-top: 30px;
        }
        .action-buttons .btn {
            margin: 0 10px;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Biodata Details</h1>
            <div class="user-info">
                <a href="dashboard.php" class="btn btn-info">Back to Dashboard</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        
        <div class="biodata-view">
            <h2><?php echo htmlspecialchars($biodata['full_name']); ?>'s Biodata</h2>
            
            <table>
                <tr>
                    <td>Full Name:</td>
                    <td><?php echo htmlspecialchars($biodata['full_name']); ?></td>
                </tr>
                <tr>
                    <td>Father's Name:</td>
                    <td><?php echo htmlspecialchars($biodata['father_name']); ?></td>
                </tr>
                <tr>
                    <td>Mother's Name:</td>
                    <td><?php echo htmlspecialchars($biodata['mother_name']); ?></td>
                </tr>
                <tr>
                    <td>Date of Birth:</td>
                    <td><?php echo date('F d, Y', strtotime($biodata['date_of_birth'])); ?></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td><?php echo htmlspecialchars($biodata['gender']); ?></td>
                </tr>
                <tr>
                    <td>Nationality:</td>
                    <td><?php echo htmlspecialchars($biodata['nationality']); ?></td>
                </tr>
                <tr>
                    <td>Religion:</td>
                    <td><?php echo htmlspecialchars($biodata['religion']); ?></td>
                </tr>
                <tr>
                    <td>Marital Status:</td>
                    <td><?php echo htmlspecialchars($biodata['marital_status']); ?></td>
                </tr>
                <tr>
                    <td>Division:</td>
                    <td><?php echo htmlspecialchars($biodata['division']); ?></td>
                </tr>
                <tr>
                    <td>National ID:</td>
                    <td><?php echo htmlspecialchars($biodata['national_id']); ?></td>
                </tr>
                <tr>
                    <td>Blood Group:</td>
                    <td><?php echo htmlspecialchars($biodata['blood_group']); ?></td>
                </tr>
                <tr>
                    <td>Education Level:</td>
                    <td><?php echo htmlspecialchars($biodata['education_level']); ?></td>
                </tr>
                <tr>
                    <td>Institution:</td>
                    <td><?php echo htmlspecialchars($biodata['institution']); ?></td>
                </tr>
                <tr>
                    <td>Occupation:</td>
                    <td><?php echo htmlspecialchars($biodata['occupation']); ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?php echo nl2br(htmlspecialchars($biodata['address'])); ?></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><?php echo htmlspecialchars($biodata['phone']); ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo htmlspecialchars($biodata['email']); ?></td>
                </tr>
                <tr>
                    <td>Education:</td>
                    <td><?php echo htmlspecialchars($biodata['education']); ?></td>
                </tr>
                <tr>
                    <td>Created At:</td>
                    <td><?php echo date('F d, Y H:i', strtotime($biodata['created_at'])); ?></td>
                </tr>
                <tr>
                    <td>Last Updated:</td>
                    <td><?php echo date('F d, Y H:i', strtotime($biodata['updated_at'])); ?></td>
                </tr>
            </table>
            
            <div class="action-buttons">
                <a href="edit_biodata.php?id=<?php echo $biodata['id']; ?>" class="btn btn-warning">Edit Biodata</a>
                <a href="delete_biodata.php?id=<?php echo $biodata['id']; ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Are you sure you want to delete this biodata?')">Delete Biodata</a>
            </div>
        </div>
    </div>
</body>
</html>
