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
                                <Link :href="`/member-area/${product.slug}/${subProduct.slug}/tryouts`" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/member-area/${product.slug}/${subProduct.slug}/tryout-result/${tryout_group.id}`" class="btn-link-myprimary fw-bold pe-3">Hasil Tryout</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Jawaban</li>
                        </ol>
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                            <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                                <h1 class="mb-0 text-dark">{{ tryout_group . tryout . title }}</h1>
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
                                </div>
                                <div class="card-body p-7 ">
                                    <div v-if="question_active !== null">
                                        <div class="fs-5 fw-semibold text-dark"
                                            v-html="question_active.question.question"></div>
                                        <img v-if="question_active.question.question_image" class="img-fluid rounded mt-1 mh-300px" :src="`/storage/${question_active.question.question_image}`" alt="Gambar Soal">
                                        <div class="d-flex flex-column gap-3 mt-6">
                                            <div v-for="(answer, index) in answer_order" :key="index"
                                                class="d-flex align-items-center p-4 border border-gray-300 rounded gap-3"
                                                :class="{
                                                    'btn-tryout-correct': (question_active.is_correct == 'Y' && question_active.answer == answer) ||
                                                        (question_active.is_correct == 'N' && question_active.question.answer == answer),
                                                    'btn-tryout-incorrect': question_active.is_correct == 'N' &&
                                                        question_active.answer == answer
                                                }">
                                                <div class="text-center fs-5 w-30px" style="flex-shrink: 0;"
                                                    :class="{ 'fw-bolder': answer == question_active.answer ||
                                                        (question_active.is_correct == 'N' && question_active.question.answer == answer) }">
                                                    {{ options[index] }}
                                                </div>
                                                <div class="fs-5 w-100"
                                                    v-html="question_active.question['option_'+answer]">
                                                </div>
                                                <p class="fs-5 fw-semibold mb-0 me-2" v-if="
                                                    (question_active.is_correct == 'Y' && question_active.answer == answer) ||
                                                    (question_active.is_correct == 'N' && question_active.question.answer == answer)">
                                                    Benar
                                                </p>
                                                <p class="fs-5 fw-semibold mb-0 me-2" v-else-if="question_active.is_correct == 'N' && question_active.answer == answer">
                                                    Salah
                                                </p>
                                            </div>
                                        </div>
                                        <div v-if="can_show_explanation">
                                            <!-- <p class="fs-4 fw-semibold text-dark mt-6 mb-0">Pembahasan:</p> -->
                                            <div class="fs-4 text-gray-800 mt-6"
                                                v-html="question_active.question.explanation"></div>
                                            <img v-if="question_active.question.explanation_image" class="img-fluid mt-3 rounded mh-300px" :src="`/storage/${question_active.question.explanation_image}`" alt="Gambar Pembahasan">
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
                                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3">
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
                                    <p class="fs-5 mb-0 text-gray-600">{{ question_correct }} Benar</p>
                                </div>
                                <div class="card-body p-7">
                                    <div class="m-n1" v-for="(question, index) in all_questions"
                                        :key="index">
                                        <div class="p-1 float-start" style="width: 20%;">
                                            <button @click.prevent="clickQuestion(index)"
                                                :class="[
                                                    'fs-5 px-0 btn btn-sm w-100',
                                                    index + 1 === page ?
                                                    question.is_correct === 'Y' ?
                                                    'btn-myprimary btn-outline-myprimary' :
                                                    question.is_correct === 'N' ?
                                                    'btn-mydanger-solid btn-outline-mydanger' :
                                                    'btn-myprimary' :
                                                    question.is_correct === 'Y' ?
                                                    'btn-myprimary' :
                                                    question.is_correct === 'N' ?
                                                    'btn-mydanger-solid' :
                                                    'btn-mysecondary'
                                                ]">
                                                {{ index + 1 }}
                                            </button>
                                        </div>
                                    </div>
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

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link,
        },

        props: {
            page: Number,
            all_questions: Array,
            question_active: Object,
            question_correct: Number,
            tryout_group: Object,
            answer_order: Array,
            can_show_explanation: Boolean,
            product: Object,
            subProduct: Object,
        },

        setup(props) {
            const options = ["A", "B", "C", "D", "E"];

            const prevPage = () => router.get(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout/${props.tryout_group.id}/review/${props.page - 1}`);
            const nextPage = () => router.get(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout/${props.tryout_group.id}/review/${props.page + 1}`);
            const clickQuestion = (index) => router.get(`/member-area/${props.product.slug}/${props.subProduct.slug}/tryout/${props.tryout_group.id}/review/${index + 1}`);

            return {
                options,
                prevPage,
                nextPage,
                clickQuestion,
            };
        },
    }
</script>

<style>
</style>
