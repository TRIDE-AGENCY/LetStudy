<template>
    <Head>
        <title>LetStudy</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div id="home" class="bg-white">
                <Navbar />
                <div v-if="banners.length > 0" 
                    class="container pt-10 pt-md-20">
                    <swiper
                        :loop="true"
                        :space-between="20"
                        :modules="modules"
                        :autoplay="{
                            delay: 5000,
                            disableOnInteraction: false,
                        }"
                        :breakpoints="{
                            0: { slidesPerView: 1 },      
                        }">
                        <swiper-slide  v-for="(banner, index) in banners" :key="index"
                            class="d-flex h-100 align-self-end">
                            <div class="row g-10 justify-content-center justify-content-lg-start">
                                <div class="col-12 col-lg-6 mw-600px mw-md-700px align-self-center">
                                    <p class="text-center text-lg-start text-gray-600 fs-5 text-myprimary fw-bold mb-3"
                                        style="letter-spacing: 0.04em;">
                                        #YOURSTUDYPARTNER
                                    </p>
                                    <h1 class="text-center text-lg-start text-dark lh-sm fw-bold fs-3hx mb-6">
                                        {{ banner.heading }}
                                    </h1>
                                    <p class="text-center text-lg-start text-gray-600 fs-4 mb-8">
                                        {{ banner.sub_heading }}
                                    </p>
                                    <div class="d-flex flex-wrap gap-4 justify-content-center justify-content-lg-start mb-lg-20">
                                        <a :href="`${banner.ebook.id_form}`" target="_blank" class="btn btn-lg btn-myprimary ps-6 fs-4 d-inline-flex gap-2 align-items-center">
                                            <i class="fs-3 ri-download-cloud-2-line"></i>
                                            <span>Unduh Sekarang</span>
                                        </a>
                                        <a :href="isLoggedIn 
                                            ? `https://drive.google.com/file/d/${banner.ebook.id_ebook}/preview` : '/login'"
                                            :target="isLoggedIn ? '_blank' : '_self'"
                                            class="btn btn-lg btn-mysecondary ps-6 fs-4 d-inline-flex gap-2 align-items-center">
                                            <i class="fs-3 ri-book-open-line"></i>
                                            <span>Baca E-Book</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mw-500px mw-lg-100 align-self-end">
                                    <img class="img-landing w-100 mt-5 mt-md-10 mt-lg-0"
                                        :src="`/storage/${banner.image}`" alt="Gambar Hero Section">
                                </div>
                            </div>
                        </swiper-slide>
                    </swiper>
                </div>
            </div>
            <div id="usps" v-if="usps.length > 0"
                class="container d-flex flex-column pt-20 mt-20">
                <p class="fs-5 text-myprimary fw-bold mb-3"
                    style="letter-spacing: 0.04em;">
                    NON GOVERMENTAL ORGANIZATION
                </p>
                <h1 class="text-dark lh-sm fw-bold fs-3hx mb-4">
                    Platform Edu-Tech Nirlaba
                </h1>
                <p class="text-gray-600 fs-2 fw-semibold mb-10">
                    LetStudy berkomitmen membuka <span class="text-myprimary fw-bold">akses pendidikan gratis</span>, <span class="text-myprimary fw-bold">inklusif</span>, dan <span class="text-myprimary fw-bold">berkelanjutan</span> bagi seluruh anak bangsa.
                </p>
                <div class="row g-6">
                    <div v-for="(usp, index) in usps" :key="index"
                        class="col-12 col-md-6">
                        <div class="card card-hover h-100 p-8 rounded-4 border border-gray-300">
                            <img class="w-70px p-4 rounded bg-mysecondary mb-7" :src="`/storage/${usp.icon}`" :alt="`${usp.title}`">
                            <h3 class="text-dark lh-sm fs-2hx fs-md-1 mb-4">{{ usp.title }}</h3>
                            <p class="text-gray-600 fs-5 mb-0">
                                {{ usp.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="impact-reports" class="container d-flex pt-20 mt-20">
                <div class="bg-gradient-myprimary rounded-4 px-10 pt-10 px-md-16 py-md-16 w-100 d-flex flex-column align-items-center align-items-md-start position-relative">
                    <div class="w-100 w-md-50 w-impact text-center d-flex flex-column flex-center flex-md-start text-md-start">
                        <p class="text-white fs-4 mb-4 opacity-75">
                            {{ report.sub_heading }}
                        </p>
                        <h2 class="text-white lh-sm fs-3x fw-bold fs-md-2x mb-8 me-xl-20 pe-xxl-20">
                            {{ report.heading }}
                        </h2>
                        <a :href="`https://drive.google.com/file/d/${report.id_report}/preview`" target="_blank" class="btn-link-white btn-link-arrow btn-link-icon fw-bold fs-4">
                            <span>Baca selengkapnya disini</span> 
                            <i class="fw-normal ms-2 ri-arrow-right-s-line fs-3"></i>
                        </a>
                    </div>
                    <img class="img-impact position-md-absolute mt-10 mt-md-0"
                        :src="`/storage/${report.image}`" alt="Sampul Laporan">
                </div>
            </div>
            <div id="achievements" v-if="achievements.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Pencapaian Project LetStudy 🎯
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
            <div id="products" v-if="products.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Produk Unggulan Kami ✨
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    LetStudy menghadirkan <span class="text-myprimary fw-bold">tiga produk unggulan</span>  untuk menjawab kebutuhan generasi muda.
                </p>
                <div class="row g-6 justify-content-center">
                    <div v-for="(product, index) in products" :key="index" 
                        class="col-12 col-sm-6 col-lg-4">
                        <div class="card card-hover align-self-center flex-column justify-content-between h-100 p-8 gap-8 rounded-4 border border-gray-300">
                            <div class="d-flex flex-column align-items-center">
                                <img class="w-175px mb-6" :src="`/storage/${product.logo}`" :alt="`${product.title}`">
                                <p class="text-center text-gray-600 fs-5 mb-0">
                                    {{ product.description }}
                                </p>
                            </div>
                            <a :href="`${product.slug}`" class="btn btn-sm btn-myprimary fs-5 d-inline-flex gap-2 align-items-center justify-content-center">
                                <i :class="[getProductIconClass(product), 'fs-3']"></i>
                                <span>Lihat Produk</span>
                            </a>
                        </div>
                    </div>
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
                                            <p class="text-dark fs-5 mb-0 fw-medium">{{ testimonial.testimonial }} − {{ testimonial.product.title }}</p>
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
                                            <p class="text-dark fs-5 mb-0 fw-medium">{{ testimonial.testimonial }} − {{ testimonial.product.title }}</p>
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
            <div id="partners" v-if="partners.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-10">
                    Bersama Partner Hebat 🚀
                </h1>
                <div class="container px-0 px-md-12 w-lg-800px w-xl-900px position-relative">
                    <button class="my-prev2 d-none d-md-block btn btn-icon btn-sm btn-mysecondary rounded-pill position-absolute top-50 translate-middle-y z-3">
                        <i class="ri-arrow-left-s-line fs-1"></i>
                    </button>
                    <button class="my-next2 d-none d-md-block btn btn-icon btn-sm btn-mysecondary rounded-pill position-absolute top-50 translate-middle-y z-3">
                        <i class="ri-arrow-right-s-line fs-1"></i>
                    </button>
                    <swiper
                            :loop="true"
                            :centered-slides="true"
                            :slides-per-view="1"    
                            :space-between="20"
                            :navigation="{ prevEl: '.my-prev2', nextEl: '.my-next2' }"
                            :autoplay="{
                                delay: 5000,
                                disableOnInteraction: false,
                            }"
                            :modules="modules"
                        >
                        <swiper-slide v-for="(partner, index) in partners" :key="index">
                            <div class="d-flex flex-column flex-md-row gap-10 gap-md-12 align-items-center align-items-md-start px-0 px-md-6">
                                <div class="order-2 order-md-1 w-100">
                                    <p class="text-dark text-center text-md-end fw-medium fs-3 mb-8">
                                        {{ partner.statement }}
                                    </p>
                                    <div class="d-flex flex-column flex-center flex-md-end">
                                        <h4 class="text-dark text-end lh-sm fs-2qx fs-md-2 mb-1">{{ partner.name }}</h4>
                                        <p class="text-gray-600 text-end fs-5 mb-0">{{ partner.title }}</p>
                                    </div>
                                </div>
                                <div class="order-1 order-md-2 w-150px d-flex flex-column align-items-end">
                                    <img class="w-150px bg-white p-3 rounded border border-gray-300"
                                        :src="`/storage/${partner.photo}`" :alt="partner.name" style="transform: rotate(2.5deg);">
                                    <img class="mw-125px mh-75px bg-white p-2 rounded border border-gray-300 me-n3 mt-n9"
                                        :src="`/storage/${partner.logo}`" :alt="partner.name" style="transform: rotate(-2.5deg);">
                                </div>
                            </div>
                        </swiper-slide>
                    </swiper>
                </div>  
            </div>
            <div id="supports" v-if="supports.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    Bersama mereka, kami <span class="text-myprimary fw-bold">melangkah lebih jauh</span> 🌟
                </p>
                <div class="supports-wrapper overflow-hidden position-relative w-100">
                    <div class="supports-content gap-10">
                        <a v-for="(support, index) in supports" :key="index"
                            :href="support.link" target="_blank" rel="noopener">
                            <img class="h-50px" :src="`/storage/${support.logo}`" :alt="support.name" />
                        </a>
                        <a v-for="(support, index) in supports" :key="index"
                            :href="support.link" target="_blank" rel="noopener">
                            <img class="h-50px" :src="`/storage/${support.logo}`" :alt="support.name" />
                        </a>
                    </div>
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
                                    style="letter-spacing: 0.04em;">{{ formatDate(blog.created_at) }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                <a href="/blogs" class="fw-semibold btn-link-myprimary btn-link-arrow btn-link-icon fs-4">
                    <span>Lihat semua blog</span> 
                    <i class="fw-normal ms-2 ri-arrow-right-s-line fs-3"></i>
                </a>
            </div>
            <div id="faqs" v-if="faqs1.length > 0"
                class="container d-flex flex-column flex-center pt-20 mt-20">
                <p class="text-center text-myprimary fs-1 fw-bold mb-6 d-inline-flex align-items-center gap-3">
                    <i class="fs-1 fw-normal text-myprimary ri-chat-thread-fill"></i>
                    <span>FAQs</span>
                </p>
                <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                    Yang Sering Ditanyain 🤔
                </h1>
                <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                    Tenang, kamu nggak sendirian! <span class="text-myprimary fw-bold">Kami rangkum semua jawaban</span> biar kamu nggak bingung lagi.
                </p>
                <div class="d-flex flex-column flex-md-row gap-4 gap-lg-6 w-100 mb-10">
                    <div class="d-flex flex-column gap-4 gap-lg-6 w-100">
                        <div v-for="(faq1, index) in faqs1" :key="`faq1-${index}`"
                            class="card card-hover cursor-pointer ps-6 ps-lg-8 pe-3 pe-lg-5 py-4 py-lg-6 rounded-4 border border-gray-300 collapsible toggle collapsed w-100"
                            data-bs-toggle="collapse" :data-bs-target="`#faq-collapse-${index}`">
                            <div class="d-flex align-items-center justfy-content-between gap-2">
                                <h6 class="text-dark w-100 lh-sm fs-1 fs-md-2 mb-0">
                                    {{ faq1.question }}
                                </h6>
                                <div class="btn btn-sm btn-icon btn-active-color-myprimary">
                                    <i class="ri-checkbox-indeterminate-fill fs-1 toggle-on text-myprimary"></i>
                                    <i class="ri-add-box-fill fs-1 toggle-off text-gray-400"></i>
                                </div>
                            </div>
                            <div :id="`faq-collapse-${index}`" class="collapse mt-2">
                                <p id="content-editor" class="text-gray-600 fs-5 mb-1 me-13" v-html="faq1.answer"></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-4 gap-lg-6 w-100">
                        <div v-for="(faq2, index) in faqs2" :key="`faq2-${index}`"
                            class="card card-hover cursor-pointer ps-6 ps-lg-8 pe-3 pe-lg-5 py-4 py-lg-6 rounded-4 border border-gray-300 collapsible toggle collapsed w-100"
                            data-bs-toggle="collapse" :data-bs-target="`#faq-collapse-${index + faqs1.length}`">
                            <div class="d-flex align-items-center justfy-content-between gap-2">
                                <h6 class="text-dark w-100 lh-sm fs-1 fs-md-2 mb-0">
                                    {{ faq2.question }}
                                </h6>
                                <div class="btn btn-sm btn-icon btn-active-color-myprimary">
                                    <i class="ri-checkbox-indeterminate-fill fs-1 toggle-on text-myprimary"></i>
                                    <i class="ri-add-box-fill fs-1 toggle-off text-gray-400"></i>
                                </div>
                            </div>
                            <div :id="`faq-collapse-${index + faqs1.length}`" class="collapse mt-2">
                                <p id="content-editor" class="text-gray-600 fs-5 mb-1 me-13" v-html="faq2.answer"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/faqs" class="fw-semibold btn-link-myprimary btn-link-arrow btn-link-icon fs-4">
                    <span>Lihat semua FAQs</span> 
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
    import { computed, ref, onMounted } from 'vue'
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
            banners: Array,
            usps: Array,
            report: Object,
            achievements: Array,
            products: Array,
            testimonials: Array,
            tutors: Array,
            quote: Object,
            partners: Array,
            supports: Array,
            blogs: Array,
            faqs1: Array,
            faqs2: Array,
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
            const page = usePage();
            const user = computed(() => page.props.auth?.user);
            const isLoggedIn = computed(() => !!user.value);

            const stripTags = (html) => {
                const div = document.createElement("div");
                div.innerHTML = html;
                return div.textContent || div.innerText || "";
            };

            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return new Intl.DateTimeFormat('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric',
                }).format(date);
            };

            const getProductIconClass = (product) => {
                const map = {
                    'LetStudy PTN': 'ri-graduation-cap-line',
                    'LetStudy English': 'ri-translate-2', 
                    'LetStudy Karier': 'ri-briefcase-line',
                };

                return map[product.title] || ('ri-record-circle-line');
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
                isLoggedIn,
                stripTags,
                formatDate,
                getProductIconClass,
                selectedTag,
                tags,
                filteredTutors,
                selectedTutor,
                setTutor,
                donateAchievements,
                formatCount,
                formattedBankName,
                modules: [Autoplay, Pagination, Navigation],
            }
        }
    };
</script>

<style scoped>
    .my-prev2 { left: 0; }
    .my-next2 { right: 0; }

    @media (min-width: 992px) { 
        .my-prev2 { left: -16px; }
        .my-next2 { right: -16px; }
    }

    .swal-z100 {
        z-index: 100 !important;
    }

    .img-impact {
        height: auto;
        width: 100%;
        max-width: 325px;
    }

    @media (min-width: 768px) {
        .img-impact {
            height: 94%;
            width: auto;
            max-width: none;
            bottom: 0;
            right: 3.5rem;
        }
    }

    @media (min-width: 992px) {
        .img-impact {
            height: 116%;
            right: 3.75rem;
        }

        .w-impact {
            width: 55% !important;
        }
    }

    @media (min-width: 1200px) {
        .w-impact {
            width: 65% !important;
        }
    }

    @media (min-width: 1400px) {
        .w-impact {
            width: 75% !important;
        }
    }
    
</style>