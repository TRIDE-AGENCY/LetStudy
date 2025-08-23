<template>

    <Head>
        <title>Section Tutor − {{ product.title }}</title>
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
                                <Link :href="`/admin/pages/products/${product.slug}`" class="btn-link-myprimary fw-bold pe-3">{{ product.title }}</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Tutor</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Section Tutor</h1>
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
                                        placeholder="Cari nama tutor disini..." v-model="search" />
                                </form>
                            </div>
                            <div class="d-flex gap-4">
                                <Link :href="`/admin/pages/products/${product.slug}/tutors/create`" type="button"
                                    class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-center white-space-nowrap">
                                    Tambah Tutor
                                </Link>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="tutors.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Tutor Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada tutor atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#</th>
                                            <th class="bg-secondary min-w-300px" style="letter-spacing: 0.04em;">
                                                Tutor
                                            </th>
                                            <th class="bg-secondary min-w-250px" style="letter-spacing: 0.04em;">
                                                E-Book</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(tutor, index) in tutors.data" :key="index">
                                            <td class="ps-6">
                                                {{ ++index + (tutors . current_page - 1) * tutors . per_page }}
                                            </td>
                                            <td class="d-flex align-items-center gap-3">
                                                <img class="w-45px h-45px min-w-45px rounded-circle object-fit-cover"
                                                    :src="`/storage/${tutor.photo}`" alt="Foto Profil">
                                                <div>
                                                    <p class="text-dark fw-bold mb-1">{{ tutor . name }}</p>
                                                    <p class="fs-7 mb-0">{{ tutor . education }}</p>
                                                </div>
                                            </td>
                                            <td class="mw-250px">
                                                <div>
                                                    <p class="mb-1">{{ tutor . ebook . title }}</p>
                                                    <p class="fs-7 mb-0">{{ tutor . title }}</p>
                                                </div>
                                            </td>
                                            <td class="text-end pe-6">
                                                <Link :href="`/admin/pages/products/${product.slug}/tutors/${tutor.id}/edit`" type="button"
                                                    class="btn btn-sm btn-icon btn-mysecondary me-2">
                                                    <i class="ri-edit-2-fill fs-3"></i></Link>
                                                <button @click.prevent="destroy(tutor.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="tutors.links" align="end" class="py-5 px-6" />
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
            tutors: Object,
            product: Object
        },

        setup(props) {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get(`/admin/pages/products/${props.product.slug}/tutors`, {
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
                        router.delete(`/admin/pages/products/${props.product.slug}/tutors/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Tutor Berhasil Dihapus!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            },
                        });
                    }
                });
            };

            return {
                search,
                handleSearch,
                destroy,
            };
        },
    };
</script>

<style>

</style>
