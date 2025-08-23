<template>

    <Head>
        <title>Halaman {{ product.title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">{{ product.title }}</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Halaman {{ product.title }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="row g-4 g-md-6">
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link :href="`/admin/pages/products/${product.slug}/banner`" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-news-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Banner</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ bannerComplete }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link :href="`/admin/pages/products/${product.slug}/sub-products`" type="button">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <span class="menu-icon mb-4">
                                            <i class="ri-shapes-fill fs-5hx fs-md-4hx text-myprimary"></i>
                                        </span>
                                        <p class="text-gray-800 fs-3 fw-bold mb-2 text-truncate">Sub Produk</p>
                                        <p class="fs-6 fw-semibold text-gray-400 m-0">
                                            {{ subProducts > 0 ? subProducts + ' Data' : 'Belum Tersedia' }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link :href="`/admin/pages/products/${product.slug}/testimonials`" type="button">
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
                                <Link :href="`/admin/pages/products/${product.slug}/tutors`" type="button">
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
                                <Link :href="`/admin/pages/products/${product.slug}/quote`" type="button">
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
                                <Link :href="`/admin/pages/products/${product.slug}/blogs`" type="button">
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
                                <Link :href="`/admin/pages/products/${product.slug}/social-media`" type="button">
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
    import { Head, Link } from '@inertiajs/vue3';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            product: Object,
            bannerComplete: String,
            subProducts: Number,
            testimonials: Number,
            tutors: Number,
            quoteComplete: String,
            blogs: Number,
            sosmedCount: Number,
        },
    }
</script>

<style>

</style>
