<template>

    <Head>
        <title>Halaman LetStudy</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/dashboard" class="btn-link-myprimary fw-bold pe-3">Dashboard</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">LetStudy</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Halaman LetStudy</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="row g-4 g-md-6">
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/banners" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-book-read-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Banner</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ banners > 0 ? banners + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/usps" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-award-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">USP</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ usps > 0 ? usps + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/report" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-file-chart-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Impact Report</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ reportComplete }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/achievements" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-trophy-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Pencapaian</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ achievements > 0 ? achievements + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/products" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-apps-2-ai-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Produk</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ listProducts > 0 ? listProducts + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/testimonials" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-chat-quote-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Testimoni</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ testimonials > 0 ? testimonials + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/tutors" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-user-voice-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Tutor</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ tutors > 0 ? tutors + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/quote" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-double-quotes-l fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Kutipan</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ quoteComplete }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/partners" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-community-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Partner</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ partners > 0 ? partners + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/supports" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-service-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Dukungan</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ supports > 0 ? supports + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/blogs" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-article-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Blog</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ blogs > 0 ? blogs + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/faqs" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-question-answer-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">FAQs</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ faqs > 0 ? faqs + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/donate" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-gift-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Donasi</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ donateComplete }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link href="/admin/pages/letstudy/social-media" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-global-line fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Sosial Media</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ sosmedCount > 0 ? sosmedCount + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../Layouts/Admin.vue';
    import { Head, Link, router } from '@inertiajs/vue3';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            banners: Number,
            usps: Number,
            reportComplete: String,
            achievements: Number,
            listProducts: Number,
            testimonials: Number,
            tutors: Number,
            quoteComplete: String,
            partners: Number,
            supports: Number,
            blogs: Number,
            faqs: Number,
            donateComplete: String,
            sosmedCount: Number,
        },
    }
</script>

<style>

</style>
