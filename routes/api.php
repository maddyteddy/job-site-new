<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Locations
    Route::apiResource('locations', 'LocationsApiController');

    // Companies
    Route::post('companies/media', 'CompaniesApiController@storeMedia')->name('companies.storeMedia');
    Route::apiResource('companies', 'CompaniesApiController');

    // Jobs
    Route::apiResource('jobs', 'JobsApiController');
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Manatal', 'middleware' => ['auth:api']], function () {
    // manatal jobs
    Route::apiResource('manataljobs', 'ManatalJobsApiController');
});
