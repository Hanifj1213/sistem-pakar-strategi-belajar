<?php
require_once '../config/database.php';
require_once '../expert/inference_engine.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $symptoms = isset($_POST['symptoms']) ? $_POST['symptoms'] : [];

    // Validasi
    if (empty($name) || count($symptoms) < 2) {
        header('Location: ../index.php?page=consultation&msg=error');
        exit;
    }

    // Melakukan inferensi menggunakan Forward Chaining
    $result = run_forward_chaining($symptoms);

    // Menyimpan data ke database
    $name_safe = $conn->real_escape_string($name);
    $selected_symptoms_str = $conn->real_escape_string(implode(',', $symptoms));
    $learning_style = $conn->real_escape_string($result['learning_style']);
    $main_problem = $conn->real_escape_string($result['main_problem']);
    $recommendation = $conn->real_escape_string($result['recommendation']);
    $active_rules_str = $conn->real_escape_string($result['active_rules']);

    $stmt = $conn->prepare('INSERT INTO consultations (name, selected_symptoms, learning_style, main_problem, recommendation, active_rules) VALUES (?, ?, ?, ?, ?, ?)');

    $stmt->bind_param('ssssss', $name_safe, $selected_symptoms_str, $learning_style, $main_problem, $recommendation, $active_rules_str);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        header("Location: ../index.php?page=result&id=$last_id");
    } else {
        echo 'Error: ' . $stmt->error;
    }
} else {
    header('Location: ../index.php');
}
?>