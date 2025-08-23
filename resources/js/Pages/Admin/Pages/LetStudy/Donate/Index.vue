<template>

    <Head>
        <title>Section Donasi − LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Donasi</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Section Donasi</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="card rounded-4 border border-gray-300">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-0" style="min-height: unset;">
                                        <h3 class="mb-0">Informasi Rekening</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola informasi rekening untuk donasi
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Nama Bank</label>
                                        <select class="form-select fs-5" required v-model="form.bank_name"
                                            :class="{ 'is-invalid': errors.bank_name }">
                                            <option value="BCA">BCA</option>
                                            <option value="BRI">BRI</option>
                                            <option value="BNI">BNI</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="BTN">BTN</option>
                                            <option value="BSI">BSI</option>
                                        </select>
                                        <div v-if="errors.bank_name" class="text-mydanger mt-2">
                                            {{ errors . bank_name }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Nomor Rekening</label>
                                        <input type="text" class="form-control fs-5" required placeholder="Masukkan nomor rekening disini..."
                                            v-model="form.bank_number" :class="{ 'is-invalid': errors.bank_number }">
                                        <div v-if="errors.bank_number" class="text-mydanger mt-2">
                                            {{ errors . bank_number }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Nama Pemilik</label>
                                        <input type="text" class="form-control fs-5" required placeholder="Masukkan nama pemilik disini..."
                                            v-model="form.bank_account" :class="{ 'is-invalid': errors.bank_account }">
                                        <div v-if="errors.bank_account" class="text-mydanger mt-2">
                                            {{ errors . bank_account }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-0" style="min-height: unset;">
                                        <h3 class="mb-0">Informasi QRIS</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola informasi QRIS untuk donasi
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">QR Code </label>
                                        <div id="qrcode-dropzone"
                                            class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                            <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                <div>
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini /
                                                        klik untuk mengunggah.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Maks. 10 MB • Rasio 1:1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="errors.qrcode_image" class="text-mydanger mt-2">
                                            {{ errors . qrcode_image }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Nomor NMID</label>
                                        <input type="text" class="form-control fs-5" required placeholder="Masukkan nomor NMID disini..."
                                            v-model="form.qrcode_nmid" :class="{ 'is-invalid': errors.qrcode_nmid }">
                                        <div v-if="errors.qrcode_nmid" class="text-mydanger mt-2">
                                            {{ errors . qrcode_nmid }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Nama Pemilik</label>
                                        <input type="text" class="form-control fs-5" required placeholder="Masukkan nama pemilik disini..."
                                            v-model="form.qrcode_name" :class="{ 'is-invalid': errors.qrcode_name }">
                                        <div v-if="errors.qrcode_name" class="text-mydanger mt-2">
                                            {{ errors . qrcode_name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-0" style="min-height: unset;">
                                        <h3 class="mb-0">Informasi Pencapaian</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola pencapaian yang tampil di section donasi
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Pencapaian 1</label>
                                        <select class="form-select fs-5" v-model="form.achievement1_id">
                                            <option v-for="achievement in achievements" :key="achievement.id" :value="achievement.id">
                                                {{ achievement.title }} − {{ achievement.value }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Pencapaian 2</label>
                                        <select class="form-select fs-5" v-model="form.achievement2_id">
                                            <option v-for="achievement in achievements" :key="achievement.id" :value="achievement.id">
                                                {{ achievement.title }} − {{ achievement.value }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="fv-row">
                                        <label class="form-label fs-6">Pencapaian 3</label>
                                        <select class="form-select fs-5" v-model="form.achievement3_id">
                                            <option v-for="achievement in achievements" :key="achievement.id" :value="achievement.id">
                                                {{ achievement.title }} − {{ achievement.value }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Simpan Perubahan
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
    import LayoutAdmin from '../../../../../Layouts/Admin.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, onMounted } from 'vue';
    import Dropzone from 'dropzone';
    import Swal from 'sweetalert2';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            errors: Object,
            donate: Object,
            achievements: Array
        },

        setup(props) {
            const form = reactive({
                achievement1_id: props.donate.achievement1_id ?? '',
                achievement2_id: props.donate.achievement2_id ?? '',
                achievement3_id: props.donate.achievement3_id ?? '',
                bank_name: props.donate.bank_name,
                bank_number: props.donate.bank_number,
                bank_account: props.donate.bank_account,
                qrcode_image: null,
                qrcode_name: props.donate.qrcode_name,
                qrcode_nmid: props.donate.qrcode_nmid,
            });

            onMounted(() => {
                const dz = new Dropzone('#qrcode-dropzone', {
                    url: '/', 
                    paramName: 'qrcode_image',
                    maxFiles: 1,
                    maxFilesize: 10,
                    acceptedFiles: 'image/jpeg,image/png',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Hapus',
                    init: function () {
                        this.on('addedfile', function (file) {
                            form.qrcode_image = file;
                        });
                        this.on('removedfile', function () {
                            form.qrcode_image = null;
                        });

                        if (props.donate.qrcode_image) {
                            const mockFile = {
                                name: props.donate.qrcode_image_name ?? 'QR Code',
                                size: props.donate.qrcode_image_size ?? 12345
                            };
                            this.emit('addedfile', mockFile);
                            this.emit('thumbnail', mockFile, `/storage/${props.donate.qrcode_image}`);
                            this.emit('complete', mockFile);
                            mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                        }
                    },
                });
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('achievement1_id', form.achievement1_id);
                payload.append('achievement2_id', form.achievement2_id);
                payload.append('achievement3_id', form.achievement3_id);
                payload.append('bank_name', form.bank_name);
                payload.append('bank_number', form.bank_number);
                payload.append('bank_account', form.bank_account);
                payload.append('qrcode_name', form.qrcode_name);
                payload.append('qrcode_nmid', form.qrcode_nmid);
                if (form.qrcode_image && (form.qrcode_image instanceof File || form.qrcode_image instanceof Blob)) {
                    payload.append('qrcode_image', form.qrcode_image);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/pages/letstudy/donate/${props.donate.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Donasi Berhasil Diperbarui!',
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
                submit,
            };
        }
    }
</script>

<style>

</style>
