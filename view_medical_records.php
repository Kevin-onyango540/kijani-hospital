<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Medical Records - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:1100px; margin:20px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
table { width:100%; border-collapse:collapse; margin-top:15px; font-size:14px; }
th, td { border:1px solid #ddd; padding:8px; text-align:left; }
th { background:#2e7d32; color:white; }
.ward-yes { background:#f8d7da; color:#721c24; padding:3px 6px; border-radius:3px; font-weight:bold; }
.ward-no { background:#d4edda; color:#155724; padding:3px 6px; border-radius:3px; }
.search-box { display:flex; gap:10px; margin:15px 0; }
.search-box input { flex:1; padding:10px; border:1px solid #ccc; border-radius:5px; }
.search-box button { padding:10px 20px; background:#2e7d32; color:white; border:none; border-radius:5px; }
</style>
</head>
<body>
<div class="card">
<h2>📋 Patient Diseases, Drugs & Ward Records</h2>
<a href="add_medical_record.php" style="background:#2e7d32; color:white; padding:8px 15px; text-decoration:none; border-radius:5px;">+ Add Record</a>
<a href="index.php" style="background:#666; color:white; padding:8px 15px; text-decoration:none; border-radius:5px;">Dashboard</a>

<form method="GET" class="search-box">
<input type="text" name="search" placeholder="Search by Patient name, Disease, or Prescription..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
<button type="submit">🔍 Search</button>
<?php if(isset($_GET['search'])){ echo '<a href="view_medical_records.php" style="padding:10px;">Clear</a>'; } ?>
</form>

<table>
<tr><th>ID</th><th>Patient</th><th>Disease</th><th>Prescription (Drugs)</th><th>Doctor</th><th>Ward?</th><th>Days</th><th>Date</th></tr>
<?php
$base = "SELECT mr.*, p.full_name as patient_name, d.full_name as doctor_name 
         FROM medical_records mr
         JOIN patients p ON mr.patient_id = p.patient_id
         JOIN doctors d ON mr.doctor_id = d.doctor_id";

if(isset($_GET['search']) && !empty($_GET['search'])){
    $s = $conn->real_escape_string($_GET['search']);
    $sql = $base . " WHERE p.full_name LIKE '%$s%' OR mr.disease LIKE '%$s%' OR mr.prescription LIKE '%$s%' ORDER BY mr.visit_date DESC";
} else {
    $sql = $base . " ORDER BY mr.visit_date DESC";
}

$res = $conn->query($sql);
if($res && $res->num_rows > 0){
    while($row=$res->fetch_assoc()){
        $wardClass = ($row['ward_required']=='Yes') ? 'ward-yes' : 'ward-no';
        $wardText = ($row['ward_required']=='Yes') ? $row['ward_type']." (".$row['days_in_ward']." days)" : "Outpatient";
        echo "<tr>";
        echo "<td>{$row['record_id']}</td>";
        echo "<td><b>{$row['patient_name']}</b><br><small>{$row['symptoms']}</small></td>";
        echo "<td style='color:#c62828; font-weight:bold;'>{$row['disease']}</td>";
        echo "<td>{$row['prescription']}</td>";
        echo "<td>{$row['doctor_name']}</td>";
        echo "<td><span class='$wardClass'>{$row['ward_required']}</span><br><small>$wardText</small></td>";
        echo "<td>{$row['days_in_ward']}</td>";
        echo "<td>{$row['visit_date']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' style='text-align:center;'>No medical records found. Add one.</td></tr>";
}
?>
</table>

<br>
<div style="background:#e8f5e9; padding:15px; border-radius:5px;">
<h4>How the Doctor Decides Ward & Days:</h4>
<ul>
<li><b>Malaria:</b> No ward or 2-3 days if severe</li>
<li><b>Typhoid:</b> 5-7 days in General Ward</li>
<li><b>Pneumonia:</b> 7-10 days, may need ICU</li>
<li><b>Surgery/Accident:</b> 7-14 days in Surgical Ward</li>
<li><b>Diabetes/Pressure:</b> Usually Outpatient + monthly drugs</li>
</ul>
</div>

</div>
</body>
</html>