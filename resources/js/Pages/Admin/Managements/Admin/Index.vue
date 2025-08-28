<template>

    <Head>
        <title>Manajemen Akun Admin − LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Admin</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Manajemen Akun Admin</h1>
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
                                    Tambah Admin
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="admins.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                <h2 class="text-dark mb-4">Admin Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4 mb-0">Belum ada admin atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#
                                            </th>
                                            <th class="bg-secondary min-w-250px" style="letter-spacing: 0.04em;">Admin</th>
                                            <th class="bg-secondary min-w-150px" style="letter-spacing: 0.04em;">Jenis Kelamin</th>
                                            <th class="bg-secondary min-w-200px" style="letter-spacing: 0.04em;">Pendidikan</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(admin, index) in admins.data" :key="index">
                                            <td class="ps-6">
                                                {{ ++index + (admins . current_page - 1) * admins . per_page }}
                                            </td>
                                            <td class="d-flex align-items-center gap-3">
                                                <div class="symbol symbol-45px symbol-circle">
                                                    <div class="symbol-label fs-4 fw-semibold bg-myprimary text-white">{{ getInitials (admin . name) }}</div>
                                                </div>
                                                <div>
                                                    <p class="text-dark fw-bold mb-1">{{ admin . name }}</p>
                                                    <p class="fs-7 mb-0">{{ admin . email }}</p>
                                                </div>
                                            </td>
                                            <td>{{ genderLabel (admin . gender) }}</td>
                                            <td>{{ admin . education }}</td>
                                            <td class="text-end pe-6">
                                                <button @click="editAdmin(admin)"
                                                    class="btn btn-sm btn-icon btn-mysecondary me-2">
                                                    <i class="ri-edit-2-fill fs-3"></i></button>
                                                <button @click.prevent="destroy(admin.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="admins.links" align="end" class="py-5 px-6" />
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
                            <h2>{{ isEditMode ? 'Edit Admin' : 'Tambah Admin' }}</h2>
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
                                        <label class="required form-label fs-6">Nama</label>
                                        <input type="text" class="form-control fs-5" v-model="form.name" required
                                            placeholder="Masukkan nama disini..."
                                            :class="{ 'is-invalid': errors.name }" />
                                        <div v-if="errors.name" class="text-mydanger mt-2">
                                            {{ errors . name }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Jenis Kelamin</label>
                                        <div class="btn-group w-100" data-kt-buttons="true"
                                            data-kt-buttons-target="[data-kt-button]">
                                            <label
                                                class="btn w-50 btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                data-kt-button="true"
                                                :class="{ active: form.gender === 'L' }">
                                                <input class="btn-check" type="radio" v-model="form.gender"
                                                    value="L" />
                                                Laki-laki
                                            </label>
                                            <label
                                                class="btn w-50 btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                data-kt-button="true"
                                                :class="{ active: form.gender === 'P' }">
                                                <input class="btn-check" type="radio" v-model="form.gender"
                                                    value="P" />
                                                Perempuan
                                            </label>
                                        </div>
                                        <div v-if="errors.gender" class="text-danger mt-2">
                                            {{ errors . gender }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Tempat Lahir</label>
                                        <div class="input-group">
                                            <select class="form-select fs-5" v-model="form.province_id"
                                                :class="[
                                                    { 'is-invalid': errors.province_id },
                                                    !form.province_id ? 'text-gray-400' : 'text-dark'
                                                ]">
                                                <option disabled value="">Provinsi</option>
                                                <option class="text-dark" v-for="province in provinces"
                                                    :key="province.id" :value="province.id">
                                                    {{ province.name }}
                                                </option>
                                            </select>
                                            <select class="form-select fs-5" v-model="form.city_id"
                                                :class="[
                                                    { 'is-invalid': errors.city_id },
                                                    !form.city_id ? 'text-gray-400' : 'text-dark'
                                                ]">
                                                <option disabled value="">Kab / Kota</option>
                                                <option class="text-dark" v-for="city in filteredCities"
                                                    :key="city.id" :value="city.id">
                                                    {{ city.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Tanggal Lahir</label>
                                        <input class="form-control fs-5" v-model="form.birth_date"
                                                placeholder="Pilih tanggal lahir" id="kt_datepicker_1"/>
                                        <div v-if="errors.birth_date" class="text-mydanger mt-2">
                                            {{ errors . birth_date }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Asal Sekolah / Kampus</label>
                                        <select class="form-select fs-5" required v-model="form.education"
                                            :class="[
                                                { 'is-invalid': errors.city_id },
                                                !form.education ? 'text-gray-400' : 'text-dark'
                                            ]">
                                            <option disabled value="">Pilih asal sekolah / kampus</option>
                                            <option class="text-dark" v-for="(education, index) in educations" :key="index"
                                                :value="education.name">{{ education . name }}</option>
                                            <option class="text-dark" value="Lainnya">Lainnya</option>
                                        </select>
                                        <div v-if="form.education === 'Lainnya'" class="mt-3">
                                            <input type="text" class="form-control fs-5" v-model="form.education_other"
                                                placeholder="Masukkan nama sekolah / kampus lain..." />
                                        </div>
                                        <div v-if="errors.education" class="text-mydanger mt-2">
                                            {{ errors . education }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-4 border border-gray-300 mt-6">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3 class="required">Kredensial Akun</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Alamat Email</label>
                                        <input type="email" class="form-control fs-5" v-model="form.email"
                                            required placeholder="Masukkan alamat email disini..."
                                            :class="{ 'is-invalid': errors.email }" />
                                        <div v-if="errors.email" class="text-danger mt-2">
                                            {{ errors . email }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Kata Sandi</label>
                                        <input type="password" class="form-control fs-5" v-model="form.password"
                                            placeholder="Masukkan kata sandi disini..."
                                            :class="{ 'is-invalid': errors.password }" />
                                        <div v-if="errors.password" class="text-danger mt-2">
                                            {{ errors . password }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Konfirmasi Kata Sandi</label>
                                        <input type="password" class="form-control fs-5" v-model="form.password_confirmation"
                                            placeholder="Masukkan konfirmasi kata sandi disini..." />
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
                                    {{ isEditMode ? 'Edit Admin' : 'Tambah Admin' }}
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
    import LayoutAdmin from '../../../../Layouts/Admin.vue';
    import Pagination from '../../../../Components/Pagination.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, computed, ref, nextTick, onMounted, watch } from 'vue';
    import Swal from 'sweetalert2';
    import flatpickr from "flatpickr"

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
            Pagination
        },

        props: {
            errors: Object,
            admins: Object,
            provinces: Array,
            cities: Array,
            educations: Array,
        },

        setup(props) {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get('/admin/management/admin', {
                    q: search.value,
                });
            }

            const openDrawer = async () => {
                await nextTick();

                const drawerEl = document.querySelector('#kt_drawer_example_advanced');
                if (drawerEl && window.KTDrawer) {
                    const drawer = KTDrawer.getInstance(drawerEl) || new KTDrawer(drawerEl);
                    drawer.show();
                }
            };

            onMounted(() => {
                flatpickr("#kt_datepicker_1", {
                    dateFormat: "Y-m-d"
                });
            });

            const form = reactive({
                name: '',
                gender: '',
                province_id: '',
                city_id: '',
                birth_date: '',
                education: '',
                education_other: '',
                email: '',
                password: '',
                password_confirmation: ''
            });

            const filteredCities = computed(() => {
                if (!form.province_id) return [];
                return props.cities.filter(
                    (c) => c.province_id === parseInt(form.province_id)
                );
            });

            watch(() => form.province_id, () => {
                form.city_id = '';
            });

            const editing = ref(null);
            const isEditMode = ref(false);

            const resetForm = () => {
                form.name = '';
                form.gender = '';
                form.province_id = '';
                form.city_id = '';
                form.birth_date = '';
                form.education = '';
                form.education_other = '';
                form.email = '';
                form.password = '';
                form.password_confirmation = '';

                isEditMode.value = false;
                editing.value = null;

                const drawerCloseBtn = document.querySelector('#kt_drawer_example_advanced_close');
                if (drawerCloseBtn) drawerCloseBtn.click();
            };

            const submit = () => {
                const submitBtn = document.querySelector('#kt_drawer_submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = {
                    name: form.name,
                    gender: form.gender,
                    province_id: form.province_id,
                    city_id: form.city_id,
                    birth_date: form.birth_date,
                    education: form.education === 'Lainnya' ? form.education_other : form.education,
                    email: form.email,
                };

                if (isEditMode.value && form.password.trim() !== '') {
                    payload.password = form.password;
                    payload.password_confirmation = form.password_confirmation;
                } else if (!isEditMode.value) {
                    payload.password = form.password;
                    payload.password_confirmation = form.password_confirmation;
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                if (isEditMode.value && editing.value) {
                    router.put(`/admin/management/admin/${editing.value.id}`, payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Admin Berhasil Diperbarui!',
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
                    router.post('/admin/management/admin', payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Admin Berhasil Disimpan!',
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

            const editAdmin = async (admin) => {
                isEditMode.value = true;
                editing.value = admin;

                form.name = admin.name;
                form.gender = admin.gender;
                form.province_id = admin.province_id ?? '';
                form.birth_date = admin.birth_date;
                form.education = admin.education;
                form.email = admin.email;
                form.password = '';
                form.password_confirmation = '';

                const inList = (props.educations || []).some(e => e.name === admin.education);

                if (inList) {
                    form.education = admin.education;
                    form.education_other = '';
                } else {
                    form.education = 'Lainnya';
                    form.education_other = admin.education || '';
                }

                await nextTick();
                form.city_id = admin.city_id ?? '';

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
                        router.delete(`/admin/management/admin/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Admin Berhasil Dihapus!',
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

            const getInitials = (name) => {
                if (!name) return '';
                return name
                    .split(' ')               
                    .map(word => word[0])   
                    .join('') 
                    .substring(0, 2)              
                    .toUpperCase();          
            };

            const genderLabel = (gender) => {
                if (gender === 'L') return 'Laki-laki';
                if (gender === 'P') return 'Perempuan';
                return '-';
            };

            return {
                search,
                handleSearch,
                form,
                filteredCities,
                submit,
                destroy,
                resetForm,
                editAdmin,
                isEditMode,
                openDrawer,
                getInitials,
                genderLabel
            };
        },
    };
</script>

<style>

</style>
