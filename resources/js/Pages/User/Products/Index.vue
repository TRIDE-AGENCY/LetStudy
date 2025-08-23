<template>
    <Head>
        <title>{{ product.title }}</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div id="home" class="bg-white">
                <Navbar />
                <div class="container pt-10 pt-md-20">
                    <div class="row g-10 justify-content-center justify-content-lg-start">
                        <div class="col-12 col-lg-6 mw-600px mw-md-700px align-self-center">
                            <h1 class="text-center text-lg-start text-dark lh-sm fw-bold fs-3hx mb-6">
                                {{ banner.heading }}
                            </h1>
                            <p class="text-center text-lg-start text-gray-600 fs-4 mb-0 mb-lg-20">
                                {{ banner.sub_heading }}
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 mw-500px mw-lg-100 align-self-end">
                            <img class="img-landing w-100 mt-5 mt-md-10 mt-lg-0"
                                :src="`/storage/${banner.image}`" alt="Gambar Hero Section">
                        </div>
                    </div>
                </div>
            </div>
            <div id="services" class="container d-flex flex-column flex-center pt-20 mt-20">
                <p class="text-center text-myprimary fs-1 fw-bold mb-6 d-inline-flex align-items-center gap-3">
                    <i :class="[getProductIconClass(product), 'fs-1 fw-normal text-myprimary ']"></i>
                    <span>{{ product.title }}</span>
                </p>
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Layanan Utama 🚀
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    Latih <span class="text-myprimary fw-bold">kemampuanmu</span>, dan raih <span class="text-myprimary fw-bold">kampus impuanmu</span> bersama kami.
                </p>
                <div class="row g-6 justify-content-center">
                    <a v-for="(subProduct, index) in subProducts" :key="index" 
                        :href="`/member-area/${product.slug}/${subProduct.slug}/ebooks`" class="col-12 col-md-6">
                        <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                            <img class="w-70px p-4 rounded bg-mysecondary mb-7" :src="`/storage/${subProduct.icon}`" :alt="`${subProduct.title}`">
                            <h2 class="text-dark lh-sm fs-2tx mb-3">
                                {{ subProduct.title }}
                            </h2>
                            <p class="text-gray-600 fs-4 mb-0">
                                {{ subProduct.description }}
                            </p>
                            <div v-if="subProduct.sub_product_benefits.length > 0"
                                class="d-flex flex-column gap-2 mt-5">
                                <div v-for="(benefit, index) in subProduct.sub_product_benefits" :key="index"   
                                    class="d-flex align-items-start gap-3">
                                    <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                    <p class="text-gray-600 fs-4 mb-0">
                                        {{ benefit.benefit }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div id="ebooks" v-if="ebooks.length > 0"
                class="container position-relative d-flex flex-column flex-start pt-20 mt-20">
                <div class="d-flex flex-row w-100 gap-6 align-items-end mb-10">
                    <div class="flex-grow-1">
                        <h1 class="text-center text-md-start text-dark lh-sm fw-bold fs-3hx mb-4">
                            E-Book Masterclass 🔥
                        </h1>
                        <p class="text-center text-md-start text-gray-600 fs-2 fw-semibold mb-0">
                            Akses semua <span class="text-myprimary fw-bold">Kitab Sakti</span> yang siap bantu kamu <span class="text-myprimary fw-bold">menaklukkan ujian</span>.
                        </p>
                    </div>
                    <div v-if="ebooks.length > 2"
                        class="d-none d-md-flex flex-row gap-3 mb-2">
                        <button class="my-prev btn btn-icon btn-sm btn-mysecondary rounded-pill">
                            <i class="ri-arrow-left-s-line fs-1"></i>
                        </button>
                        <button class="my-next btn btn-icon btn-sm btn-mysecondary rounded-pill">
                            <i class="ri-arrow-right-s-line fs-1"></i>
                        </button>
                    </div>
                </div>
                <div class="container px-0">
                    <swiper
                        :loop="true"
                        :space-between="20"
                        :navigation="{ prevEl: '.my-prev', nextEl: '.my-next' }"
                        :modules="modules"
                        :autoplay="{
                            delay: 3000,
                            disableOnInteraction: false,
                        }"
                        :breakpoints="{
                            0: { slidesPerView: 1 },      
                            768: { slidesPerView: 2 },    
                        }">
                        <swiper-slide v-for="(ebook, index) in ebooks" :key="index">
                            <a :href="`/member-area/${product.slug}/${ebook.sub_product.slug}/ebooks/${ebook.slug}`" 
                                class="card card-hover rounded-4 border border-gray-300 h-100">
                                <div class="card-body d-flex p-7">
                                    <img class="h-150px h-sm-200px rounded object-fit-cover"
                                        :src="`/storage/${ebook.image}`"
                                        :alt="`Sampul ${ebook.title}`">
                                    <div class="d-flex flex-column flex-grow-1 ms-6 gap-4 justify-content-between">
                                        <div>
                                            <span class="badge px-3 py-2 fs-6">{{ ebook.sub_product.title }}</span>
                                            <p class="text-dark fs-1 fw-bold mb-0 mt-3 text-truncate-2">{{ ebook.title }}</p>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <i class="fs-3 text-gray-600 ri-user-voice-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">{{ ebook.tutors_count ?? 0 }} Tutor</p>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <i class="fs-3 text-gray-600 ri-book-open-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">{{ ebook.total_pages.toLocaleString('id-ID') }} Halaman</p>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-calendar-check-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">Rilis {{ formatDateEbooks(ebook.launch_date) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </swiper-slide >
                    </swiper>
                </div>
            </div>
            <div id="tryouts" v-if="tryouts.length > 0" class="pt-20 mt-20">
                <div class="bg-gray-300">
                    <div class="container py-20">
                        <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                            Siap Tryout? 📝
                        </h1>
                        <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                            Uji <span class="text-myprimary fw-bold">kemampuanmu</span> dan temukan <span class="text-myprimary fw-bold">potensi terbaikmu</span>.
                        </p>
                        <div class="container px-0 px-md-17 px-lg-18 position-relative">
                            <div v-if="tryouts.length > 3">
                                <button class="my-prev2 d-none d-md-block btn btn-icon btn-sm btn-mywhite rounded-pill position-absolute top-50 start-0 translate-middle-y z-3">
                                    <i class="ri-arrow-left-s-line fs-1"></i>
                                </button>
                                <button class="my-next2 d-none d-md-block btn btn-icon btn-sm btn-mywhite rounded-pill position-absolute top-50 end-0 translate-middle-y z-3">
                                    <i class="ri-arrow-right-s-line fs-1"></i>
                                </button>
                            </div>
                            <swiper
                                :loop="true"
                                :space-between="24"
                                :navigation="{ prevEl: '.my-prev2', nextEl: '.my-next2' }"
                                :modules="modules"
                                :autoplay="{
                                    delay: 3000,
                                    disableOnInteraction: false,
                                }"
                                :breakpoints="{
                                    0: { slidesPerView: 1 },      
                                    768: { slidesPerView: 2 },    
                                    1400: { slidesPerView: 3 }    
                                }">
                                <swiper-slide v-for="(tryout, index) in tryouts" :key="index">
                                    <a :href="`/member-area/${product.slug}/${tryout.sub_product.slug}/tryouts`" 
                                        class="card rounded-4 h-100">
                                        <div class="card-body d-flex flex-column justify-content-between h-100 p-7 gap-7">
                                            <div class="d-flex flex-column">
                                                <p class="fs-5 text-myprimary fw-bold mb-2">{{ tryout.sub_product.title }}</p>
                                                <p class="text-dark fs-1 fw-bold pb-5 mb-6 text-truncate-3 border-bottom border-gray-300">{{ tryout.title }}</p>
                                                <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <i class="fs-3 text-gray-600 ri-timer-line"></i>
                                                        <p class="fs-5 text-gray-600 m-0">Durasi</p>
                                                    </div>
                                                    <p class="fs-5 text-dark text-end fw-bold m-0">{{ tryout.duration }} Menit</p>
                                                </div>
                                                <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <i class="fs-3 text-gray-600 ri-list-check-2"></i>
                                                        <p class="fs-5 text-gray-600 m-0">Jumlah Soal</p>
                                                    </div>
                                                    <p class="fs-5 text-dark text-end fw-bold m-0">{{ tryout.questions.length }} Soal</p>
                                                </div>
                                                <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <i class="fs-3 text-gray-600 ri-login-box-line"></i>
                                                        <p class="fs-5 text-gray-600 m-0">Mulai</p>
                                                    </div>
                                                    <p class="fs-5 text-dark text-end fw-bold m-0">
                                                        {{ tryout.start_time ? formatDateTryouts(tryout.start_time) : '-' }}
                                                    </p>
                                                </div>
                                                <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <i class="fs-3 text-gray-600 ri-logout-box-line"></i>
                                                        <p class="fs-5 text-gray-600 m-0">Selesai</p>
                                                    </div>
                                                    <p class="fs-5 text-dark text-end fw-bold m-0">
                                                        {{ tryout.end_time ? formatDateTryouts(tryout.end_time) : '-' }}    
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </swiper-slide>
                            </swiper>
                        </div>
                    </div>
                </div>
            </div>
            <div id="playlists" v-if="playlists.length > 0"
                class="container position-relative d-flex flex-column pt-20 mt-20">
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Belajar Lewat Video ✨
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    Tingkatkan <span class="text-myprimary fw-bold">pemahamanmu</span> lewat <span class="text-myprimary fw-bold">video-video</span> pilihan terbaik.
                </p>
                <div class="row g-6 justify-content-center">
                    <div v-for="(playlist, index) in limitedPlaylists" :key="index"
                        class="col-12 col-md-6 col-xl-4">
                        <div class="ribbon ribbon-start ribbon-clip">
                            <div class="ribbon-label fw-semibold fs-6"
                                style="top: 10% !important;">
                                <span class="mw-100px mw-sm-125px text-truncate">
                                    {{ playlist.sub_product.title }}
                                </span>
                                <span class="ribbon-inner bg-myprimary"></span>
                            </div>
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <a :href="`/member-area/${product.slug}/${playlist.sub_product.slug}/playlists/${playlist.id_playlist}`" class="h-100" type="button">
                                    <div class="card-body d-flex flex-column justify-content-between h-100 p-7 gap-2">
                                        <div class="d-flex flex-column">
                                            <div class="overflow-hidden position-relative rounded ratio ratio-16x9 mb-6">
                                                <img class="object-fit-cover"
                                                    :src="`/storage/${playlist.thumbnail}`" :alt="`Thumbnail ${playlist.title}`">
                                            </div>
                                            <p class="text-dark fs-1 fs-lg-2 fw-bold mb-0 text-truncate-3">{{ playlist.title }}</p>
                                        </div>
                                        <p class="fs-5 text-gray-600 m-0">{{ playlist.playlist_videos_count ?? 0 }} Video</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center h-250px h-md-200px align-items-end position-absolute z-3 start-0 end-0"
                    style="bottom: -20px; background: linear-gradient(to top, var(--bs-light) 0%, var(--bs-light) 40%, rgba(245,248,250,0) 100%);">
                    <a href="/member-area" class="fw-semibold mb-6 btn-link-myprimary btn-link-arrow btn-link-icon fs-4">
                        <span>Akses Member Area</span> 
                        <i class="fw-normal ms-2 ri-arrow-right-s-line fs-3"></i>
                    </a>
                </div>
            </div>
            <div id="testimonials" v-if="testimonials.length > 0"
                class="pt-20 mt-20">
                <div class="bg-myprimary">
                    <div class="container">
                        <div class="row g-16 align-items-center">
                            <div class="col-12 col-md-6 py-20 py-md-0">
                                <h1 class="text-white text-center text-md-start lh-sm fw-bold fs-3hx mb-4 me-md-14 w-lg-400px">
                                    Kata Mereka, Suara dari Hati 🤍
                                </h1>
                                <p class="text-white text-center text-md-start opacity-75 fs-2 mb-0 me-md-14 w-lg-400px">
                                    Ucapan tulus dari mereka yang jadi bagian perjalanan ini.
                                </p>
                            </div>
                            <div class="testimonial-cards col-12 col-md-6 position-relative overflow-hidden h-700px">
                                <div class="testimonial-scroll d-flex flex-column gap-6 gap-lg-8">
                                    <div v-for="(testimonial, index) in testimonials" :key="index"
                                        class="card d-flex flex-column gap-8 text-start p-8 p-lg-10 rounded-4">
                                        <img src="/assets/media/elements/quotation_marks.png" class="w-45px"
                                            alt="" />
                                        <div class="d-flex flex-column justify-content-between flex-grow-1">
                                            <p class="text-dark fs-5 mb-0 fw-medium">{{ testimonial.testimonial }}</p>
                                            <div class="d-flex flex-row gap-5 mt-6 align-items-center">
                                                <img :src="`/storage/${testimonial.photo}`"
                                                    class="object-fit-cover w-50px h-50px rounded-pill" :alt="`${testimonial.name}`" />
                                                <div>
                                                    <p class="text-dark fs-4 fw-bold mb-0">{{ testimonial.name }}</p>
                                                    <p class="text-gray-600 fs-6 mb-0">{{ testimonial.title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-for="(testimonial, index) in testimonials" :key="index"
                                        class="card d-flex flex-column gap-8 text-start p-8 p-lg-10 rounded-4">
                                        <img src="/assets/media/elements/quotation_marks.png" class="w-45px"
                                            alt="" />
                                        <div class="d-flex flex-column justify-content-between flex-grow-1">
                                            <p class="text-dark fs-5 mb-0 fw-medium">{{ testimonial.testimonial }}</p>
                                            <div class="d-flex flex-row gap-5 mt-6 align-items-center">
                                                <img :src="`/storage/${testimonial.photo}`"
                                                    class="object-fit-cover w-50px h-50px rounded-pill" :alt="`${testimonial.name}`" />
                                                <div>
                                                    <p class="text-dark fs-4 fw-bold mb-0">{{ testimonial.name }}</p>
                                                    <p class="text-gray-600 fs-6 mb-0">{{ testimonial.title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tutors" v-if="tutors.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <p class="text-center text-myprimary fs-1 fw-bold mb-6 d-inline-flex align-items-center gap-3">
                    <i class="fs-1 fw-normal text-myprimary ri-book-read-fill"></i>
                    <span>Kitab Saksi</span>
                </p>
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Para Tutor Inspiratif 🌟
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-8">
                    Tutor pilihan yang <span class="text-myprimary fw-bold">berdedikasi</span> untuk membimbingmu meraih <span class="text-myprimary fw-bold">prestasi</span>.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3 mb-8">
                    <button v-for="(tag, i) in tags" :key="i" class="btn fs-5 rounded-pill btn-sm" @click="selectedTag = tag"
                        :class="selectedTag === tag ? 'btn-myprimary text-white' : 'btn-mylight'">
                        {{ tag }}
                    </button>
                </div>
                <div class="container px-0 px-md-14 px-lg-15 position-relative">
                    <button class="my-prev3 d-none d-md-block btn btn-icon btn-sm btn-mysecondary rounded-pill position-absolute top-50 start-0 translate-middle-y z-3">
                        <i class="ri-arrow-left-s-line fs-1"></i>
                    </button>
                    <button class="my-next3 d-none d-md-block btn btn-icon btn-sm btn-mysecondary rounded-pill position-absolute top-50 end-0 translate-middle-y z-3">
                        <i class="ri-arrow-right-s-line fs-1"></i>
                    </button>
                    <swiper
                        :loop="true"
                        :space-between="2"
                        :navigation="{ prevEl: '.my-prev3', nextEl: '.my-next3' }"
                        :modules="modules"
                        :autoplay="{
                            delay: 1500,
                            disableOnInteraction: false,
                        }"
                        :breakpoints="{
                            0: { slidesPerView: 2 },      
                            768: { slidesPerView: 3 },    
                            992: { slidesPerView: 4 }    
                        }">
                        <swiper-slide v-for="(tutor, index) in filteredTutors" :key="index" class="px-3 cursor-pointer"
                            @click="setTutor(tutor)" data-bs-toggle="modal" data-bs-target="#kt_modal_tutor">
                            <div class="ribbon ribbon-start ribbon-clip">
                                <div class="ribbon-label fw-semibold fs-6">
                                    <span class="mw-100px mw-sm-125px text-truncate">
                                        {{ tutor.ebook.sub_product.title }}
                                    </span>
                                    <span class="ribbon-inner bg-myprimary"></span>
                                </div>
                                <div class="overflow-hidden position-relative">
                                    <img class="w-100 bg-white p-3 p-lg-4 mb-6 rounded border border-gray-300"
                                        :src="`/storage/${tutor.photo}`" :alt="`${tutor.name}`">
                                </div>
                            </div>
                            <h4 class="text-dark text-center lh-sm fs-1 fs-md-2 fs-xl-1 mb-1">{{ tutor.name }}</h4>
                            <p class="text-gray-600 text-center fs-6 fs-xl-5 mb-0">{{ tutor.education }}</p>
                        </swiper-slide>
                    </swiper>
                    <div class="modal fade" id="kt_modal_tutor" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered justify-content-center">
                            <div class="modal-content rounded-4 mw-400px mw-md-500px">
                                <div class="modal-header ps-6 pe-3 h-60px border-bottom border-gray-300 h-60px h-lg-70px">
                                    <h2 class="modal-title">Detail Tutor</h2>
                                    <div class="btn btn-sm btn-icon btn-mylighten rounded-pill" data-bs-dismiss="modal">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>
                                <div class="modal-body p-6">
                                    <template v-if="selectedTutor">
                                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-6">
                                            <img
                                                v-if="selectedTutor.photo"
                                                :src="`/storage/${selectedTutor.photo}`"
                                                :alt="selectedTutor.name"
                                                class="w-150px img-fluid h-auto rounded"
                                            />
                                            <div class="flex-grow-1 w-100">
                                                <h4 class="text-center text-sm-start text-dark lh-sm fs-1 fs-md-2 mb-1">{{ selectedTutor.name }}</h4>
                                                <p class="text-center text-sm-start text-dark fs-5 mb-6 pb-6 border-bottom border-gray-300">{{ selectedTutor.education }}</p>
                                                <p class="text-gray-600 fs-7 mb-1">Topik / Subtopik / Subtes</p>
                                                <p class="text-dark fs-5 mb-6">{{ selectedTutor.title }}</p>
                                                <p class="text-gray-600 fs-7 mb-1">Pencapaian</p>
                                                <p class="text-dark fs-5 mb-6" id="content-editor question-editor" v-html="selectedTutor.achievement"></p>
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
            <div id="quotes" class="container d-flex pt-20 mt-20">
                <div class="bg-gradient-myprimary w-100 rounded-4 p-10 p-md-16 position-relative">
                    <p class="text-white text-uppercase fw-semibold fs-4 mb-6 mb-md-8" style="letter-spacing: 0.06em;">
                        {{ quote.name }} <span class="opacity-75 fw-normal">– {{ quote.title }}</span>
                    </p>
                    <h2 class="text-white lh-sm fs-2tx fw-bold mb-n1">
                        {{ quote.quote }}
                    </h2>
                </div>
            </div>
            <div id="blogs" v-if="blogs.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Sudut Cerita LetStudy ✍️
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    Berbagi <span class="text-myprimary fw-bold">tulisan</span>, <span class="text-myprimary fw-bold">cerita</span>, dan <span class="text-myprimary fw-bold">wawasan</span> tentang belajar dan tumbuh bareng-bareng.
                </p>
                <div class="d-flex flex-column gap-8 mb-10 w-100">
                    <div v-for="(blog, index) in blogs" :key="index">
                        <a :href="`/blogs/${blog.slug}`" class="d-flex h-100 flex-row gap-8 text-start align-items-start" id="blog-card">
                            <div class="overflow-hidden position-relative rounded-4 mw-125px mw-md-200px
                                ratio ratio-4x3 order-3 order-md-0 mt-9 mt-md-0 flex-shrink-0">
                                <img :src="`/storage/${blog.image}`"
                                    class="img-blog img-fluid object-fit-cover h-md-100" alt="" />
                            </div>
                            <div class="d-flex flex-column justify-content-between gap-6 flex-grow-1 h-100">
                                <div class="flex-grow-1">
                                    <p class="fw-semibold text-myprimary fs-5 mb-1 text-uppercase"
                                        style="letter-spacing: 0.06em;">
                                        {{ blog.sub_product?.title ?? 'General' }}
                                    </p>
                                    <p class="fw-bold text-dark fs-2 mb-2 text-truncate-2">
                                        {{ blog.title }}
                                    </p>
                                    <p class="text-gray-600 fs-5 mb-0 text-truncate-2">
                                        {{ stripTags(blog.content) }}
                                    </p>
                                </div>
                                <p class="text-gray-400 fs-6 mb-0 text-uppercase"
                                    style="letter-spacing: 0.04em;">{{ formatDateBlogs(blog.created_at) }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                <a href="/blogs" class="fw-semibold btn-link-myprimary btn-link-arrow btn-link-icon fs-4">
                    <span>Lihat semua blog</span> 
                    <i class="fw-normal ms-2 ri-arrow-right-s-line fs-3"></i>
                </a>
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
                            <a class="btn btn-sm btn-myprimary fs-5">
                                Gabung Komunitas
                            </a>
                            <a class="btn btn-sm btn-mysecondary fs-5">
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
                            :autoplay="{
                                delay: 3000,
                                disableOnInteraction: false,
                            }"
                            :modules="modules">
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
    import { Head } from '@inertiajs/vue3';
    import { computed, ref, onMounted } from 'vue'
    import { useWindowSize } from '@vueuse/core'
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
            product: Object,
            banner: Object,
            subProducts: Array,
            ebooks: Array,
            tryouts: Array,
            playlists: Array,
            testimonials: Array,
            tutors: Array,
            quote: Object,
            blogs: Array,
            donate: Object,
            sosmed: Object,
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
            const getProductIconClass = (product) => {
                const map = {
                    'LetStudy PTN': 'ri-graduation-cap-fill',
                    'LetStudy English': 'ri-translate-2', 
                    'LetStudy Karier': 'ri-briefcase-fill',
                };

                return map[product.title] || ('ri-record-circle-fill');
            };

            const formatDateEbooks = (dateString) => {
                if (!dateString) return '';

                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = String(date.getFullYear()).slice(-2);

                return `${day}/${month}/${year}`;
            };

            const formatDateTryouts = (dateString) => {
                if (!dateString) return '';

                const date = new Date(dateString);
                const time = date.toLocaleTimeString('id-ID', {
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',
                });
                const options = {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                };
                const formattedDate = date.toLocaleDateString('id-ID', options);

                return `${time}, ${formattedDate}`;
            };

            const selectedTag = ref("Semua");
            const tags = computed(() => {
            const set = new Set(props.tutors.map(t => t.ebook.sub_product.title));
                return ["Semua", ...set];
            });

            const filteredTutors = computed(() => {
                if (selectedTag.value === "Semua") {
                    return props.tutors;
                }
                return props.tutors.filter(
                    t => t.ebook.sub_product.title === selectedTag.value
                );
            });

            const selectedTutor = ref(null)
            const setTutor = (tutor) => { selectedTutor.value = tutor }

            onMounted(() => {
                const el = document.getElementById('kt_modal_tutor')
                if (el) {
                    el.addEventListener('hidden.bs.modal', () => {
                    selectedTutor.value = null
                    })
                }
            })

            const formatDateBlogs = (dateStr) => {
                const date = new Date(dateStr);
                return new Intl.DateTimeFormat('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric',
                }).format(date);
            };

            const { width } = useWindowSize()

            const limitedPlaylists = computed(() => {
                if (width.value < 768) return props.playlists.slice(0, 3)
                if (width.value < 1400) return props.playlists.slice(0, 4)
                return props.playlists.slice(0, 6)
            })

            const stripTags = (html) => {
                const div = document.createElement("div");
                div.innerHTML = html;
                return div.textContent || div.innerText || "";
            };

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
                getProductIconClass,
                formatDateEbooks,
                formatDateTryouts,
                formatDateBlogs,
                limitedPlaylists,
                selectedTag,
                tags,
                filteredTutors,
                selectedTutor,
                setTutor,
                stripTags,
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