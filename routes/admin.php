<?php

//admin Login, logout, forget password routes

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ContactFeedbackController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\Admin\LoginController;

Route::get('rt-admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('rt-admin/login', [LoginController::class, 'login']);
Route::post('rt-admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
//show the link request form to reset password
// Route::get('password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Send the link - it will use the notification from admin model
// Route::post('password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//receive the request from the send email
// Route::get('password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('password.reset');
//update password
// Route::post('password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('password.update');



Route::group(['middleware' => ['auth:admin', 'preventBackHistory']], function () {
    Route::group(['prefix' => 'rt-admin', 'as' => 'admin.'], function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        //change password
        Route::get('change-password', [AdminProfileController::class, 'changePasswordView'])->name('change.password');
        Route::post('change-password', [AdminProfileController::class, 'changePassword'])->name('change.password');

        // contact and feedback
        Route::get('contacts', [ContactFeedbackController::class, 'contacts'])->name('contacts');
        // Route::get('feedbacks', [ContactFeedbackController::class,'feedbacks'])->name('feedbacks');
        Route::get('contacts/{contactFeedback}', [ContactFeedbackController::class, 'show'])->name('contactFeedback.show');
        Route::delete('contact-feedback-delete/{contactFeedback}', [ContactFeedbackController::class, 'contactFeedbackDelete']);

        // Icon
        Route::get('rt-icons1', function () {
            return view('admin.others.icons1');
        });
        Route::get('rt-icons2', function () {
            return view('admin.others.icons2');
        });

        // Backups
        Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
        Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
        Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');

        //Resources Routes
        Route::resources(
            [
                'admins' => AdminController::class,
                'users' => UserController::class,
                'books' => BookController::class,
            ]
        );

        //Settings
        Route::resource('settings', SettingController::class)->only(['index', 'store', 'create']);
        Route::post('settings-updateAll', [SettingController::class, 'updateAll'])->name('settings.updateAll');
    });
});

