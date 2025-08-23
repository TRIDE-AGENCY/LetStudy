<template>

    <Head>
        <title>Tambah Tryout − {{ product.title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Tambah Tryout</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Tambah Tryout</h1>
                            <span class="badge px-3 py-2 fs-5">{{ subProduct.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="row g-6">
                            <div class="col-md-4">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-0">Data Tryout</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Nama</label>
                                            <input type="text" class="form-control fs-5" v-model="form.title"
                                                required placeholder="Masukkan nama disini..."
                                                :class="{ 'is-invalid': errors.title }" />
                                            <div v-if="errors.title" class="text-mydanger mt-2">
                                                {{ errors . title }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="form-label fs-6">Deskripsi</label>
                                            <textarea class="form-control fs-5" data-kt-autosize="true" rows="5"
                                                placeholder="Masukkan deskripsi disini..." v-model="form.description"
                                                :class="{ 'is-invalid': errors.description }">
                                            </textarea>
                                            <div v-if="errors.description" class="text-mydanger mt-2">
                                                {{ errors . description }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Durasi</label>
                                            <div class="input-group fs-5">
                                                <input type="number" class="form-control" v-model="form.duration" aria-describedby="basic-addon2"
                                                    required placeholder="Masukkan durasi disini..." :class="{ 'is-invalid': errors.duration }"/>
                                                <span class="input-group-text" id="basic-addon2">Menit</span>
                                            </div>
                                            <div v-if="errors.duration" class="text-danger mt-2">
                                                {{ errors . duration }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="form-label fs-6">Waktu Mulai</label>
                                            <input class="form-control fs-5" v-model="form.start_time" 
                                                placeholder="Pilih waktu mulai disini..." id="kt_datepicker_3"
                                                :class="{ 'is-invalid': errors.start_time }" />
                                            <div v-if="errors.start_time" class="text-mydanger mt-2">
                                                {{ errors . start_time }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="form-label fs-6">Waktu Selesai</label>
                                            <input class="form-control fs-5" v-model="form.end_time" 
                                                placeholder="Pilih waktu selesai disini..." id="kt_datepicker_3"
                                                :class="{ 'is-invalid': errors.end_time }" />
                                            <div v-if="errors.end_time" class="text-mydanger mt-2">
                                                {{ errors . end_time }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Status</label>
                                            <div class="btn-group w-100" data-kt-buttons="true"
                                                data-kt-buttons-target="[data-kt-button]">
                                                <label
                                                    class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                    data-kt-button="true"
                                                    :class="{ active: form.status === 'published' }">
                                                    <input class="btn-check" type="radio" v-model="form.status"
                                                        value="published" />
                                                    Terbit
                                                </label>
                                                <label
                                                    class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                    data-kt-button="true"
                                                    :class="{ active: form.status === 'archived' }">
                                                    <input class="btn-check" type="radio" v-model="form.status"
                                                        value="archived" />
                                                    Arsip
                                                </label>
                                            </div>
                                            <div v-if="errors.status" class="text-mydanger mt-2">
                                                {{ errors . status }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-0">Pengaturan Tryout</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-4 fv-row border-bottom border-gray-300 pb-4">
                                            <div class="form-check form-switch form-check-custom form-check-solid gap-4 justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <label class="form-label fs-5 mb-1">Acak Pertanyaan</label>
                                                    <p class="text-gray-600 fs-7 mb-0">
                                                        Untuk mengacak urutan soal tryout.
                                                    </p>
                                                </div>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchDefault"
                                                    v-model="form.is_random_question" :true-value="true" :false-value="false"/>
                                            </div>
                                        </div>
                                        <div class="mb-4 fv-row border-bottom border-gray-300 pb-4">
                                            <div class="form-check form-switch form-check-custom form-check-solid gap-4 justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <label class="form-label fs-5 mb-1">Acak Jawaban</label>
                                                    <p class="text-gray-600 fs-7 mb-0">
                                                        Untuk mengacak pilihan jawaban tryout.
                                                    </p>
                                                </div>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchDefault2"
                                                    v-model="form.is_random_answer" :true-value="true" :false-value="false"/>
                                            </div>
                                        </div>
                                        <div class="mb-4 fv-row border-bottom border-gray-300 pb-4">
                                            <div class="form-check form-switch form-check-custom form-check-solid gap-4 justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <label class="form-label fs-5 mb-1">Tampilkan Jawaban</label>
                                                    <p class="text-gray-600 fs-7 mb-0">
                                                        Untuk menampilkan jawaban setelah tryout selesai.
                                                    </p>
                                                </div>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchDefault3"
                                                    v-model="form.is_show_answer" :true-value="true" :false-value="false"/>
                                            </div>
                                        </div>
                                        <div class="mb-4 fv-row border-bottom border-gray-300 pb-4">
                                            <div class="form-check form-switch form-check-custom form-check-solid gap-4 justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <label class="form-label fs-5 mb-1">Tampilkan Pembahasan</label>
                                                    <p class="text-gray-600 fs-7 mb-0">
                                                        Untuk menampilkan pembahasan setelah tryout selesai.
                                                    </p>
                                                </div>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchDefault4"
                                                    v-model="form.is_show_explanation" :true-value="true" :false-value="false"/>
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <div class="form-check form-switch form-check-custom form-check-solid gap-4 justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <label class="form-label fs-5 mb-1">Tampilkan Peringkat</label>
                                                    <p class="text-gray-600 fs-7 mb-0">
                                                        Untuk menampilkan peringkat peserta setelah tryout selesai.
                                                    </p>
                                                </div>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchDefault5"
                                                    v-model="form.is_show_rank" :true-value="true" :false-value="false"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4 border border-gray-300 mt-6">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-2">Petunjuk Teknis Tryout</h3>
                                        <p class="fs-5 text-gray-600 m-0">
                                            Sebelum memulai tryout, harap perhatikan hal-hal berikut:
                                        </p>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="fv-row">
                                            <Editor 
                                                :api-key="TinyMCEApiKey" 
                                                v-model="form.instruction" 
                                                :init="editorInit"
                                            />
                                            <div v-if="errors.instruction" class="text-mydanger mt-2">
                                                {{ errors . instruction }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts`"
                                type="button" class="btn btn-sm btn-mylighten fs-5 me-3">Batal</Link>
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Tambah Tryout
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../Layouts/Admin.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, onMounted, watch } from 'vue';
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
            Editor
        },

        props: {
            errors: Object,
            product: Object,
            subProduct: Object,
            TinyMCEApiKey: String,
        },

        setup(props) {
            const form = reactive({
                title: '',
                description: '',
                instruction: '',
                duration: '',
                start_time: '',
                end_time: '',
                is_random_question: false,
                is_random_answer: false,
                is_show_answer: false,
                is_show_explanation: false,
                is_show_rank: false,
                status: '',
            });

            const editorInit = {
                menubar: false,
                plugins: 'advlist lists link emoticons autoresize',
                toolbar:
                    'undo redo | bold italic underline | bullist numlist | link emoticons',
                block_formats: 'Paragraf=p',
                min_height: 300,
                max_height: 600,
                content_style: `
                    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
                    body {
                        font-family: 'Inter', sans-serif;
                    }
                `
            };

            onMounted(() => {
                flatpickr("#kt_datepicker_3", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            });

            const submit = () => {
                if (
                    (form.start_time && !form.end_time) ||
                    (!form.start_time && form.end_time)
                ) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Waktu Tidak Lengkap',
                        text: 'Isi waktu mulai dan selesai secara bersamaan, atau kosongkan keduanya.',
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-icon',
                        }
                    });
                    return;
                }
                if (form.start_time && form.end_time && new Date(form.end_time) <= new Date(form.start_time)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Waktu Tidak Valid',
                        text: 'Waktu selesai harus lebih besar dibandingkan dengan waktu mulai.',
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-icon',
                        }
                    });
                    return; 
                }

                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('title', form.title);
                payload.append('description', form.description);
                payload.append('instruction', form.instruction);
                payload.append('duration', form.duration);
                payload.append('start_time', form.start_time);
                payload.append('end_time', form.end_time);
                payload.append('is_random_question', form.is_random_question ? '1' : '0'); 
                payload.append('is_random_answer', form.is_random_answer ? '1' : '0'); 
                payload.append('is_show_answer', form.is_show_answer ? '1' : '0'); 
                payload.append('is_show_explanation', form.is_show_explanation ? '1' : '0'); 
                payload.append('is_show_rank', form.is_show_rank ? '1' : '0'); 
                payload.append('status', form.status);

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                router.post(`/admin/${props.product.slug}/${props.subProduct.slug}/tryouts`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Tryout Berhasil Disimpan!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            }
                        });
                    },
                    onFinish: cleanup
                });
            }

            return {
                form,
                editorInit,
                submit,
            };
        }
    }
</script>

<style>

</style>
