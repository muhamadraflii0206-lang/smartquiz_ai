-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 30 Apr 2026 pada 13.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartquiz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `kode_quiz` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `user_id`, `skor`, `tanggal`, `kode_quiz`) VALUES
(1, 6, 100, '2026-04-19 21:28:30', NULL),
(2, 7, 90, '2026-04-19 22:05:36', NULL),
(3, 8, 20, '2026-04-21 04:39:50', NULL),
(4, 10, 4, '2026-04-26 23:16:16', '481079'),
(5, 12, 3, '2026-04-30 10:01:45', '481079'),
(6, 12, 0, '2026-04-30 10:15:03', 'A562E2'),
(8, 13, 3, '2026-04-30 11:01:29', '7F76CB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `opsi` text NOT NULL,
  `jawaban` varchar(10) NOT NULL,
  `level` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT 0,
  `kode_quiz` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id`, `pertanyaan`, `opsi`, `jawaban`, `level`, `user_id`, `aktif`, `kode_quiz`, `created_at`) VALUES
(78, 'Apa pengertian dari database?', 'sistem yang digunakan untuk menyimpan dan mengelola data|metode umum dalam teknologi|alat dalam sistem komputer|proses yang tidak berkaitan dengan database', 'A', 'hard', 4, 1, NULL, '2026-04-28 12:50:05'),
(79, 'Apa pengertian dari dbms?', 'proses yang tidak berkaitan dengan dbms|perangkat lunak yang digunakan untuk mengelola database|alat dalam sistem komputer|metode umum dalam teknologi', 'B', 'easy', 4, 1, NULL, '2026-04-28 12:50:05'),
(80, 'Apa pengertian dari tabel?', 'struktur dalam database yang terdiri dari baris dan kolom|metode umum dalam teknologi|alat dalam sistem komputer|proses yang tidak berkaitan dengan tabel', 'A', 'medium', 4, 1, NULL, '2026-04-28 12:50:05'),
(81, 'Apa pengertian dari primary key?', 'metode umum dalam teknologi|atribut yang digunakan untuk membedakan setiap data dalam tabel|alat dalam sistem komputer|proses yang tidak berkaitan dengan primary key', 'B', 'easy', 4, 1, NULL, '2026-04-28 12:50:05'),
(82, 'Apa pengertian dari normalisasi?', 'proses yang tidak berkaitan dengan normalisasi|alat dalam sistem komputer|metode umum dalam teknologi|proses untuk mengurangi redundansi data dalam database', 'D', 'easy', 4, 1, NULL, '2026-04-28 12:50:05'),
(83, 'Apa pengertian dari sql?', 'proses yang tidak berkaitan dengan sql|metode umum dalam teknologi|bahasa yang digunakan untuk mengakses dan mengelola database|alat dalam sistem komputer', 'C', 'hard', 4, 1, NULL, '2026-04-28 12:50:05'),
(84, 'Apa pengertian dari relasi?', 'alat dalam sistem komputer|metode umum dalam teknologi|hubungan antara tabel dalam database|proses yang tidak berkaitan dengan relasi', 'C', 'hard', 4, 1, NULL, '2026-04-28 12:50:05'),
(85, 'Apa pengertian dari field?', 'proses yang tidak berkaitan dengan field|alat dalam sistem komputer|metode umum dalam teknologi|bagian terkecil dari tabel yang menyimpan data', 'D', 'easy', 4, 1, NULL, '2026-04-28 12:50:05'),
(86, 'Apa pengertian dari record?', 'metode umum dalam teknologi|proses yang tidak berkaitan dengan record|kumpulan field yang membentuk satu data utuh|alat dalam sistem komputer', 'C', 'hard', 4, 1, NULL, '2026-04-28 12:50:05'),
(87, 'Apa pengertian dari index?', 'metode umum dalam teknologi|struktur yang digunakan untuk mempercepat pencarian data|alat dalam sistem komputer|proses yang tidak berkaitan dengan index', 'B', 'easy', 4, 1, NULL, '2026-04-28 12:50:05'),
(88, 'Apa yang dimaksud dengan Imajinasi Sosiologi?', 'Kemampuan untuk memunculkan gagasan kreatif dalam studi sosiologi.|Kemampuan untuk memahami hubungan antara biografi pribadi dan sejarah masyarakat dalam skala yang lebih luas.|Kemampuan untuk mengkritisi teori-teori sosiologi yang sudah ada.|Kemampuan untuk mengadopsi semua pandangan sosiologis tanpa penolakan.', 'A', 'medium', 9, 0, '481079', '2026-04-28 12:50:05'),
(89, 'Apa yang dengan Sosiologi?', 'ilmu yang mempelajari struktur masyarakat dan dinamika interaksi sosial antarmanusia.|Kemampuan individu untuk mengontrol orang lain dalam kelompok sosialnya.|Kemampuan individu untuk berinteraksi dengan kelompok sosial.|Kemampuan individu untuk merasa nyaman dalam status sosialnya.', 'A', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(91, 'Apa yang dimaksud dengan solidaritas mekanik menurut Emile Durkheim?', 'Berasal dari pembagian kerja yang kompleks dalam masyarakat modern.|Didasarkan pada kesamaan atau keseragaman di masyarakat tradisional.|Dibangun melalui hubungan impersonal di masyarakat modern.|Merupakan bentuk solidaritas moral dalam masyarakat agraris.', 'B', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(92, 'Apa yang dimaksud dengan konformitas dalam sosiologi?', 'Tindakan melanggar norma yang ditetapkan oleh kelompok.|Tindakan mengikuti norma kelompok untuk diterima dan menghindari penolakan.|Tindakan memberontak terhadap struktur sosial.|Tindakan menciptakan norma baru dalam kelompok sosial.', 'B', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(93, 'Apa dampak positif dari globalisasi dalam masyarakat?', 'Penjagaan identitas budaya lokal.|Pertumbuhan isolasionisme dalam suatu negara.|Pertukaran ilmu pengetahuan dan budaya antarnegara.|Pemisahan antarbangsa lebih jelas.', 'C', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(94, 'Apa yang dimaksud dengan mobilitas sosial vertikal?', 'Pergerakan individu atau kelompok dari satu lapisan sosial ke lapisan sosial lain dalam struktur yang sama.|Pergerakan individu atau kelompok dari satu negara ke negara lain.|Pergerakan individu yang tetap berada di lapisan sosial yang sama sepanjang hidupnya.|Pergerakan individu atau kelompok ke berbagai lapisan sosial dalam waktu yang singkat.', 'A', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(95, 'Bagaimana konsep stratifikasi sosial memengaruhi kesehataan dan kesejahteraan individu dalam masyarakat?', 'Memastikan kesetaraan akses terhadap sumber daya bagi setiap individu.|Membuat kesuksesan hanya tergantung pada kerja keras individu.|Menyebabkan ketidakseimbangan akses terhadap sumber daya dan kesempatan hidup.|Hanya memengaruhi pendidikan individu dalam masyarakat.', 'C', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(96, 'Apakah dampak negatif dari perubahan sosial dalam masyarakat?', 'Meningkatkan keberagaman budaya lokal.|Memperkuat institusi sosial yang sudah ada.|Membawa stagnasi kehidupan sosial.|Menyebabkan ketidakpastian dan ketegangan antar kelompok.', 'D', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(97, 'Apa peran institusi sosial dalam masyarakat?', 'Memberikan kerangka untuk membangun norma dan nilai sosial.|Membatasi kebebasan individu dalam berinteraksi dengan lingkungan sosial.|Menyebabkan konflik antar kelompok dalam masyarakat.|Hanya ada untuk menopang status quo yang ada.', 'A', 'medium', 9, 1, '481079', '2026-04-28 12:50:05'),
(98, 'Apa yang menjadi dasar dalam pengambilan keputusan rasional bagi individu dalam ekonomi?', 'Biaya produksi|Biaya peluang|Resesi ekonomi|Inflasi yang tinggi', 'B', 'easy', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(99, 'Apa yang menyebabkan harga barang akan cenderung bergerak naik atau turun secara dinamis?', 'Permintaan yang rendah|Inflasi yang stabil|Gangguan pada sisi permintaan atau penawaran|Penurunan biaya produksi', 'C', 'medium', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(100, 'Inflasi yang rendah dan stabil dibutuhkan untuk mendorong pertumbuhan ekonomi karena menandakan adanya aktivitas konsumsi yang ______.', 'Tinggi|Sehat|Rendah|Stagnan', 'B', 'easy', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(101, 'Prinsip utilitas marjinal menjelaskan bahwa kepuasan tambahan dari mengonsumsi satu unit barang tambahan akan cenderung ______ seiring waktu.', 'Tetap|Meningkat|Menurun|Stabil', 'C', 'medium', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(102, 'Dalam pasar monopoli, produsen memiliki kekuatan besar untuk menentukan ______ karena tidak adanya pesaing yang sebanding.', 'Harga|Kualitas produk|Biaya produksi|Permintaan pasar', 'A', 'easy', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(104, 'Keuangan publik adalah bidang ekonomi yang mempelajari bagaimana pemerintah memperoleh ______.', 'Utang negara|Pendapatan|Investasi|Subsidi', 'B', 'easy', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(105, 'Pajak memiliki fungsi sebagai alat redistribusi kekayaan untuk mengurangi kesenjangan sosial di tengah masyarakat yang ______.', 'Heterogen|Homogen|Stabil|Kompak', 'A', 'medium', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(106, 'Kebijakan fiskal diambil pemerintah untuk memengaruhi perekonomian melalui perubahan ______ dan tarif pajak.', 'Suku bunga|Pengangguran|Belanja negara|Ketimpangan sosial', 'C', 'easy', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(107, 'Anggaran Pendapatan dan Belanja Negara (APBN) merupakan dokumen resmi yang mencerminkan prioritas pembangunan suatu pemerintahan setiap tahunnya, yang menunjukkan apakah pemerintah lebih memprioritaskan ______.', 'Kesejahteraan sosial|Pertumbuhan ekonomi|Ketertiban sosial|Pertumbuhan populasi', 'A', 'medium', 9, 1, 'E621BF', '2026-04-28 12:50:05'),
(108, 'Apa yang dimaksud dengan global warming?', 'Fenomena pemanasan global akibat peningkatan gas rumah kaca|Fenomena penurunan suhu global akibat polusi udara|Fenomena pencahayaan global akibat kerusakan ozon|Fenomena kelangkaan air bersih akibat deforestasi', 'A', 'easy', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(109, 'Berikut adalah contoh tindakan mengurangi emisi gas rumah kaca, KECUALI:', 'Menggunakan kendaraan bermotor yang ramah lingkungan|Menanam lebih banyak pohon|Mengurangi konsumsi listrik yang berlebihan|Meningkatkan produksi industri yang banyak menghasilkan polusi', 'D', 'medium', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(110, 'Apa yang menjadi penyebab utama terjadinya polusi udara?', 'Emisi dari kendaraan bermotor dan pabrik-pabrik|Penebangan hutan secara liar|Pemanasan global yang meningkat|Produksi limbah industri yang tidak terkelola dengan baik', 'A', 'easy', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(111, 'Apakah dampak dari deforestasi terhadap lingkungan?', 'Menurunnya suhu global|Kekurangan oksigen|Peningkatan keanekaragaman hayati|Peningkatan hasil pertanian', 'B', 'medium', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(112, 'Bagaimana cara mengurangi penggunaan plastik secara efektif?', 'Menggunakan kantong plastik sekali pakai|Membuang sampah plastik sembarangan|Menggunakan botol air minum reusable|Membakar sampah plastik di halaman rumah', 'C', 'easy', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(113, 'Apa yang dimaksud dengan daur ulang?', 'Proses pengelolaan sampah untuk dijadikan barang baru|Proses pembakaran sampah tanpa meninggalkan asap|Proses penanaman kembali pohon yang ditebang|Proses penanganan limbah industri berbahaya', 'A', 'easy', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(114, 'Fungsi hutan hujan bagi lingkungan adalah...', 'Sebagai penghasil udara bersih|Sebagai tempat tinggal manusia|Sebagai sumber air minum|Sebagai tempat pembuangan limbah', 'C', 'medium', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(115, 'Apa yang menjadi penyebab terjadinya kebakaran hutan?', 'Penebangan hutan secara liar|Hujan deras yang terus-menerus|Ketinggian suhu udara yang rendah|Penanaman kembali hutan secara masif', 'A', 'medium', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(116, 'Mengapa perlu menjaga keberagaman hayati di dunia?', 'Untuk menjamin keberlanjutan sumber daya alam|Untuk mengurangi populasi hewan liar|Agar manusia memiliki dominasi penuh atas ekosistem|Agar tanaman budidaya bisa berkembang lebih baik', 'A', 'medium', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(117, 'Apa dampak negatif dari pencemaran air?', 'Menjadi sumber air minum yang sehat|Meningkatkan keberagaman hayati di perairan|Mengganggu kesehatan manusia dan hewan|Meningkatkan pertumbuhan alga', 'C', 'easy', 9, 1, 'A562E2', '2026-04-28 12:50:05'),
(118, 'Apa yang dimaksud dengan kernel dalam arsitektur Linux?', 'Antarmuka baris perintah yang menerjemahkan instruksi pengguna ke kernel.|Jantung sistem operasi yang mengelola komunikasi antara perangkat keras dan aplikasi.|Lapisan pustaka dan utilitas sistem yang memungkinkan perangkat lunak berfungsi.|Lingkungan desktop untuk interaksi visual pengguna.', 'B', 'medium', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(119, 'Manakah perintah yang digunakan untuk membuat direktori baru di Linux?', 'ls|cd|touch|mkdir', 'D', 'easy', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(120, 'Apa kelebihan Linux dalam manajemen paket perangkat lunak?', 'Menggunakan installer dari situs web sembarang.|Tidak memperhitungkan ketergantungan perangkat lunak.|Menggunakan manajer paket yang terhubung ke repositori resmi.|Memungkinkan proses pembaruan sistem secara manual.', 'C', 'medium', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(121, 'Apa keuntungan menggunakan Command Line Interface (CLI) di Linux?', 'Memiliki antarmuka visual yang lebih menarik.|Memberikan kemampuan otomatisasi melalui scripting.|Memudahkan pengguna untuk melakukan tugas administratif.|Meningkatkan penggunaan sumber daya komputer.', 'B', 'medium', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(122, 'Apa yang menyebabkan Linux cocok digunakan sebagai server atau infrastruktur cloud?', 'Kekurangan alat diagnosa jaringan yang canggih.|Tidak dapat berjalan tanpa antarmuka grafis (headless).|Efisiensi penggunaan sumber daya dan kemampuan berjalan di latar belakang.|Keterbatasan dalam konfigurasi sistem secara teks.', 'C', 'hard', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(123, 'Manakah alat pemrograman yang memiliki dukungan kelas satu di Linux?', 'Java|Ruby|C++|Swift', 'C', 'medium', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(124, 'Apa yang dimaksud dengan Distro dalam konteks Linux?', 'Perangkat keras tambahan yang sering digunakan.|Distribusi Linux yang dibuat oleh berbagai organisasi.|Protokol komunikasi antar server dalam jaringan.|Manajer paket untuk menginstal aplikasi di Linux.', 'B', 'easy', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(125, 'Mengapa keamanan Linux bergantung pada model pengembangan yang transparan?', 'Mengurangi ketergantungan atas perangkat lunak tertutup.|Mempercepat penemuan dan perbaikan celah keamanan.|Membatasi akses program ke sumber daya sistem.|Memastikan ketergantungan perangkat lunak terpenuhi secara otomatis.', 'B', 'hard', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(126, 'Apa keuntungan menggunakan editor teks seperti Nano atau Vim dalam konfigurasi sistem Linux?', 'Memastikan konfigurasi sistem disimpan dalam cloud.|Memudahkan backup dan manajemen konfigurasi.|Mengurangi fitur otomatisasi dalam pengaturan.|Membatasi akses administrator ke direktori /etc.', 'B', 'medium', 9, 1, '7F76CB', '2026-04-30 10:56:14'),
(127, 'Apakah keuntungan Linux dalam dunia pengembangan IoT?', 'Dimungkinkannya untuk berjalan di perangkat kecil seperti router Wi-Fi.|Kemampuannya dalam memainkan game secara online.|Banyaknya aplikasi kantor yang dapat dijalankan.|Tidak memiliki dukungan bahasa pemrograman yang lengkap.', 'A', 'hard', 9, 1, '7F76CB', '2026-04-30 10:56:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'dosen', 'dosen123', 'dosen'),
(3, 'mahasiswa', 'mhs123', 'mahasiswa'),
(4, 'dosen-a', 'dosen123', 'dosen'),
(5, 'dosen-b', 'dosen-b', 'dosen'),
(6, 'rafli', 'rafli1', 'mahasiswa'),
(7, 'syafiq', 'syafiq33', 'mahasiswa'),
(8, 'rafli', '123', 'mahasiswa'),
(9, 'Yuni Kurniasih', 'Sosiologi Smada', 'dosen'),
(10, 'Lintang Juwita', 'Juwita334', 'mahasiswa'),
(11, 'ninis', 'ekonomi id', 'dosen'),
(12, 'Muhamad Rafli', 'rflyvv', 'mahasiswa'),
(13, 'mario', 'mario774', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
