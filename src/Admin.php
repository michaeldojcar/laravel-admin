<?php


namespace MichaelDojcar\LaravelAdmin;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use MichaelDojcar\LaravelAdmin\Http\Controllers\Auth\ConfirmPasswordController;
use MichaelDojcar\LaravelAdmin\Http\Controllers\Auth\ForgotPasswordController;
use MichaelDojcar\LaravelAdmin\Http\Controllers\Auth\LoginController;
use MichaelDojcar\LaravelAdmin\Http\Controllers\Auth\RegisterController;
use MichaelDojcar\LaravelAdmin\Http\Controllers\Auth\ResetPasswordController;
use MichaelDojcar\LaravelAdmin\Http\Controllers\Auth\VerificationController;

class Admin
{
    /**
     * Load default auth and admin routes.
     *
     * @param array $options
     */
    public function routes(array $options = [])
    {
        $this->authRoutes($options);

        require __DIR__ . '/../routes/web.php';
    }

    public function authRoutes(array $options = [])
    {
        // Login Routes...
        if ($options['login'] ?? true) {
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
            Route::post('login', [LoginController::class, 'login']);
        }

        // Logout Routes...
        if ($options['logout'] ?? true) {
            Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        }

        // Registration Routes...
        if ($options['register'] ?? true) {
            Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
            Route::post('register', [RegisterController::class, 'register']);
        }

        // Password Reset Routes...
        if ($options['reset'] ?? true) {
            $this->resetPassword();
        }

        // Password Confirmation Routes...
        if ($options['confirm'] ?? true) {
            $this->confirmPassword();
        }

        // Email Verification Routes...
        if ($options['verify'] ?? false) {
            $this->emailVerification();
        }
    }

    /**
     * Register the typical reset password routes for an application.
     *
     * @return callable
     */
    public function resetPassword()
    {
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    }

    /**
     * Register the typical confirm password routes for an application.
     *
     * @return callable
     */
    public function confirmPassword()
    {
        Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
        Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
    }

    /**
     * Register the typical email verification routes for an application.
     *
     * @return callable
     */
    public function emailVerification()
    {
        Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    }
}