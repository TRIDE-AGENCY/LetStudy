<template>
    <Head>
        <title>FAQs − LetStudy</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="flex-grow-1">
                <div id="home" class="bg-white">
                    <Navbar />
                    <div class="container d-flex flex-column w-100 w-md-700px w-lg-auto">
                        <div class="d-flex flex-column align-items-center text-center py-10 py-md-20">
                            <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                                Yang Sering Ditanyain 🤔
                            </h1>
                            <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                                Tenang, kamu nggak sendirian! <span class="text-myprimary fw-bold">Kami rangkum semua jawaban</span> biar kamu nggak bingung lagi.
                            </p>
                            <form @submit.prevent="handleSearch"
                                class="d-flex align-items-center position-relative w-100 w-lg-75">
                                <i class="ri-search-line position-absolute ms-7 fs-3"></i>
                                <input type="text"
                                    class="form-control form-control-solid border border-gray-300 rounded-pill px-16 fs-5 h-50px"
                                    placeholder="Cari pertanyaan disini..." v-model="search" />
                                <i class="cursor-pointer ri-filter-3-line position-absolute end-0 me-4 p-3 fs-3"
                                    data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"></i>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 gap-1
                                    menu-state-bg border border-gray-300 rounded-4 menu-state-color fw-semibold mt-3 p-2 w-225px"
                                    data-kt-menu="true">
                                    <div v-for="(tag, i) in tags" data-kt-menu-dismiss="true"
                                        :key="i" class="menu-item btn btn-sm btn-mylightest fs-5 w-100 text-start"
                                        :class="{ 'bg-mysecondary text-mysecondary': selectedTag === tag }" @click="selectedTag = tag">
                                        {{ tag }}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="faqs" class="container d-flex flex-column flex-center py-10 py-md-20">
                    <div class="text-center" v-if="faqs.data.length === 0">
                        <img src="/assets/media/illustrations/empty.png"
                            alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                        <h2 class="text-dark mb-4">FAQs Tidak Ditemukan</h2>
                        <p class="text-gray-600 fs-4 mb-0">Belum ada FAQs atau pencarian tidak sesuai.</p>
                    </div>
                    <div class="d-flex flex-column gap-4 gap-lg-6 w-100" v-else>
                        <div v-for="(faq, index) in filteredFaqs" :key="`faq-${index}`"
                            class="card card-hover cursor-pointer ps-6 ps-lg-8 pe-3 pe-lg-5 py-4 py-lg-6 rounded-4 border border-gray-300 collapsible toggle collapsed w-100"
                            data-bs-toggle="collapse" :data-bs-target="`#faq-collapse-${index}`">
                            <div class="d-flex align-items-center justfy-content-between gap-2">
                                <h6 class="text-dark w-100 lh-sm fs-1 fs-md-2 mb-0">
                                    {{ faq.question }}
                                </h6>
                                <div class="btn btn-sm btn-icon btn-active-color-myprimary">
                                    <i class="ri-checkbox-indeterminate-fill fs-1 toggle-on text-myprimary"></i>
                                    <i class="ri-add-box-fill fs-1 toggle-off text-gray-400"></i>
                                </div>
                            </div>
                            <div :id="`faq-collapse-${index}`" class="collapse mt-2">
                                <p id="content-editor" class="text-gray-600 fs-5 mb-1 me-13" v-html="faq.answer"></p>
                            </div>
                        </div>
                        <Pagination :links="faqs.links" class="mt-8" align="center" />
                    </div>
                </div>
            </div>

            <Footer :sosmed="sosmed" />

            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <i class="fs-1 ri-arrow-up-double-line"></i>
            </div>
        </div>
    </main>
</template>

<script>
    import Navbar from "../../../Components/Navbar/Home.vue";
    import Footer from "../../../Components/Footer/Home.vue";
    import Pagination from '../../../Components/Pagination.vue';
    import { Head, router } from '@inertiajs/vue3';
    import { ref, computed, onMounted, nextTick, watch } from 'vue';

    export default {
        components: {
            Head,
            Navbar,
            Footer,
            Pagination,
        },

        props: {
            faqs: Object,
            sosmed: Object,
        },

        setup(props) {
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            const initMenus = () => {
                if (window.KTMenu && typeof window.KTMenu.createInstances === 'function') {
                    window.KTMenu.createInstances();
                }
            };

            onMounted(() => {
                nextTick(() => initMenus());
            });

            router.on('success', () => {
                nextTick(() => initMenus());
            });

            watch(() => props.faqs, () => {
                nextTick(() => initMenus());
            }, { deep: true });

            const handleSearch = () => {
                router.get('/faqs', {
                    q: search.value,
                });
            }

            const selectedTag = ref("Semua");
            const tags = computed(() => {
            const set = new Set(
                (props.faqs?.data || [])
                    .map(b => b.category)
                    .filter(Boolean)
                );
                return ["Semua", ...set];
            });

            const filteredFaqs = computed(() => {
            if (selectedTag.value === "Semua") return props.faqs.data;
                return props.faqs.data.filter(b => {
                    if (!b.category) return false;
                    return b.category.toLowerCase().includes(selectedTag.value.toLowerCase());
                });
            });

            return {
                search,
                handleSearch,
                selectedTag,
                tags,
                filteredFaqs,
            }
        }
    };
</script>

<style scoped>

</style>
