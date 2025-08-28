<template>

    <Head>
        <title>{{ page }}/{{ all_questions . length }} − {{ tryout_group . tryout . title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center w-100 flex-wrap">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/member-area" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/member-area/${product.slug}/${subProduct.slug}/tryouts`" class="btn-link-myprimary fw-bold pe-3">Produk</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Tryout</li>
                        </ol>
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                            <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                                <h1 class="mb-0 text-dark">{{ tryout_group . tryout . title }}</h1>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="ri-timer-fill fs-3 me-2 text-mydanger"></i>
                                <span class="fw-bold fs-5 text-mydanger">
                                    {{ formatTime . hours }} Jam
                                    {{ formatTime . minutes }} Menit
                                    {{ formatTime . seconds }} Detik
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="row g-6">
                        <div class="col-md-8">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header h-auto p-7 border-bottom border-gray-300 gap-3"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3>Soal Nomor {{ page }}/{{ all_questions . length }}</h3>
                                    </div>
                                    <button v-if="question_active.answer !== 0"  
                                        @click.prevent="toggleFlag(question_active.question.id)" class="btn btn-link-mywarning p-0 fs-5 d-flex align-items-center gap-1">
                                        <i class="ri-flag-fill fs-3"></i>
                                        {{ question_active.flag === 'Y' ? 'Hapus Tanda Ragu-ragu' : 'Tandai Ragu-ragu' }}
                                    </button>
                                </div>
                                <div class="card-body p-7 ">
                                    <div v-if="question_active !== null">
                                        <div id="question-editor" class="fs-5 fw-semibold text-dark user-select-none"
                                            v-html="question_active.question.question"></div>
                                        <div class="d-flex flex-column gap-3 mt-6">
                                            <div v-for="(answer, index) in answer_order" :key="index"
                                                class="user-select-none d-flex align-items-center cursor-pointer px-4 pt-4 border border-gray-300 rounded gap-3"
                                                @click="submitAnswer(question_active.question.tryout.id, question_active.question.id, answer)"
                                                :class="{ 'btn-tryout-active': answer == question_active.answer }">
                                                <div class="text-center fs-5 w-30px pb-4" style="flex-shrink: 0;"
                                                    :class="{ 'fw-bolder': answer == question_active.answer }">
                                                    {{ options[index] }}
                                                </div>
                                                <div class="fs-5 w-100" id="question-editor"
                                                    v-html="question_active.question['option_'+answer]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="alert alert-danger d-flex align-items-center p-5 m-0">
                                            <i class="bi bi-exclamation-triangle-fill text-danger fs-1 me-4"></i>
                                            <div class="d-flex flex-column">
                                                <h3 class="mb-2 text-dark">Soal Tidak Ditemukan!</h3>
                                                <span class="fs-5">Silakan pilih nomor soal yang sesuai untuk
                                                    melanjutkan pengerjaan.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-7 border-top border-gray-300">
                                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-3">
                                        <button @click.prevent="clearAnswer(question_active.question.tryout.id, question_active.question.id)"
                                            class="btn btn-sm btn-mydanger fs-5 d-flex align-items-center justify-content-center gap-1 ps-5"
                                            :disabled="question_active.answer === 0">
                                            <i class="ri-eraser-fill fs-3"></i>
                                            Hapus Jawaban
                                        </button>
                                        <div class="d-flex gap-3">
                                            <button v-if="page > 1" @click.prevent="prevPage" type="button"
                                                class="btn btn-sm btn-myprimary fs-5 d-flex align-items-center gap-1 ps-3 btn-hover-rotate-end justify-content-center w-100 w-sm-auto">
                                                <i class="ri-arrow-left-s-line fs-3"></i>
                                                Sebelumnya</button>
                                            <button v-if="page < Object.keys(all_questions).length"
                                                @click.prevent="nextPage" type="button"
                                                class="btn btn-sm btn-myprimary fs-5 d-flex align-items-center gap-1 pe-3 btn-hover-rotate-start justify-content-center w-100 w-sm-auto">
                                                Selanjutnya
                                                <i class="ri-arrow-right-s-line fs-3"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header h-auto p-7 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3>Nomor Soal</h3>
                                    </div>
                                    <p v-if="question_answered !== 0" class="fs-5 mb-0 text-gray-600">{{ question_answered }} Dikerja</p>
                                </div>
                                <div class="card-body p-7">
                                    <div class="m-n1" v-for="(question, index) in all_questions"
                                        :key="index">
                                        <div class="p-1 float-start" style="width: 20%;">
                                            <button @click.prevent="clickQuestion(index)"
                                                v-if="index + 1 == page && question.answer == 0"
                                                class="fs-5 px-0 btn btn-sm btn-outline-myprimary w-100 btn-mysecondary">
                                                {{ index + 1 }}
                                            </button>
                                            <button @click.prevent="clickQuestion(index)"
                                                v-else-if="index + 1 == page && question.answer != 0"
                                                class="fs-5 px-0 btn btn-sm w-100"
                                                :class="{
                                                    'btn-myprimary btn-outline-myprimary': question.flag === 'N',
                                                    'btn-mywarning-solid btn-outline-mywarning': question.flag === 'Y'
                                                }">
                                                {{ index + 1 }}
                                            </button>
                                            <button @click.prevent="clickQuestion(index)"
                                                v-else-if="question.answer == 0"
                                                class="fs-5 px-0 btn btn-sm w-100 btn-mylight">
                                                {{ index + 1 }}
                                            </button>
                                            <button @click.prevent="clickQuestion(index)" v-else
                                                class="fs-5 px-0 btn btn-sm w-100"
                                                :class="{
                                                    'btn-myprimary': question.flag === 'N',
                                                    'btn-mywarning-solid': question.flag === 'Y'
                                                }">
                                                {{ index + 1 }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-7 border-top border-gray-300">
                                    <button @click="confirmEndTryout" class="btn btn-sm btn-mydanger-solid fs-5 w-100">
                                        Akhiri Tryout
                                    </button>
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
    import { ref, computed, onMounted, onUnmounted } from 'vue'
    import Swal from 'sweetalert2';
    import { DateTime } from 'luxon';

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link,
        },

        props: {
            id: Number,
            page: Number,
            tryout_group: Object,
            all_questions: Array,
            question_answered: Number,
            question_active: Object,
            answer_order: Array,
            grade: Object,
            server_now: String,
            product: Object,
            subProduct: Object,
        },

        setup(props) {
            const options = ["A", "B", "C", "D", "E"];

            const serverNow = DateTime.fromISO(props.server_now, { zone: 'utc' });
            const startTime = DateTime.fromISO(props.grade.start_time, { zone: 'utc' });
            const durationMinutes = props.tryout_group.tryout.duration;

            const endTime = startTime.plus({
                minutes: durationMinutes
            });

            const clientNow = DateTime.local();
            const serverClientOffset = clientNow.toMillis() - serverNow.toMillis();
            const now = ref(clientNow);

            const remaining = computed(() => {
                const correctedNow = DateTime.fromMillis(now.value.toMillis() - serverClientOffset);
                const diff = endTime.toMillis() - correctedNow.toMillis();
                return Math.max(diff, 0);
            });

            const formatTime = computed(() => {
                const totalSeconds = Math.floor(remaining.value / 1000);
                return {
                    hours: Math.floor(totalSeconds / 3600),
                    minutes: Math.floor((totalSeconds % 3600) / 60),
                    seconds: totalSeconds % 60,
                };
            });

            let interval = null;

            const onTimeEnd = () => {
                router.post(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout-end`, {
                    tryout_group_id: props.tryout_group.id,
                    tryout_id: props.tryout_group.tryout.id,
                });

                Swal.fire({
                    title: "Waktu Habis!",
                    text: "Waktu tryout sudah berakhir! Anda dialihkan ke halaman hasil tryout.",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 10000,
                    customClass: {
                        popup: "swal-custom-icon",
                    },
                });
            };

            onMounted(() => {
                interval = setInterval(() => {
                    now.value = DateTime.local();

                    if (remaining.value <= 0) {
                        clearInterval(interval);
                        onTimeEnd();
                    }
                }, 1000);
            });

            onUnmounted(() => {
                clearInterval(interval);
            });

            const prevPage = () => router.get(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout/${props.id}/${props.page - 1}`);
            const nextPage = () => router.get(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout/${props.id}/${props.page + 1}`);
            const clickQuestion = (index) => router.get(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout/${props.id}/${index + 1}`);

            const submitAnswer = (tryout_id, question_id, answer) => {
                router.post(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout-answer`, {
                    tryout_id,
                    question_id,
                    answer,
                    duration: Math.floor(remaining.value / 1000),
                });
            };

            const clearAnswer = (tryout_id, question_id) => {
                router.post('/member-area/${props.product.slug}/${props.subProduct.slug}/tryout-clear', {
                    tryout_id,
                    question_id
                });
            };

            const toggleFlag = (questionId) => {
                router.post(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout-flag`, {
                    tryout_id: props.tryout_group.tryout.id,
                    question_id: questionId
                }).then(response => {
                    const question = props.all_questions.find(q => q.id === questionId);
                    question.flag = question.flag === 'Y' ? 'N' : 'Y';  // Update local flag status
                });
            };

            const confirmEndTryout = () => {
                Swal.fire({
                    title: "Akhiri tryout?",
                    text: "Setelah mengakhiri tryout, Anda tidak dapat kembali ke tryout ini lagi.",
                    icon: "question",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "Ya, akhiri tryout",
                    cancelButtonText: "Batal",
                    customClass: {
                        popup: "swal-custom-icon",
                        confirmButton: "btn btn-myprimary",
                        cancelButton: "btn btn-mydanger",
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        endTryout();
                    }
                });
            };

            const endTryout = () => {
                router.post(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout-end`, {
                    tryout_group_id: props.tryout_group.id,
                    tryout_id: props.tryout_group.tryout.id,
                });

                Swal.fire({
                    title: "Tryout Selesai!",
                    text: "Anda dialihkan ke halaman hasil tryout.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: "swal-custom-icon",
                    },
                });
            };

            return {
                options,
                formatTime,
                prevPage,
                nextPage,
                clickQuestion,
                submitAnswer,
                clearAnswer,
                toggleFlag,
                confirmEndTryout,
                onTimeEnd,
                endTryout,
            };
        },
    }
</script>

<style>
    .user-select-none {
        -webkit-user-select: none; /* Safari */
        -moz-user-select: none;    /* Firefox */
        -ms-user-select: none;     /* IE10+/Edge */
        user-select: none;         /* Standard */
    }
</style>
