<?php

$symptoms = [
    'G01' => 'Lebih mudah memahami materi melalui gambar, diagram, tabel, warna, atau mind map.',
    'G02' => 'Sering membuat catatan visual seperti peta konsep atau rangkuman berwarna.',
    'G03' => 'Lebih mudah memahami materi melalui penjelasan lisan dari guru, dosen, atau video.',
    'G04' => 'Suka berdiskusi atau menjelaskan ulang materi secara lisan.',
    'G05' => 'Lebih mudah paham ketika langsung mencoba praktik atau mengerjakan contoh.',
    'G06' => 'Lebih suka belajar melalui simulasi, latihan soal, atau eksperimen.',
    'G07' => 'Lebih mudah memahami materi dengan membaca dan menulis ulang rangkuman.',
    'G08' => 'Suka membuat catatan tertulis yang rapi dan terstruktur.',
    'G09' => 'Mudah bosan jika belajar terlalu lama.',
    'G10' => 'Sulit fokus ketika belajar.',
    'G11' => 'Sering terdistraksi oleh handphone atau media sosial.',
    'G12' => 'Sering menunda belajar sampai mendekati ujian.',
    'G13' => 'Sulit menghafal istilah, definisi, atau konsep penting.',
    'G14' => 'Sulit memahami teori yang abstrak.',
    'G15' => 'Sulit mengerjakan soal hitungan atau soal berbasis rumus.',
    'G16' => 'Mudah panik atau cemas menjelang ujian.',
    'G17' => 'Belum memiliki jadwal belajar yang teratur.',
    'G18' => 'Merasa sudah belajar, tetapi hasil latihan soal masih rendah.',
    'G19' => 'Lebih nyaman belajar sendiri daripada berkelompok.',
    'G20' => 'Lebih nyaman belajar bersama teman atau kelompok kecil.'
];

$rules = [
    'R01' => [
        'conditions' => ['G01', 'G02'],
        'learning_style' => 'Visual',
        'main_problem' => '',
        'recommendation' => 'Gunakan mind map, diagram, warna, tabel, dan rangkuman visual saat belajar.'
    ],
    'R02' => [
        'conditions' => ['G03', 'G04'],
        'learning_style' => 'Auditori',
        'main_problem' => '',
        'recommendation' => 'Gunakan rekaman suara, video penjelasan, diskusi, dan teknik menjelaskan ulang materi secara lisan.'
    ],
    'R03' => [
        'conditions' => ['G05', 'G06'],
        'learning_style' => 'Kinestetik',
        'main_problem' => '',
        'recommendation' => 'Gunakan latihan soal, praktik langsung, simulasi, dan studi kasus.'
    ],
    'R04' => [
        'conditions' => ['G07', 'G08'],
        'learning_style' => 'Reading/Writing',
        'main_problem' => '',
        'recommendation' => 'Gunakan rangkuman tertulis, membaca ulang materi, membuat daftar istilah, dan menulis ulang konsep penting.'
    ],
    'R05' => [
        'conditions' => ['G09', 'G10', 'G11'],
        'learning_style' => '',
        'main_problem' => 'Sulit Fokus',
        'recommendation' => 'Gunakan teknik Pomodoro, jauhkan handphone, buat target belajar kecil, dan belajar dalam sesi pendek.'
    ],
    'R06' => [
        'conditions' => ['G12', 'G17'],
        'learning_style' => '',
        'main_problem' => 'Manajemen Waktu Buruk',
        'recommendation' => 'Buat jadwal belajar harian, tentukan prioritas materi, dan mulai belajar lebih awal sebelum ujian.'
    ],
    'R07' => [
        'conditions' => ['G13', 'G07'],
        'learning_style' => '',
        'main_problem' => 'Sulit Menghafal',
        'recommendation' => 'Gunakan flashcard, metode spaced repetition, membuat rangkuman singkat, dan mengulang materi secara berkala.'
    ],
    'R08' => [
        'conditions' => ['G14', 'G01'],
        'learning_style' => '',
        'main_problem' => 'Sulit Memahami Konsep Teori',
        'recommendation' => 'Ubah teori menjadi bagan, contoh sederhana, analogi, dan mind map.'
    ],
    'R09' => [
        'conditions' => ['G15', 'G06'],
        'learning_style' => '',
        'main_problem' => 'Sulit Soal Hitungan',
        'recommendation' => 'Perbanyak latihan soal bertahap, pahami rumus dasar, dan kerjakan contoh soal dari level mudah ke sulit.'
    ],
    'R10' => [
        'conditions' => ['G16', 'G18'],
        'learning_style' => '',
        'main_problem' => 'Cemas Menghadapi Ujian',
        'recommendation' => 'Lakukan simulasi ujian, latihan soal dengan batas waktu, dan evaluasi kesalahan secara bertahap.'
    ],
    'R11' => [
        'conditions' => ['G01', 'G02', 'G14'],
        'learning_style' => 'Visual',
        'main_problem' => 'Sulit Memahami Konsep Teori',
        'recommendation' => 'Gunakan peta konsep, diagram alur, warna pembeda, dan contoh visual untuk memahami teori.'
    ],
    'R12' => [
        'conditions' => ['G03', 'G04', 'G20'],
        'learning_style' => 'Auditori',
        'main_problem' => 'Membutuhkan Diskusi',
        'recommendation' => 'Belajar dengan kelompok kecil, diskusi tanya jawab, dan menjelaskan ulang materi kepada teman.'
    ],
    'R13' => [
        'conditions' => ['G05', 'G06', 'G15'],
        'learning_style' => 'Kinestetik',
        'main_problem' => 'Sulit Soal Hitungan',
        'recommendation' => 'Fokus pada praktik soal, simulasi, pembahasan contoh, dan latihan berulang.'
    ],
    'R14' => [
        'conditions' => ['G07', 'G08', 'G13'],
        'learning_style' => 'Reading/Writing',
        'main_problem' => 'Sulit Menghafal',
        'recommendation' => 'Buat catatan ringkas, daftar istilah, flashcard, dan review berkala.'
    ],
    'R15' => [
        'conditions' => ['G09', 'G10', 'G12', 'G17'],
        'learning_style' => '',
        'main_problem' => 'Pola Belajar Tidak Teratur',
        'recommendation' => 'Gunakan jadwal belajar, teknik Pomodoro, target kecil harian, dan evaluasi progres setiap hari.'
    ],
    'R16' => [
        'conditions' => ['G19', 'G07', 'G08'],
        'learning_style' => 'Reading/Writing',
        'main_problem' => '',
        'recommendation' => 'Belajar mandiri dengan membaca, menulis rangkuman, dan membuat daftar pertanyaan pribadi.'
    ],
    'R17' => [
        'conditions' => ['G20', 'G03', 'G04'],
        'learning_style' => 'Auditori',
        'main_problem' => '',
        'recommendation' => 'Belajar melalui diskusi kelompok, presentasi kecil, dan tanya jawab.'
    ],
    'R18' => [
        'conditions' => ['G18', 'G15'],
        'learning_style' => '',
        'main_problem' => 'Kurang Latihan Soal',
        'recommendation' => 'Tingkatkan latihan soal, evaluasi kesalahan, dan ulangi tipe soal yang sering salah.'
    ]
];
?>