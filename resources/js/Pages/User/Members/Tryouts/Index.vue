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
                                <Link href="/member-area" class="btn-link-myprimary fw-bold pe-3">Member Area</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Produk</li>
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
                            <Link class="nav-link" :href="`/member-area/${product.slug}/${subProduct.slug}/ebooks`">E-Book</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link active" href="#" >Tryout</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="`/member-area/${product.slug}/${subProduct.slug}/playlists`">Playlist</Link>
                        </li>
                    </ul>
                    <div v-if="tryouts.length > 0" class="d-flex flex-grow gap-4 flex-column flex-sm-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3x fs-md-2x mb-1">Siap Tryout? 📝</h1>
                            <p class="text-gray-600 fs-4 mb-0">
                                Uji kemampuanmu dan temukan potensi terbaikmu.
                            </p>
                        </div>
                    </div>
                    <div class="row g-6">
                        <div class="text-center py-10" v-if="tryouts.length === 0">
                            <img src="/assets/media/images/stay-tuned.png"
                                alt="Tidak ada data" class="mh-350px img-fluid">
                            <h1 class="text-dark mb-4">Stay Tune Ya! ✨</h1>
                            <p class="text-gray-600 fs-4 mb-0">Belum ada tryout yang tersedia. Cek kembali nanti ya!</p>
                        </div>
                        <div v-else v-for="(data, index) in tryouts" :key="index" class="col-12 col-md-6 col-xxl-4">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <div class="card-body d-flex flex-column justify-content-between h-100 p-7 gap-7">
                                    <div class="d-flex flex-column">
                                        <p class="text-dark fs-1 fs-lg-2 fw-bold pb-5 mb-6 text-truncate-3 border-bottom border-gray-300">{{ data.tryout.title }}</p>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-timer-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">Durasi</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">{{ data.tryout.duration }} Menit</p>
                                        </div>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-list-check-2"></i>
                                                <p class="fs-5 text-gray-600 m-0">Jumlah Soal</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">{{ data.tryout.questions.length }} Soal</p>
                                        </div>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5 mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-login-box-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">Mulai</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">
                                                {{ data.tryout.start_time ? formatDate(data.tryout.start_time) : '-' }}
                                            </p>
                                        </div>
                                        <div class="d-flex flex-grow-1 justify-content-between align-items-start gap-5">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fs-3 text-gray-600 ri-logout-box-line"></i>
                                                <p class="fs-5 text-gray-600 m-0">Selesai</p>
                                            </div>
                                            <p class="fs-5 text-dark text-end fw-bold m-0">
                                                {{ data.tryout.end_time ? formatDate(data.tryout.end_time) : '-' }}    
                                            </p>
                                        </div>
                                    </div>

                                    <div v-if="data.grade.end_time == null">
                                        <div v-if="tryoutTimeRangeChecker(data.tryout.start_time, data.tryout.end_time)">
                                            <div v-if="data.tryout_group">
                                                <Link :href="`/member-area/${product.slug}/${subProduct.slug}/tryout/${data.tryout_group.id}/1`"
                                                    class="btn btn-sm btn-mydanger-solid w-100 fs-5">
                                                    Lanjut Kerjakan
                                                </Link>
                                            </div>
                                            <button v-else @click="setTryout(data)" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_tryout" class="btn btn-sm btn-myprimary w-100 fs-5">
                                                Mulai Tryout
                                            </button>
                                        </div>
                                        <button v-else class="btn btn-sm w-100 fs-5"
                                            :class="tryoutTimeStartChecker(data.tryout.start_time) ? 'btn-mysecondary' : 'btn-mydanger'" disabled>
                                            {{ tryoutTimeStartChecker(data.tryout.start_time) ? 'Belum Mulai' : 'Waktu Terlewat' }}
                                        </button>
                                    </div>
                                    <Link v-else :href="`/member-area/${product.slug}/${subProduct.slug}/tryout-result/${data.tryout_group.id}`"
                                        class="btn btn-sm btn-mysecondary w-100 fs-5">
                                        Lihat Hasil
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="kt_modal_tryout" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered justify-content-center">
                            <div class="modal-content rounded-4 mw-400px mw-md-500px">
                                <div class="modal-header ps-6 pe-3 h-60px border-bottom border-gray-300 h-60px h-lg-70px">
                                    <h2 class="modal-title">
                                        {{ selectedTryout?.tryout.title ?? 'Detail Tryout' }}
                                    </h2>
                                    <div class="btn btn-sm btn-icon btn-mylighten rounded-pill" data-bs-dismiss="modal">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>
                                <div class="modal-body p-6">
                                    <template v-if="selectedTryout">
                                        <div class="d-flex flex-column">
                                            <p class="text-gray-600 fs-7 mb-2">Deskripsi</p>
                                            <p class="text-dark fs-5 mb-6">
                                                {{ selectedTryout?.tryout.description ?? 'Deskripsi tidak tersedia pada tryout ini.' }}
                                            </p>
                                            <p class="text-gray-600 fs-7 mb-2">Petunjuk Teknis</p>
                                            <p class="text-dark fs-5 mb-2" id="content-editor question-editor"
                                                v-html="selectedTryout?.tryout.instruction ?? 'Petunjuk teknis tidak tersedia pada tryout ini.'">
                                            </p>
                                        </div>
                                        <button @click="submitJoinTryout"
                                            class="btn btn-sm btn-myprimary fs-5 w-100 mt-4">
                                            Mulai Tryout
                                        </button>
                                    </template>
                                    <template v-else>
                                        <div class="text-center text-dark lh-sm fs-1 fs-md-2 p-6">Memuat…</div>
                                    </template>
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
    import LayoutUser from '../../../../Layouts/User.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue'

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link,
        },

        props: {
            product: Object,
            subProduct: Object,
            tryouts: {
                type: Array,
                default: () => []
            },
        },

        setup(props) {
            const selectedTryout = ref(null)
            const setTryout = (item) => {
                selectedTryout.value = item;
            };

            onMounted(() => {
                const el = document.getElementById('kt_modal_tryout')
                if (el) {
                    el.addEventListener('hidden.bs.modal', () => {
                    selectedTryout.value = null
                    })
                }
            })

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

            const tryoutTimeRangeChecker = (start_time, end_time) => {
                const now = new Date()
                if (!start_time && !end_time) {
                    return true
                }
                return now >= new Date(start_time) && now <= new Date(end_time)
            }

            const tryoutTimeStartChecker = (start_time) => {
                const now = new Date()
                if (!start_time) {
                    return false
                }
                return now < new Date(start_time)
            }

            const submitJoinTryout = () => {
                if (!selectedTryout.value?.tryout) return;
                router.post(
                    `/member-area/${props.product.slug}/${props.subProduct.slug}/tryout-join`,
                    {
                        tryout_id: selectedTryout.value.tryout.id,
                    },
                    {
                        onSuccess: () => {
                            window.location.reload();
                        }
                    }
                );
            };

            return {
                formatDate,
                selectedTryout,
                setTryout,
                tryoutTimeRangeChecker,
                tryoutTimeStartChecker,
                submitJoinTryout
            };
        }
    }
</script>

<style>

</style>
