<?php include 'auth.php'; ?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Medical Record - Kijani Hospital</title>
<style>
body { font-family: Arial; max-width:800px; margin:20px auto; background:#f5f5f5; }
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 2px 10px #ccc; }
input, select, textarea { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc; box-sizing:border-box; }
button { width:100%; padding:12px; background:#2e7d32; color:white; border:none; border-radius:5px; font-size:16px; cursor:pointer; }
label { font-weight:bold; margin-top:10px; display:block; }
.row { display:flex; gap:15px; }
.row div { flex:1; }
</style>
<script>
function checkWard(){
    var w = document.getElementById('ward_required').value;
    var box = document.getElementById('ward_box');
    if(w == 'Yes'){ box.style.display='block'; } else { box.style.display='none'; }
}
</script>
</head>
<body>
<div class="card">
<h2>🩺 Add Diagnosis, Prescription & Ward Info</h2>
<a href="view_medical_records.php" style="text-decoration:none;">📋 View All Records</a> | 
<a href="index.php" style="text-decoration:none;">Dashboard</a>
<hr>

<?php
if(isset($_POST['save'])){
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $disease = $conn->real_escape_string($_POST['disease']);
    $symptoms = $conn->real_escape_string($_POST['symptoms']);
    $prescription = $conn->real_escape_string($_POST['prescription']);
    $ward_required = $_POST['ward_required'];
    $ward_type = $conn->real_escape_string($_POST['ward_type']);
    $days = intval($_POST['days_in_ward']);
    $visit_date = $_POST['visit_date'];
    $notes = $conn->real_escape_string($_POST['notes']);

    $sql = "INSERT INTO medical_records (patient_id, doctor_id, disease, symptoms, prescription, ward_required, ward_type, days_in_ward, visit_date, notes) 
            VALUES ('$patient_id','$doctor_id','$disease','$symptoms','$prescription','$ward_required','$ward_type','$days','$visit_date','$notes')";
    
    if($conn->query($sql)){
        echo "<p style='background:#d4edda; padding:10px; color:#155724;'>✅ Medical record saved! Disease: $disease recorded.</p>";
    } else {
        echo "<p style='background:#f8d7da; padding:10px;'>Error: ".$conn->error."</p>";
    }
}
?>

<form method="POST">
<label>Select Patient:</label>
<select name="patient_id" required>
<option value="">-- Choose Patient --</option>
<?php $res = $conn->query("SELECT patient_id, full_name, id_number FROM patients"); while($r=$res->fetch_assoc()){ echo "<option value='{$r['patient_id']}'>{$r['full_name']} - ID: {$r['id_number']}</option>"; } ?>
</select>

<label>Select Doctor (Who diagnosed):</label>
<select name="doctor_id" required>
<option value="">-- Choose Doctor --</option>
<?php $res = $conn->query("SELECT doctor_id, full_name, specialization FROM doctors"); while($r=$res->fetch_assoc()){ echo "<option value='{$r['doctor_id']}'>{$r['full_name']} - {$r['specialization']}</option>"; } ?>
</select>

<label>Disease / Diagnosis:</label>
<input type="text" name="disease" placeholder="e.g., Malaria, Typhoid, Diabetes, Hypertension" required>

<label>Symptoms:</label>
<textarea name="symptoms" rows="2" placeholder="e.g., High fever, headache, vomiting for 3 days"></textarea>

<label>Prescription (Drugs):</label>
<textarea name="prescription" rows="3" placeholder="e.g., Artemether 80mg - 2x daily for 3 days, Paracetamol 500mg - 3x daily" required></textarea>

<div class="row">
<div>
<label>Visit Date:</label>
<input type="date" name="visit_date" required value="<?php echo date('Y-m-d'); ?>">
</div>
<div>
<label>Need Ward Admission?</label>
<select name="ward_required" id="ward_required" onchange="checkWard()" required>
<option value="No">No - Outpatient</option>
<option value="Yes">Yes - Admit to Ward</option>
</select>
</div>
</div>

<div id="ward_box" style="display:none; background:#fff3cd; padding:15px; border-radius:5px; margin-top:10px;">
<label>Ward Type:</label>
<select name="ward_type">
<option value="">-- Select Ward --</option>
<option value="General Ward">General Ward</option>
<option value="Male Ward">Male Ward</option>
<option value="Female Ward">Female Ward</option>
<option value="Pediatric Ward">Pediatric Ward (Children)</option>
<option value="Maternity Ward">Maternity Ward</option>
<option value="ICU">ICU - Intensive Care</option>
<option value="Isolation Ward">Isolation Ward</option>
</select>
<label>How many days in Ward? (Based on disease severity)</label>
<input type="number" name="days_in_ward" value="0" min="0" placeholder="e.g., Malaria=3 days, Surgery=7 days">
<small>Doctor decides: Malaria 2-3 days, Typhoid 5-7 days, Surgery 7-14 days</small>
</div>

<label>Doctor Notes:</label>
<textarea name="notes" rows="2" placeholder="Additional notes..."></textarea>

<br><br>
<button type="submit" name="save">💾 Save Medical Record</button>
</form>
</div>
</body>
</html>