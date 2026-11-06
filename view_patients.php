<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>All Patients - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:900px; margin:30px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th, td { border:1px solid #ddd; padding:10px; text-align:left; }
th { background:#2e7d32; color:white; }
tr:nth-child(even) { background:#f2f2f2; }
a.btn { background:#2e7d32; color:white; padding:8px 15px; text-decoration:none; border-radius:5px; }
.search-box { display:flex; gap:10px; margin:15px 0; }
.search-box input { flex:1; padding:10px; border:1px solid #ccc; border-radius:5px; }
.search-box button { padding:10px 20px; background:#2e7d32; color:white; border:none; border-radius:5px; cursor:pointer; }
</style>
</head>
<body>
<div class="card">
<h2>📋 All Registered Patients</h2>
<a class="btn" href="add_patient.php">+ Add New Patient</a>
<a class="btn" href="index.php" style="background:#666;">Dashboard</a>

<!-- SEARCH BAR ADDED HERE -->
<form method="GET" class="search-box">
<input type="text" name="search" placeholder="Search by Name or ID Number..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
<button type="submit">🔍 Search</button>
<?php if(isset($_GET['search'])){ echo '<a href="view_patients.php" style="padding:10px;">Clear</a>'; } ?>
</form>

<table>
<tr>
<th>ID</th>
<th>Full Name</th>
<th>ID Number</th>
<th>Phone</th>
<th>Gender</th>
<th>Date Registered</th>
</tr>

<?php
// SEARCH LOGIC - if search exists, filter
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM patients WHERE full_name LIKE '%$search%' OR id_number LIKE '%$search%' ORDER BY patient_id DESC";
} else {
    $sql = "SELECT * FROM patients ORDER BY patient_id DESC";
}

$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['patient_id']."</td>";
        echo "<td>".$row['full_name']."</td>";
        echo "<td>".$row['id_number']."</td>";
        echo "<td>".$row['phone']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['created_at']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' style='text-align:center; color:red;'>No patient found matching '".(isset($_GET['search'])?$_GET['search']:'')."'</td></tr>";
}
?>
</table>

</div>
</body>
</html>