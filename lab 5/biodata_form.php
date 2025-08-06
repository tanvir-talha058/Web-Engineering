<?php
require_once 'config.php';
requireLogin();

$message = '';
$error = '';
$edit_mode = false;
$biodata = null;

// Check if we're editing an existing biodata
if (isset($_GET['id'])) {
    $biodata_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    $query = "SELECT * FROM biodata WHERE id = $biodata_id AND user_id = $user_id";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        $biodata = $result->fetch_assoc();
        $edit_mode = true;
    } else {
        header('Location: dashboard.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $full_name = sanitizeInput($_POST['fullname']);
    $father_name = sanitizeInput($_POST['fathername']);
    $mother_name = sanitizeInput($_POST['mothername']);
    $dob = sanitizeInput($_POST['dob']);
    $gender = sanitizeInput($_POST['gender']);
    $nationality = sanitizeInput($_POST['nationality']);
    $religion = sanitizeInput($_POST['religion']);
    $marital_status = sanitizeInput($_POST['marital_status']);
    $division = sanitizeInput($_POST['division']);
    $nid = sanitizeInput($_POST['nid']);
    $blood_group = sanitizeInput($_POST['blood_group']);
    $education_level = sanitizeInput($_POST['education_level']);
    $institution = sanitizeInput($_POST['institution']);
    $occupation = sanitizeInput($_POST['occupation']);
    $address = sanitizeInput($_POST['address']);
    $phone = sanitizeInput($_POST['phone']);
    $email = sanitizeInput($_POST['email']);
    $education = sanitizeInput($_POST['education']);
    
    if ($edit_mode && isset($_POST['biodata_id'])) {
        // Update existing biodata
        $biodata_id = intval($_POST['biodata_id']);
        $update_query = "UPDATE biodata SET 
            full_name = '$full_name',
            father_name = '$father_name',
            mother_name = '$mother_name',
            date_of_birth = '$dob',
            gender = '$gender',
            nationality = '$nationality',
            religion = '$religion',
            marital_status = '$marital_status',
            division = '$division',
            national_id = '$nid',
            blood_group = '$blood_group',
            education_level = '$education_level',
            institution = '$institution',
            occupation = '$occupation',
            address = '$address',
            phone = '$phone',
            email = '$email',
            education = '$education'
            WHERE id = $biodata_id AND user_id = $user_id";
        
        if ($conn->query($update_query) === TRUE) {
            $message = "Biodata updated successfully!";
        } else {
            $error = "Error updating biodata: " . $conn->error;
        }
    } else {
        // Insert new biodata
        $insert_query = "INSERT INTO biodata (
            user_id, full_name, father_name, mother_name, date_of_birth, gender,
            nationality, religion, marital_status, division, national_id,
            blood_group, education_level, institution, occupation, address,
            phone, email, education
        ) VALUES (
            $user_id, '$full_name', '$father_name', '$mother_name', '$dob', '$gender',
            '$nationality', '$religion', '$marital_status', '$division', '$nid',
            '$blood_group', '$education_level', '$institution', '$occupation', '$address',
            '$phone', '$email', '$education'
        )";
        
        if ($conn->query($insert_query) === TRUE) {
            $message = "Biodata created successfully!";
        } else {
            $error = "Error creating biodata: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $edit_mode ? 'Edit' : 'Create'; ?> Biodata - Biodata System</title>
    <link rel="stylesheet" href="biodata_styles.css">
    <link rel="stylesheet" href="auth_styles.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><?php echo $edit_mode ? 'Edit' : 'Create'; ?> Biodata</h1>
            <div class="user-info">
                <a href="dashboard.php" class="btn btn-info">Back to Dashboard</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        
        <?php if ($message): ?>
            <div class="message success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="" method="post">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="biodata_id" value="<?php echo $biodata['id']; ?>">
            <?php endif; ?>
            
            <table cellpadding="10">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="fullname" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['full_name']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Father's Name:</td>
                    <td><input type="text" name="fathername" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['father_name']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Mother's Name:</td>
                    <td><input type="text" name="mothername" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['mother_name']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Date of Birth:</td>
                    <td><input type="date" name="dob" required 
                               value="<?php echo $edit_mode ? $biodata['date_of_birth'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <input type="radio" name="gender" value="Male" required 
                               <?php echo ($edit_mode && $biodata['gender'] == 'Male') ? 'checked' : ''; ?>> Male
                        <input type="radio" name="gender" value="Female" 
                               <?php echo ($edit_mode && $biodata['gender'] == 'Female') ? 'checked' : ''; ?>> Female
                        <input type="radio" name="gender" value="Other" 
                               <?php echo ($edit_mode && $biodata['gender'] == 'Other') ? 'checked' : ''; ?>> Other
                    </td>
                </tr>
                <tr>
                    <td>Nationality:</td>
                    <td><input type="text" name="nationality" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['nationality']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Religion:</td>
                    <td><input type="text" name="religion" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['religion']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Marital Status:</td>
                    <td>
                        <select name="marital_status" required>
                            <option value="">--Select--</option>
                            <option value="Single" <?php echo ($edit_mode && $biodata['marital_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option value="Married" <?php echo ($edit_mode && $biodata['marital_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Division:</td>
                    <td>
                        <select name="division" required>
                            <option value="">--Select--</option>
                            <option value="Dhaka" <?php echo ($edit_mode && $biodata['division'] == 'Dhaka') ? 'selected' : ''; ?>>Dhaka</option>
                            <option value="Chittagong" <?php echo ($edit_mode && $biodata['division'] == 'Chittagong') ? 'selected' : ''; ?>>Chittagong</option>
                            <option value="Rajshahi" <?php echo ($edit_mode && $biodata['division'] == 'Rajshahi') ? 'selected' : ''; ?>>Rajshahi</option>
                            <option value="Khulna" <?php echo ($edit_mode && $biodata['division'] == 'Khulna') ? 'selected' : ''; ?>>Khulna</option>
                            <option value="Barisal" <?php echo ($edit_mode && $biodata['division'] == 'Barisal') ? 'selected' : ''; ?>>Barisal</option>
                            <option value="Sylhet" <?php echo ($edit_mode && $biodata['division'] == 'Sylhet') ? 'selected' : ''; ?>>Sylhet</option>
                            <option value="Rangpur" <?php echo ($edit_mode && $biodata['division'] == 'Rangpur') ? 'selected' : ''; ?>>Rangpur</option>
                            <option value="Mymensingh" <?php echo ($edit_mode && $biodata['division'] == 'Mymensingh') ? 'selected' : ''; ?>>Mymensingh</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>National ID:</td>
                    <td><input type="text" name="nid" pattern="[0-9]{10,17}" title="Please enter valid NID number" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['national_id']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Blood Group:</td>
                    <td>
                        <select name="blood_group" required>
                            <option value="">--Select--</option>
                            <option value="A+" <?php echo ($edit_mode && $biodata['blood_group'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                            <option value="A-" <?php echo ($edit_mode && $biodata['blood_group'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                            <option value="B+" <?php echo ($edit_mode && $biodata['blood_group'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                            <option value="B-" <?php echo ($edit_mode && $biodata['blood_group'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                            <option value="O+" <?php echo ($edit_mode && $biodata['blood_group'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                            <option value="O-" <?php echo ($edit_mode && $biodata['blood_group'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                            <option value="AB+" <?php echo ($edit_mode && $biodata['blood_group'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                            <option value="AB-" <?php echo ($edit_mode && $biodata['blood_group'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Education Level:</td>
                    <td>
                        <select name="education_level" required>
                            <option value="">--Select--</option>
                            <option value="SSC" <?php echo ($edit_mode && $biodata['education_level'] == 'SSC') ? 'selected' : ''; ?>>SSC</option>
                            <option value="HSC" <?php echo ($edit_mode && $biodata['education_level'] == 'HSC') ? 'selected' : ''; ?>>HSC</option>
                            <option value="Diploma" <?php echo ($edit_mode && $biodata['education_level'] == 'Diploma') ? 'selected' : ''; ?>>Diploma</option>
                            <option value="Bachelor" <?php echo ($edit_mode && $biodata['education_level'] == 'Bachelor') ? 'selected' : ''; ?>>Bachelor's Degree</option>
                            <option value="Masters" <?php echo ($edit_mode && $biodata['education_level'] == 'Masters') ? 'selected' : ''; ?>>Master's Degree</option>
                            <option value="PhD" <?php echo ($edit_mode && $biodata['education_level'] == 'PhD') ? 'selected' : ''; ?>>PhD</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Institution:</td>
                    <td><input type="text" name="institution" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['institution']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Occupation:</td>
                    <td><input type="text" name="occupation" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['occupation']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><textarea name="address" rows="3" cols="30" required><?php echo $edit_mode ? htmlspecialchars($biodata['address']) : ''; ?></textarea></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="tel" name="phone" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['phone']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['email']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Education:</td>
                    <td><input type="text" name="education" required 
                               value="<?php echo $edit_mode ? htmlspecialchars($biodata['education']) : ''; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="<?php echo $edit_mode ? 'Update' : 'Submit'; ?>">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
