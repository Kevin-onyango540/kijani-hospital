<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Appointments - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:1000px; margin:30px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th, td { border:1px solid #ddd; padding:10px; text-align:left; }
th { background:#ef6c00; color:white; }
a.btn { background:#ef6c00; color:white; padding:8px 15px; text-decoration:none; border-radius:5px; }
.search-box { display:flex; gap:10px; margin:15px 0; }
.search-box input { flex:1; padding:10px; border:1px solid #ccc; border-radius:5px; }
.search-box button { padding:10px 20px; background:#ef6c00; color:white; border:none; border-radius:5px; }
</style>
</head>
<body>
<div class="card">
<h2>📅 All Appointments</h2>
<a class="btn" href="add_appointment.php">+ Book New</a>
<a class="btn" href="index.php" style="background:#666;">Dashboard</a>

<form method="GET" class="search-box">
<input type="text" name="search" placeholder="Search by Patient or Doctor name..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
<button type="submit">🔍 Search</button>
<?php if(isset($_GET['search'])){ echo '<a href="view_appointments.php" style="padding:10px;">Clear</a>'; } ?>
</form>

<table>
<tr><th>ID</th><th>Patient</th><th>Doctor</th><th>Specialization</th><th>Date</th><th>Time</th><th>Status</th></tr>
<?php
$base = "SELECT a.*, p.full_name as patient_name, d.full_name as doctor_name, d.specialization 
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        JOIN doctors d ON a.doctor_id = d.doctor_id";

if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $conn->real_escape_string($_GET['search']);
    $sql = $base . " WHERE p.full_name LIKE '%$search%' OR d.full_name LIKE '%$search%' ORDER BY a.appointment_date DESC";
} else {
    $sql = $base . " ORDER BY a.appointment_date DESC";
}

$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    echo "<tr><td>{$row['appointment_id']}</td><td>{$row['patient_name']}</td><td>{$row['doctor_name']}</td><td>{$row['specialization']}</td><td>{$row['appointment_date']}</td><td>{$row['appointment_time']}</td><td>{$row['status']}</td></tr>";
}
?>
</table>
</div>
</body>
</html>