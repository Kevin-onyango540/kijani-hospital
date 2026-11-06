<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Book Appointment - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:600px; margin:30px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
select, input { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc; }
button { background:#ef6c00; color:white; padding:12px; border:none; width:100%; border-radius:5px; font-size:16px; cursor:pointer; }
.success { background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:10px; }
</style>
</head>
<body>
<div class="card">
<h2>📅 Book Appointment</h2>

<?php
if(isset($_POST['book'])){
    $pid = $_POST['patient_id'];
    $did = $_POST['doctor_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    
    $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time) VALUES ('$pid','$did','$date','$time')";
    
    if($conn->query($sql)){
        echo "<div class='success'>✅ Appointment booked for $date at $time!</div>";
    } else {
        echo "<p style='color:red'>Error: ".$conn->error."</p>";
    }
}
?>

<form method="POST">
Select Patient:
<select name="patient_id" required>
<option value="">--Choose Patient--</option>
<?php
$p = $conn->query("SELECT * FROM patients");
while($r = $p->fetch_assoc()){
    echo "<option value='{$r['patient_id']}'>{$r['full_name']} - {$r['id_number']}</option>";
}
?>
</select>

Select Doctor:
<select name="doctor_id" required>
<option value="">--Choose Doctor--</option>
<?php
$d = $conn->query("SELECT * FROM doctors");
while($r = $d->fetch_assoc()){
    echo "<option value='{$r['doctor_id']}'>{$r['full_name']} - {$r['specialization']}</option>";
}
?>
</select>

Date: <input type="date" name="appointment_date" required>
Time: <input type="time" name="appointment_time" required>

<br><br>
<button type="submit" name="book">Book Appointment</button>
</form>

<br>
<a href="view_appointments.php">View All Appointments →</a>
</div>
</body>
</html>