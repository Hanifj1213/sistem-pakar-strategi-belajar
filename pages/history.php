<?php
require_once 'config/database.php';

$query = 'SELECT * FROM consultations ORDER BY id DESC';
$result = $conn->query($query);
?>

<div class="card">
    <h2>Riwayat Konsultasi</h2>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Gaya Belajar</th>
                    <th>Kendala Utama</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1;
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['learning_style']); ?></td>
                            <td><?php echo htmlspecialchars($row['main_problem']); ?></td>
                            <td><?php echo date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>
                            <td>
                                <a href="index.php?page=detail&id=<?php echo $row['id']; ?>" class="btn" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Detail</a>
                                <a href="process/delete_consultation.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.85rem; margin-left: 0.5rem;">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: #6b7280; padding: 2rem;">Belum ada riwayat konsultasi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>