<?php
require_once 'config/database.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $conn->prepare('SELECT * FROM consultations WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<div class='alert alert-error'>Data tidak ditemukan.</div>";
    echo "<a href='index.php?page=history' class='btn btn-secondary'>Kembali</a>";
    exit;
}

$symptoms_array = explode(',', $data['selected_symptoms']);
require_once 'expert/knowledge_base.php';
?>

<div class="card">
    <h2>Detail Hasil Konsultasi</h2>
    
    <div style="background-color: #f9fafb; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
        <p><strong>ID Konsultasi:</strong> #<?php echo $data['id']; ?></p>
        <p><strong>Nama Mahasiswa:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
        <p><strong>Tanggal Konsultasi:</strong> <?php echo date('d M Y, H:i', strtotime($data['created_at'])); ?></p>
    </div>

    <h3>Gejala yang Dipilih:</h3>
    <ul style="margin-left: 20px; margin-bottom: 1.5rem; color: #4b5563;">
        <?php foreach ($symptoms_array as $code): ?>
            <li><strong><?php echo $code; ?>:</strong> <?php echo isset($symptoms[$code]) ? $symptoms[$code] : '-'; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Hasil Inferensi:</h3>
    <div style="border: 1px solid #e5e7eb; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
        <p><strong>Gaya Belajar:</strong> <?php echo htmlspecialchars($data['learning_style']); ?></p>
        <p><strong>Kendala Utama:</strong> <?php echo htmlspecialchars($data['main_problem']); ?></p>
        <p><strong>Rule Aktif:</strong> <?php echo htmlspecialchars($data['active_rules']); ?></p>
    </div>

    <h3>Rekomendasi Lengkap:</h3>
    <div style="background-color: #eff6ff; border: 1px solid #bfdbfe; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
        <p style="margin: 0; color: #1e3a8a; line-height: 1.6;">
            <?php echo htmlspecialchars($data['recommendation']); ?>
        </p>
    </div>

    <a href="index.php?page=history" class="btn btn-secondary">Kembali ke Riwayat</a>
</div>