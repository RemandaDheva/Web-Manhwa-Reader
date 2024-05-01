-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Bulan Mei 2024 pada 16.17
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtoonz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_webtoon` int(11) DEFAULT NULL,
  `waktu_tambah` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `favorit`
--

INSERT INTO `favorit` (`id_favorit`, `id_user`, `id_webtoon`, `waktu_tambah`) VALUES
(33, 3, 3, '2024-04-15 22:48:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `username`, `email`, `password`, `level`) VALUES
(1, 'remanda', 'remanda@gmail.com', '12345678', 'user'),
(3, 'dokja', 'kimcom@angst.com', 'cumi', 'user'),
(4, 'webtoonz', 'webtoonz24@gmail.com', 'web22', 'admin'),
(5, 'manda', 'manda@gmail.com', 'jungkook', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `webtoon`
--

CREATE TABLE `webtoon` (
  `id_webtoon` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `sinopsis` varchar(10000) NOT NULL,
  `nama_gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `webtoon`
--

INSERT INTO `webtoon` (`id_webtoon`, `judul`, `genre`, `penulis`, `gambar`, `penerbit`, `sinopsis`, `nama_gambar`) VALUES
(1, 'The Villiness is a Marionette', 'Fantasi', 'manggle', 'manggle', 'Yeondam X Polarfox', 'Cayena dipuji sebagai wanita tercantik di kekaisaran, tetapi dia tidak bisa apa-apa selain melakukan hal jahat. Cayena dimanfaatkan oleh adiknya yang merupakan seorang tiran untuk menjadi kaisar, dibunuh oleh suaminya yang gila dan menemui akhir yang pantas untuk seorang antagonis.... Aku menjadi Putri Cayena yang seperti itu. \"Aku akan membuatmu menjadi kaisar.\" \"...Maksud kakak, aku?\" \"Sebagai gantinya, berikan aku kebebasan.\" Mawar dengan duri beracun, kecantikan yang memanggil kematian.', '1.PNG'),
(2, 'I Don\'t Trust My Twin', 'Fantasi', 'Gwat', 'Gwat', 'DCC Ent', 'Wanita yang paling sukses di kekaisaran, tapi dia dikhianati oleh orang-orang yang dicintainya. Dia bekerja siang dan malam untuk melindungi saudari kembarnya yang lemah, tapi ternyata semua itu hanya kebohongan. Dib belakang, saudari kembarnya mengkhianati dia dan bekerja sama dengan tunangannya. Setelah merasakan rasa sakit yang tiada tara itu, dia membuka pintu yang diberi tahu oleh sang kakek. Tanpa disangka, dia kembali ke masa lalu!', '2.PNG'),
(3, 'Kill the Villainess', 'Fantasi', 'Haegi', 'Haegi', 'D&C MEDIA', 'Aku bereinkarnasi dalam sebuah novel di dalam tubuh seorang antagonis bernama Eris. Aku memiliki seorang tunangan yaitu Putra Mahkota namun menyukai teman kecilku sendiri pelayan Helena dan akan menikahinya di masa depan. Mengetahui semua hal yang ada di dunia ini, aku hanya punya satu tujuan. Yaitu kembali ke tempatku berasal dan keluar dari dunia novel ini. Banyak cara yang telah kulakukan untuk bisa mati berharap dapat kembali ke duniaku dengan itu, namun kausal dunia ini tidak mengizinkan. Aku terus berusaha mencari tahu cara agar aku dapat kembali dengan menemui orang-orang yang penting dan melakukan segala hal yang kubisa.\r\n\r\nNamun aku tetap tidak menyukai tempat ini meski waktu sudah berlalu. Aku tidak pernah yakin dapat mencintai dunia ini.', '3.PNG'),
(4, 'Spring\'s Espresso', 'Romansa', 'GwonDohee', 'GwonDohee', 'CARROTOON', 'Setelah menutup cafe yang selama 9 tahun ia kelola, Bomsol akhirnya memutuskan untuk mencari pekerjaan.\r\n\r\nI bekerja di bawah barista pria terkenal di dunia yang handal namun galak bernama Jake. Tapi, wajahnya seperti tidak asing.\r\n\r\nPertama kalinya bekerja di bawah orang lain, apakah bomsol bisa melakukannya dengan baik?\r\n\r\n\"Bukankah ini sudah waktunya untuk ingat? Cafe Spring, Pelanggan tetap, anak SMA.\"', '4.PNG'),
(5, 'Boutique at 97th Sheldon Street', 'Romansa', 'Young Hyeon', 'Young Hyeon', 'Kidari Studio', 'Setelah tersadar kembali, ternyata Yueun telah masuk ke dunia game! Tidak bisa log out! Tidak ada juga inventory! Yang bisa dirinya lakukan hanyalah membuat pakaian?! Yueun yang merasa putus asa karena tempat survival game itu menjadi realita, akhirnya pergi ke butik di jalan Sheldon untuk mencoba bertahan hidup. Namun dalam perjalanannya dia bertemu dengan bangsawan misterius bernama Ashton. Lelaki itu memberinya bantuan seolah dia telah menantikan kedatangannya, tidakkah itu sangat misterius?', '5.PNG'),
(6, 'Wanna Be a Star', 'Romansa', 'Hyeonsook', 'Hyeonsook', 'DAEWOON C.I Inc', 'Lee So punya paras yang cantik, tapi dengan tubuhnya yang tinggi dan pundak yang lebar seperti pria, dunia entertainment tidak kunjung mendebutkannya menjadi anggota girl group. Selama 8 tahun menjadi trainee, dia hanya bisa menatap pahit trainee lain yang belum lama menjadi trainee, tapi sudah debut lebih dulu dan menjadi bintang terkenal. Hanya Yujin, idol favoritnya yang menjadi pegangan hidupnya. Begitu mendengar Yujin ingin didebutkan dalam group baru, Lee So pun meminjam identitas adik kembarnya untuk ikut audisi yang sama...!', '6.PNG'),
(7, 'Ranker yang Hidup Dua Kali', 'Aksi', 'Sadoyeon', 'NongNong', 'Dreamtoon', 'Setelah 5 tahun hilang, Cha Yeonwoo menemukan bahwa adiknya, Cha Jungwoo, sudah meninggal. Saat membongkar barang peninggalan adiknya, dia menemukan sebuah jam saku. Begitu membuka jam tersebut, Cha Yeonwoo mendengar suara adiknya yang menceritakan kehidupannya selama 5 tahun ini. Ternyata Cha Jungwoo bukan hilang melainkan terdampar di dunia lain. Di dunia itu pula Cha Jungwoo dikhianati dan dibunuh. Berhasilkah Cha Yeonwoo balas dendam?!', '7.PNG'),
(8, 'Return of the 8th Class Magician', 'Aksi', 'Ryu Song', 'Tess', 'graycompany', 'Aku telah membiarkan darah menempel di tanganku selama puluhan tahun demi kaisar ragnar dan kekaisaran bersatu.\r\n\r\nTapi,\r\n\r\n\"Kau adalah penyihir agung class 8 yang bisa melahapku dan kekaisaranku kapan pun.\"\r\n\r\n\"Bagaimana mungkin aku membiarkan monster seperti itu tetap hidup?\"\r\n\r\nAku dikhianati oleh teman sekaligus tuan-ku ragnar. Dan tepat sebelum aku mati, aku menusukkan pisau belati yang sudah diberi mantra sihir waktu ke jantungku. Akhirnya aku berhasil kembali ke 30 tahun yang lalu.', '8.PNG'),
(9, 'SSS-Class Revival Hunter', 'Aksi', 'Neida', 'Bill K', 'Fansia', 'Sebuah menara tiba-tiba muncul di dunia. Dari sisi mana pun di bumi, menara tersebut tetap terlihat menembus horizon. Berbagai monster memenuhi tiap lantai yang ada di menara itu. Orang yang masuk dalam menara itu ternyata bisa mendapatkan skill!\r\n\r\n\"Tapi aku hunter kelas F yang tidak punya skill, aku juga mau skill kelas S!\"\r\n\r\n\"Akhirnya kemunculan skill-ku datang juga?\"\r\n\r\n[BISA MENDUPLIKASI SKILL ORANG YANG MEMBUNUHMU, HANYA TERAKTIVASI KETIKA KAMU MATI]\r\n\r\n\"Skill ini... Apa gunanya skill semacam ini?!\"', '9.PNG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id_favorit`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `webtoon`
--
ALTER TABLE `webtoon`
  ADD PRIMARY KEY (`id_webtoon`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id_favorit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `webtoon`
--
ALTER TABLE `webtoon`
  MODIFY `id_webtoon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
