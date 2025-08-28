<template>

    <Head>
        <title>Member Area − LetStudy</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0 mb-2">
                            Member Area
                        </h1>
                        <p class="fs-4 text-gray-600 m-0">Selamat datang {{ $page . props . auth . user . name }}, mau belajar apa hari ini studemates?</p>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid pb-12">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="bg-gradient-myprimary rounded-4 p-8 p-md-14 position-relative mb-7">
                        <p class="text-white fw-semibold fs-4 mb-2" style="letter-spacing: 0.04em;">
                            #YOURSTUDYPARTNER
                        </p>
                        <h2 class="text-white lh-sm fs-3x fw-bold mb-4 mb-md-6">
                            LetStudy Teman Belajar Tanpa Batas
                        </h2> 
                        <p class="text-white fs-4 mb-0 opacity-75">
                            Belajar tidak seharusnya terasa sendiri. Bersama LetStudy, kamu punya partner yang selalu siap menemani perjalanan akademik dan pengembangan diri. Mulai dari persiapan ujian masuk PTN, persiapan tes kecakapan berbahasa Inggris, persiapan beasiswa + kuliah ke luar negeri, hingga persiapan karir kamu yang super lengkap untuk membangun masa depan, LetStudy hadir sebagai #YourStudyPartner yang memahami kebutuhanmu. Kami percaya setiap orang berhak mendapatkan akses belajar yang mudah, relevan, dan gratis. Dengan dukungan tutor, komunitas, dan materi terkurasi, LetStudy menjadi ruang belajar inklusif tempat kamu bisa bertumbuh tanpa batas. Melalui optimalisasi ekonomi syariah, LetStudy semakin mampu mewujudkan pendidikan gratis yang lebih merata dan berkeadilan.
                        </p>
                    </div>

                    <div class="row g-6">
                        <div class="col-12 col-md-4">
                            <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                                <div class="d-flex rounded bg-mysecondary mb-7">
                                    <i class="p-6 fs-2tx text-mysecondary ri-book-open-fill"></i>
                                </div>
                                <h2 class="text-dark lh-sm fs-2tx mb-5">E-Book</h2>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Koleksi eBook (Kitab Sakti) TERKURASI sesuai kebutuhan-mu!
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Bahan belajar dibuat oleh tutor yang ahli di bidangnya.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Bisa diakses kapan saja dan di mana saja. 
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Ringkas, relevan, dan paket komplit untuk menunjang belajar-mu!
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Dilengkapi dengan materi pembelajaran, video belajar, latihan soal, serta tips and trick yang memenuhi seluruh metode belajar-mu!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                                <div class="d-flex rounded bg-mywarning-light mb-7">
                                    <i class="p-6 fs-2tx text-mywarning ri-survey-fill"></i>
                                </div>
                                <h2 class="text-dark lh-sm fs-2tx mb-5">Tryout</h2>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Tryout online dengan soal HOTS dan pastinya terkini. 
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Dilengkapi dengan video pembahasan soal yang bantu kamu makin PAHAM! 
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Bantu kamu analisis langsung untuk mengetahui kekuatan dan kelemahan belajar.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Bantu meningkatkan kepercayaan diri sebelum ujian.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Skoring real-time dan bisa tracking perkembangan belajar melalui fitur rangking!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                                <div class="d-flex rounded bg-mydanger-light mb-7">
                                    <i class="p-6 fs-2tx text-mydanger ri-folder-video-fill"></i>
                                </div>
                                <h2 class="text-dark lh-sm fs-2tx mb-5">Playlist</h2>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mydanger ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Video pembelajaran dengan materi yang SUPER LENGKAP dan sesuai kebutuhan-mu!
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mydanger ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Dibuat terstruktur agar proses belajar-mu lebih fokus dan bisa praktik langsung.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mydanger ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Bantu kamu memahami lebih dalam setelah membaca materi di eBook.
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mydanger ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-5 mb-0">
                                            Kamu juga bisa memilih topik materi yang kamu rasa ingin memahami lebih dalam agar sesuai dengan minat & target belajar-mu!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutUser from '../../../Layouts/User.vue';
    import {
        Head,
        Link
    } from '@inertiajs/vue3';

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link
        },
    };
</script>
