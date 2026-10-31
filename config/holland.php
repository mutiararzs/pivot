<?php

/*
 * Konten hasil tes per dimensi Holland (RIASEC).
 * Dipakai halaman Hasil Tes untuk menyusun interpretasi, rekomendasi karier,
 * dan rekomendasi jurusan berdasarkan kode Holland siswa.
 */

return [
    // Skor maksimum per dimensi: 10 soal x skala 5
    'max_score' => 10,

    'types' => [
        'R' => [
            'name' => 'Realistik',
            'description' => 'Anda menyukai pekerjaan praktis yang menghasilkan sesuatu yang nyata. '
                .'Anda nyaman bekerja dengan alat, mesin, dan aktivitas lapangan, serta cepat '
                .'mengeksekusi solusi teknis.',
            'traits' => ['Terampil Teknis', 'Praktis & Tangkas', 'Berorientasi Hasil Nyata'],
            'careers' => [
                ['title' => 'Teknisi & Insinyur Mekanik', 'subtitle' => 'Mesin • Manufaktur', 'tags' => ['Hands-on', 'Teknik Terapan']],
                ['title' => 'Ahli Robotika & IoT', 'subtitle' => 'Robotics • Otomasi Terapan', 'tags' => ['Hardware & AI', 'Otomasi Cerdas']],
                ['title' => 'Teknisi Jaringan & Elektronika', 'subtitle' => 'Infrastruktur • Perangkat Keras', 'tags' => ['Jaringan', 'Elektronika']],
            ],
            'majors' => [
                ['title' => 'Teknik Mesin', 'faculty' => 'Fakultas Teknik'],
                ['title' => 'Teknik Elektro & Mekatronika', 'faculty' => 'Fakultas Teknik Industri & Rekayasa'],
                ['title' => 'Teknik Sipil', 'faculty' => 'Fakultas Teknik'],
            ],
        ],

        'I' => [
            'name' => 'Investigatif',
            'description' => 'Anda memiliki rasa ingin tahu intelektual yang tajam dan senang membedah '
                .'masalah kompleks dengan analisis mendalam. Anda terstimulasi oleh riset, data, '
                .'dan pencarian penjelasan ilmiah.',
            'traits' => ['Berpikir Analitis', 'Rasa Ingin Tahu Tinggi', 'Berbasis Data'],
            'careers' => [
                ['title' => 'Insinyur Perangkat Lunak', 'subtitle' => 'Software Engineer • Sistem & Cloud', 'tags' => ['High Growth', 'Stem Tech']],
                ['title' => 'Peneliti & Analis Data', 'subtitle' => 'Data Scientist • AI Specialist', 'tags' => ['Komp. Analitik', 'Machine Learning']],
                ['title' => 'Ilmuwan & Peneliti Laboratorium', 'subtitle' => 'Sains • Riset Terapan', 'tags' => ['Riset', 'Eksperimen']],
            ],
            'majors' => [
                ['title' => 'Teknik Informatika / Ilmu Komputer', 'faculty' => 'Fakultas Ilmu Komputer (FASILKOM)'],
                ['title' => 'Sains Data & Kecerdasan Buatan', 'faculty' => 'Fakultas Sains & Teknologi Matematika'],
                ['title' => 'Matematika, Fisika & Statistika', 'faculty' => 'Fakultas MIPA'],
            ],
        ],

        'A' => [
            'name' => 'Artistik',
            'description' => 'Anda ekspresif, imajinatif, dan menyukai kebebasan berkreasi. Anda peka '
                .'terhadap estetika serta senang mengubah ide orisinal menjadi karya yang bisa '
                .'dinikmati orang lain.',
            'traits' => ['Kreatif & Orisinal', 'Peka Estetika', 'Ekspresif'],
            'careers' => [
                ['title' => 'Desainer UI/UX & Grafis', 'subtitle' => 'Product Design • Visual', 'tags' => ['Kreatif Digital', 'User-Centered']],
                ['title' => 'Kreator Konten & Sutradara', 'subtitle' => 'Film • Media Digital', 'tags' => ['Storytelling', 'Produksi Media']],
                ['title' => 'Arsitek & Desainer Interior', 'subtitle' => 'Ruang • Estetika', 'tags' => ['Desain Ruang', 'Konsep Visual']],
            ],
            'majors' => [
                ['title' => 'Desain Komunikasi Visual', 'faculty' => 'Fakultas Desain & Seni Kreatif'],
                ['title' => 'Arsitektur', 'faculty' => 'Fakultas Teknik & Desain'],
                ['title' => 'Film & Televisi', 'faculty' => 'Fakultas Seni Pertunjukan & Media'],
            ],
        ],

        'S' => [
            'name' => 'Sosial',
            'description' => 'Anda hangat, empatik, dan senang membantu orang berkembang. Anda mudah '
                .'membangun hubungan dan merasa bermakna ketika pekerjaan Anda berdampak langsung '
                .'pada orang lain.',
            'traits' => ['Empatik', 'Komunikatif', 'Kolaboratif'],
            'careers' => [
                ['title' => 'Guru & Pendidik', 'subtitle' => 'Pendidikan • Pengembangan Diri', 'tags' => ['Edukasi', 'Mentoring']],
                ['title' => 'Psikolog & Konselor', 'subtitle' => 'Kesehatan Mental • Pendampingan', 'tags' => ['Konseling', 'Empati']],
                ['title' => 'Tenaga Kesehatan', 'subtitle' => 'Keperawatan • Layanan Publik', 'tags' => ['Pelayanan', 'Kesehatan Masyarakat']],
            ],
            'majors' => [
                ['title' => 'Pendidikan / Keguruan', 'faculty' => 'Fakultas Keguruan & Ilmu Pendidikan'],
                ['title' => 'Psikologi', 'faculty' => 'Fakultas Psikologi'],
                ['title' => 'Kesehatan Masyarakat & Keperawatan', 'faculty' => 'Fakultas Ilmu Kesehatan'],
            ],
        ],

        'E' => [
            'name' => 'Enterprising',
            'description' => 'Anda percaya diri, persuasif, dan termotivasi memimpin serta mencapai '
                .'target. Anda berani mengambil risiko terukur dan senang mengarahkan orang menuju '
                .'tujuan bersama.',
            'traits' => ['Kepemimpinan', 'Persuasif', 'Berani Mengambil Risiko'],
            'careers' => [
                ['title' => 'Wirausaha & Pendiri Startup', 'subtitle' => 'Bisnis • Inovasi', 'tags' => ['Entrepreneur', 'Growth']],
                ['title' => 'Manajer Produk & Bisnis', 'subtitle' => 'Strategi • Operasional', 'tags' => ['Strategi', 'Manajemen']],
                ['title' => 'Pemasaran & Penjualan', 'subtitle' => 'Brand • Komunikasi Pasar', 'tags' => ['Marketing', 'Negosiasi']],
            ],
            'majors' => [
                ['title' => 'Manajemen & Bisnis', 'faculty' => 'Fakultas Ekonomi & Bisnis'],
                ['title' => 'Ilmu Komunikasi', 'faculty' => 'Fakultas Ilmu Komunikasi'],
                ['title' => 'Hubungan Internasional / Ilmu Politik', 'faculty' => 'Fakultas Ilmu Sosial & Politik'],
            ],
        ],

        'C' => [
            'name' => 'Konvensional',
            'description' => 'Anda teliti, rapi, dan menyukai pekerjaan terstruktur dengan aturan yang '
                .'jelas. Anda andal menjaga akurasi data serta memastikan proses berjalan tertib '
                .'dan tepat waktu.',
            'traits' => ['Teliti & Terstruktur', 'Andal', 'Disiplin Prosedur'],
            'careers' => [
                ['title' => 'Akuntan & Auditor', 'subtitle' => 'Keuangan • Pemeriksaan', 'tags' => ['Akurasi', 'Kepatuhan']],
                ['title' => 'Administrator Sistem Informasi', 'subtitle' => 'Basis Data • Operasional', 'tags' => ['Data', 'Tata Kelola']],
                ['title' => 'Analis Keuangan & Perpajakan', 'subtitle' => 'Perencanaan • Anggaran', 'tags' => ['Finansial', 'Analisis Angka']],
            ],
            'majors' => [
                ['title' => 'Akuntansi', 'faculty' => 'Fakultas Ekonomi & Bisnis'],
                ['title' => 'Sistem Informasi', 'faculty' => 'Fakultas Ilmu Komputer'],
                ['title' => 'Administrasi Bisnis / Perpajakan', 'faculty' => 'Fakultas Ilmu Administrasi'],
            ],
        ],
    ],
];