@extends('layouts.app')

@section('content')
    {{-- Bagian utama konten dengan ID 'home-content' yang terbungkus dalam kontainer --}}
    <section id="home-content" class="container">
        <div class="my-5">
            {{-- Baris header dengan judul "About AYOTI" --}}
            <div class="align-items-center d-flex justify-content-between mt-5 mb-5">
                <h3>About ayoti</h3>
            </div>

            {{-- Deskripsi tentang platform AYOTI --}}
            <div>
                {{-- Paragraf pertama menjelaskan visi dan tujuan dari AYOTI --}}
                <p>
                    AYOTI adalah sebuah platform e-commerce inovatif yang mengkhususkan diri dalam menyediakan berbagai produk terbaru dan terbaik dalam dunia Internet of Things (IoT). Kami memahami bahwa teknologi IoT telah mengubah cara kita berinteraksi dengan perangkat di sekitar kita, dan AYOTI hadir untuk membawa solusi cerdas dan terhubung kepada masyarakat luas. Sebagai pengecer terkemuka dalam bidang IoT, kami menawarkan berbagai produk yang dapat meningkatkan kualitas hidup Anda, mulai dari perangkat rumah pintar, perangkat wearable, hingga solusi IoT untuk bisnis dan industri.
                </p>

                {{-- Paragraf kedua menjelaskan komitmen AYOTI untuk menyediakan pengalaman berbelanja yang menyenangkan --}}
                <p>
                    Di AYOTI, kami berkomitmen untuk memberikan pengalaman berbelanja yang mudah dan menyenangkan. Kami menawarkan berbagai pilihan produk berkualitas tinggi dengan harga yang kompetitif, serta dukungan pelanggan yang responsif dan terpercaya. Setiap produk yang kami jual telah melalui proses seleksi yang ketat, sehingga Anda bisa yakin mendapatkan perangkat yang tidak hanya canggih, tetapi juga aman dan efisien. Kami bekerja sama dengan berbagai merek terkemuka di industri IoT untuk memastikan setiap item yang tersedia di platform kami memenuhi standar teknologi dan kualitas tertinggi.
                </p>

                {{-- Paragraf ketiga menjelaskan visi perusahaan untuk menjadi pusat belanja utama bagi penggemar teknologi --}}
                <p>
                    Visi kami adalah menjadi pusat belanja utama bagi para penggemar teknologi yang ingin menjelajahi dunia IoT dengan lebih mudah. Dengan berbagai kategori produk yang kami tawarkan, Anda dapat menemukan solusi IoT yang tepat untuk kebutuhan pribadi maupun profesional. Kami juga memahami pentingnya inovasi dalam dunia yang terus berkembang ini, oleh karena itu kami selalu berusaha memperbarui koleksi produk kami dengan teknologi terbaru dan terbaik.
                </p>

                {{-- Paragraf keempat mengungkapkan fokus AYOTI pada edukasi dan pemberdayaan pelanggan --}}
                <p>
                    Selain itu, AYOTI juga berfokus pada edukasi dan pemberdayaan pelanggan kami. Kami tidak hanya menjual produk, tetapi juga memberikan informasi dan panduan yang dibutuhkan untuk memaksimalkan penggunaan teknologi IoT. Di situs kami, Anda akan menemukan artikel, tutorial, dan ulasan tentang berbagai produk, sehingga Anda dapat membuat keputusan yang lebih baik dan lebih cerdas dalam memilih produk yang sesuai dengan kebutuhan Anda.
                </p>

                {{-- Paragraf terakhir menyampaikan rasa terima kasih dan komitmen AYOTI untuk terus berinovasi --}}
                <p>
                    Kami berterima kasih atas kepercayaan yang telah diberikan oleh pelanggan kami dan berkomitmen untuk terus berinovasi dan meningkatkan kualitas layanan kami. Di AYOTI, kami percaya bahwa teknologi IoT memiliki potensi besar untuk membuat kehidupan lebih mudah, efisien, dan terhubung. Kami siap menjadi mitra Anda dalam perjalanan menuju dunia yang lebih pintar dan lebih terhubung. Terima kasih telah memilih AYOTI sebagai tujuan belanja IoT Anda!
                </p>
            </div>
        </div>
    </section>
@endsection
