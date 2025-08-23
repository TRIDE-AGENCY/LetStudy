<template>

    <Head>
        <title>Section Partner − LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Partner</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0">Section Partner</h1>
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
                                        placeholder="Cari nama/pernyataan disini..." v-model="search" />
                                </form>
                            </div>
                            <div class="d-flex gap-4">
                                <button @click="() => { resetForm(); isEditMode = false; openDrawer(); }"
                                    class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-center white-space-nowrap">
                                    Tambah Partner
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="partners.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Partner Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada partner atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#
                                            </th>
                                            <th class="bg-secondary min-w-250px" style="letter-spacing: 0.04em;">Dari /
                                                Oleh</th>
                                            <th class="bg-secondary min-w-300px" style="letter-spacing: 0.04em;">
                                                Pernyataan</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(partner, index) in partners.data" :key="index">
                                            <td class="ps-6">
                                                {{ ++index + (partners . current_page - 1) * partners . per_page }}
                                            </td>
                                            <td class="d-flex align-items-center gap-3">
                                                <img class="w-45px h-45px min-w-45px rounded-circle object-fit-cover"
                                                    :src="`/storage/${partner.photo}`" alt="Foto Profil">
                                                <div>
                                                    <p class="text-dark fw-bold mb-1">{{ partner . name }}</p>
                                                    <p class="fs-7 mb-0">{{ partner . title }}</p>
                                                </div>
                                            </td>
                                            <td class="mw-300px">
                                                <p class="text-truncate-2 mb-0">
                                                    {{ partner . statement }}
                                                </p>
                                            </td>
                                            <td class="text-end pe-6">
                                                <button @click="editPartner(partner)"
                                                    class="btn btn-sm btn-icon btn-mysecondary me-2">
                                                    <i class="ri-edit-2-fill fs-3"></i></button>
                                                <button @click.prevent="destroy(partner.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="partners.links" align="end" class="py-5 px-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="submit">
            <div id="kt_drawer_example_advanced" class="bg-body" style="overflow-x: hidden;" data-kt-drawer="true" data-kt-drawer-activate="true"
                data-kt-drawer-toggle="#kt_drawer_example_advanced_button"
                data-kt-drawer-close="#kt_drawer_example_advanced_close" data-kt-drawer-name="docs"
                data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'100%', 'md': '500px'}"
                data-kt-drawer-direction="end">
                <div class="card w-100 rounded-0">
                    <div class="card-header ps-6 pe-3 h-60px border-bottom border-gray-300 h-60px h-lg-70px">
                        <div class="card-title">
                            <h2>{{ isEditMode ? 'Edit Partner' : 'Tambah Partner' }}</h2>
                        </div>
                        <div class="card-toolbar" id="kt_drawer_example_advanced_close">
                            <div class="btn btn-sm btn-icon btn-mylighten rounded-pill">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light p-6 d-flex flex-column gap-7">
                        <div class="flex-grow-1">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3>Data Partner</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Foto Profil</label>
                                        <div id="partner-photo-dropzone" :key="dropzonePhotoKey"
                                            class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                            <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                <div>
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini /
                                                        klik untuk mengunggah.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Maks. 10 MB • Rasio 3:4</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="errors.photo" class="text-mydanger mt-2">
                                            {{ errors . photo }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Nama</label>
                                        <input type="text" class="form-control fs-5" v-model="form.name" required
                                            placeholder="Masukkan nama disini..."
                                            :class="{ 'is-invalid': errors.name }" />
                                        <div v-if="errors.name" class="text-mydanger mt-2">
                                            {{ errors . name }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Gelar / Peran</label>
                                        <input type="text" class="form-control fs-5" v-model="form.title" required
                                            placeholder="Masukkan gelar / peran disini..."
                                            :class="{ 'is-invalid': errors.title }" />
                                        <div v-if="errors.title" class="text-mydanger mt-2">
                                            {{ errors . title }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Logo Partner</label>
                                        <div id="partner-logo-dropzone" :key="dropzoneLogoKey"
                                            class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                            <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                <div>
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini /
                                                        klik untuk mengunggah.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Maksimal 10 MB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="errors.logo" class="text-mydanger mt-2">
                                            {{ errors . logo }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-4 border border-gray-300 mt-6">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3 class="required">Detail Pernyataan</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="fv-row">
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                            placeholder="Masukkan detail pernyataan disini..." v-model="form.statement"
                                            :class="{ 'is-invalid': errors.statement }">
                                        </textarea>
                                        <div v-if="errors.statement" class="text-mydanger mt-2">
                                            {{ errors . statement }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-sm btn-mylighten fs-5 me-3"
                                id="kt_drawer_example_advanced_close">Batal</button>
                            <button type="submit" id="kt_drawer_submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    {{ isEditMode ? 'Edit Partner' : 'Tambah Partner' }}
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../../Layouts/Admin.vue';
    import Pagination from '../../../../../Components/Pagination.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, ref, nextTick, watch } from 'vue';
    import Dropzone from 'dropzone';
    import Swal from 'sweetalert2';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
            Pagination,
        },

        props: {
            errors: Object,
            partners: Object,
        },

        setup() {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get('/admin/pages/letstudy/partners', {
                    q: search.value,
                });
            }

            const dropzonePhotoRef = ref(null);
            const dropzoneLogoRef  = ref(null);

            const dropzonePhotoKey = ref(Date.now());
            const dropzoneLogoKey = ref(Date.now());

            const openDrawer = async () => {
                dropzonePhotoKey.value = Date.now();
                dropzoneLogoKey.value = Date.now();
                await nextTick();

                const drawerEl = document.querySelector('#kt_drawer_example_advanced');
                if (drawerEl && window.KTDrawer) {
                    const drawer = KTDrawer.getInstance(drawerEl) || new KTDrawer(drawerEl);
                    drawer.show();
                }
            };

            const form = reactive({
                name: '',
                title: '',
                photo: null,
                logo: null,
                statement: '',
            });

            const editing = ref(null);
            const isEditMode = ref(false);

            const resetForm = () => {
                form.name = '';
                form.title = '';
                form.photo = null;
                form.logo = null;
                form.statement = '';

                isEditMode.value = false;
                editing.value = null;

                if (dropzonePhotoRef.value) {
                    dropzonePhotoRef.value.removeAllFiles(true);
                }

                if (dropzoneLogoRef.value) {
                    dropzoneLogoRef.value.removeAllFiles(true);
                }

                const drawerCloseBtn = document.querySelector('#kt_drawer_example_advanced_close');
                if (drawerCloseBtn) drawerCloseBtn.click();
            };

            const submit = () => {
                const submitBtn = document.querySelector('#kt_drawer_submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('name', form.name);
                payload.append('title', form.title);
                payload.append('statement', form.statement);
                if (form.photo && (form.photo instanceof File || form.photo instanceof Blob)) {
                    payload.append('photo', form.photo);
                }
                if (form.logo && (form.logo instanceof File || form.logo instanceof Blob)) {
                    payload.append('logo', form.logo);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                if (isEditMode.value && editing.value) {
                    payload.append('_method', 'PUT');
                    router.post(`/admin/pages/letstudy/partners/${editing.value.id}`, payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Partner Berhasil Diperbarui!',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                customClass: {
                                    popup: 'swal-custom-icon',
                                }
                            });
                            resetForm();
                        },
                        onFinish: cleanup
                    });
                } else {
                    router.post('/admin/pages/letstudy/partners', payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Partner Berhasil Disimpan!',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                customClass: {
                                    popup: 'swal-custom-icon',
                                }
                            });
                            resetForm();
                        },
                        onFinish: cleanup
                    });
                }
            };

            const editPartner = (partner) => {
                isEditMode.value = true;
                editing.value = partner;

                form.name = partner.name;
                form.title = partner.title;
                form.photo = null;
                form.logo = null;
                form.statement = partner.statement;

                openDrawer();
            };

            const destroy = (id) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda yakin?',
                    text: 'Anda tidak akan dapat mengembalikan ini!',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'swal-custom-icon',
                        confirmButton: 'btn btn-sm btn-myprimary',
                        cancelButton: 'btn btn-sm btn-mydanger',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        router.delete(`/admin/pages/letstudy/partners/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Partner Berhasil Dihapus!',
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

            watch(dropzonePhotoKey, () => {
                nextTick(() => {
                    const dz = new Dropzone('#partner-photo-dropzone', {
                        url: '/',
                        paramName: 'photo',
                        maxFiles: 1,
                        maxFilesize: 10,
                        acceptedFiles: 'image/jpeg,image/png',
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictRemoveFile: 'Hapus',
                        init: function() {
                            this.on('addedfile', function(file) {
                                form.photo = file;
                            });

                            this.on('removedfile', function() {
                                form.photo = null;
                            });

                            dropzonePhotoRef.value = this;

                            if (isEditMode.value && editing.value?.photo) {
                                const mockFile = {
                                    name: editing.value.photo.split('/').pop(),
                                };
                                this.emit('addedfile', mockFile);
                                this.emit('thumbnail', mockFile, `/storage/${editing.value.photo}`);
                                this.emit('complete', mockFile);
                                mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                            }
                        },
                    });
                });
            });

            watch(dropzoneLogoKey, () => {
                nextTick(() => {
                    const dz = new Dropzone('#partner-logo-dropzone', {
                        url: '/',
                        paramName: 'logo',
                        maxFiles: 1,
                        maxFilesize: 10,
                        acceptedFiles: 'image/jpeg,image/png',
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictRemoveFile: 'Hapus',
                        init: function() {
                            this.on('addedfile', function(file) {
                                form.logo = file;
                            });

                            this.on('removedfile', function() {
                                form.logo = null;
                            });

                            dropzoneLogoRef.value = this;

                            if (isEditMode.value && editing.value?.logo) {
                                const mockFile = {
                                    name: editing.value.logo.split('/').pop(),
                                };
                                this.emit('addedfile', mockFile);
                                this.emit('thumbnail', mockFile, `/storage/${editing.value.logo}`);
                                this.emit('complete', mockFile);
                                mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                            }
                        },
                    });
                });
            });

            return {
                search,
                handleSearch,
                form,
                submit,
                destroy,
                resetForm,
                editPartner,
                isEditMode,
                openDrawer,
                dropzonePhotoKey,
                dropzoneLogoKey,
            };
        },
    };
</script>

<style >
</style>
