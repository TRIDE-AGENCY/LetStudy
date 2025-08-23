<template>

    <Head>
        <title>Hasil Tryout − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts`" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}`" class="btn-link-myprimary fw-bold pe-3">Detail Tryout</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Hasil Tryout</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Hasil Tryout</h1>
                            <span class="badge px-3 py-2 fs-5">{{ subProduct.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="d-flex flex-grow gap-6 flex-column flex-md-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3qx fs-md-2qx mb-3">{{ tryout.title }}</h1>
                            <p class="fs-4 text-gray-600 m-0">
                                {{ tryout.description ? tryout.description : 'Tidak ada deskripsi pada Tryout ini.' }}
                            </p>
                        </div>
                    </div>
                    <div class="card rounded-4 border border-gray-300 mt-6">
                        <div class="card-header border-0 p-6 d-flex gap-4 flex-column flex-md-row">
                            <div class="d-flex flex-column flex-grow-1">
                                <h1 class="fs-2 mb-2">Peringkat Nilai</h1>
                                <p class="fs-5 text-gray-600 mb-0">Menampilkan dari tertinggi ke terendah</p>
                            </div>
                            <div class="card-toolbar m-0">
                                <form @submit.prevent="handleSearch"
                                    class="d-flex align-items-center position-relative my-1 w-100 w-md-300px">
                                    <i class="ri-search-line position-absolute ms-5 fs-3"></i>
                                    <input type="text" class="form-control form-control-solid ps-13 fs-5"
                                        placeholder="Cari peserta disini..." v-model="search" />
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="all_grades.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Peserta Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada peserta atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#</th>
                                            <th class="bg-secondary min-w-150px" style="letter-spacing: 0.04em;">Nama</th>
                                            <th class="bg-secondary min-w-75px pe-6" style="letter-spacing: 0.04em;">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(item) in all_grades.data" :key="item.id"
                                            :class="{ 'bg-mysecondary text-mysecondary fw-bold': item.user?.id === user_id }">
                                            <td class="ps-6">{{ item.ranking }}</td>
                                            <td class="text-dark fw-bold">{{ item.user?.name ?? 'Tidak Diketahui' }}</td>
                                            <td class="pe-6">{{ parseFloat(item.grade).toFixed(2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="all_grades.links" align="end" class="py-5 px-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../Layouts/Admin.vue';
    import Pagination from '../../../../Components/Pagination.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { ref } from 'vue';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
            Pagination
        },

        props: {
            product: Object,
            subProduct: Object,
            tryout: Object,
            all_grades: Object,
        },

        setup(props) {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get(`/admin/${props.product.slug}/${props.subProduct.slug}/tryouts/${props.tryout.slug}/result`, {
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
                        router.delete(`/admin/${props.product.slug}/${props.subProduct.slug}/tryouts/${props.tryout.slug}/questions/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Soal Tryout Berhasil Dihapus!',
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
                destroy
            }
        }
    }
</script>

<style>

</style>
