<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Doctor - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:600px; margin:30px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
input { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc; }
button { background:#1565c0; color:white; padding:12px; border:none; width:100%; border-radius:5px; font-size:16px; cursor:pointer; }
.success { background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:10px; }
</style>
</head>
<body>
<div class="card">
<h2>👨‍⚕️ Kijani Hospital - Add Doctor</h2>

<?php
if(isset($_POST['save'])){
    $name = $_POST['full_name'];
    $spec = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO doctors (full_name, specialization, phone, email) VALUES ('$name','$spec','$phone','$email')";
    
    if($conn->query($sql)){
        echo "<div class='success'>✅ Doctor $name added!</div>";
    } else {
        echo "<p style='color:red'>Error: " . $conn->error . "</p>";
    }
}
?>

<form method="POST">
Full Name: <input type="text" name="full_name" required placeholder="Dr. Jane Wafula">
Specialization: <input type="text" name="specialization" required placeholder="Dentist, General, Pediatrician">
Phone: <input type="text" name="phone" required>
Email: <input type="email" name="email" required>

<br><br>
<button type="submit" name="save">Save Doctor</button>
</form>

<br>
<a href="view_doctors.php">View All Doctors →</a> |
<a href="add_patient.php">Back to Patients</a>
</div>
</body>
</html>