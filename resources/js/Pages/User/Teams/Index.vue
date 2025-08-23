<template>
    <Head>
        <title>Tim LetStudy</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="flex-grow-1">
                <div id="home" class="bg-white">
                    <Navbar />
                    <div class="container d-flex flex-column w-100 w-md-700px w-lg-auto">
                        <div class="d-flex flex-column align-items-center text-center py-10 py-md-20">
                            <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                                Meet Our Team
                            </h1>
                            <p class="text-center text-gray-600 fs-2 fw-semibold mb-0">
                                Tim yang siap <span class="text-myprimary fw-bold">mendukung</span> dan <span class="text-myprimary fw-bold">menemani</span> perjalanan belajarmu.
                            </p>
                        </div>
                    </div>
                </div>
                <div id="teams" class="container d-flex flex-column py-20">

                    <!-- Pimpinan -->
                    <div v-if="pimpinan.length > 0" 
                        class="row g-6 justify-content-center">
                        <div v-for="(team, index) in pimpinan" :key="index" class="col-6 col-md-4 col-lg-3">
                            <div id="blog-card"
                                class="cursor-pointer" @click="setTeam(team)" data-bs-toggle="modal" data-bs-target="#kt_modal_team" >
                                <div class="overflow-hidden position-relative rounded-4 ratio ratio-1x1">
                                    <img :src="`/storage/${team.photo}`"
                                        class="img-blog img-fluid object-fit-cover" :alt="`${team.name}`" />
                                </div>
                                <h3 class="text-dark fs-1 fw-bold mb-2 mt-6">{{ team.name }}</h3>
                                <p class="fs-5 text-gray-600 m-0">{{ team.position }}</p>
                            </div >
                        </div>
                    </div>

                    <!-- Marketing Creative -->
                    <div v-if="marketing_creative.length > 0"
                        class="d-flex flex-row w-100 gap-6 align-items-end mb-6 mb-md-10 mt-20">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-sm fw-bold fs-3x mb-4">
                                Marketing Creative 🎨
                            </h1>
                            <p class="text-gray-600 fs-3 fw-semibold mb-0">
                                Kreator ide segar untuk <span class="text-myprimary fw-bold">menjangkau</span> dan <span class="text-myprimary fw-bold">menginspirasi</span> lebih banyak pelajar.
                            </p>
                        </div>
                        <div v-if="marketing_creative.length > 4"
                            class="d-none d-md-flex flex-row gap-3 mb-2">
                            <button class="my-prev btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-left-s-line fs-1"></i>
                            </button>
                            <button class="my-next btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-right-s-line fs-1"></i>
                            </button>
                        </div>
                    </div>
                    <div v-if="marketing_creative.length > 0"
                        class="container px-0">
                        <swiper
                            :loop="true"
                            :space-between="20"
                            :navigation="{ prevEl: '.my-prev', nextEl: '.my-next' }"
                            :modules="modules"
                            :breakpoints="{
                                0: { slidesPerView: 2 },      
                                768: { slidesPerView: 3 },    
                                992: { slidesPerView: 4 }  
                            }">
                            <swiper-slide v-for="(team, index) in marketing_creative" :key="index" id="blog-card"
                                class="cursor-pointer" @click="setTeam(team)" data-bs-toggle="modal" data-bs-target="#kt_modal_team" >
                                <div class="overflow-hidden position-relative rounded-4 ratio ratio-1x1">
                                    <img :src="`/storage/${team.photo}`"
                                        class="img-blog img-fluid object-fit-cover" :alt="`${team.name}`" />
                                </div>
                                <h3 class="text-dark fs-1 fw-bold mb-2 mt-6">{{ team.name }}</h3>
                                <p class="fs-5 text-gray-600 m-0">{{ team.position }}</p>
                            </swiper-slide >
                        </swiper>
                    </div>

                    <!-- Strategic Partnership -->
                    <div v-if="strategic_partnership.length > 0" 
                        class="d-flex flex-row w-100 gap-6 align-items-end mb-6 mb-md-10 mt-20">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-sm fw-bold fs-3x mb-4">
                                Strategic Partnership 🤝
                            </h1>
                            <p class="text-gray-600 fs-3 fw-semibold mb-0">
                                Membangun <span class="text-myprimary fw-bold">koneksi</span> dan <span class="text-myprimary fw-bold">kolaborasi</span> untuk perkembangan bersama.
                            </p>
                        </div>
                        <div v-if="strategic_partnership.length > 4"
                            class="d-none d-md-flex flex-row gap-3 mb-2">
                            <button class="my-prev2 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-left-s-line fs-1"></i>
                            </button>
                            <button class="my-next2 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-right-s-line fs-1"></i>
                            </button>
                        </div>
                    </div>
                    <div v-if="strategic_partnership.length > 0" 
                        class="container px-0">
                        <swiper
                            :loop="true"
                            :space-between="20"
                            :navigation="{ prevEl: '.my-prev2', nextEl: '.my-next2' }"
                            :modules="modules"
                            :breakpoints="{
                                0: { slidesPerView: 2 },      
                                768: { slidesPerView: 3 },    
                                992: { slidesPerView: 4 }  
                            }">
                            <swiper-slide v-for="(team, index) in strategic_partnership" :key="index" id="blog-card"
                                class="cursor-pointer" @click="setTeam(team)" data-bs-toggle="modal" data-bs-target="#kt_modal_team" >
                                <div class="overflow-hidden position-relative rounded-4 ratio ratio-1x1">
                                    <img :src="`/storage/${team.photo}`"
                                        class="img-blog img-fluid object-fit-cover" :alt="`${team.name}`" />
                                </div>
                                <h3 class="text-dark fs-1 fw-bold mb-2 mt-6">{{ team.name }}</h3>
                                <p class="fs-5 text-gray-600 m-0">{{ team.position }}</p>
                            </swiper-slide >
                        </swiper>
                    </div>

                    <!-- Administration Finance -->
                    <div v-if="administration_finance.length > 0" 
                        class="d-flex flex-row w-100 gap-6 align-items-end mb-6 mb-md-10 mt-20">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-sm fw-bold fs-3x mb-4">
                                Administration & Finance 📊
                            </h1>
                            <p class="text-gray-600 fs-3 fw-semibold mb-0">
                                Menjaga kelancaran <span class="text-myprimary fw-bold">administrasi</span> dan <span class="text-myprimary fw-bold">stabilitas</span> LetStudy.
                            </p>
                        </div>
                        <div v-if="administration_finance.length > 4"
                            class="d-none d-md-flex flex-row gap-3 mb-2">
                            <button class="my-prev3 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-left-s-line fs-1"></i>
                            </button>
                            <button class="my-next3 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-right-s-line fs-1"></i>
                            </button>
                        </div>
                    </div>
                    <div v-if="administration_finance.length > 0" 
                        class="container px-0">
                        <swiper
                            :loop="true"
                            :space-between="20"
                            :navigation="{ prevEl: '.my-prev3', nextEl: '.my-next3' }"
                            :modules="modules"
                            :breakpoints="{
                                0: { slidesPerView: 2 },      
                                768: { slidesPerView: 3 },    
                                992: { slidesPerView: 4 }  
                            }">
                            <swiper-slide v-for="(team, index) in administration_finance" :key="index" id="blog-card"
                                class="cursor-pointer" @click="setTeam(team)" data-bs-toggle="modal" data-bs-target="#kt_modal_team" >
                                <div class="overflow-hidden position-relative rounded-4 ratio ratio-1x1">
                                    <img :src="`/storage/${team.photo}`"
                                        class="img-blog img-fluid object-fit-cover" :alt="`${team.name}`" />
                                </div>
                                <h3 class="text-dark fs-1 fw-bold mb-2 mt-6">{{ team.name }}</h3>
                                <p class="fs-5 text-gray-600 m-0">{{ team.position }}</p>
                            </swiper-slide >
                        </swiper>
                    </div>

                    <!-- Product Project -->
                    <div v-if="product_project.length > 0" 
                        class="d-flex flex-row w-100 gap-6 align-items-end mb-6 mb-md-10 mt-20">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-sm fw-bold fs-3x mb-4">
                                Product & Project Manager 🗂️
                            </h1>
                            <p class="text-gray-600 fs-3 fw-semibold mb-0">
                                Mengelola <span class="text-myprimary fw-bold">produk</span> dan <span class="text-myprimary fw-bold">proyek</span> agar berjalan tepat sasaran.
                            </p>
                        </div>
                        <div v-if="product_project.length > 4"
                            class="d-none d-md-flex flex-row gap-3 mb-2">
                            <button class="my-prev4 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-left-s-line fs-1"></i>
                            </button>
                            <button class="my-next4 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-right-s-line fs-1"></i>
                            </button>
                        </div>
                    </div>
                    <div v-if="product_project.length > 0" 
                        class="container px-0">
                        <swiper
                            :loop="true"
                            :space-between="20"
                            :navigation="{ prevEl: '.my-prev4', nextEl: '.my-next4' }"
                            :modules="modules"
                            :breakpoints="{
                                0: { slidesPerView: 2 },      
                                768: { slidesPerView: 3 },    
                                992: { slidesPerView: 4 }  
                            }">
                            <swiper-slide v-for="(team, index) in product_project" :key="index" id="blog-card"
                                class="cursor-pointer" @click="setTeam(team)" data-bs-toggle="modal" data-bs-target="#kt_modal_team" >
                                <div class="overflow-hidden position-relative rounded-4 ratio ratio-1x1">
                                    <img :src="`/storage/${team.photo}`"
                                        class="img-blog img-fluid object-fit-cover" :alt="`${team.name}`" />
                                </div>
                                <h3 class="text-dark fs-1 fw-bold mb-2 mt-6">{{ team.name }}</h3>
                                <p class="fs-5 text-gray-600 m-0">{{ team.position }}</p>
                            </swiper-slide >
                        </swiper>
                    </div>

                    <!-- Education Development -->
                    <div v-if="education_development.length > 0" 
                        class="d-flex flex-row w-100 gap-6 align-items-end mb-6 mb-md-10 mt-20">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-sm fw-bold fs-3x mb-4">
                                Education Development 📚
                            </h1>
                            <p class="text-gray-600 fs-3 fw-semibold mb-0">
                                Menciptakan inovasi <span class="text-myprimary fw-bold">pembelajaran</span> untuk <span class="text-myprimary fw-bold">pengalaman</span> belajar terbaik.
                            </p>
                        </div>
                        <div v-if="education_development.length > 4"
                            class="d-none d-md-flex flex-row gap-3 mb-2">
                            <button class="my-prev5 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-left-s-line fs-1"></i>
                            </button>
                            <button class="my-next5 btn btn-icon btn-sm btn-mysecondary rounded-pill">
                                <i class="ri-arrow-right-s-line fs-1"></i>
                            </button>
                        </div>
                    </div>
                    <div v-if="education_development.length > 0" 
                        class="container px-0">
                        <swiper
                            :loop="true"
                            :space-between="20"
                            :navigation="{ prevEl: '.my-prev5', nextEl: '.my-next5' }"
                            :modules="modules"
                            :breakpoints="{
                                0: { slidesPerView: 2 },      
                                768: { slidesPerView: 3 },    
                                992: { slidesPerView: 4 }  
                            }">
                            <swiper-slide v-for="(team, index) in education_development" :key="index" id="blog-card"
                                class="cursor-pointer" @click="setTeam(team)" data-bs-toggle="modal" data-bs-target="#kt_modal_team" >
                                <div class="overflow-hidden position-relative rounded-4 ratio ratio-1x1">
                                    <img :src="`/storage/${team.photo}`"
                                        class="img-blog img-fluid object-fit-cover" :alt="`${team.name}`" />
                                </div>
                                <h3 class="text-dark fs-1 fw-bold mb-2 mt-6">{{ team.name }}</h3>
                                <p class="fs-5 text-gray-600 m-0">{{ team.position }}</p>
                            </swiper-slide >
                        </swiper>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="kt_modal_team" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered justify-content-center">
                            <div class="modal-content rounded-4 mw-400px mw-md-500px">
                                <div class="modal-header ps-6 pe-3 h-60px border-bottom border-gray-300 h-60px h-lg-70px">
                                    <h2 class="modal-title">Detail Tim</h2>
                                    <div class="btn btn-sm btn-icon btn-mylighten rounded-pill" data-bs-dismiss="modal">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>
                                <div class="modal-body p-6">
                                    <template v-if="selectedTeam">
                                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-6">
                                            <div v-if="selectedTeam.photo" 
                                                class="overflow-hidden mw-150px position-relative rounded ratio ratio-1x1">
                                                <img :src="`/storage/${selectedTeam.photo}`"
                                                    class="img-fluid object-fit-cover" :alt="selectedTeam.name" />
                                            </div>
                                            <div class="flex-grow-1 w-100">
                                                <h4 class="text-center text-sm-start text-dark lh-sm fs-1 fs-md-2 mb-1">{{ selectedTeam.name }}</h4>
                                                <p class="text-center text-sm-start text-dark fs-5 mb-6 pb-6 border-bottom border-gray-300">{{ selectedTeam.position }}</p>
                                                <p class="text-gray-600 fs-7 mb-1">Biodata</p>
                                                <p class="text-dark fs-5 mb-0">{{ selectedTeam.bio }}</p>
                                                <div v-if="selectedTeam.quote" class="mt-6">
                                                    <p class="text-gray-600 fs-7 mb-1">Quote</p>
                                                    <p class="text-dark fs-5 mb-0">{{ selectedTeam.quote }}</p>
                                                </div>
                                                <div class="d-flex gap-3 mt-6"
                                                    v-if="selectedTeam.email || selectedTeam.linkedin || selectedTeam.instagram || selectedTeam.tiktok || selectedTeam.x">
                                                    <a v-if="selectedTeam.email" :href="`mailto:${selectedTeam.email}`">
                                                        <i class="fs-3 btn-link-myprimary ri-mail-line"></i>
                                                    </a>
                                                    <a v-if="selectedTeam.linkedin" :href="selectedTeam.linkedin" target="_blank">
                                                        <i class="fs-3 btn-link-myprimary ri-linkedin-box-fill"></i>
                                                    </a>
                                                    <a v-if="selectedTeam.instagram" :href="selectedTeam.instagram" target="_blank">
                                                        <i class="fs-3 btn-link-myprimary ri-instagram-line"></i>
                                                    </a>
                                                    <a v-if="selectedTeam.tiktok" :href="selectedTeam.tiktok" target="_blank">
                                                        <i class="fs-3 btn-link-myprimary ri-tiktok-fill"></i>
                                                    </a>
                                                    <a v-if="selectedTeam.x" :href="selectedTeam.x" target="_blank">
                                                        <i class="fs-3 btn-link-myprimary ri-twitter-x-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="text-center text-dark lh-sm fs-3 p-6">Gagal memuat, silahkan coba lagi...</div>
                                    </template>
                                </div>
                            </div>
                        </div>
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
    import { Head } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue'
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import 'swiper/css';
    import 'swiper/css/pagination';
    import 'swiper/css/navigation';
    import { Autoplay, Pagination, Navigation } from 'swiper/modules';

    export default {
        components: {
            Head,
            Navbar,
            Footer,
            Swiper,
            SwiperSlide,
        },

        props: {
            pimpinan: Array,
            marketing_creative: Array,
            strategic_partnership: Array,
            administration_finance: Array,
            product_project: Array,
            education_development: Array,
            sosmed: Object,
        },

        setup() {
            const selectedTeam = ref(null)
            const setTeam = (team) => { selectedTeam.value = team }

            onMounted(() => {
                const el = document.getElementById('kt_modal_team')
                if (el) {
                    el.addEventListener('hidden.bs.modal', () => {
                    selectedTeam.value = null
                    })
                }
            })

            return {
                selectedTeam,
                setTeam,
                modules: [Autoplay, Pagination, Navigation],
            }
        }
    };
</script>