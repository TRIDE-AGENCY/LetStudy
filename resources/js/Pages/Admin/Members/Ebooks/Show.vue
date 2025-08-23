<template>

    <Head>
        <title>Detail E-Book − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/dashboard" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks`" class="btn-link-myprimary fw-bold pe-3">Member Area</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Detail E-Book</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Detail E-Book</h1>
                            <span class="badge px-3 py-2 fs-5">{{ subProduct.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="d-flex flex-grow gap-6 flex-column flex-md-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3qx fs-md-2qx mb-3">{{ ebook.title }}</h1>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3 me-4">
                                    <i class="fs-3 text-gray-600 ri-calendar-check-line"></i>
                                    <p class="fs-4 text-gray-600 m-0">Rilis {{ formatDate(ebook.launch_date) }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-3 me-4">
                                    <i class="fs-3 text-gray-600 ri-book-open-line"></i>
                                    <p class="fs-4 text-gray-600 m-0">{{ ebook.total_pages.toLocaleString('id-ID') }} Halaman</p>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fs-3 text-gray-600 ri-user-voice-line"></i>
                                    <p class="fs-4 text-gray-600 m-0">{{ ebook.total_tutors ?? 0 }} Tutor</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-4">
                            <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks/${ebook.slug}/edit`"
                                class="w-100 w-md-auto btn btn-sm btn-mysecondary fs-5 align-self-end white-space-nowrap">
                                Edit E-Book
                            </Link>
                            <!-- <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks/${ebook.slug}/read`"
                                class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-end white-space-nowrap">
                                Baca E-Book
                            </Link> -->
                            <a :href="`https://drive.google.com/file/d/${ebook.id_ebook}/preview`" target="_blank"
                                class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-end white-space-nowrap">
                                Baca E-Book
                            </a>
                        </div>
                    </div>
                    <div class="row g-8">
                        <div class="col-md-4 col-xl-3">
                            <img class="w-100 object-fit-cover"
                                :src="`/storage/${ebook.image}`"
                                :alt="`Sampul ${ebook.title}`">
                        </div>
                        <div class="col-md-8 col-xl-9">
                            <h2 class="text-dark lh-base fs-2x fs-md-1 mb-3">Deskripsi</h2>
                            <div id="content-editor" class="fs-5 mb-8" v-html="ebook.description"></div>
                            <h2 class="text-dark lh-base fs-2x fs-md-1 mb-3">Benefit yang Didapatkan</h2>
                            <div id="content-editor" class="fs-5 mb-8" v-html="ebook.benefit"></div>
                            <h2 class="text-dark lh-base fs-2x fs-md-1 mb-3">Tutor E-Book</h2>
                            <p class="text-gray-600 fs-5 mb-8">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <h2 class="text-dark lh-base fs-2x fs-md-1 mb-3">Hak Cipta</h2>
                            <p class="text-gray-600 fs-5 mb-0">
                                Dilarang mengutip atau menduplikasi sebagian atau seluruh isi buku ini dengan cara apa pun, tanpa izin sah dari Team LetStudy. Hukum yang berlaku sesuai dengan UNDANG-UNDANG REPUBLIK INDONESIA terkait Hak Cipta No.28 tahun 2014.
                            </p>
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
            ebook: Object,
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
