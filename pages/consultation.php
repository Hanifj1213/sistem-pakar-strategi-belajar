<?php
require_once "expert/knowledge_base.php";

$keys = array_keys($symptoms);
$total_questions = count($keys);

// Handle reset
if (isset($_GET["action"]) && $_GET["action"] == "reset") {
    unset($_SESSION["consult"]);
    header("Location: index.php?page=consultation");
    exit;
}

// Handle submit step
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["start_consult"])) {
        // Start process
        $_SESSION["consult"] = [
            "name" => trim($_POST["name"]),
            "answers" => [],
            "step" => 0
        ];
        header("Location: index.php?page=consultation");
        exit;
    } elseif (isset($_POST["answer"])) {
        $step = $_SESSION["consult"]["step"];
        $current_key = $keys[$step];

        // If user says "Yes", save symptom
        if ($_POST["answer"] == "yes") {
            $_SESSION["consult"]["answers"][] = $current_key;
        }

        // Increment step
        $_SESSION["consult"]["step"]++;
        header("Location: index.php?page=consultation");
        exit;
    }
}

$is_started = isset($_SESSION["consult"]);
$step = $is_started ? (int)$_SESSION["consult"]["step"] : 0;
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 style="text-align: center;">Mulai Sistem Pakar</h2>

    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "error") : ?>
        <div class="alert alert-error" style="text-align: center;">
            Terjadi kesalahan. Pastikan Anda telah menjawab dan memilih setidaknya 2 gejala.
        </div>
    <?php endif; ?>

    <?php if (!$is_started) : ?>
        <!-- Pendaftaran Nama -->
        <p style="text-align: center; color: #4b5563;">Silakan masukkan nama Anda untuk memulai sesi tanya jawab.</p>
        <form method="POST" action="index.php?page=consultation" style="margin-top: 2rem;">
            <div class="form-group">
                <label for="name">Nama Mahasiswa:</label>
                <input type="text" id="name" name="name" required placeholder="Contoh: Budi Santoso">
            </div>
            <button type="submit" name="start_consult" class="btn" style="width: 100%;">Mulai Pertanyaan</button>
        </form>

    <?php elseif ($step < $total_questions) : ?>
        <!-- Menampilkan Pertanyaan Satu per Satu -->
        <?php
        $current_code = $keys[$step];
        $current_symptom = $symptoms[$current_code];
        $progress = (($step) / $total_questions) * 100;
        ?>
        
        <div style="margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-weight: 600; color: #1e3a8a;">Pertanyaan <?php echo ($step + 1); ?> dari <?php echo $total_questions; ?></span>
                <span style="font-size: 0.9rem; color: #6b7280;"><?php echo round($progress); ?>%</span>
            </div>
            <!-- Progress Bar -->
            <div style="width: 100%; background-color: #e5e7eb; border-radius: 999px; height: 10px; overflow: hidden;">
                <div style="background-color: #2563eb; height: 100%; border-radius: 999px; width: <?php echo $progress; ?>%; transition: width 0.3s ease;"></div>
            </div>
        </div>

        <div style="background-color: #f9fafb; padding: 2rem; border-radius: 8px; border: 1px solid #e5e7eb; text-align: center; margin-bottom: 2rem;">
            <p style="font-size: 1.2rem; font-weight: 500; color: #1f2937; line-height: 1.6; margin-bottom: 0;">
                Apakah Anda... <br><br>
                <span style="color: #2563eb;">"<?php echo htmlspecialchars($current_symptom); ?>"</span>
            </p>
        </div>

        <form method="POST" action="index.php?page=consultation" style="display: flex; gap: 1rem; justify-content: center;">
            <button type="submit" name="answer" value="yes" class="btn" style="flex: 1; padding: 1rem; font-size: 1.1rem; background-color: #10b981; border: 1px solid #059669;">IYA</button>
            <button type="submit" name="answer" value="no" class="btn" style="flex: 1; padding: 1rem; font-size: 1.1rem; background-color: #ef4444; border: 1px solid #dc2626;">TIDAK</button>
        </form>
        
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="index.php?page=consultation&action=reset" style="color: #6b7280; text-decoration: underline; font-size: 0.9rem;">Ulangi dari awal</a>
        </div>

    <?php else : ?>
        <!-- Pertanyaan Selesai, Menampilkan Form ke proses consultation -->
        <div style="text-align: center; padding: 2rem;">
            <div style="width: 64px; height: 64px; background-color: #d1fae5; color: #059669; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; font-size: 2rem; font-weight: bold;">
                ✓
            </div>
            <h3 style="color: #1f2937; margin-bottom: 1rem;">Semua Pertanyaan Selesai Dijawab</h3>
            <p style="color: #4b5563; margin-bottom: 2rem;">Klik tombol di bawah untuk melihat hasil analisis gaya belajar dan kendala dominan Anda berdasarkan jawaban.</p>
            
            <form action="process/process_consultation.php" method="POST">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($_SESSION["consult"]["name"]); ?>">
                <?php foreach ($_SESSION["consult"]["answers"] as $code) : ?>
                    <input type="hidden" name="symptoms[]" value="<?php echo htmlspecialchars($code); ?>">
                <?php endforeach; ?>
                
                <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem;">Lihat Hasil Rekomendasi</button>
            </form>

            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="index.php?page=consultation&action=reset" style="color: #6b7280; text-decoration: underline; font-size: 0.9rem;">Ulangi dari awal</a>
            </div>
        </div>
    <?php endif; ?>
</div>

