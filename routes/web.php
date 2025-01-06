<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\CertificateController;
use App\Http\Controllers\admin\FooterController;
use App\Http\Controllers\admin\InfoController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\ProjectImageController;
use App\Http\Controllers\admin\SkillController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/projects', 'project');
    Route::get('/projects/{id}', 'project_detail');
    Route::get('/info', 'info');
    Route::get('/contact', 'contact');
});

// Admin routes
Route::controller(AdminAuthController::class)->group(function () {
    Route::get('/admin/login', 'showLoginForm')->name('admin.login.form');
    Route::post('/admin/login', 'login')->name('admin.logins');
    Route::post('/admin/logout', 'logout')->name('admin.logout');
});

// Secure admin routes protected by middleware
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/secure-page', [AdminAuthController::class, 'index'])->name('admin.securePage');
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/project/list', 'list');
        Route::get('/project/add', 'add');
        Route::post('/project/add', 'insert');
        Route::get('/project/edit/{id}', 'edit');
        Route::post('/project/edit/{id}', 'update');
        Route::delete('/project/{id}/delete', 'delete')->name('project.destroy');
    });
    Route::controller(ProjectImageController::class)->group(function () {
        Route::get('/project/{projectId}/upload', 'index');
        Route::post('/project/{projectId}/upload', 'store');
        Route::get('/project/{projectId}/delete', 'delete');
    });
    Route::controller(InfoController::class)->group(function () {
        Route::get('/info/list', 'list');
        Route::get('/info/add', 'add');
        Route::post('/info/add', 'insert');
        Route::get('/info/edit/{id}', 'edit');
        Route::post('/info/edit/{id}', 'update');
        Route::get('/info/destroy/{id}', 'destroy');
        Route::delete('/admin/info/{id}', 'destroy')->name('info.destroy');
    });
    Route::controller(SkillController::class)->group(function () {
        Route::get('/skill/list', 'list');
        Route::get('/skill/add', 'add');
        Route::post('/skill/add', 'insert');
        Route::get('/skill/edit/{id}', 'edit');
        Route::post('/skill/edit/{id}', 'update');
        Route::get('/skill/destroy/{id}', 'destroy');
        Route::delete('/admin/skill/{id}', 'destroy')->name('skill.destroy');
    });
    Route::controller(CertificateController::class)->group(function () {
        Route::get('/certificate/list', 'list');
        Route::get('/certificate/add', 'add');
        Route::post('/certificate/add', 'insert');
        Route::get('/certificate/edit/{id}', 'edit');
        Route::post('/certificate/edit/{id}', 'update');
        Route::get('/certificate/destroy/{id}', 'destroy');
        Route::delete('/admin/certificate/{id}', 'destroy')->name('certificate.destroy');
    });
    Route::controller(FooterController::class)->group(function () {
        Route::get('/footer/list', 'list');
        Route::get('/footer/add', 'add');
        Route::post('/footer/add', 'insert');
        Route::get('/footer/edit/{id}', 'edit');
        Route::post('/footer/edit/{id}', 'update');
        Route::get('/footer/destroy/{id}', 'destroy');
        Route::delete('/admin/footer/{id}', 'destroy')->name('footer.destroy');
    });
});
