<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse::class, \App\Http\Responses\SuccessfulPasswordResetLinkRequestResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\PasswordResetResponse::class, \App\Http\Responses\PasswordResetResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    Fortify::username() => __('Email atau kata sandi yang Anda masukkan salah.'),
                ]);
            }

            if ($user->role !== 'Admin') {
                throw ValidationException::withMessages([
                    Fortify::username() => __('Anda tidak memiliki izin untuk masuk sebagai admin.'),
                ]);
            }

            return $user;
        });

        //login
        Fortify::loginView(function () {
            return Inertia::render('Auth/Admin/Login');
        });

        //forgot
        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::render('Auth/ForgotPassword');
        });

        //reset
        Fortify::resetPasswordView(function ($request) {
            return Inertia::render('Auth/ResetPassword', [
                'request' => $request,
            ]);
        });
    }
}
