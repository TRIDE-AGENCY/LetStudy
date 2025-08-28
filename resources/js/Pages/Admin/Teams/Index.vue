<template>

    <Head>
        <title>Tim LetStudy</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/dashboard" class="btn-link-myprimary fw-bold pe-3">Dashboard</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Tim LetStudy</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Tim LetStudy</h1>
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
                                        placeholder="Cari nama disini..." v-model="search" />
                                </form>
                            </div>
                            <div class="d-flex gap-4">
                                <button @click="() => { resetForm(); isEditMode = false; openDrawer(); }"
                                    class="w-100 w-md-auto btn btn-sm btn-myprimary fs-5 align-self-center white-space-nowrap">
                                    Tambah Tim
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="teams.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Tim Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada tim atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#
                                            </th>
                                            <th class="bg-secondary min-w-250px" style="letter-spacing: 0.04em;">Nama</th>
                                            <th class="bg-secondary min-w-300px" style="letter-spacing: 0.04em;">Bio</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(team, index) in teams.data" :key="index">
                                            <td class="ps-6">
                                                {{ ++index + (teams . current_page - 1) * teams . per_page }}
                                            </td>
                                            <td class="d-flex align-items-center gap-3">
                                                <img class="w-45px h-45px min-w-45px rounded-circle object-fit-cover"
                                                    :src="`/storage/${team.photo}`" alt="Foto Profil">
                                                <div>
                                                    <p class="text-dark fw-bold mb-1">{{ team . name }}</p>
                                                    <p class="fs-7 mb-0">{{ team . position }}</p>
                                                </div>
                                            </td>
                                            <td class="mw-300px">
                                                <p class="text-truncate-2 mb-0">
                                                    {{ team . bio }}
                                                </p>
                                            </td>
                                            <td class="text-end pe-6">
                                                <button @click="editTim(team)"
                                                    class="btn btn-sm btn-icon btn-mysecondary me-2">
                                                    <i class="ri-edit-2-fill fs-3"></i></button>
                                                <button @click.prevent="destroy(team.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="teams.links" align="end" class="py-5 px-6" />
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
                            <h2>{{ isEditMode ? 'Edit Tim' : 'Tambah Tim' }}</h2>
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
                                        <h3>Informasi Pribadi</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Foto Profil</label>
                                        <div id="team-dropzone" :key="dropzoneKey"
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
                                        <label class="required form-label fs-6">Departemen</label>
                                        <select class="form-select fs-5" required v-model="form.department"
                                            :class="[
                                                { 'is-invalid': errors.department },
                                                !form.department ? 'text-gray-400' : 'text-dark'
                                            ]">
                                            <option disabled value="">Pilih departemen</option>
                                            <option class="text-dark" value="Pimpinan">Pimpinan</option>
                                            <option class="text-dark" value="Marketing Creative">Marketing Creative</option>
                                            <option class="text-dark" value="Strategic Partnership">Strategic Partnership</option>
                                            <option class="text-dark" value="Administration & Finance">Administration & Finance</option>
                                            <option class="text-dark" value="Product & Project Manager">Product & Project Manager</option>
                                            <option class="text-dark" value="Education Development">Education Development</option>
                                        </select>
                                        <div v-if="errors.department" class="text-mydanger mt-2">
                                            {{ errors . department }}
                                        </div>
                                    </div>
                                    <div v-if="form.department && form.department != 'Pimpinan'"
                                        class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Status</label>
                                        <select class="form-select fs-5" required v-model="form.status"
                                            :class="[
                                                { 'is-invalid': errors.status },
                                                !form.status ? 'text-gray-400' : 'text-dark'
                                            ]">
                                            <option disabled value="">Pilih status</option>
                                            <option class="text-dark" value="chief">Chief Officer</option>
                                            <option class="text-dark" value="head">Head Department</option>
                                            <option class="text-dark" value="vice">Vice Head Department</option>
                                            <option class="text-dark" value="member">Member</option>
                                        </select>
                                        <div v-if="errors.status" class="text-mydanger mt-2">
                                            {{ errors . status }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Posisi</label>
                                        <input type="text" class="form-control fs-5" v-model="form.position" required
                                            placeholder="Masukkan nama disini..."
                                            :class="{ 'is-invalid': errors.position }" />
                                        <div v-if="errors.position" class="text-mydanger mt-2">
                                            {{ errors . position }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Biodata</label>
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                            placeholder="Masukkan biodata disini..." v-model="form.bio"
                                            :class="{ 'is-invalid': errors.bio }">
                                        </textarea>
                                        <div v-if="errors.bio" class="text-mydanger mt-2">
                                            {{ errors . bio }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-4 border border-gray-300 mt-6">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3>Kutipan / Quote</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="fv-row">
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5"
                                            placeholder="Masukkan kutipan / quote disini..." v-model="form.quote"
                                            :class="{ 'is-invalid': errors.quote }">
                                        </textarea>
                                        <div v-if="errors.quote" class="text-mydanger mt-2">
                                            {{ errors . quote }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-4 border border-gray-300 mt-6">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3>Sosial Media</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Alamat Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-mail-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan alamat email disini..."
                                                v-model="form.email" :class="{ 'is-invalid': errors.email }" />
                                        </div>
                                        <div v-if="errors.email" class="text-mydanger mt-2">
                                            {{ errors . email }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">LinkedIn</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-linkedin-box-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link linkedin disini..."
                                                v-model="form.linkedin" :class="{ 'is-invalid': errors.linkedin }" />
                                        </div>
                                        <div v-if="errors.linkedin" class="text-mydanger mt-2">
                                            {{ errors . linkedin }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-instagram-line fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link instagram disini..."
                                                v-model="form.instagram" :class="{ 'is-invalid': errors.instagram }" />
                                        </div>
                                        <div v-if="errors.instagram" class="text-mydanger mt-2">
                                            {{ errors . instagram }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">TikTok</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-tiktok-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link tiktok disini..."
                                                v-model="form.tiktok" :class="{ 'is-invalid': errors.tiktok }" />
                                        </div>
                                        <div v-if="errors.tiktok" class="text-mydanger mt-2">
                                            {{ errors . tiktok }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="form-label fs-6">Twitter / X</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-twitter-x-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link twitter / x disini..."
                                                v-model="form.x" :class="{ 'is-invalid': errors.x }" />
                                        </div>
                                        <div v-if="errors.x" class="text-mydanger mt-2">
                                            {{ errors . x }}
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
                                    {{ isEditMode ? 'Edit Tim' : 'Tambah Tim' }}
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
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import Pagination from '../../../Components/Pagination.vue';
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
            teams: Object,
        },

        setup() {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get('/admin/teams', {
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
                photo: null,
                name: '',
                department: '',
                status: '',
                position: '',
                bio: '',
                quote: '',
                email: '',
                linkedin: '',
                instagram: '',
                tiktok: '',
                x: '',
            });

            const editing = ref(null);
            const isEditMode = ref(false);

            const resetForm = () => {
                form.photo = null;
                form.name = '';
                form.department = '';
                form.status = '';
                form.position = '';
                form.bio = '';
                form.quote = '';
                form.email = '';
                form.linkedin = '';
                form.instagram = '';
                form.tiktok = '';
                form.x = '';

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
                payload.append('name', form.name);
                payload.append('department', form.department);
                payload.append('status', form.status);
                payload.append('position', form.position);
                payload.append('bio', form.bio);
                payload.append('quote', form.quote);
                payload.append('email', form.email);
                payload.append('linkedin', form.linkedin);
                payload.append('instagram', form.instagram);
                payload.append('tiktok', form.tiktok);
                payload.append('x', form.x);
                if (form.photo && (form.photo instanceof File || form.photo instanceof Blob)) {
                    payload.append('photo', form.photo);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                if (isEditMode.value && editing.value) {
                    payload.append('_method', 'PUT');
                    router.post(`/admin/teams/${editing.value.id}`, payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Tim Berhasil Diperbarui!',
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
                    router.post('/admin/teams', payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Tim Berhasil Disimpan!',
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

            const editTim = (team) => {
                isEditMode.value = true;
                editing.value = team;

                form.photo = null;
                form.name = team.name;
                form.department = team.department;
                form.status = team.status ?? '';
                form.position = team.position;
                form.bio = team.bio;
                form.quote = team.quote ?? '';
                form.email = team.email ?? '';
                form.linkedin = team.linkedin ?? '';
                form.instagram = team.instagram ?? '';
                form.tiktok = team.tiktok ?? '';
                form.x = team.x ?? '';

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
                        router.delete(`/admin/teams/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Tim Berhasil Dihapus!',
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
                    const dz = new Dropzone('#team-dropzone', {
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

                            dropzoneRef.value = this;

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

            return {
                search,
                handleSearch,
                form,
                submit,
                destroy,
                resetForm,
                editTim,
                isEditMode,
                openDrawer,
                dropzoneKey,
            };
        },
    };
</script>

<style>

</style>
