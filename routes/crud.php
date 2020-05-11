<?php


Route::group(['prefix' => 'modular_type', 'as' => 'modular_type.', 'namespace' => 'ModularTypes'], function () {

    Route::get('/{id}/show', 'FetchModularTypeController@fetch')->name('show');

    Route::get('/list/{type}', 'ListModularTypesController@list')->name('list');

    Route::post('/create/{type}', 'CreateModularTypeController@create')->name('create');

    Route::put('/update/{id}', 'UpdateModularTypeController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteModularTypeController@destroy')->name('delete');

});

Route::group(['prefix' => 'client', 'as' => 'client.', 'namespace' => 'Clients'], function () {

    Route::get('/{id}/show', 'FetchClientController@fetch')->name('show');

    Route::get('/list', 'ListClientsController@list')->name('list');

    Route::post('/create', 'CreateClientController@create')->name('create');

    Route::put('/update/{id}', 'UpdateClientController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteClientController@destroy')->name('delete');

});


Route::group(['prefix' => 'department', 'as' => 'department.', 'namespace' => 'Departments'], function () {

    Route::get('/{id}/show', 'FetchDepartmentController@fetch')->name('show');

    Route::get('/list', 'ListDepartmentsController@list')->name('list');

    Route::post('/create', 'CreateDepartmentController@create')->name('create');

    Route::put('/update/{id}', 'UpdateDepartmentController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteDepartmentController@destroy')->name('delete');

});

Route::group(['prefix' => 'project', 'as' => 'project.', 'namespace' => 'Projects'], function () {

    Route::get('/{id}/show', 'FetchProjectController@fetch')->name('show');

    Route::get('/list', 'ListProjectsController@list')->name('list');

    Route::post('/create', 'CreateProjectController@create')->name('create');

    Route::put('/update/{id}', 'UpdateProjectController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteProjectController@destroy')->name('delete');

});

Route::group(['prefix' => 'milestone', 'as' => 'milestone.', 'namespace' => 'Milestones'], function () {

    Route::get('/{id}/show', 'FetchMilestoneController@fetch')->name('show');

    Route::get('/list/{service_id}', 'ListMilestonesController@list')->name('list');

    Route::post('/create', 'CreateMilestoneController@create')->name('create');

    Route::put('/update/{id}', 'UpdateMilestoneController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteMilestoneController@destroy')->name('delete');

});

Route::group(['prefix' => 'milestone_task', 'as' => 'milestone_task.', 'namespace' => 'MilestoneTasks'], function () {

    Route::get('/{id}/show', 'FetchMilestoneTaskController@fetch')->name('show');

    Route::get('/list/{milestone_id}', 'ListMilestoneTasksController@list')->name('list');

    Route::post('/create', 'CreateMilestoneTaskController@create')->name('create');

    Route::put('/update/{id}', 'UpdateMilestoneTaskController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteMilestoneTaskController@destroy')->name('delete');

});

Route::group(['prefix' => 'project_milestone', 'as' => 'project_milestone.', 'namespace' => 'ProjectMilestones'], function () {

    Route::get('/{id}/show', 'FetchProjectMilestoneController@fetch')->name('show');

    Route::get('/list', 'ListProjectMilestonesController@list')->name('list');

    Route::post('/create', 'CreateProjectMilestoneController@create')->name('create');

    Route::put('/update/{id}', 'UpdateProjectMilestoneController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteProjectMilestoneController@destroy')->name('delete');

});

Route::group(['prefix' => 'task', 'as' => 'task.', 'namespace' => 'Tasks'], function () {

    Route::get('/{id}/show', 'FetchTaskController@fetch')->name('show');

    Route::get('/list', 'ListTasksController@list')->name('list');

    Route::post('/create', 'CreateTaskController@create')->name('create');

    Route::put('/update/{id}', 'UpdateTaskController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteTaskController@destroy')->name('delete');

});

Route::group(['prefix' => 'milestone_task_assignee', 'as' => 'milestone_task_assignee.', 'namespace' => 'MilestoneTaskAssignees'], function () {

    Route::get('/{id}/show', 'FetchMilestoneTaskAssigneeController@fetch')->name('show');

    Route::get('/list', 'ListMilestoneTaskAssigneesController@list')->name('list');

    Route::post('/create', 'CreateMilestoneTaskAssigneeController@create')->name('create');

    Route::put('/update/{id}', 'UpdateMilestoneTaskAssigneeController@update')->name('update');

    Route::delete('/delete', 'DeleteMilestoneTaskAssigneeController@destroy')->name('delete');

});

Route::group(['prefix' => 'task_assignee', 'as' => 'task_assignee.', 'namespace' => 'TaskAssignees'], function () {

    Route::get('/{id}/show', 'FetchTaskAssigneeController@fetch')->name('show');

    Route::get('/list', 'ListTaskAssigneesController@list')->name('list');

    Route::post('/create', 'CreateTaskAssigneeController@create')->name('create');

    Route::put('/update/{id}', 'UpdateTaskAssigneeController@update')->name('update');

    Route::delete('/delete/{id}', 'DeleteTaskAssigneeController@destroy')->name('delete');

});