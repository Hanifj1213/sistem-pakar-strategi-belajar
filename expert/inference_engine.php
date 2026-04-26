<?php
require_once 'knowledge_base.php';

function run_forward_chaining($selected_symptoms)
{
    global $rules;

    $active_rules = [];
    $learning_style_counts = [];
    $main_problem_counts = [];
    $recommendations = [];

    // Mengecek setiap rule
    foreach ($rules as $rule_id => $rule_data) {
        $match = true;

        // Jika ada kondisi yang tidak dipilih user, rule tidak cocok
        foreach ($rule_data['conditions'] as $condition) {
            if (!in_array($condition, $selected_symptoms)) {
                $match = false;
                break;
            }
        }

        // Jika semua kondisi terpenuhi, rule aktif
        if ($match) {
            $active_rules[] = $rule_id;

            if (!empty($rule_data['learning_style'])) {
                $ls = $rule_data['learning_style'];
                $learning_style_counts[$ls] = isset($learning_style_counts[$ls]) ? $learning_style_counts[$ls] + 1 : 1;
            }

            if (!empty($rule_data['main_problem'])) {
                $mp = $rule_data['main_problem'];
                $main_problem_counts[$mp] = isset($main_problem_counts[$mp]) ? $main_problem_counts[$mp] + 1 : 1;
            }

            $recommendations[] = $rule_data['recommendation'];
        }
    }

    // Menentukan hasil yang paling banyak muncul
    $final_learning_style = 'Belum dapat ditentukan';
    if (!empty($learning_style_counts)) {
        arsort($learning_style_counts);
        $final_learning_style = array_key_first($learning_style_counts);
    }

    $final_main_problem = 'Belum dapat ditentukan';
    if (!empty($main_problem_counts)) {
        arsort($main_problem_counts);
        $final_main_problem = array_key_first($main_problem_counts);
    }

    $final_recommendation = '';
    if (!empty($recommendations)) {
        $final_recommendation = implode(' ', array_unique($recommendations));
    } else {
        $final_recommendation = 'Pilih gejala yang lebih sesuai atau gunakan strategi umum seperti membuat jadwal belajar, latihan soal, mencatat materi penting, dan menjaga waktu istirahat.';
    }

    return [
        'learning_style' => $final_learning_style,
        'main_problem' => $final_main_problem,
        'recommendation' => $final_recommendation,
        'active_rules' => implode(', ', $active_rules)
    ];
}
?>