<?php

use Illuminate\Support\Facades\Route;

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

Route::get('', function () {
    return view('pages.accounts.authentication.login');
})->name('login');

Route::get('account/password/reset/{token}', function ($token){
    return view('pages.accounts.authentication.reset_password',['token' => $token]);
})->name('account.password.reset');

Route::get('authentication/expire', function () {
    return redirect()->route('login')->withErrors('To keep your account secure we need to re-validate your account.');
})->name('authenticate.expire');

Route::group(['middleware' => 'secure'], function () {

    Route::get('/modular_types/{type}', function ($type) {
        return view('pages.modular_types.index', ['type' => $type]);
    })->where('type', 'client|project|task|ticket|document|field|status')->name('modular_type.dashboard');

    Route::get('/clients', function () {
        return view('pages.clients.index');
    })->name('client.dashboard');

    Route::get('/clients/groups', function () {
        return view('pages.clients.categories');
    })->name('client.types');

    Route::get('/departments', function () {
        return view('pages.departments.index');
    })->name('department.dashboard');

    Route::get('/projects', function () {
        return view('pages.projects.index');
    })->name('project.dashboard');

    Route::get('/services', function () {
        return view('pages.projects.categories');
    })->name('project.types');

    Route::get('/services/{id}/milestones', function ($id) {
        $businessService = new App\Http\Resources\ModularTypeResource(\App\Models\ModularType::find($id));
        return view('pages.milestones.index', ['businessService' => $businessService]);
    })->name('milestone.dashboard');

    Route::get('/milestone_tasks', function () {
        return view('pages.milestone_tasks.index');
    })->name('milestone_task.dashboard');

    Route::get('/project_milestones', function () {
        return view('pages.project_milestones.index');
    })->name('project_milestone.dashboard');

    Route::get('/tasks', function () {
        return view('pages.tasks.index');
    })->name('task.dashboard');

    Route::get('/milestone_task_assignees', function () {
        return view('pages.milestone_task_assignees.index');
    })->name('milestone_task_assignees.dashboard');

    Route::get('/task_assignees', function () {
        return view('pages.task_assignees.index');
    })->name('task_assignee.dashboard');

});


