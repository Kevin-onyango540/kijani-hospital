<?php include 'db_connect.php';
$sql = "CREATE TABLE IF NOT EXISTS medical_records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    disease VARCHAR(255) NOT NULL,
    symptoms TEXT,
    prescription TEXT NOT NULL,
    ward_required ENUM('Yes','No') DEFAULT 'No',
    ward_type VARCHAR(100),
    days_in_ward INT DEFAULT 0,
    visit_date DATE NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE CASCADE
)";

if($conn->query($sql)){
    echo "✅ SUCCESS! Table medical_records created!<br><br>";
    echo "<a href='add_medical_record.php'>Now go to Add Diagnosis Page</a>";
} else {
    echo "Error: ".$conn->error;
}
?><?php include 'db_connect.php';
$sql = "CREATE TABLE IF NOT EXISTS medical_records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    disease VARCHAR(255) NOT NULL,
    symptoms TEXT,
    prescription TEXT NOT NULL,
    ward_required ENUM('Yes','No') DEFAULT 'No',
    ward_type VARCHAR(100),
    days_in_ward INT DEFAULT 0,
    visit_date DATE NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE CASCADE
)";

if($conn->query($sql)){
    echo "✅ SUCCESS! Table medical_records created!<br><br>";
    echo "<a href='add_medical_record.php'>Now go to Add Diagnosis Page</a>";
} else {
    echo "Error: ".$conn->error;
}
?>