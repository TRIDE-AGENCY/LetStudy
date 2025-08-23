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
                                <Link href="/member-area/" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/member-area/${product.slug}/${subProduct.slug}/tryouts`" class="btn-link-myprimary fw-bold pe-3">Produk</Link>
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
                            <h1 class="text-dark lh-base fs-3qx fs-md-2qx mb-3">{{ tryout_group.tryout.title }}</h1>
                            <p class="fs-4 text-gray-600 m-0">
                                {{ tryout_group.tryout.description ? tryout_group.tryout.description : 'Tidak ada deskripsi pada Tryout ini.' }}
                            </p>
                        </div>
                        <div v-if="can_show_answer" class="d-flex gap-4">
                            <Link :href="`/member-area/${product.slug}/${subProduct.slug}/tryout/${tryout_group.id}/review/1`"
                                class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-end white-space-nowrap">
                                Lihat Jawaban
                            </Link>
                        </div>
                    </div>
                    <div class="row g-6">
                        <div class="col-sm-12 col-md-4">
                            <div class="card rounded-4 border border-gray-300 h-100">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center gap-4 px-6">
                                    <h1 class="fs-2 mb-0">Nilai Tryout</h1>
                                    <h1 class="fs-4x fw-bolder mb-0">{{ grade . grade }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="row g-4 g-md-6">
                                <div class="col-12 col-sm-6">
                                    <div class="card rounded-4 border border-gray-300">
                                        <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                            <div class="p-6 bg-mysecondary rounded d-flex align-items-center justify-content-center">
                                                <i class="ri-trophy-fill text-mysecondary fs-3qx fs-md-2qx"></i>
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Peringkat</p>
                                                <div class="d-flex align-items-end gap-2">
                                                    <h1 class="fs-3qx fs-md-2qx mb-0">{{ user_ranking }}</h1>
                                                    <p class="fs-4 fw-semibold text-gray-400 mb-0 text-truncate-1 white-space-nowrap">/ {{ total_users }} Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card rounded-4 border border-gray-300">
                                        <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                            <div class="p-6 bg-mywarning-light rounded d-flex align-items-center justify-content-center">
                                                <i class="ri-timer-fill text-mywarning fs-3qx fs-md-2qx"></i>
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Durasi Pengerjaan</p>
                                                <div class="d-flex align-items-end gap-2">
                                                    <h1 class="fs-3qx fs-md-2qx mb-0">{{ grade.duration_minutes }}</h1>
                                                    <p class="fs-4 fw-semibold text-gray-400 mb-0 text-truncate-1 white-space-nowrap">/ {{ tryout_group . tryout . duration }} Menit</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card rounded-4 border border-gray-300">
                                        <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                            <div class="p-6 bg-mysuccess-light rounded d-flex align-items-center justify-content-center">
                                                <i class="ri-checkbox-circle-fill text-mysuccess fs-3qx fs-md-2qx"></i>
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Jumlah Benar</p>
                                                <div class="d-flex align-items-end gap-2">
                                                    <h1 class="fs-3qx fs-md-2qx mb-0">{{ grade.total_correct }}</h1>
                                                    <p class="fs-4 fw-semibold text-gray-400 mb-0 text-truncate-1 white-space-nowrap">/ {{ tryout_group.tryout.questions.length }} Soal</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card rounded-4 border border-gray-300">
                                        <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                            <div class="p-6 bg-mydanger-light rounded d-flex align-items-center justify-content-center">
                                                <i class="ri-close-circle-fill text-mydanger fs-3qx fs-md-2qx"></i>
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Jumlah Salah</p>
                                                <div class="d-flex align-items-end gap-2">
                                                    <h1 class="fs-3qx fs-md-2qx mb-0">{{ totalIncorrect }}</h1>
                                                    <p class="fs-4 fw-semibold text-gray-400 mb-0 text-truncate-1 white-space-nowrap">/ {{ tryout_group.tryout.questions.length }} Soal</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        placeholder="Cari member disini..." v-model="search" />
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="all_grades.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Member Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada member atau pencarian tidak sesuai.</p>
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
                                            <td>{{ item.user?.name ?? 'Tidak Diketahui' }}</td>
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
    import LayoutUser from '../../../../Layouts/User.vue';
    import Pagination from '../../../../Components/Pagination.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { ref } from 'vue';

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link,
            Pagination
        },

        props: {
            product: Object,
            subProduct: Object,
            tryout_group: Object,
            grade: Object,
            all_grades: Object,
            user_ranking: Number,
            total_users: Number,
            user_id: Number,
            can_show_answer: Boolean
        },

        computed: {
            totalIncorrect() {
                const totalQuestions = this.tryout_group.tryout.questions.length;
                const totalCorrect = this.grade.total_correct;
                return totalQuestions - totalCorrect;
            }
        },

        setup(props) {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout-result/${props.tryout_group.id}`, {
                    q: search.value,
                });
            }

            const stripTags = (html) => {
                const div = document.createElement("div");
                div.innerHTML = html;
                return div.textContent || div.innerText || "";
            };

            return {
                search,
                handleSearch,
                stripTags,
            }
        }
    }
</script>

<style>

</style>
