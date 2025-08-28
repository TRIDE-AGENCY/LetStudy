<template>

    <Head>
        <title>Section FAQs − LetStudy</title>
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
                                <Link href="/admin/pages/letstudy" class="btn-link-myprimary fw-bold pe-3">LetStudy</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">FAQs</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Section Pertanyaan Umum</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="card rounded-4 border border-gray-300">
                        <div class="d-flex flex-grow border-0 p-6 gap-4 flex-column flex-md-row">
                            <div class="flex-grow-1 ">
                                <form @submit.prevent="handleSearch"
                                    class="d-flex align-items-center position-relative my-1w-100 w-md-300px">
                                    <i class="ri-search-line position-absolute ms-5 fs-3"></i>
                                    <input type="text" class="form-control form-control-solid ps-13 fs-5"
                                        placeholder="Cari pertanyaan disini..." v-model="search" />
                                </form>
                            </div>
                            <div class="d-flex gap-4">
                                <Link href="/admin/pages/letstudy/faqs/create" type="button"
                                    class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-center white-space-nowrap">
                                    Tambah FAQs
                                </Link>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="faqs.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Pertanyaan Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada pertanyaan atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#</th>
                                            <th class="bg-secondary min-w-250px" style="letter-spacing: 0.04em;">Pertanyaan</th>
                                            <th class="bg-secondary min-w-150px" style="letter-spacing: 0.04em;">Kategori</th>
                                            <th class="bg-secondary min-w-100px" style="letter-spacing: 0.04em;">Status</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(faq, index) in faqs.data" :key="index">
                                            <td class="ps-6">
                                                {{ ++index + (faqs . current_page - 1) * faqs . per_page }}
                                            </td>
                                            <td class="text-dark fw-bold mw-300px text-truncate">
                                                <i v-if="faq.is_featured" class="ri-star-fill fs-4 me-1 text-warning"></i>
                                                {{ faq . question }}
                                            </td>
                                            <td>{{ faq . category }}</td>
                                            <td>
                                                <span
                                                    class="text-capitalize fw-bold fs-7 px-3 py-1 rounded"
                                                    :class="{
                                                        'btn-mysecondary pe-none': faq.status === 'published',
                                                        'btn-mydanger pe-none': faq.status === 'archived'
                                                    }"
                                                >
                                                    {{ faq.status === 'published' ? 'Terbit' : faq.status === 'archived' ? 'Arsip' : faq.status }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-6">
                                                <Link :href="`/admin/pages/letstudy/faqs/${faq.id}/edit`" type="button"
                                                    class="btn btn-sm btn-icon btn-mysecondary me-2">
                                                    <i class="ri-edit-2-fill fs-3"></i></Link>
                                                <button @click.prevent="destroy(faq.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="faqs.links" align="end" class="py-5 px-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../../Layouts/Admin.vue';
    import Pagination from '../../../../../Components/Pagination.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import Swal from 'sweetalert2';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
            Pagination
        },

        props: {
            errors: Object,
            faqs: Object,
        },

        setup() {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get('/admin/pages/letstudy/faqs', {
                    q: search.value,
                });
            }

            const destroy = (id) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    showCancelButton: true,
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    customClass: {
                        popup: 'swal-custom-icon',
                        confirmButton: "btn btn-sm btn-myprimary",
                        cancelButton: "btn btn-sm btn-mydanger"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        router.delete(`/admin/pages/letstudy/faqs/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data FAQs Berhasil Dihapus!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            }
                        });
                    }
                })
            };

            return {
                search,
                handleSearch,
                destroy,
            }
        }
    }
</script>

<style>

</style>
