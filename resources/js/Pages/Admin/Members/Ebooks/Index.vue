<template>

    <Head>
        <title>Member Area − {{ product.title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Member Area</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">{{ product.title }}</h1>
                            <span class="badge px-3 py-2 fs-5">{{ subProduct.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <ul class="nav nav-tabs nav-line-tabs mb-8 fs-4">
                        <li class="nav-item">
                            <Link class="nav-link active" href="#">E-Book</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="`/admin/${product.slug}/${subProduct.slug}/tryouts`">Tryout</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="`/admin/${product.slug}/${subProduct.slug}/playlists`">Playlist</Link>
                        </li>
                    </ul>
                    <div class="d-flex flex-grow gap-4 flex-column flex-sm-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3x fs-md-2x mb-1">E-Book Masterclass 🔥</h1>
                            <p class="text-gray-600 fs-4 mb-0">
                                Akses semua Kitab Sakti yang siap bantu kamu menaklukkan ujian.
                            </p>
                        </div>
                        <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks/create`"
                            class="w-100 w-sm-auto btn btn-sm btn-myprimary fs-5 align-self-end white-space-nowrap">
                            Tambah E-Book
                        </Link>
                    </div>
                    <div class="row g-6">
                        <div class="text-center py-10" v-if="ebooks.data.length === 0">
                            <img src="/assets/media/illustrations/empty.png"
                                alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                            <h2 class="text-dark mb-4">Belum Ada E-Book</h2>
                            <p class="text-gray-600 fs-4 mb-0">Silakan tambahkan e-book baru untuk akses belajar.</p>
                        </div>
                        <div v-else v-for="ebook in ebooks.data" :key="ebook.id" class="col-12 col-md-6 col-xxl-4">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks/${ebook.slug}`" type="button">
                                    <div class="card-body d-flex p-7">
                                        <img class="h-150px h-sm-200px object-fit-cover"
                                            :src="`/storage/${ebook.image}`"
                                            :alt="`Sampul ${ebook.title}`">
                                        <div class="d-flex flex-column flex-grow-1 ms-6 justify-content-between">
                                            <p class="text-dark fs-1 fs-lg-2 fw-bold mb-3 text-truncate-3">{{ ebook.title }}</p>
                                            <div>
                                                <div class="d-flex align-items-center gap-3 mb-3">
                                                    <i class="fs-3 text-gray-600 ri-user-voice-line"></i>
                                                    <p class="fs-5 text-gray-600 m-0">{{ ebook.total_tutors ?? 0 }} Tutor</p>
                                                </div>
                                                <div class="d-flex align-items-center gap-3 mb-3">
                                                    <i class="fs-3 text-gray-600 ri-book-open-line"></i>
                                                    <p class="fs-5 text-gray-600 m-0">{{ ebook.total_pages.toLocaleString('id-ID') }} Halaman</p>
                                                </div>
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="fs-3 text-gray-600 ri-calendar-check-line"></i>
                                                    <p class="fs-5 text-gray-600 m-0">Rilis {{ formatDate(ebook.launch_date) }}</p>
                                                </div>
                                            </div>
                                        </div>
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
            product: Object,
            subProduct: Object,
            ebooks: Object,
        },

        setup() {
            const formatDate = (dateString) => {
                if (!dateString) return '';

                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = String(date.getFullYear()).slice(-2);

                return `${day}/${month}/${year}`;
            };

            return {
                formatDate,
            };
        }
    }
</script>

<style>

</style>
