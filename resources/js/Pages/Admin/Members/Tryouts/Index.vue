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
                            <Link class="nav-link" :href="`/admin/${product.slug}/${subProduct.slug}/ebooks`">E-Book</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link active" href="#">Tryout</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="`/admin/${product.slug}/${subProduct.slug}/playlists`">Playlist</Link>
                        </li>
                    </ul>
                    <div class="d-flex flex-grow gap-4 flex-column flex-sm-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3x fs-md-2x mb-1">Siap Tryout? 📝</h1>
                            <p class="text-gray-600 fs-4 mb-0">
                                Uji kemampuanmu dan temukan potensi terbaikmu.
                            </p>
                        </div>
                        <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/create`"
                            class="w-100 w-sm-auto btn btn-sm btn-myprimary fs-5 align-self-end white-space-nowrap">
                            Tambah Tryout
                        </Link>
                    </div>
                    <div class="row g-6">
                        <div class="text-center py-10" v-if="tryouts.data.length === 0">
                            <img src="/assets/media/illustrations/empty.png"
                                alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                            <h2 class="text-dark mb-4">Belum Ada Tryout</h2>
                            <p class="text-gray-600 fs-4 mb-0">Silakan tambahkan Tryout baru untuk akses latihan.</p>
                        </div>
                        <div v-else v-for="tryout in tryouts.data" :key="tryout.id" class="col-12 col-md-6 col-xxl-4">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <div class="card-body d-flex flex-column justify-content-between h-100 p-7 gap-7">
                                    <div class="d-flex flex-column">
                                        <p class="text-dark fs-1 fs-lg-2 fw-bold pb-5 mb-6 text-truncate-3 border-bottom border-gray-300">{{ tryout.title }}</p>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-timer-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">Durasi</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">{{ tryout.duration.toLocaleString('id-ID') }} Menit</p>
                                        </div>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-list-check-2"></i>
                                                <p class="fs-5 text-gray-600 m-0">Jumlah Soal</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">0 Soal</p>
                                        </div>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-login-box-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">Mulai</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">
                                                {{ tryout.start_time ? formatDate(tryout.start_time) : '-' }}
                                            </p>
                                        </div>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-logout-box-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">Selesai</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">
                                                {{ tryout.end_time ? formatDate(tryout.end_time) : '-' }}    
                                            </p>
                                        </div>
                                    </div>
                                    <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}`"
                                        class="btn btn-sm btn-myprimary fs-5">
                                        Detail Tryout
                                    </Link>
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
            tryouts: Object,
        },

        setup() {
            const formatDate = (dateString) => {
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

            return {
                formatDate,
            };
        }
    }
</script>

<style>

</style>
