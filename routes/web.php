<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [\App\Http\Controllers\User\UserController::class, 'userRegister'])->name('user.register.index');
    Route::post('/register', [\App\Http\Controllers\User\UserController::class, 'userRegisterStore'])->name('user.register.store');
    Route::get('/login', [\App\Http\Controllers\User\UserController::class, 'userLogin'])->name('user.login.index');
    Route::post('/login', [\App\Http\Controllers\User\UserController::class, 'userLoginStore'])->name('user.login.store');
});

Route::prefix('member-area')->name('member.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\User\MemberController::class, 'index'])->name('home');
    Route::prefix('/{product:slug}/{subProduct:slug}')->group(function () {
        Route::get('/ebooks', [App\Http\Controllers\User\Member\EbookController::class, 'ebooks'])->name('ebooks.index');
        Route::get('/ebooks/{ebook:slug}', [App\Http\Controllers\User\Member\EbookController::class, 'ebookShow'])->name('ebooks.show');
        Route::get('/tryouts', [App\Http\Controllers\User\Member\TryoutController::class, 'tryouts'])->name('tryouts.index');
        Route::post('/tryout-join', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutJoin'])->name('tryouts.join');
        Route::get('/tryout-start/{id}', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutStart'])->name('tryouts.start');
        Route::get('/tryout/{id}/{page}', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutShow'])->name('tryouts.show');
        Route::post('/tryout-answer', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutAnswer'])->name('tryouts.answer');
        Route::post('/tryout-clear', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutClear'])->name('tryouts.clear');
        Route::post('/tryout-flag', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutFlag'])->name('tryouts.flag');
        Route::post('/tryout-end', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutEnd'])->name('tryouts.end');
        Route::get('/tryout-result/{tryout_group_id}', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutResult'])->name('tryouts.result');
        Route::get('/tryout/{tryout_group_id}/review/{page}', [App\Http\Controllers\User\Member\TryoutController::class, 'tryoutReview'])->name('tryouts.review');
        Route::get('/playlists', [App\Http\Controllers\User\Member\PlaylistController::class, 'playlists'])->name('playlists.index');
        Route::get('/playlists/{playlist:id_playlist}', [App\Http\Controllers\User\Member\PlaylistController::class, 'playlistShow'])->name('playlists.show');
        Route::get('/playlists/{playlist:id_playlist}/videos/{playlistVideo:id_video}', [App\Http\Controllers\User\Member\PlaylistController::class, 'playlistShowVideo'])->name('playlists.videos.show');
    });
    Route::get('/user', [App\Http\Controllers\User\UserController::class, 'userDetail'])->name('user');
    Route::put('/user/{user}', [App\Http\Controllers\User\UserController::class, 'userDetailUpdate'])->name('user.update');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');
    Route::prefix('/pages')->name('admin.pages.')->group(function () {
        Route::get('/letstudy', [\App\Http\Controllers\Admin\PagesController::class, 'letStudy'])->name('letstudy.index');
        Route::prefix('/letstudy')->name('letstudy.')->group(function () {
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\BannerController::class)->group(function () {
                Route::get('/banners', 'banners')->name('banners.index');
                Route::post('/banners', 'bannerStore')->name('banners.store');
                Route::put('/banners/{banner}', 'bannerUpdate')->name('banners.update');
                Route::delete('/banners/{banner}', 'bannerDestroy')->name('banners.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\UspController::class)->group(function () {
                Route::get('/usps', 'usps')->name('usps.index');
                Route::post('/usps', 'uspStore')->name('usps.store');
                Route::put('/usps/{usp}', 'uspUpdate')->name('usps.update');
                Route::delete('/usps/{usp}', 'uspDestroy')->name('usps.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\ReportController::class)->group(function () {
                Route::get('/report', 'report')->name('report.index');
                Route::put('/report/{report}', 'reportUpdate')->name('report.update');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\AchievementController::class)->group(function () {
                Route::get('/achievements', 'achievements')->name('achievements.index');
                Route::post('/achievements', 'achievementStore')->name('achievements.store');
                Route::put('/achievements/{achievement}', 'achievementUpdate')->name('achievements.update');
                Route::delete('/achievements/{achievement}', 'achievementDestroy')->name('achievements.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\ProductController::class)->group(function () {
                Route::get('/products', 'products')->name('products.index');
                Route::post('/products', 'productStore')->name('products.store');
                Route::put('/products/{product}', 'productUpdate')->name('products.update');
                Route::delete('/products/{product}', 'productDestroy')->name('products.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\TestimonialController::class)->group(function () {
                Route::get('/testimonials', 'testimonials')->name('testimonials.index');
                Route::post('/testimonials', 'testimonialStore')->name('testimonials.store');
                Route::put('/testimonials/{testimonial}', 'testimonialUpdate')->name('testimonials.update');
                Route::delete('/testimonials/{testimonial}', 'testimonialDestroy')->name('testimonials.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\TutorController::class)->group(function () {
                Route::get('/tutors', 'tutors')->name('tutors.index');
                Route::get('/tutors/create', 'tutorCreate')->name('tutors.create');
                Route::post('/tutors', 'tutorStore')->name('tutors.store');
                Route::get('/tutors/{tutor}/edit', 'tutorEdit')->name('tutors.edit');
                Route::put('/tutors/{tutor}', 'tutorUpdate')->name('tutors.update');
                Route::delete('/tutors/{tutor}', 'tutorDestroy')->name('tutors.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\QuoteController::class)->group(function () {
                Route::get('/quote', 'quote')->name('quote.index');
                Route::put('/quote/{quote}', 'quoteUpdate')->name('quote.update');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\PartnerController::class)->group(function () {
                Route::get('/partners', 'partners')->name('partners.index');
                Route::post('/partners', 'partnerStore')->name('partners.store');
                Route::put('/partners/{partner}', 'partnerUpdate')->name('partners.update');
                Route::delete('/partners/{partner}', 'partnerDestroy')->name('partners.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\SupportController::class)->group(function () {
                Route::get('/supports', 'supports')->name('supports.index');
                Route::post('/supports', 'supportStore')->name('supports.store');
                Route::put('/supports/{support}', 'supportUpdate')->name('supports.update');
                Route::delete('/supports/{support}', 'supportDestroy')->name('supports.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\BlogController::class)->group(function () {
                Route::get('/blogs', 'blogs')->name('blogs.index');
                Route::get('/blogs/create', 'blogCreate')->name('blogs.create');
                Route::post('/blogs', 'blogStore')->name('blogs.store');
                Route::get('/blogs/{blog}/edit', 'blogEdit')->name('blogs.edit');
                Route::put('/blogs/{blog}', 'blogUpdate')->name('blogs.update');
                Route::delete('/blogs/{blog}', 'blogDestroy')->name('blogs.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\FaqController::class)->group(function () {
                Route::get('/faqs', 'faqs')->name('faqs.index');
                Route::get('/faqs/create', 'faqCreate')->name('faqs.create');
                Route::post('/faqs', 'faqStore')->name('faqs.store');
                Route::get('/faqs/{faq}/edit', 'faqEdit')->name('faqs.edit');
                Route::put('/faqs/{faq}', 'faqUpdate')->name('faqs.update');
                Route::delete('/faqs/{faq}', 'faqDestroy')->name('faqs.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\DonateController::class)->group(function () {
                Route::get('/donate', 'donate')->name('donate.index');
                Route::put('/donate/{donate}', 'donateUpdate')->name('donate.update');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\LetStudy\SosmedController::class)->group(function () {
                Route::get('/social-media', 'sosmed')->name('sosmed.index');
                Route::put('/social-media/{sosmed}', 'sosmedUpdate')->name('sosmed.update');
            });
        });
        Route::get('/products/{product:slug}', [\App\Http\Controllers\Admin\PagesController::class, 'products'])->name('products.index');
        Route::prefix('/products/{product:slug}')->name('products.')->group(function () {
            Route::controller(App\Http\Controllers\Admin\Pages\Product\BannerController::class)->group(function () {
                Route::get('/banner', 'banner')->name('banner.index');
                Route::put('/banner/{banner}', 'bannerUpdate')->name('banner.update');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\Product\SubProductController::class)->group(function () {
                Route::get('/sub-products', 'subProducts')->name('subproducts.index');
                Route::post('/sub-products', 'subProductStore')->name('subproducts.store');
                Route::put('/sub-products/{subProduct}', 'subProductUpdate')->name('subproducts.update');
                Route::delete('/sub-products/{subProduct}', 'subProductDestroy')->name('subproducts.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\Product\TestimonialController::class)->group(function () {
                Route::get('/testimonials', 'testimonials')->name('testimonials.index');
                Route::post('/testimonials', 'testimonialStore')->name('testimonials.store');
                Route::put('/testimonials/{testimonial}', 'testimonialUpdate')->name('testimonials.update');
                Route::delete('/testimonials/{testimonial}', 'testimonialDestroy')->name('testimonials.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\Product\TutorController::class)->group(function () {
                Route::get('/tutors', 'tutors')->name('tutors.index');
                Route::get('/tutors/create', 'tutorCreate')->name('tutors.create');
                Route::post('/tutors', 'tutorStore')->name('tutors.store');
                Route::get('/tutors/{tutor}/edit', 'tutorEdit')->name('tutors.edit');
                Route::put('/tutors/{tutor}', 'tutorUpdate')->name('tutors.update');
                Route::delete('/tutors/{tutor}', 'tutorDestroy')->name('tutors.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\Product\QuoteController::class)->group(function () {
                Route::get('/quote', 'quote')->name('quote.index');
                Route::put('/quote/{quote}', 'quoteUpdate')->name('quote.update');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\Product\BlogController::class)->group(function () {
                Route::get('/blogs', 'blogs')->name('blogs.index');
                Route::get('/blogs/create', 'blogCreate')->name('blogs.create');
                Route::post('/blogs', 'blogStore')->name('blogs.store');
                Route::get('/blogs/{blog}/edit', 'blogEdit')->name('blogs.edit');
                Route::put('/blogs/{blog}', 'blogUpdate')->name('blogs.update');
                Route::delete('/blogs/{blog}', 'blogDestroy')->name('blogs.destroy');
            });
            Route::controller(App\Http\Controllers\Admin\Pages\Product\SosmedController::class)->group(function () {
                Route::get('/social-media', 'sosmed')->name('sosmed.index');
                Route::put('/social-media/{sosmed}', 'sosmedUpdate')->name('sosmed.update');
            });
        });
        Route::prefix('/legal')->name('legal.')->group(function () {
            Route::controller(App\Http\Controllers\Admin\PagesController::class)->group(function () {
                Route::get('/terms-and-condition', 'legalTerms')->name('terms.index');
                Route::put('/terms-and-condition/{legal}', 'legalTermsUpdate')->name('terms.update');

                Route::get('/privacy-policy', 'legalPrivacy')->name('privacy.index');
                Route::put('/privacy-policy/{legal}', 'legalPrivacyUpdate')->name('privacy.update');
            });
        });
    });
    Route::prefix('/master')->name('admin.masters.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Master\EducationController::class)->group(function () {
            Route::get('/educations', 'educations')->name('educations.index');
            Route::post('/educations', 'educationStore')->name('educations.store');
            Route::put('/educations/{education}', 'educationUpdate')->name('educations.update');
            Route::delete('/educations/{education}', 'educationDestroy')->name('educations.destroy');
        });
    });
    Route::prefix('/management')->name('admin.managements.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Management\UserController::class)->group(function () {
            Route::get('/user', 'user')->name('user.index');
            Route::post('/user', 'userStore')->name('user.store');
            Route::put('/user/{user}', 'userUpdate')->name('user.update');
            Route::delete('/user/{user}', 'userDestroy')->name('user.destroy');
        });
        Route::controller(App\Http\Controllers\Admin\Management\AdminController::class)->group(function () {
            Route::get('/admin', 'admin')->name('admin.index');
            Route::post('/admin', 'adminStore')->name('admin.store');
            Route::put('/admin/{admin}', 'adminUpdate')->name('admin.update');
            Route::delete('/admin/{admin}', 'adminDestroy')->name('admin.destroy');
        });
    });

    Route::get('/messages', [App\Http\Controllers\Admin\MessageController::class, 'messages'])->name('admin.messages.index');
    Route::put('/messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'messageUpdate'])->name('admin.messages.update');
    Route::delete('/messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'messageDestroy'])->name('admin.messages.destroy');

    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'userDetail'])->name('admin.user');
    Route::put('/user/{user}', [App\Http\Controllers\Admin\UserController::class, 'userDetailUpdate'])->name('admin.user.update');

    Route::get('/teams', [App\Http\Controllers\Admin\TeamController::class, 'teams'])->name('admin.teams.index');
    Route::post('/teams', [App\Http\Controllers\Admin\TeamController::class, 'teamStore'])->name('admin.teams.store');
    Route::put('/teams/{team}', [App\Http\Controllers\Admin\TeamController::class, 'teamUpdate'])->name('admin.teams.update');
    Route::delete('/teams/{team}', [App\Http\Controllers\Admin\TeamController::class, 'teamDestroy'])->name('admin.teams.destroy');

    Route::prefix('/{product:slug}/{subProduct:slug}/ebooks')->name('admin.members.ebooks.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Member\EbookController::class)->group(function () {
            Route::get('/', 'ebooks')->name('index');
            Route::get('/create', 'ebookCreate')->name('create');
            Route::post('/', 'ebookStore')->name('store');
            Route::get('/{ebook:slug}', 'ebookShow')->name('show');
            Route::get('/{ebook:slug}/edit', 'ebookEdit')->name('edit');
            Route::put('/{ebook:slug}', 'ebookUpdate')->name('update');
            Route::delete('/{ebook:slug}', 'ebookDestroy')->name('destroy');
            Route::get('/{ebook:slug}/read', 'ebookRead')->name('read');
        });
    });

    Route::prefix('/{product:slug}/{subProduct:slug}/tryouts')->name('admin.members.tryouts.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Member\TryoutController::class)->group(function () {
            Route::get('/', 'tryouts')->name('index');
            Route::get('/create', 'tryoutCreate')->name('create');
            Route::post('/', 'tryoutStore')->name('store');
            Route::get('/{tryout:slug}', 'tryoutShow')->name('show');
            Route::get('/{tryout:slug}/edit', 'tryoutEdit')->name('edit');
            Route::put('/{tryout:slug}', 'tryoutUpdate')->name('update');
            Route::delete('/{tryout:slug}', 'tryoutDestroy')->name('destroy');
            Route::get('/{tryout:slug}/questions/create', 'tryoutCreateQuestion')->name('questions.create');
            Route::post('/{tryout:slug}/questions', 'tryoutStoreQuestion')->name('questions.store');
            Route::get('/{tryout:slug}/questions/{question}/edit', 'tryoutEditQuestion')->name('questions.edit');
            Route::put('/{tryout:slug}/questions/{question}', 'tryoutUpdateQuestion')->name('questions.update');
            Route::delete('/{tryout:slug}/questions/{question}', 'tryoutDestroyQuestion')->name('questions.destroy');
        });
    });

    Route::prefix('/{product:slug}/{subProduct:slug}/playlists')->name('admin.members.playlists.')->group(function () {
        Route::controller(App\Http\Controllers\Admin\Member\PlaylistController::class)->group(function () {
            Route::get('/', 'playlists')->name('index');
            Route::get('/create', 'playlistCreate')->name('create');
            Route::post('/', 'playlistStore')->name('store');
            Route::get('/{playlist:id_playlist}', 'playlistShow')->name('show');
            Route::get('/{playlist:id_playlist}/edit', 'playlistEdit')->name('edit');
            Route::put('/{playlist:id_playlist}', 'playlistUpdate')->name('update');
            Route::delete('/{playlist:id_playlist}', 'playlistDestroy')->name('destroy');
            Route::get('/{playlist:id_playlist}/videos/create', 'playlistCreateVideo')->name('videos.create');
            Route::post('/{playlist:id_playlist}/videos', 'playlistStoreVideo')->name('videos.store');
            Route::get('/{playlist:id_playlist}/videos/{playlistVideo:id_video}', 'playlistShowVideo')->name('videos.show');
            Route::get('/{playlist:id_playlist}/videos/{playlistVideo:id_video}/edit', 'playlistEditVideo')->name('videos.edit');
            Route::put('/{playlist:id_playlist}/videos/{playlistVideo:id_video}', 'playlistUpdateVideo')->name('videos.update');
            Route::delete('/{playlist:id_playlist}/videos/{playlistVideo:id_video}', 'playlistDestroyVideo')->name('videos.destroy');
        });
    });

    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class, ['as' => 'admin']);
});

Route::get('/', \App\Http\Controllers\User\HomeController::class)->name('user.home');
Route::get('/blogs', [\App\Http\Controllers\User\HomeController::class, 'blogs'])->name('user.blog');
Route::get('/blogs/{blog:slug}', [\App\Http\Controllers\User\HomeController::class, 'blogShow'])->name('user.blog.show');
Route::get('/faqs', [\App\Http\Controllers\User\HomeController::class, 'faqs'])->name('user.faq');
Route::get('/our-team', [\App\Http\Controllers\User\HomeController::class, 'teams'])->name('user.team');
Route::get('/contact-us', [\App\Http\Controllers\User\HomeController::class, 'contact'])->name('user.contact');
Route::post('/contact-us', [\App\Http\Controllers\User\HomeController::class, 'contactStore'])->name('user.contact.store');
Route::get('/terms-and-condition', [\App\Http\Controllers\User\HomeController::class, 'terms'])->name('user.terms');
Route::get('/privacy-policy', [\App\Http\Controllers\User\HomeController::class, 'privacy'])->name('user.privacy');
Route::get('/{product:slug}', [\App\Http\Controllers\User\HomeController::class, 'products'])->name('user.product');
