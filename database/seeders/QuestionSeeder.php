<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $bank = [
            'I' => [
                'Saya menikmati memecahkan masalah teka-teki logika, menganalisis struktur data sistem, atau meneliti mengapa sebuah program komputer mengalami bug.',
                'Saya penasaran dan suka mencari tahu penjelasan ilmiah di balik suatu fenomena.',
                'Saya senang melakukan percobaan atau eksperimen di laboratorium.',
                'Saya menikmati membaca artikel sains atau teknologi.',
                'Saya suka menganalisis data untuk menemukan pola.',
                'Saya senang mempelajari matematika dan memecahkan soal yang rumit.',
                'Saya tertarik meneliti penyebab suatu masalah secara mendalam.',
                'Saya lebih suka bekerja dengan ide dan teori daripada rutinitas.',
                'Saya menikmati belajar hal baru yang menantang pikiran.',
                'Saya senang merancang rencana riset atau penyelidikan sendiri.',
            ],
            'R' => [
                'Saya menikmati memperbaiki atau merakit peralatan mekanik dan elektronik.',
                'Saya senang bekerja dengan alat-alat tangan dan mesin.',
                'Saya suka beraktivitas di luar ruangan seperti berkebun atau berkemah.',
                'Saya menikmati membangun sesuatu dengan tangan sendiri.',
                'Saya tertarik mengendarai atau mengoperasikan kendaraan dan mesin berat.',
                'Saya senang merawat hewan atau tanaman.',
                'Saya lebih suka pekerjaan yang hasilnya nyata dan bisa dilihat langsung.',
                'Saya menikmati kegiatan fisik seperti olahraga atau pekerjaan lapangan.',
                'Saya tertarik mempelajari cara kerja mesin dan peralatan teknik.',
                'Saya senang memasang instalasi seperti kabel, pipa, atau perabot.',
            ],
            'A' => [
                'Saya menikmati menggambar, melukis, atau mendesain sesuatu.',
                'Saya senang menulis cerita, puisi, atau lirik lagu.',
                'Saya suka bermain atau menciptakan musik.',
                'Saya senang tampil di depan orang, seperti bermain drama atau menari.',
                'Saya tertarik pada fotografi, film, atau desain visual.',
                'Saya lebih suka pekerjaan yang memberi kebebasan berkreasi.',
                'Saya sering memiliki ide orisinal yang berbeda dari orang lain.',
                'Saya menikmati mengunjungi museum, galeri, atau pertunjukan seni.',
                'Saya peka terhadap keindahan warna, bentuk, dan suara.',
                'Saya senang mendekorasi ruangan atau menata penampilan dengan gaya sendiri.',
            ],
            'S' => [
                'Saya senang membantu orang lain yang sedang kesulitan.',
                'Saya menikmati mengajar atau menjelaskan sesuatu kepada teman.',
                'Saya mudah mendengarkan dan memahami perasaan orang lain.',
                'Saya tertarik ikut kegiatan sosial atau menjadi relawan.',
                'Saya senang bekerja dalam tim dan membangun kerja sama.',
                'Saya suka menjadi tempat teman bercerita atau meminta saran.',
                'Saya tertarik pada pekerjaan di bidang pendidikan, kesehatan, atau konseling.',
                'Saya senang membantu menyelesaikan konflik antar teman dengan damai.',
                'Saya menikmati merawat dan mendampingi orang yang membutuhkan.',
                'Saya mudah akrab dengan orang baru.',
            ],
            'E' => [
                'Saya suka memimpin kelompok atau mengorganisasi kegiatan.',
                'Saya senang meyakinkan orang lain untuk menyetujui ide saya.',
                'Saya tertarik memulai usaha atau bisnis sendiri.',
                'Saya berani mengambil risiko demi mencapai target.',
                'Saya menikmati berbicara di depan umum atau berdebat.',
                'Saya senang bernegosiasi dan mencari kesepakatan terbaik.',
                'Saya termotivasi oleh persaingan dan pencapaian.',
                'Saya suka mengambil keputusan penting untuk kelompok.',
                'Saya tertarik pada dunia penjualan, pemasaran, atau politik.',
                'Saya senang memengaruhi arah suatu proyek atau organisasi.',
            ],
            'C' => [
                'Saya senang menyusun data atau dokumen secara rapi dan teratur.',
                'Saya suka mengikuti prosedur dan aturan yang jelas.',
                'Saya teliti memeriksa detail agar tidak ada kesalahan.',
                'Saya menikmati mencatat dan mengelola keuangan atau administrasi.',
                'Saya lebih nyaman dengan jadwal dan rencana yang terstruktur.',
                'Saya senang bekerja dengan angka, tabel, dan spreadsheet.',
                'Saya suka merapikan arsip, file, atau barang agar mudah ditemukan.',
                'Saya lebih suka tugas dengan instruksi yang jelas.',
                'Saya menikmati pekerjaan yang rutin dan dapat diprediksi.',
                'Saya merasa puas ketika pekerjaan selesai tepat waktu dan sesuai aturan.',
            ],
        ];

        // 10 soal, diselang-seling per kategori (I, R, A, S, E, C) seperti versi mobile.
        $limit = 10; // jumlah soal yang dipakai
        $order = 1;
        for ($i = 0; $i < 10; $i++) {
            foreach (['I', 'R', 'A', 'S', 'E', 'C'] as $category) {
                if ($order > $limit) {
                    break 2;
                }
                Question::updateOrCreate(
                    ['sort_order' => $order],
                    ['category' => $category, 'text' => $bank[$category][$i]],
                );
                $order++;
            }
        }
        // Hapus soal di atas batas (jika sebelumnya pernah 60 soal).
        Question::where('sort_order', '>', $limit)->delete();
    }
}
