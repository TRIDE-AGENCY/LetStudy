<template>
    <Head>
        <title>Tentang LetStudy</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div id="home" class="bg-white">
                <Navbar />
                <div class="container py-10 py-md-20">
                    <div class="row g-10 justify-content-center justify-content-lg-start">
                        <div class="col-12 col-lg-6 mw-600px mw-md-700px align-self-center">
                            <p class="text-center text-lg-start text-gray-600 fs-5 text-myprimary fw-bold mb-3"
                                style="letter-spacing: 0.04em;">
                                #YOURSTUDYPARTNER
                            </p>
                            <h1 class="text-center text-lg-start text-dark lh-sm fw-bold fs-3hx mb-6">
                                Tentang Kami
                            </h1>
                            <p class="text-center text-lg-start me-lg-10 text-gray-600 fs-4 mb-0">
                                {{ profile.about }}
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 mw-500px mw-lg-100 align-self-center">
                            <div class="ratio ratio-16x9 mt-md-5 mt-lg-0">
                                <iframe class="w-100 h-100 rounded-4"
                                    src="https://www.youtube.com/embed/zjxMuoWKDc0"
                                    title="YouTube video"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="products" class="container d-flex flex-column pt-20 mt-20">
                <div class="row g-6 justify-content-center">
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card card-hover align-self-center flex-column justify-content-between h-100 p-8 gap-8 rounded-4 border border-gray-300">
                            <div class="d-flex flex-column align-items-center">
                                <img class="w-175px mb-6" src="/assets/media/logos/logo-letstudy-ptn.png" alt="LetStudy PTN">
                                <p class="text-center text-gray-600 fs-5 mb-0">
                                    LetStudy PTN, sebagai layanan yang sangat dibutuhkan oleh siswa SMA dan sederajat dalam progres belajarnya sehari hari untuk persiapan melanjutkan pendidikan mereka di universitas negeri. Dengan menyediakan bahan belajar gratis berkualitas, akan membantu persiapan siswa menghadapi ujian sehari-hari di sekolahnya dan ujian masuk perguruan tinggi. Layanan ini memastikan bahwa siswa memiliki semua sumber daya yang mereka butuhkan untuk berhasil memiliki prestasi akademik yang gemilang.
                                </p>
                            </div>
                            <a href="/letstudy-ptn" class="btn btn-sm btn-myprimary fs-5 d-inline-flex gap-2 align-items-center justify-content-center">
                                <i class="ri-graduation-cap-line fs-3"></i>
                                <span>Lihat Produk</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card card-hover align-self-center flex-column justify-content-between h-100 p-8 gap-8 rounded-4 border border-gray-300">
                            <div class="d-flex flex-column align-items-center">
                                <img class="w-175px mb-6" src="/assets/media/logos/logo-letstudy-english.png" alt="LetStudy English">
                                <p class="text-center text-gray-600 fs-5 mb-0">
                                    LetStudy English memenuhi kebutuhan pada era global saat ini. Dengan fokus pada peningkatan kemampuan bahasa Inggris pelajar bertujuan untuk membuka banyak pintu kesempatan, dari pendidikan lebih lanjut di luar negeri hingga karier global.  LetStudy English menyediakan akses ke materi pembelajaran grammar, TOEFL, dan IELTS yang memungkinkan pengguna untuk meningkatkan kemampuan bahasa Inggris mereka secara efektif dan efisien.
                                </p>
                            </div>
                            <a href="/letstudy-english" class="btn btn-sm btn-myprimary fs-5 d-inline-flex gap-2 align-items-center justify-content-center">
                                <i class="ri-translate-2 fs-3"></i>
                                <span>Lihat Produk</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card card-hover align-self-center flex-column justify-content-between h-100 p-8 gap-8 rounded-4 border border-gray-300">
                            <div class="d-flex flex-column align-items-center">
                                <img class="w-175px mb-6" src="/assets/media/logos/logo-letstudy-karier.png" alt="LetStudy Karier">
                                <p class="text-center text-gray-600 fs-5 mb-0">
                                    LetStudy Karier bertujuan untuk membantu mahasiswa akhir dan fresh graduate dengan keterampilan yang dibutuhkan untuk memasuki dunia kerja. Mengakui bahwa transisi dari pendidikan formal ke lingkungan profesional bisa menjadi tantangan. Layanan ini menyediakan panduan, tips, dan strategi untuk tidak hanya bertahan, tetapi juga unggul dalam karier. Selain itu, pengguna dapat meningkatkan skill mereka untuk mempersiapkan generasi muda menghadapi persaingan di pasar kerja.
                                </p>
                            </div>
                            <a href="/letstudy-karier" class="btn btn-sm btn-myprimary fs-5 d-inline-flex gap-2 align-items-center justify-content-center">
                                <i class="ri-briefcase-line fs-3"></i>
                                <span>Lihat Produk</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="statements" class="container d-flex pt-20 mt-20">
                <div class="bg-gradient-myprimary w-100 rounded-4 p-10 p-md-16 position-relative">
                    <h2 class="text-white lh-sm fs-2tx fw-bold mb-0">
                        Dengan komitmen ini, LetStudy menjadi salah satu pilar dalam mewujudkan Visi dan Misi Indonesia Emas 2045
                    </h2>
                </div>
            </div>
            <div id="background" class="container d-flex flex-column pt-20 mt-20">
                <div class="row g-10 align-items-center">
                    <div class="col-12 col-md-6">
                        <p class="fs-5 text-myprimary fw-bold mb-3"
                            style="letter-spacing: 0.04em;">
                            LATAR BELAKANG
                        </p>
                        <h1 class="text-dark lh-sm fw-bold fs-3hx mb-6">
                            Mengapa LetStudy Hadir
                        </h1>
                        <p class="text-gray-600 fs-4 mb-0">
                            Struktur sosial-ekonomi yang tidak merata di masyarakat membuat keluarga miskin lebih sulit untuk mengakses pendidikan yang berkualitas dan memiliki kesempatan belajar yang lebih rendah daripada rekan-rekan mereka yang berasal dari keluarga berpenghasilan menengah ke atas.
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="h-100">
                            <div class="position-relative h-300px">
                                <canvas id="bgChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row gap-6 mt-10">
                    <div class="card p-8 align-items-start rounded-4 border border-gray-300">
                        <div class="d-flex rounded bg-mysecondary mb-7">
                            <i class="p-6 fs-2tx text-mysecondary ri-hand-coin-fill"></i>
                        </div>
                        <h3 class="text-dark lh-sm fs-2hx fs-md-1 mb-4">
                            The Cost of Education in Indonesia is Expensive
                        </h3>
                        <p class="text-gray-600 fs-5 mb-0">
                            Dengan besarnya populasi demografi pelajar di Indonesia dan pasokan infrastruktur sekolah atau universitas di Indonesia masih kurang, menyebabkan pendidikan sering kali dikomersilkan karena pasokan di pasar pendidikan tidak dapat menyeimbangkan permintaan. Untuk itu, diperlukan sistem platform EduTech pendukung yang dapat membantu masyarakat dengan keterbatasan finansial untuk dapat bersaing mendapatkan pendidikan yang lebih berkualitas.
                        </p>
                    </div>
                    <div class="card p-8 align-items-start rounded-4 border border-gray-300">
                        <div class="d-flex rounded bg-mywarning-light mb-7">
                            <i class="p-6 fs-2tx text-mywarning ri-team-fill"></i>
                        </div>
                        <h3 class="text-dark lh-sm fs-2hx fs-md-1 mb-4">
                            Low Human Capital and Education Inequality
                        </h3>
                        <p class="text-gray-600 fs-5 mb-0">
                            Menghambat potensi pertumbuhan yang dapat dihasilkan oleh melimpahnya jumlah penduduk usia produktif, yang diakui sebagai kunci untuk mewujudkan visi Indonesia Emas 2045. Oleh karena itu, pemerintah Indonesia menetapkan kebijakan pembangunan nasional yang inklusif dan berkelanjutan serta menginstruksikan program pemerataan pendidikan. Namun, pemerintah memiliki sumber daya yang terbatas, sehingga memperlambat pembangunan ekonomi nasional.
                        </p>
                    </div>
                </div>
            </div>
            <div id="vision" class="pt-20 mt-20">
                <div class="bg-gray-300">
                    <div class="container d-flex flex-column flex-center py-20">
                        <img src="/assets/media/elements/quotation_marks-solid.png" class="w-45px mb-10" alt="" />
                        <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-6">
                            Visi LetStudy
                        </h1>
                        <p class="text-center text-gray-600 fs-2 fs-md-1 fw-semibold mb-0">
                            Menjadi sebuah wadah yang dapat menumbuhkan solidaritas sosial masyarakat untuk turut berkontribusi di bidang pendidikan sehingga dapat memunculkan bibit potensi sumber daya manusia yang unggul serta mampu berdampak positif dalam jangka panjang.
                        </p>
                    </div>
                </div>
            </div>
            <div id="mission" class="container d-flex mt-20">
                <div class="bg-white w-100 d-flex flex-column border border-gray-300 rounded-4 p-10 p-md-16">
                    <h1 class="text-center text-dark lh-sm fw-bold fs-3hx pb-6 pb-lg-8 mb-6 mb-md-8 border-bottom border-gray-300">
                        Misi LetStudy
                    </h1>
                    <div class="row g-6 g-lg-8">
                        <div class="col-12 col-lg-4">
                            <div class="d-flex gap-5">
                                <div class="symbol symbol-45px symbol-circle">
                                    <div class="symbol-label fs-4 fw-semibold bg-myprimary text-white">01</div>
                                </div>
                                <p class="text-gray-600 fs-3 mb-0">
                                    Mendukung pelayanan edukasi berkelanjutan sesuai dengan SDGs ke-4 dan membantu persiapan para pelajar untuk menghadapi dunia kerja sesuai dengan SDGs ke-8.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="d-flex gap-5">
                                <div class="symbol symbol-45px symbol-circle">
                                    <div class="symbol-label fs-4 fw-semibold bg-myprimary text-white">02</div>
                                </div>
                                <p class="text-gray-600 fs-3 mb-0">
                                    Memfasilitasi masyarakat untuk peduli dengan pendidikan di Indonesia melalui program nyata sesuai dengan kapasitasnya.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="d-flex gap-5">
                                <div class="symbol symbol-45px symbol-circle">
                                    <div class="symbol-label fs-4 fw-semibold bg-myprimary text-white">03</div>
                                </div>
                                <p class="text-gray-600 fs-3 mb-0">
                                    Menyediakan wadah pengembangan baik akademik maupun non-akademik yang mendukung pengembangan sumber daya manusia berkualitas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="achievements" v-if="achievements.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Pencapaian LetStudy 🎯
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    Sejak <span class="text-myprimary fw-bold">2023</span>, LetStudy telah menjangkau <span class="text-myprimary fw-bold">ratusan ribu pelajar</span> di seluruh <span class="text-myprimary fw-bold">Indonesia</span>.
                </p>
                <div class="achievements-wrapper overflow-hidden position-relative w-100">
                    <div class="achievements-content gap-6 h-100">
                        <div v-for="(achievement, index) in achievements" :key="index"
                            class="card w-200px h-100 justify-content-start flex-center p-6 rounded-4 border border-gray-300">
                            <img class="w-100 mb-4" :src="`/storage/${achievement.icon}`" :alt="`${achievement.title}`">
                            <h2 class="text-dark text-center fw-bolder lh-sm fs-3x fs-md-2x mb-2">
                                {{ achievement.value }}
                            </h2>
                            <p class="text-center text-gray-600 fs-5 mb-0">
                                {{ achievement.title }}
                            </p>
                        </div>
                        <div v-for="(achievement, index) in achievements" :key="index"
                            class="card w-200px h-100 justify-content-start flex-center p-6 rounded-4 border border-gray-300">
                            <img class="w-100 mb-4" :src="`/storage/${achievement.icon}`" :alt="`${achievement.title}`">
                            <h2 class="text-dark text-center fw-bolder lh-sm fs-3x fs-md-2x mb-2">
                                {{ achievement.value }}
                            </h2>
                            <p class="text-center text-gray-600 fs-5 mb-0">
                                {{ achievement.title }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="community" class="container d-flex pt-20 mt-20">
                <div class="bg-white w-100 d-flex flex-column flex-lg-row flex-center flex-lg-start border border-gray-300 rounded-4 px-10 pt-10 px-md-16 pt-md-16 pb-lg-16 position-relative">
                    <div class="w-100 w-lg-50 w-xxl-60 text-center d-flex flex-column flex-center flex-lg-start text-lg-start">
                        <h2 class="text-dark lh-sm fs-3x fw-bold mb-4 mb-md-6">
                            LetStudy Together!
                        </h2>
                        <p class="text-gray-600 fs-4 mw-600px mb-10">
                            Ruang untuk saling dukung, saling berbagi, saling belajar, dan saling tumbuh bersama setiap waktu.
                        </p>
                        <div class="d-flex gap-4 justify-content-center justify-content-lg-start">
                            <a :href="`${profile.community}`" target="_blank" class="btn btn-sm btn-myprimary fs-5">
                                Gabung Komunitas
                            </a>
                            <a href="/contact-us" class="btn btn-sm btn-mysecondary fs-5">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                    <img class="img-community position-lg-absolute mt-10 mt-lg-0"
                        src="/assets/media/images/letstudy-together.png" alt="Let's Study Together">
                </div>
            </div>
            <div id="donation" class="container d-flex flex-column flex-center pt-20 mt-20">
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Jadi Bagian Kebaikan 🤝
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    Mari satukan langkah untuk <span class="text-myprimary fw-bold">kesetaraan pendidikan</span> untuk semua.
                </p>
                <div class="row g-8 w-100 justify-content-center px-lg-10 px-xl-20 mb-10">
                    <div v-for="(ach, i) in donateAchievements" :key="i" class="col-12 col-sm-6 col-md-4">
                        <h1 class="text-center text-myprimary lh-sm fw-boldest fs-5tx fs-md-3tx fs-lg-4x mb-2">
                            {{ formatCount(ach.value) }}
                        </h1>
                        <h6 class="text-center text-dark fs-1 fs-md-2 fw-bold mb-0">
                            {{ ach.title }}
                        </h6>
                    </div>
                </div>
                <p class="text-gray-600 text-center fs-4 px-lg-10 px-xl-20 mb-20">
                    LetStudy berkomitmen mengelola setiap donasi secara profesional dan transparan, memastikan pemanfaatan yang efektif dan dapat dipertanggungjawabkan untuk mendukung pendidikan.
                </p>
                <div class="position-relative d-flex justify-content-center">
                    <img src="/assets/media/images/mockup-phone.png" class="img-fluid object-fit-cover w-75 mw-325px w-sm-300px" alt="" />
                    
                    <div class="w-100 mw-375px w-sm-375px w-md-400px w-lg-500px position-absolute z-index-1">
                        <swiper
                            :loop="true"
                            :slides-per-view="1"    
                            :space-between="20"
                            :modules="modules"
                            :autoplay="{
                                delay: 3000,
                                disableOnInteraction: false,
                            }">
                            <swiper-slide>
                                <div class="bank-card mt-17 mt-sm-20 mt-lg-18 p-10 bg-gradient-myprimary d-flex flex-row gap-6">
                                    <div class="d-flex flex-column justify-content-between">
                                        <img src="/assets/media/illustrations/qris.png" class="w-100px mb-10" />
                                        <div>
                                            <p class="text-white fw-bold fs-4 mb-0">
                                                {{ donate.qrcode_nmid }}
                                            </p>
                                            <p class="text-white opacity-75 fs-4 mb-0">
                                                a.n {{ donate.qrcode_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <img src="/assets/media/illustrations/qr-code.png" class="h-100 p-3 rounded card" />
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="bank-card mt-17 mt-sm-20 mt-lg-18 p-10 bg-gradient-myprimary text-start">
                                    <div class="d-flex align-items-center gap-3 mb-5">
                                        <h1 class="fw-bolder text-white lh-base fs-4x fs-md-3x mb-0">
                                            {{ donate.bank_name }}
                                        </h1>
                                        <p class="custom-flex-text text-white opacity-75 fs-8 mt-1 text-uppercase mb-0"
                                            style="letter-spacing: 0.08em;" v-html="formattedBankName(donate.bank_name)"></p>
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                        <h3 id="bank-number"
                                            class="fw-bolder text-white opacity-100 lh-base fs-3x fs-md-2hx mb-0 text-truncate">
                                            {{ donate.bank_number }}
                                        </h3>
                                        <i id="copy-icon" class="ri-file-copy-2-line text-white fs-1 cursor-pointer"></i>
                                    </div>
                                    <p class="text-white opacity-75 fs-4 mb-0">
                                        a.n {{ donate.bank_account }}
                                    </p>
                                </div>
                            </swiper-slide>
                        </swiper>
                    </div>
                </div>
            </div>
            
            <Footer :sosmed="sosmed" />

            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <i class="fs-1 ri-arrow-up-double-line"></i>
            </div>
        </div>
    </main>
</template>

<script>
    import Navbar from "../../../Components/Navbar/Home.vue";
    import Footer from "../../../Components/Footer/Home.vue";
    import { Head, usePage } from '@inertiajs/vue3';
    import { computed, onMounted, onUnmounted, watch } from 'vue'
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import 'swiper/css';
    import 'swiper/css/pagination';
    import 'swiper/css/navigation';
    import { Autoplay, Pagination, Navigation } from 'swiper/modules';
    import { Chart, registerables } from 'chart.js';

    export default {
        components: {
            Head,
            Navbar,
            Footer,
            Swiper,
            SwiperSlide,
        },

        props: {
            profile: Object,
            achievements: Array,
            donate: Object,
            sosmed: Object,
            backgroundStats: {
                type: Array,
                default: () => ([
                { kuintil: "Kuintil 1", sma: 74.45, ptn: 18.23 },
                { kuintil: "Kuintil 2", sma: 84.53, ptn: 22.47 },
                { kuintil: "Kuintil 3", sma: 88.39, ptn: 27.12 },
                { kuintil: "Kuintil 4", sma: 92.50, ptn: 33.34 },
                { kuintil: "Kuintil 5", sma: 97.37, ptn: 54.25 },
                ])
            }
        },

        mounted() {
            document.getElementById('copy-icon').addEventListener('click', this.copyToClipboard);
        },

        methods: {
            copyToClipboard() {
                const bankNumber = document.getElementById('bank-number').innerText;

                navigator.clipboard.writeText(bankNumber).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Nomor rekening berhasil disalin!',
                        text: 'Setiap langkah kebaikan yang Anda berikan, menjadi bagian dari perjalanan bersama ✨',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-icon',
                            container: 'swal-z100'
                        }
                    });
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyalin!',
                        text: 'Silakan coba lagi.',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-icon',
                            container: 'swal-z100'
                        }
                    });
                });
            },
        },

        setup(props) {
            Chart.register(...registerables);

            let bgChart; // simpan instance Chart

            const labels = computed(() => props.backgroundStats.map(r => r.kuintil));
            const dataSMA = computed(() => props.backgroundStats.map(r => r.sma));
            const dataPTN = computed(() => props.backgroundStats.map(r => r.ptn));

            const renderBgChart = () => {
            const ctx = document.getElementById('bgChart');
            if (!ctx) return;

            if (bgChart) {
                bgChart.destroy();
                bgChart = null;
            }

            bgChart = new Chart(ctx, {
                type: 'bar',               
                data: {
                    labels: labels.value,
                    datasets: [
                        {
                            label: 'SMA',
                            data: dataSMA.value,
                            backgroundColor: 'rgba(96, 165, 250, 1)',  
                        },
                        {
                            label: 'Perguruan Tinggi',
                            data: dataPTN.value,
                            backgroundColor: 'rgba(251, 191, 36, 1)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,   
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { position: 'top' },
                        tooltip: {
                        callbacks: {
                            label: (ctx) => {
                            const val = ctx.parsed.y;
                            return `${ctx.dataset.label}: ${new Intl.NumberFormat('id-ID').format(val)}`;
                            }
                        }
                        }
                    },
                    scales: {
                        x: {
                        grid: { display: false },
                        ticks: { font: { size: 12 } }
                        },
                        y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (val) => new Intl.NumberFormat('id-ID').format(val),
                            font: { size: 12 }
                        }
                        }
                    }
                }});
            };

            onMounted(() => {
                if (props.backgroundStats && props.backgroundStats.length) {
                    renderBgChart();
                }
            });

            onUnmounted(() => {
                if (bgChart) {
                    bgChart.destroy();
                    bgChart = null;
                }
            });

            watch(() => props.backgroundStats, () => {
                if (props.backgroundStats && props.backgroundStats.length) {
                    renderBgChart();
                }
            }, { deep: true });

            const donateAchievements = computed(() => {
                const d = props.donate ?? {};
                return [d.achievement1, d.achievement2, d.achievement3].filter(Boolean);
            });

            const formatCount = (val) => {
                if (val == null) return '';
                const num = Number(val);
                if (Number.isNaN(num)) return String(val);
                return new Intl.NumberFormat('id-ID').format(num) + '+';
            };
            
            const formattedBankName = (bankName) => {
                const map = {
                    BCA: 'Bank Central<br>Asia',
                    BRI: 'Bank Rakyat<br>Indonesia',
                    BNI: 'Bank Negara<br>Indonesia',
                    BTN: 'Bank Tabungan<br>Negara',
                    BSI: 'Bank Syariah<br>Indonesia',
                    MANDIRI: ' ',
                };

                const key = (bankName ?? '').trim().toUpperCase();
                return map[key] ?? (bankName ?? '');
            };

            return {
                donateAchievements,
                formatCount,
                formattedBankName,
                modules: [Autoplay, Pagination, Navigation],
            }
        }
    };
</script>

<style scoped>
    .swal-z100 {
        z-index: 100 !important;
    }
</style>