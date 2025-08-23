<template>

    <Head>
        <title>Produk − LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Produk</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0">Produk LetStudy</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="card border border-gray-300">
                        <div class="card-header border-0 py-5 px-6 d-flex flex-wrap gap-3">
                            <form @submit.prevent="handleSearch"
                                class="d-flex align-items-center position-relative my-1 flex-grow-1 flex-sm-grow-0 w-100 w-sm-300px">
                                <i class="bi bi-search position-absolute ms-5 fs-4"></i>
                                <input type="text" class="form-control form-control-solid ps-13 fs-5"
                                    placeholder="Cari produk disini..." v-model="search" />
                            </form>
                            <div class="card-toolbar m-0 flex-grow-1 flex-sm-grow-0">
                                <button @click="() => { resetForm(); isEditMode = false; openDrawer(); }"
                                    class="d-flex align-items-center justify-content-center btn btn-sm btn-myprimary fs-5 w-100">
                                    Tambah Produk
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center border-top border-bottom border-gray-300 py-10 px-6" v-if="products.data.length === 0">
                                <img src="/assets/media/illustrations/empty.png"
                                    alt="Tidak ada data" class="mh-300px img-fluid">
                                <h2 class="text-gray-800 mb-4">Produk Tidak Ditemukan</h2>
                                <p class="text-gray-600 fs-4">Belum ada produk atau pencarian tidak sesuai.</p>
                            </div>
                            <div class="table-responsive" v-else>
                                <table id="kt_datatable_horizontal_scroll"
                                    class="table align-middle table-row-bordered fs-5 gy-5 border-bottom border-gray-300 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-20px ps-6 pe-5 bg-secondary" style="letter-spacing: 0.04em;">#</th>
                                            <th class="bg-secondary min-w-150px" style="letter-spacing: 0.04em;">Produk</th>
                                            <th class="bg-secondary min-w-300px" style="letter-spacing: 0.04em;">Deskripsi</th>
                                            <th class="bg-secondary pe-6 min-w-125px" style="letter-spacing: 0.04em;"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr v-for="(product, index) in products.data" :key="index">
                                            <td class="ps-6">
                                                {{ ++index + (products . current_page - 1) * products . per_page }}
                                            </td>
                                            <td class="text-dark fw-bold">
                                                {{ product.title }}
                                            </td>
                                            <td class="mw-300px">
                                                <p class="text-truncate-2 mb-0">
                                                    {{ product . description }}
                                                </p>
                                            </td>
                                            <td class="text-end pe-6">
                                                <button @click="editProduct(product)"
                                                    class="btn btn-sm btn-icon btn-mysecondary me-2">
                                                    <i class="ri-edit-2-fill fs-3"></i></button>
                                                <button @click.prevent="destroy(product.id)"
                                                    class="btn btn-sm btn-icon btn-mydanger">
                                                    <i class="ri-delete-bin-fill fs-3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="products.links" align="end" class="py-5 px-6" />
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
                            <h2>{{ isEditMode ? 'Edit Produk' : 'Tambah Produk' }}</h2>
                        </div>
                        <div class="card-toolbar" id="kt_drawer_example_advanced_close">
                            <div class="btn btn-sm btn-icon btn-mylighten rounded-pill">
                                <i class="bi bi-x-lg fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light p-6 d-flex flex-column gap-7">
                        <div class="flex-grow-1">
                            <div class="card border border-gray-300">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3>Data Produk</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Logo</label>
                                        <div id="product-dropzone" :key="dropzoneKey"
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
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Produk</label>
                                        <input type="text" class="form-control fs-5" v-model="form.title"
                                            required placeholder="Masukkan nama produk disini..."
                                            :class="{ 'is-invalid': errors.title }" />
                                        <div v-if="errors.title" class="text-mydanger mt-2">
                                            {{ errors . title }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Deskripsi</label>
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                            placeholder="Masukkan desckripsi disini..." v-model="form.description"
                                            :class="{ 'is-invalid': errors.description }">
                                        </textarea>
                                        <div v-if="errors.description" class="text-mydanger mt-2">
                                            {{ errors . description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border border-gray-300 mt-6">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3 class="required">Daftar Sub Produk</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div v-for="(subProduct, index) in form.subProducts" :key="index" class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Sub Produk {{ index + 1 }}</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="text" class="form-control fs-5" v-model="subProduct.title" required
                                                placeholder="Masukkan nama sub produk disini..." :class="{ 'is-invalid': errors.subProducts && errors.subProducts[index]?.title }" />
                                            <button :disabled="index === 0" class="btn btn-md btn-icon btn-mydanger" @click="removeSubProduct(index)">
                                                <i class="ri-delete-bin-fill fs-3"></i>
                                            </button>
                                        </div>
                                        <div v-if="errors.subProducts && errors.subProducts[index]?.title" class="text-mydanger mt-2">
                                            {{ errors.subProducts[index]?.title }}
                                        </div>
                                    </div>
                                    <button @click="addSubProduct" class="mt-1 d-flex align-items-center justify-content-center btn btn-sm btn-myprimary-outline fs-5 w-100">
                                        Tambah Sub Produk
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-sm btn-mylighten fs-5 me-3"
                                id="kt_drawer_example_advanced_close">Batal</button>
                            <button type="submit" id="kt_drawer_submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    {{ isEditMode ? 'Edit Produk' : 'Tambah Produk' }}
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
            products: Object,
        },

        setup() {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const handleSearch = () => {
                router.get('/admin/products', {
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
                logo: null,
                title: '',
                description: '',
                subProducts: [{ title: '' }]
            });

            const editing = ref(null);
            const isEditMode = ref(false);

            const resetForm = () => {
                form.logo = null;
                form.title = '';
                form.description = '';
                form.subProducts = [{ title: '' }];

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
                payload.append('description', form.description);
                if (form.logo && (form.logo instanceof File || form.logo instanceof Blob)) {
                    payload.append('logo', form.logo);
                }

                form.subProducts.forEach((subProduct, index) => {
                    payload.append(`sub_products[${index}][title]`, subProduct.title);
                });

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                if (isEditMode.value && editing.value) {
                    payload.append('_method', 'PUT');
                    router.post(`/admin/products/${editing.value.id}`, payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Produk Berhasil Diperbarui!',
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
                    router.post('/admin/products', payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Produk Berhasil Disimpan!',
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

            const editProduct = (product) => {
                isEditMode.value = true;
                editing.value = product;

                form.logo = null;
                form.title = product.title;
                form.description = product.description;

                form.subProducts = product.sub_products.map(subProduct => ({
                    title: subProduct.title,
                }));

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
                        router.delete(`/admin/products/${id}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Produk Berhasil Dihapus!',
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

            const addSubProduct = () => {
                form.subProducts.push({ title: '' });
            };

            const removeSubProduct = (index) => {
                if (index > 0) {
                    form.subProducts.splice(index, 1);
                }
            };

            watch(dropzoneKey, () => {
                nextTick(() => {
                    const dz = new Dropzone('#product-dropzone', {
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

                            dropzoneRef.value = this;

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
                editProduct,
                isEditMode,
                openDrawer,
                dropzoneKey,
                addSubProduct,
                removeSubProduct
            };
        },
    };
</script>

<style>

</style>
