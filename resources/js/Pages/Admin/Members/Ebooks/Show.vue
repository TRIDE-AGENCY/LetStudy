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
                                    <p class="fs-4 text-gray-600 m-0">{{ ebook.tutors_count ?? 0 }} Tutor</p>
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
                            <img class="w-100 rounded-4 object-fit-cover"
                                :src="`/storage/${ebook.image}`"
                                :alt="`Sampul ${ebook.title}`">
                        </div>
                        <div class="col-md-8 col-xl-9">
                            <h2 class="text-dark lh-base fs-2x fs-md-1 mb-3">Deskripsi</h2>
                            <div id="content-editor" class="fs-5 mb-8" v-html="ebook.description"></div>
                            <h2 class="text-dark lh-base fs-2x fs-md-1 mb-3">Benefit yang Didapatkan</h2>
                            <div id="content-editor" class="fs-5 mb-8" v-html="ebook.benefit"></div>
                            <div v-if="ebook.tutors.length" class="mb-8">
                                <h2 class="text-dark lh-base fs-2x fs-md-1 mb-3">Tutor E-Book</h2>
                                <div class="row g-5 justify-content-start">
                                    <div v-for="(tutor, index) in ebook.tutors" :key="index" role="button"
                                        @click="setTutor(tutor)" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_tutor" class="col-6 col-sm-4 col-xl-3 cursor-pointer">
                                        <img class="w-100 bg-white p-3 mb-3 rounded border border-gray-300"
                                            :src="`/storage/${tutor.photo}`" :alt="`${tutor.name}`">
                                        <h4 class="text-dark text-center lh-sm fs-1 fs-md-2 mb-1">{{ tutor.name }}</h4>
                                        <p class="text-gray-600 text-center fs-6 mb-0">{{ tutor.education }}</p>
                                    </div>
                                </div>
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
    import { ref, onMounted } from 'vue'

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
                selectedTutor,
                setTutor,
            };
        }
    }
</script>

<style>

</style>
