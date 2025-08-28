<template>

    <Head>
        <title>Akun − LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Akun</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Akun</h1>
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
                                        <h3 class="mb-0">Informasi Akun</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola data dasar dan identitas pengguna
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Nama Lengkap</label>
                                        <input type="text" class="form-control fs-5" required
                                            placeholder="Masukkan nama disini..." v-model="form.name"
                                            :class="{ 'is-invalid': errors.name }" />
                                        <div v-if="errors.name" class="text-mydanger mt-2">
                                            {{ errors . name }}
                                        </div>
                                    </div>
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
                                                    form.province_id === '' ? 'text-gray-400' : 'text-dark'
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
                                                    form.city_id === '' || form.city_id === NULL ? 'text-gray-400' : 'text-dark'
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
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-0" style="min-height: unset;">
                                        <h3 class="mb-0">Kredensial Akun</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengatur keamanan akun dengan opsi perubahan kata sandi
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Kata Sandi Lama</label>
                                        <input type="password" class="form-control fs-5"
                                            placeholder="Masukkan kata sandi lama disini..." v-model="form.current_password"
                                            :class="{ 'is-invalid': errors.current_password }" />
                                        <div v-if="errors.current_password" class="text-mydanger mt-2">
                                            {{ errors.current_password }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Kata Sandi Baru</label>
                                        <input type="password" class="form-control fs-5"
                                            placeholder="Masukkan kata sandi baru disini..." v-model="form.password"
                                            :class="{ 'is-invalid': errors.password }" />
                                        <div v-if="errors.password" class="text-mydanger mt-2">
                                            {{ errors.password }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Konfirmasi Kata Sandi Baru</label>
                                        <input type="password" class="form-control fs-5"
                                            placeholder="Masukkan konfirmasi kata sandi baru disini..." v-model="form.password_confirmation" />
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
    import LayoutUser from '../../../Layouts/User.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, computed, onMounted, watch } from 'vue';
    import Swal from 'sweetalert2';
    import flatpickr from "flatpickr"

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link,
        },

        props: {
            errors: Object,
            user: Object,
            provinces: Array,
            cities: Array,
            educations: Array,
        },

        setup(props) {
            const educationNames = (props.educations || []).map(e => e.name);

            const form = reactive({
                name: props.user.name,
                email: props.user.email,
                gender: props.user.gender,
                province_id: props.user.province_id ?? '',
                city_id: props.user.city_id ?? '',
                birth_date: props.user.birth_date,
                education: educationNames.includes(props.user.education) 
                    ? props.user.education 
                    : 'Lainnya',
                education_other: educationNames.includes(props.user.education) 
                    ? '' 
                    : (props.user.education || ''),
                current_password: '',
                password: '',
                password_confirmation: '',
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

            onMounted(() => {
                flatpickr("#kt_datepicker_1", {
                    dateFormat: "Y-m-d"
                });
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                router.put(`/member-area/user/${props.user.id}`, {
                    name: form.name,
                    email: form.email,
                    gender: form.gender,
                    province_id: form.province_id,
                    city_id: form.city_id,
                    birth_date: form.birth_date,
                    education: form.education === 'Lainnya' ? form.education_other : form.education,
                    current_password: form.current_password,
                    password: form.password,
                    password_confirmation: form.password_confirmation,
                }, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Akun Berhasil Diperbarui!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            }
                        });
                        form.current_password = '';
                        form.password = '';
                        form.password_confirmation = '';
                    },
                    onFinish: cleanup
                });
            }

            return {
                form,
                filteredCities,
                submit,
            };
        }
    }
</script>

<style>

</style>
