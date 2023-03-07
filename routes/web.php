<?php
Route::redirect('/', '/admin');

Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

//Route::get('/', 'HomeController@index')->name('home');
Route::get('search', 'HomeController@search')->name('search');
Route::resource('jobs', 'JobController')->only(['index', 'show']);
Route::get('category/{category}', 'CategoryController@show')->name('categories.show');
Route::get('location/{location}', 'LocationController@show')->name('locations.show');

Route::get('manataljobs', 'Api\V1\Manatal\ManatalJobsApiController@fetch')->name('manataljobs');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Locations
    Route::delete('locations/destroy', 'LocationsController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationsController');

    // Companies
    Route::delete('companies/destroy', 'CompaniesController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompaniesController@storeMedia')->name('companies.storeMedia');
    Route::resource('companies', 'CompaniesController');

    // Jobs
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');
    Route::resource('jobs', 'JobsController');
    Route::post('jobs/candidates', 'JobsController@storeCandidates')->name('jobs.candidates');

    // MyJobs
    Route::resource('myjobs', 'MyJobsController');
    Route::delete('myjobs/destroy', 'MyJobsController@massDestroy')->name('myjobs.massDestroy');
    Route::get('myjobs/candidates/{id}', 'MyJobsController@viewCandidate')->name('myjobs.viewCandidate');

    // Vendors
    Route::delete('vendors/destroy', 'VendorsController@massDestroy')->name('vendors.massDestroy');
    Route::post('vendors/media', 'VendorsController@storeMedia')->name('vendors.storeMedia');
    Route::resource('vendors', 'VendorsController');
});
