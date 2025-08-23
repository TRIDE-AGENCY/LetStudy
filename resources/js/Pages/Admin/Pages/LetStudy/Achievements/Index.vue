<template>

    <Head>
        <title>Section Pencapaian − LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Pencapaian</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0">Section Pencapaian</h1>
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
                                        placeholder="Cari pencapaian disini..." v-model="search" />
                                </form>
                            </div>
                            <div class="d-flex gap-4">
                                <button @click="() => { resetForm(); isEditMode = false; openDrawer(); }"
                                    class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-center white-space-nowrap">
                                    Tambah Pencapaian
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="achievements.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Pencapaian Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada pencapaian atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#</th>
                                            <th class="bg-secondary min-w-200px" style="letter-spacing: 0.04em;">Judul</th>
                                            <th class="bg-secondary min-w-100px" style="letter-spacing: 0.04em;">Nilai</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(achievement, index) in achievements.data" :key="index">
                                            <td class="ps-6">
                                                {{ ++index + (achievements . current_page - 1) * achievements . per_page }}
                                            </td>
                                            <td class="text-dark fw-bold">{{ achievement . title }}</td>
                                            <td>{{ achievement . value }}</td>
                                            <td class="text-end pe-6">
                                                <button @click="editAchievement(achievement)"
                                                    class="btn btn-sm btn-icon btn-mysecondary me-2">
                                                    <i class="ri-edit-2-fill fs-3"></i></button>
                                                <button @click.prevent="destroy(achievement.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="achievements.links" align="end" class="py-5 px-6" />
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
                            <h2>{{ isEditMode ? 'Edit Pencapaian' : 'Tambah Pencapaian' }}</h2>
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
                                        <h3>Data Pencapaian</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Icon</label>
                                        <div id="achievement-dropzone" :key="dropzoneKey"
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
                                        <div v-if="errors.icon" class="text-mydanger mt-2">
                                            {{ errors . icon }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Judul</label>
                                        <input type="text" class="form-control fs-5" v-model="form.title"
                                            required placeholder="Masukkan judul disini..."
                                            :class="{ 'is-invalid': errors.title }" />
                                        <div v-if="errors.title" class="text-mydanger mt-2">
                                            {{ errors . title }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Nilai</label>
                                        <input type="text" class="form-control fs-5" v-model="form.value"
                                            required placeholder="Masukkan nilai disini..."
                                            :class="{ 'is-invalid': errors.value }" />
                                        <div v-if="errors.value" class="text-mydanger mt-2">
                                            {{ errors . value }}
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
                                    {{ isEditMode ? 'Edit Pencapaian' : 'Tambah Pencapaian' }}
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
            Pagination
        },

        props: {
            errors: Object,
            achievements: Object,
        },

        setup() {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get('/admin/pages/letstudy/achievements', {
                    q: search.value,
                });
            }

            const dropzoneRef = ref(null);
            const dropzoneKey = ref(Date.now());

            const openDrawer = async () => {
                dropzoneKey.value = Date.now();
                await nextTick();

                const drawerEl = document.querySelector('#kt_drawer_example_advanced');
                if (drawerEl && window.KTDrawer) {
                    const drawer = KTDrawer.getInstance(drawerEl) || new KTDrawer(drawerEl);
                    drawer.show();
                }
            };

            const form = reactive({
                icon: null,
                title: '',
                value: '',
            });

            const editing = ref(null);
            const isEditMode = ref(false);

            const resetForm = () => {
                form.icon = null;
                form.title = '';
                form.value = '';

                isEditMode.value = false;
                editing.value = null;

                if (dropzoneRef.value) {
                    dropzoneRef.value.removeAllFiles(true);
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
                payload.append('title', form.title);
                payload.append('value', form.value);
                if (form.icon && (form.icon instanceof File || form.icon instanceof Blob)) {
                    payload.append('icon', form.icon);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                if (isEditMode.value && editing.value) {
                    payload.append('_method', 'PUT');
                    router.post(`/admin/pages/letstudy/achievements/${editing.value.id}`, payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Pencapaian Berhasil Diperbarui!',
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
                    router.post('/admin/pages/letstudy/achievements', payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Pencapaian Berhasil Disimpan!',
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

            const editAchievement = (achievement) => {
                isEditMode.value = true;
                editing.value = achievement;

                form.icon = null;
                form.title = achievement.title;
                form.value = achievement.value;

                openDrawer();
            };

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
                        router.delete(`/admin/pages/letstudy/achievements/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Pencapaian Berhasil Dihapus!',
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

            watch(dropzoneKey, () => {
                nextTick(() => {
                    const dz = new Dropzone('#achievement-dropzone', {
                        url: '/',
                        paramName: 'icon',
                        maxFiles: 1,
                        maxFilesize: 10,
                        acceptedFiles: 'image/jpeg,image/png',
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictRemoveFile: 'Hapus',
                        init: function() {
                            this.on('addedfile', function(file) {
                                form.icon = file;
                            });

                            this.on('removedfile', function() {
                                form.icon = null;
                            });

                            dropzoneRef.value = this;

                            if (isEditMode.value && editing.value?.icon) {
                                const mockFile = {
                                    name: editing.value.icon.split('/').pop(),
                                };
                                this.emit('addedfile', mockFile);
                                this.emit('thumbnail', mockFile, `/storage/${editing.value.icon}`);
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
                editAchievement,
                isEditMode,
                openDrawer,
                dropzoneKey,
            };
        },
    };
</script>

<style>

</style>
