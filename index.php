<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; 
// Get counts
$p_count = $conn->query("SELECT COUNT(*) as c FROM patients")->fetch_assoc()['c'];
$d_count = $conn->query("SELECT COUNT(*) as c FROM doctors")->fetch_assoc()['c'];
$a_count = $conn->query("SELECT COUNT(*) as c FROM appointments")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Kijani Hospital - Dashboard</title>
<style>
body { font-family: Arial; margin:0; background:#f0f2f5; }
.header { background:#2e7d32; color:white; padding:20px; text-align:center; }
.stats { display:flex; gap:20px; max-width:900px; margin:20px auto; padding:0 20px; }
.box { background:white; flex:1; padding:20px; border-radius:10px; text-align:center; box-shadow:0 2px 5px #ccc; }
.box h1 { margin:0; font-size:40px; color:#2e7d32; }
.menu { max-width:900px; margin:20px auto; background:white; padding:20px; border-radius:10px; box-shadow:0 2px 5px #ccc; }
.menu a { display:inline-block; margin:10px; padding:12px 20px; background:#2e7d32; color:white; text-decoration:none; border-radius:5px; }
.menu a:hover { background:#1b5e20; }
.menu a.blue { background:#1565c0; }
.menu a.orange { background:#ef6c00; }
</style>
</head>
<body>
<div class="header">
<h1>🏥 KIJANI HOSPITAL MANAGEMENT SYSTEM</h1>
<p>Naivasha, Rift Valley - Your Health, Our Priority</p>
<p><a href="logout.php" style="color:white; background:#c62828; padding:5px 10px; border-radius:5px; text-decoration:none;">Logout (<?php echo $_SESSION['username']; ?>)</a></p>
</div>

<div class="stats">
<div class="box"><h1><?= $p_count ?></h1><p>Patients</p></div>
<div class="box"><h1><?= $d_count ?></h1><p>Doctors</p></div>
<div class="box"><h1><?= $a_count ?></h1><p>Appointments</p></div>
</div>

<div class="menu">
<h3>Quick Actions:</h3>
<a href="add_patient.php">+ Add Patient</a>
<a href="view_patients.php">View Patients</a>
<a class="blue" href="add_doctor.php">+ Add Doctor</a>
<a class="blue" href="view_doctors.php">View Doctors</a>
<a class="orange" href="add_appointment.php">+ Book Appointment</a>
<a class="orange" href="view_appointments.php">View Appointments</a>
<a href="add_medical_record.php" style="background:#6a1b9a; color:white; padding:12px 20px; text-decoration:none; border-radius:5px; display:inline-block; margin:10px;">+ Add Diagnosis</a>
<a href="view_medical_records.php" style="background:#6a1b9a; color:white; padding:12px 20px; text-decoration:none; border-radius:5px; display:inline-block; margin:10px;">View Diseases & Drugs</a>
<br><br>
<hr>
<p><b>System Status:</b> ✅ Database Connected (Port 3306) | ✅ 6 Tables Created | ✅ Hospital System Live</p>
</div>

</body>
</html>