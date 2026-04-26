CREATE DATABASE IF NOT EXISTS db_sistem_pakar_belajar;
USE db_sistem_pakar_belajar;

CREATE TABLE IF NOT EXISTS consultations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    selected_symptoms TEXT NOT NULL,
    learning_style VARCHAR(100) NOT NULL,
    main_problem VARCHAR(100) NOT NULL,
    recommendation TEXT NOT NULL,
    active_rules TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);