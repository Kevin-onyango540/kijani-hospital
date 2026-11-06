<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Patient - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:600px; margin:30px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
input, select { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc; }
button { background:#2e7d32; color:white; padding:12px; border:none; width:100%; border-radius:5px; font-size:16px; cursor:pointer; }
button:hover { background:#1b5e20; }
.success { background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:10px; }
</style>
</head>
<body>

<div class="card">
<h2>🏥 Kijani Hospital - Register Patient</h2>

<?php
if(isset($_POST['save'])){
    $name = $_POST['full_name'];
    $idno = $_POST['id_number'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO patients (full_name, id_number, phone, gender) VALUES ('$name','$idno','$phone','$gender')";
    
    if($conn->query($sql)){
        echo "<div class='success'>✅ Patient $name saved successfully!</div>";
    } else {
        echo "<p style='color:red'>Error: " . $conn->error . "</p>";
    }
}
?>

<form method="POST">
Full Name:
<input type="text" name="full_name" required placeholder="John Doe">

ID Number:
<input type="text" name="id_number" required placeholder="12345678">

Phone:
<input type="text" name="phone" required placeholder="0712345678">

Gender:
<select name="gender" required>
<option value="">--Select Gender--</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>

<br><br>
<button type="submit" name="save">Save Patient</button>
</form>

<br>
<a href="view_patients.php">View All Patients →</a> |
<a href="test.php">Check Connection</a>
</div>

</body>
</html>