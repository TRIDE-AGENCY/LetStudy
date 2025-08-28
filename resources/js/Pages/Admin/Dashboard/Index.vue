<template>

    <Head>
        <title>Dashboard − LetStudy</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0 mb-2">
                            Dashboard Admin
                        </h1>
                        <p class="fs-4 text-gray-600 m-0">Selamat datang {{ $page . props . auth . user . name }}</p>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="row g-4 g-md-6 mb-6">
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                    <div class="p-6 bg-myprimary rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-team-fill text-white fs-3qx fs-md-2qx"></i>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Member</p>
                                        <h1 class="fs-3qx fs-md-2qx mb-0">{{ users.length }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                    <div class="p-6 bg-mysecondary rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-book-open-fill text-mysecondary fs-3qx fs-md-2qx"></i>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">E-Book</p>
                                        <h1 class="fs-3qx fs-md-2qx mb-0">{{ totals.ebooks }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                    <div class="p-6 bg-mywarning-light rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-survey-fill text-mywarning fs-3qx fs-md-2qx"></i>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Tryout</p>
                                        <h1 class="fs-3qx fs-md-2qx mb-0">{{ totals.tryouts }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-body d-flex flex-grow align-items-center gap-5 p-6">
                                    <div class="p-6 bg-mydanger-light rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-folder-video-fill text-mydanger fs-3qx fs-md-2qx"></i>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <p class="fs-5 fw-semibold text-gray-600 mb-2 text-truncate-1 white-space-nowrap">Playlist</p>
                                        <h1 class="fs-3qx fs-md-2qx mb-0">{{ totals.playlists }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-4 border border-gray-300 mb-6">
                        <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                            <h3 class="mb-0">Grafik Distribusi Konten</h3>
                        </div>
                        <div class="card-body p-6 h-400px">
                            <canvas ref="contentChartRef"></canvas>
                        </div>
                    </div>
                    <div class="row g-6 justify-content-center">
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                    <h3 class="mb-0">Data Tutor</h3>
                                </div>
                                <div class="card-body p-6 h-auto d-flex justify-content-center">
                                    <canvas ref="tutorChartRef" ></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                    <h3 class="mb-0">Data Testimoni</h3>
                                </div>
                                <div class="card-body p-6 h-auto d-flex justify-content-center">
                                    <canvas ref="testimonialChartRef" ></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                    <h3 class="mb-0">Data Blog</h3>
                                </div>
                                <div class="card-body p-6 h-auto d-flex justify-content-center">
                                    <canvas ref="blogChartRef" ></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import { Head } from '@inertiajs/vue3';
    import { Chart, registerables } from 'chart.js';
    import { onMounted, ref, computed } from 'vue';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
        },

        props: {
            menuProducts: Array,
            subProducts: Array,
            users: Object,
            tutors: Object,
            blogs: Object,
        },

        setup(props) {
            Chart.register(...registerables);

            const contentChartRef = ref(null);
            const testimonialChartRef = ref(null);
            const tutorChartRef = ref(null);
            const blogChartRef = ref(null);

            onMounted(() => {
                if (contentChartRef.value) {
                    new Chart(contentChartRef.value, {
                        type: 'bar',
                        data: {
                            labels: props.subProducts.map(sp => sp.title),
                            datasets: [
                                {
                                    label: 'E-Book',
                                    data: props.subProducts.map(sp => sp.ebooks_count),
                                    backgroundColor: '#60A5FA'
                                },
                                {
                                    label: 'Tryout',
                                    data: props.subProducts.map(sp => sp.tryouts_count),
                                    backgroundColor: '#fbbf24'
                                },
                                {
                                    label: 'Playlist',
                                    data: props.subProducts.map(sp => sp.playlists_count),
                                    backgroundColor: '#f87171'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                };

                if (testimonialChartRef.value) {
                    new Chart(testimonialChartRef.value, {
                        type: 'doughnut',
                        data: {
                            labels: props.menuProducts.map(p => p.title),
                            datasets: [
                            {
                                data: props.menuProducts.map(p => p.testimonials_count),
                                backgroundColor: ['#60A5FA', '#fbbf24', '#f87171']
                            }
                            ]
                        },
                        options: {
                            responsive: true,
                            cutout: '50%',
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                };

                if (blogChartRef.value) {
                    const blogLabels = Object.keys(props.blogs);
                    const blogData = blogLabels.map(label => props.blogs[label].length); 

                    new Chart(blogChartRef.value, {
                        type: 'doughnut',
                        data: {
                            labels: blogLabels,
                            datasets: [{
                                data: blogData,
                                backgroundColor: ['#b5b5c3', '#60A5FA', '#fbbf24', '#f87171'],
                            }]
                        },
                        options: {
                            responsive: true,
                            cutout: '50%',
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                            },
                        }
                    });
                };

                if (tutorChartRef.value) {
                    const tutorLabels = Object.keys(props.tutors);
                    const tutorData = tutorLabels.map(label => props.tutors[label].length); 

                    new Chart(tutorChartRef.value, {
                        type: 'doughnut',
                        data: {
                            labels: tutorLabels,
                            datasets: [{
                                data: tutorData,
                                backgroundColor: ['#60A5FA', '#fbbf24', '#f87171'],
                            }]
                        },
                        options: {
                            responsive: true,
                            cutout: '50%',
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                            },
                        }
                    });
                }
            });

            const totals = computed(() => {
                const list = props.subProducts ?? [];
                return {
                    ebooks:    list.reduce((sum, sp) => sum + (sp.ebooks_count    ?? 0), 0),
                    tryouts:   list.reduce((sum, sp) => sum + (sp.tryouts_count   ?? 0), 0),
                    playlists: list.reduce((sum, sp) => sum + (sp.playlists_count ?? 0), 0),
                };
            });

            return {
                contentChartRef,
                testimonialChartRef,
                tutorChartRef,
                blogChartRef,
                totals
            };
        }
    };
</script>
