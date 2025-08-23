<template>
    <Head>
        <title>Blog − LetStudy</title>
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
                                Sudut Cerita LetStudy ✍️
                            </h1>
                            <p class="text-center text-gray-600 fs-2 fw-semibold mb-10">
                                Berbagi <span class="text-myprimary fw-bold">tulisan</span>, <span class="text-myprimary fw-bold">cerita</span>, dan <span class="text-myprimary fw-bold">wawasan</span> tentang belajar dan tumbuh bareng-bareng.
                            </p>
                            <form @submit.prevent="handleSearch"
                                class="d-flex align-items-center position-relative w-100 w-lg-75">
                                <i class="ri-search-line position-absolute ms-7 fs-3"></i>
                                <input type="text"
                                    class="form-control form-control-solid border border-gray-300 rounded-pill px-16 fs-5 h-50px"
                                    placeholder="Cari judul blog disini..." v-model="search" />
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
                <div id="blogs" class="container d-flex flex-column flex-center py-10 py-md-20">
                    <div class="text-center" v-if="blogs.data.length === 0">
                        <img src="/assets/media/illustrations/empty.png"
                            alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                        <h2 class="text-dark mb-4">Blog Tidak Ditemukan</h2>
                        <p class="text-gray-600 fs-4 mb-0">Belum ada blog atau pencarian tidak sesuai.</p>
                    </div>
                    <div class="d-flex flex-column gap-8 w-100" v-else>
                        <div v-for="(blog, index) in filteredBlogs" :key="index">
                            <a :href="`/blogs/${blog.slug}`" class="d-flex h-100 flex-row gap-8 text-start align-items-start" id="blog-card">
                                <div class="overflow-hidden position-relative rounded-4 mw-125px mw-md-200px
                                    ratio ratio-4x3 order-3 order-md-0 mt-9 mt-md-0 flex-shrink-0">
                                    <img :src="`/storage/${blog.image}`"
                                        class="img-blog img-fluid object-fit-cover h-md-100" alt="" />
                                </div>
                                <div class="d-flex flex-column justify-content-between gap-6 flex-grow-1 h-100">
                                    <div class="flex-grow-1">
                                        <p class="fw-semibold text-myprimary fs-5 mb-1 text-uppercase"
                                            style="letter-spacing: 0.06em;">
                                            {{ blog.sub_product?.title ?? 'General' }}
                                        </p>
                                        <p class="fw-bold text-dark fs-2 mb-2 text-truncate-2">
                                            {{ blog.title }}
                                        </p>
                                        <p class="text-gray-600 fs-5 mb-0 text-truncate-2">
                                            {{ stripTags(blog.content) }}
                                        </p>
                                    </div>
                                    <p class="text-gray-400 fs-6 mb-0 text-uppercase"
                                        style="letter-spacing: 0.04em;">{{ formatDate(blog.created_at) }}</p>
                                </div>
                            </a>
                        </div>
                        <Pagination :links="blogs.links" class="mt-8" align="center" />
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
            blogs: Object,
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

            watch(() => props.blogs, () => {
                nextTick(() => initMenus());
            }, { deep: true });

            const handleSearch = () => {
                router.get('/blogs', {
                    q: search.value,
                });
            }

            const selectedTag = ref("Semua");
            const tags = computed(() => {
            const set = new Set(
                (props.blogs?.data || [])
                    .map(b => b.sub_product?.title)
                    .filter(Boolean)
                );
                return ["Semua", ...set];
            });

            const filteredBlogs = computed(() => {
                if (selectedTag.value === "Semua") return props.blogs.data;
                return props.blogs.data.filter(
                    b => b.sub_product?.title === selectedTag.value
                );
            });

            const stripTags = (html) => {
                const div = document.createElement("div");
                div.innerHTML = html;
                return div.textContent || div.innerText || "";
            };

            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return new Intl.DateTimeFormat('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric',
                }).format(date);
            };

            return {
                search,
                handleSearch,
                stripTags,
                formatDate,
                selectedTag,
                tags,
                filteredBlogs,
            }
        }
    };
</script>