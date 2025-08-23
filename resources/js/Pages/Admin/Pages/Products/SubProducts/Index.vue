<template>

    <Head>
        <title>Section Sub Produk − {{ product.title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Sub Produk</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Section Sub Produk</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="row g-4 g-md-6">
                        <div v-for="(subProduct, index) in subProducts" :key="index" 
                            class="col-12 col-md-6">
                            <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                                <div class="flex-grow-1">
                                    <img class="w-70px p-4 rounded bg-mysecondary mb-7" :src="`/storage/${subProduct.icon}`" :alt="`${subProduct.title}`">
                                    <h2 class="text-dark lh-sm fs-2tx mb-3">
                                        {{ subProduct.title }}
                                    </h2>
                                    <p class="text-gray-600 fs-4 mb-0">
                                        {{ subProduct.description }}
                                    </p>
                                    <div v-if="subProduct.sub_product_benefits.length > 0"
                                        class="d-flex flex-column gap-2 mt-5">
                                        <div v-for="(benefit, index) in subProduct.sub_product_benefits" :key="index"   
                                            class="d-flex align-items-start gap-3">
                                            <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                            <p class="text-gray-600 fs-4 mb-0">
                                                {{ benefit.benefit }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <button @click="editSubProduct(subProduct)"
                                    class="w-100 mt-8 btn btn-sm btn-mysecondary fs-5">
                                    Edit Sub Produk
                                </button>
                            </div>
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
                            <h2>{{ isEditMode ? 'Edit Sub Produk' : 'Tambah Sub Produk' }}</h2>
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
                                        <h3>
                                            Sub Produk <span v-if="editingTitle">{{ editingTitle }}</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Ikon Sub Produk</label>
                                        <div id="sub-product-dropzone" :key="dropzoneKey"
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
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Deskripsi</label>
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                            placeholder="Masukkan deskripsi disini..." v-model="form.description"
                                            :class="{ 'is-invalid': errors.description }">
                                        </textarea>
                                        <div v-if="errors.description" class="text-mydanger mt-2">
                                            {{ errors . description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-4 border border-gray-300 mt-6">
                                <div class="card-header h-auto p-6 border-bottom border-gray-300"
                                    style="min-height: unset;">
                                    <div class="card-title m-0">
                                        <h3>Tujuan & Manfaat</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div v-for="(subProductBenefit, index) in form.subProductBenefits" :key="index" class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Tujuan & Manfaat {{ index + 1 }}</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="text" class="form-control fs-5" v-model="subProductBenefit.benefit" required
                                                placeholder="Masukkan tujuan & manfaat disini..." :class="{ 'is-invalid': errors.subProductBenefits && errors.subProductBenefits[index]?.benefit }" />
                                            <button class="btn btn-md btn-icon btn-mydanger" @click="removeSubProductBenefit(index)">
                                                <i class="ri-delete-bin-fill fs-3"></i>
                                            </button>
                                        </div>
                                        <div v-if="errors.subProductBenefits && errors.subProductBenefits[index]?.benefit" class="text-mydanger mt-2">
                                            {{ errors.subProductBenefits[index]?.benefit }}
                                        </div>
                                    </div>
                                    <button @click="addSubProductBenefit" class="mt-1 d-flex align-items-center justify-content-center btn btn-sm btn-myprimary-outline fs-5 w-100">
                                        Tambah Tujuan & Manfaat
                                    </button>
                                    <div v-if="errors.sub_product_benefits" class="text-mydanger mt-2">
                                        {{ errors . sub_product_benefits }}
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
                                    {{ isEditMode ? 'Edit Sub Produk' : 'Tambah Sub Produk' }}
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
    import { reactive, ref, nextTick, watch, computed } from 'vue';
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
            subProducts: Object,
            product: Object
        },

        setup(props) {
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
                description: '',
                icon: null,
                subProductBenefits: [{ benefit: '' }]
            });

            const editing = ref(null);
            const isEditMode = ref(false);
            const editingTitle = computed(() => (
                isEditMode.value && editing.value?.title ? editing.value.title : ''
            ));

            const resetForm = () => {
                form.description = '';
                form.icon = null;
                form.subProductBenefits = [{ benefit: '' }];

                isEditMode.value = false;
                editing.value = null;

                if (dropzoneRef.value) {
                    dropzoneRef.value.removeAllFiles(true);
                }

                const drawerCloseBtn = document.querySelector('#kt_drawer_example_advanced_close');
                if (drawerCloseBtn) drawerCloseBtn.click();
            };

            const addSubProductBenefit = () => {
                form.subProductBenefits.push({ benefit: '' });
            };

            const removeSubProductBenefit = (index) => {
                form.subProductBenefits.splice(index, 1);
            };

            const submit = () => {
                const submitBtn = document.querySelector('#kt_drawer_submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('description', form.description);
                if (form.icon && (form.icon instanceof File || form.icon instanceof Blob)) {
                    payload.append('icon', form.icon);
                }

                form.subProductBenefits.forEach((subProductBenefit, index) => {
                    payload.append(`sub_product_benefits[${index}][benefit]`, subProductBenefit.benefit);
                });

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                if (isEditMode.value && editing.value) {
                    payload.append('_method', 'PUT');
                    router.post(`/admin/pages/products/${props.product.slug}/sub-products/${editing.value.id}`, payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Sub Produk Berhasil Diperbarui!',
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
                    router.post(`/admin/pages/products/${props.product.slug}/sub-products`, payload, {
                        onSuccess: () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Sub Produk Berhasil Disimpan!',
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

            const editSubProduct = (subProduct) => {
                isEditMode.value = true;
                editing.value = subProduct;

                form.description = subProduct.description;
                form.icon = null;

                form.subProductBenefits = subProduct.sub_product_benefits.map(subProductBenefit => ({
                    benefit: subProductBenefit.benefit,
                }));

                openDrawer();
            };

            watch(dropzoneKey, () => {
                nextTick(() => {
                    const dz = new Dropzone('#sub-product-dropzone', {
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
                form,
                addSubProductBenefit,
                removeSubProductBenefit,
                submit,
                resetForm,
                editSubProduct,
                isEditMode,
                editingTitle,
                openDrawer,
                dropzoneKey,
            };
        },
    };
</script>

<style>

</style>
