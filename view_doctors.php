<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Doctors - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:900px; margin:30px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th, td { border:1px solid #ddd; padding:10px; text-align:left; }
th { background:#1565c0; color:white; }
a.btn { background:#1565c0; color:white; padding:8px 15px; text-decoration:none; border-radius:5px; }
.search-box { display:flex; gap:10px; margin:15px 0; }
.search-box input { flex:1; padding:10px; border:1px solid #ccc; border-radius:5px; }
.search-box button { padding:10px 20px; background:#1565c0; color:white; border:none; border-radius:5px; }
</style>
</head>
<body>
<div class="card">
<h2>👨‍⚕️ Doctors List</h2>
<a class="btn" href="add_doctor.php">+ Add Doctor</a>
<a class="btn" href="index.php" style="background:#666;">Dashboard</a>

<form method="GET" class="search-box">
<input type="text" name="search" placeholder="Search by Name or Specialization..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
<button type="submit">🔍 Search</button>
<?php if(isset($_GET['search'])){ echo '<a href="view_doctors.php" style="padding:10px;">Clear</a>'; } ?>
</form>

<table>
<tr><th>ID</th><th>Name</th><th>Specialization</th><th>Phone</th><th>Email</th></tr>
<?php
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM doctors WHERE full_name LIKE '%$search%' OR specialization LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM doctors";
}
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    echo "<tr><td>{$row['doctor_id']}</td><td>{$row['full_name']}</td><td>{$row['specialization']}</td><td>{$row['phone']}</td><td>{$row['email']}</td></tr>";
}
?>
</table>
</div>
</body>
</html>