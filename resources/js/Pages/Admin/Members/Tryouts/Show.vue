<template>

    <Head>
        <title>Detail Tryout − {{ product.title }}</title>
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
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts`" class="btn-link-myprimary fw-bold pe-3">Member Area</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Detail Tryout</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Detail Tryout</h1>
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
                        <div class="d-flex gap-4">
                            <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}/edit`"
                                class="w-100 w-md-auto btn btn-sm btn-mysecondary fs-5 align-self-end white-space-nowrap">
                                Edit Tryout
                            </Link>
                            <Link v-if="tryout.finished_grades_count > 0"
                                :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}/result`"
                                class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-end white-space-nowrap">
                                Hasil Tryout
                            </Link>
                        </div>
                    </div>
                    <div class="row g-4 g-md-6 mb-6">
                        <div class="col-12 col-md-4">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                    <div class="p-6 bg-mywarning-light rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-timer-fill text-mywarning fs-3qx fs-md-2qx"></i>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Durasi (Menit)</p>
                                        <h1 class="fs-3qx fs-md-2qx mb-0">{{ tryout.duration.toLocaleString('id-ID') }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                    <div class="p-6 bg-mysuccess-light rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-list-check-2 text-mysuccess fs-3qx fs-md-2qx"></i>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Jumlah Soal</p>
                                        <h1 class="fs-3qx fs-md-2qx mb-0">{{ tryout.questions.data.length }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                    <div class="p-6 bg-mysecondary rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-team-fill text-mysecondary fs-3qx fs-md-2qx"></i>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Total Peserta</p>
                                        <h1 class="fs-3qx fs-md-2qx mb-0">{{ tryout.finished_grades_count }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-4 border border-gray-300">
                        <div class="d-flex flex-grow border-0 p-6 gap-4 flex-column flex-md-row">
                            <div class="flex-grow-1 ">
                                <form @submit.prevent="handleSearch"
                                    class="d-flex align-items-center position-relative my-1 w-100 w-md-300px">
                                    <i class="ri-search-line position-absolute ms-5 fs-3"></i>
                                    <input type="text" class="form-control form-control-solid ps-13 fs-5"
                                        placeholder="Cari soal tryout disini..." v-model="search" />
                                </form>
                            </div>
                            <div class="d-flex gap-4">
                                <!-- <button
                                    class="w-100 w-md-auto btn btn-sm btn-mysuccess fs-5 align-self-center white-space-nowrap">
                                    Import Soal
                                </button> -->
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}/questions/create`"
                                    class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-center white-space-nowrap">
                                    Tambah Soal
                                </Link>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
                                <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="tryout.questions.data.length === 0">
                                    <img src="/assets/media/illustrations/empty.png"
                                        alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                    <h2 class="text-dark mb-4">Soal Tidak Ditemukan</h2>
                                    <p class="text-gray-600 fs-4 mb-0">Belum ada soal atau pencarian tidak sesuai.</p>
                                </div>
                                <div class="table-responsive" v-else>
                                    <table id="kt_datatable_horizontal_scroll"
                                        class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                        <thead>
                                            <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#</th>
                                                <th class="bg-secondary min-w-300px" style="letter-spacing: 0.04em;">Soal Tryout</th>
                                                <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr v-for="(question, index) in tryout.questions.data" :key="index"
                                                class="align-top">
                                                <td class="ps-6 py-8">
                                                    {{ ++index + (tryout.questions . current_page - 1) * tryout.questions . per_page }}
                                                </td>
                                                <td class="pb-0">
                                                    <div class="accordion-header pt-3 d-flex align-items-start"
                                                        :data-bs-toggle="'collapse'"
                                                        :data-bs-target="`#kt_accordion_2_item_${index}`">
                                                        <span class="accordion-icon mt-1">
                                                            <i class="ri-add-box-fill fs-3"></i>
                                                        </span>
                                                        <p class="text-dark mb-0 ms-3" id="content-editor question-editor"
                                                            v-html="question.question">
                                                        </p>
                                                    </div>
                                                    <div :id="`kt_accordion_2_item_${index}`" class="fs-5 collapse ps-8"
                                                        data-bs-parent="#kt_accordion_2">
                                                        <img v-if="question.question_image" class="mb-4 rounded" :src="`/storage/${question.question_image}`" alt="Gambar Soal" height="150">
                                                        <ol type="A" class="ps-8 mb-4">
                                                            <li class="ps-2" v-html="question.option_1"
                                                                :class="{ 'text-mysecondary fw-bolder': question.answer == '1' }">
                                                            </li>
                                                            <li class="ps-2" v-html="question.option_2"
                                                                :class="{ 'text-mysecondary fw-bolder': question.answer == '2' }">
                                                            </li>
                                                            <li class="ps-2" v-html="question.option_3"
                                                                :class="{ 'text-mysecondary fw-bolder': question.answer == '3' }">
                                                            </li>
                                                            <li class="ps-2" v-html="question.option_4"
                                                                :class="{ 'text-mysecondary fw-bolder': question.answer == '4' }">
                                                            </li>
                                                            <li class="ps-2" v-html="question.option_5"
                                                                :class="{ 'text-mysecondary fw-bolder': question.answer == '5' }">
                                                            </li>
                                                        </ol>
                                                        <p v-if="question.explanation" id="content-editor question-editor"
                                                            v-html="question.question" class="text-dark mb-4">
                                                        </p>
                                                        <img v-if="question.explanation_image" class="mb-4 rounded" :src="`/storage/${question.explanation_image}`" alt="Gambar Pembahasan" height="150">
                                                    </div>
                                                </td>
                                                <td class="pe-6 d-flex justify-content-end align-items-center gap-2">
                                                    <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}/questions/${question.id}/edit`" 
                                                        class="btn btn-sm btn-icon btn-mysecondary">
                                                        <i class="ri-edit-2-fill fs-3"></i></Link>
                                                    <button @click.prevent="destroy(question.id)"
                                                        class="btn btn-sm btn-icon btn-mydanger">
                                                        <i class="ri-delete-bin-fill fs-3"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <Pagination :links="tryout.questions.links" align="end" class="py-5 px-6" />
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
        },

        setup(props) {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get(`/admin/${props.product.slug}/${props.subProduct.slug}/tryouts/${props.tryout.slug}`, {
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
