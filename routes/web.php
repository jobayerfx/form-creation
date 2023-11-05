<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Form\FormController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Form\ResponseController;
use App\Http\Controllers\Form\FieldController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Form\FormAvailabilityController;
use App\Http\Controllers\Form\CollaboratorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'forms')->name('home');

Route::get('forms/{form}/view', [FormController::class, 'viewForm'])->name('forms.view');
Route::post('forms/{form}/responses', [ResponseController::class, 'store'])->name('forms.responses.store');


// Authentication Routes...

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    //Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'verified'])->group(function () {
    //Form Routes
    Route::get('forms', [FormController::class, 'index'])->name('forms.index');
    Route::get('forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::post('forms', [FormController::class, 'store'])->name('forms.store');
    Route::get('forms/{form}', [FormController::class, 'show'])->name('forms.show');
    Route::get('forms/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');
    Route::put('forms/{form}', [FormController::class, 'update'])->name('forms.update');
    Route::delete('forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');

    Route::post('forms/{form}/draft', [FormController::class, 'draftForm'])->name('forms.draft');
    Route::get('forms/{form}/preview', [FormController::class, 'previewForm'])->name('forms.preview');
    Route::post('forms/{form}/open', [FormController::class, 'openFormForResponse'])->name('forms.open');
    Route::post('forms/{form}/close', [FormController::class, 'closeFormToResponse'])->name('forms.close');

    Route::post('forms/{form}/share-via-email', [FormController::class, 'shareViaEmail'])->name('form.share.email');
    Route::post('forms/{form}/form-availability', [FormAvailabilityController::class, 'save'])->name('form.availability.save');
    Route::delete('forms/{form}/form-availability/reset', [FormAvailabilityController::class, 'reset'])->name('form.availability.reset');

    //Form Field Routes
    Route::post('forms/{form}/fields/add', [FieldController::class, 'store'])->name('forms.fields.store');
    Route::post('forms/{form}/fields/delete', [FieldController::class, 'destroy'])->name('forms.fields.destroy');

    //Form Response Routes
    Route::get('forms/{form}/responses', [ResponseController::class, 'index'])->name('forms.responses.index');
    Route::delete('forms/{form}/responses', [ResponseController::class, 'destroyAll'])->name('forms.responses.destroy.all');
    Route::delete('forms/{form}/responses/{response}', [ResponseController::class, 'destroy'])->name('forms.responses.destroy.single');

    //Form Collaborator Routes
    Route::post('forms/{form}/collaborators', [CollaboratorController::class, 'store'])->name('form.collaborators.store');
    Route::delete('forms/{form}/collaborators/{collaborator}', [CollaboratorController::class, 'destroy'])->name('form.collaborator.destroy');
});
