<template>

    <Head>
        <title>Section Kutipan − {{ product.title }}</title>
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
                                <Link :href="`/admin/pages/products/${product.slug}`" class="btn-link-myprimary fw-bold pe-3">{{ product.title }}</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Kutipan</li>
                        </ol>
                        <div class="page-name">
                            <h1 class="mb-0 text-dark">Section Kutipan</h1>
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
                                        <h3 class="mb-0">Kutipan / Quote</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola kutipan yang tampil di section quote 
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Nama</label>
                                        <input type="text" class="form-control fs-5" v-model="form.name"
                                            required placeholder="Masukkan nama disini..."
                                            :class="{ 'is-invalid': errors.name }" />
                                        <div v-if="errors.name" class="text-mydanger mt-2">
                                            {{ errors . name }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Gelar / Peran</label>
                                        <input type="text" class="form-control fs-5" v-model="form.title"
                                            required placeholder="Masukkan gelar / peran disini..."
                                            :class="{ 'is-invalid': errors.title }" />
                                        <div v-if="errors.title" class="text-mydanger mt-2">
                                            {{ errors . title }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Kutipan / Quote</label>
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                            placeholder="Masukkan kutipan / quote disini..." v-model="form.quote"
                                            :class="{ 'is-invalid': errors.quote }">
                                        </textarea>
                                        <div v-if="errors.quote" class="text-mydanger mt-2">
                                            {{ errors . quote }}
                                        </div>
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
    import { reactive } from 'vue';
    import Swal from 'sweetalert2';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            errors: Object,
            quote: Object,
            product: Object
        },

        setup(props) {
            const form = reactive({
                name: props.quote.name,
                title: props.quote.title,
                quote: props.quote.quote,
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('name', form.name);
                payload.append('title', form.title);
                payload.append('quote', form.quote);

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/pages/products/${props.product.slug}/quote/${props.quote.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Kutipan Berhasil Diperbarui!',
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
