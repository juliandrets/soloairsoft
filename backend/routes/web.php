<?php

    Route::get('adm', 'AdminPanelController@index')->middleware('auth', 'role:admin');

    // Users
    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::get('user/validate/validateemail', 'UserController@validarUserBD');

    // Products
    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
	Route::get('adm/products/{id}/edit', 'ProductController@edit')->middleware('auth', 'role:admin');
	Route::post('adm/products/{id}/update', 'ProductController@update')->middleware('auth', 'role:admin');
	Route::get('adm/products/{id}/delete', 'ProductController@destroy')->middleware('auth', 'role:admin');
	Route::get('products/{id}', 'ProductController@show');

	// cupones
	Route::resource('adm/coupons', 'CouponController')->middleware('auth', 'role:admin');
	Route::get('adm/coupons/{id}/edit', 'CouponController@edit')->middleware('auth', 'role:admin');
	Route::get('adm/coupons/{id}/delete', 'CouponController@destroy')->middleware('auth', 'role:admin');
	Route::post('adm/coupons/{id}/update', 'CouponController@update')->middleware('auth', 'role:admin');
	Route::post('cart/coupon/apply', 'CouponController@applyCoupon');

	// sliders
	Route::resource('adm/sliders', 'SliderController')->middleware('auth', 'role:admin');
	Route::get('adm/sliders/{id}/edit', 'SliderController@edit')->middleware('auth', 'role:admin');
	Route::get('adm/sliders/{id}/delete', 'SliderController@destroy')->middleware('auth', 'role:admin');
	Route::post('adm/sliders/{id}/update', 'SliderController@update')->middleware('auth', 'role:admin');
	Route::post('cart/sliders/apply', 'SliderController@applyCoupon');

	// Caterogies
	Route::resource('adm/categories', 'CategoryController');
	Route::get('adm/categories/{id}/delete', 'CategoryController@destroy')->middleware('auth', 'role:admin');
	Route::get('adm/categories/{id}/edit', 'CategoryController@edit')->middleware('auth', 'role:admin');
	Route::post('adm/categories/{id}/update', 'CategoryController@update')->middleware('auth', 'role:admin');	
	Route::get('category/{name}', 'CategoryController@show');	
	Route::post('category/{name}/filter/price', 'CategoryController@showWithFilterPrice');	

	// SubCaterogies
	Route::resource('adm/subcategories', 'SubcategoryController');
	Route::get('adm/subcategories/{id}/delete', 'SubcategoryController@destroy')->middleware('auth', 'role:admin');
	Route::get('adm/subcategories/{id}/edit', 'SubcategoryController@edit')->middleware('auth', 'role:admin');
	Route::post('adm/subcategories/{id}/update', 'SubcategoryController@update')->middleware('auth', 'role:admin');

	// marcas
	Route::resource('adm/brands', 'BrandController');
	Route::get('adm/brands/{id}/delete', 'BrandController@destroy')->middleware('auth', 'role:admin');
	Route::get('adm/brands/{id}/edit', 'BrandController@edit')->middleware('auth', 'role:admin');
	Route::post('adm/brands/{id}/update', 'BrandController@update')->middleware('auth', 'role:admin');	
	Route::get('brand/{name}', 'BrandController@brandSection');

	// lista de deseos
	Route::get('wishes', 'WishController@index');
	Route::post('wish/add', 'WishController@store');
	Route::post('wish/delete', 'WishController@destroy');

	// carrito
	Route::get('cart', 'CartController@index');
	Route::post('cart/add', 'CartController@store');
	Route::post('cart/delete', 'CartController@destroy');

	// buscar
	Route::post('search', 'SearchController@index');
	Route::post('category/filter/price', 'CategoryController@showWithFilterPrice');	

	// Perfil
	Route::get('profile', 'UserController@show')->name('index');
	Route::post('profile/edit', 'UserController@edit')->name('index');
	Route::post('profile/update', 'UserController@update');

	// notificaciones
	Route::get('notifications', 'NotificationController@index');
	Route::get('notifications/get', 'NotificationController@get');
	Route::get('notifications/update', 'NotificationController@update');
	Route::post('notification/delete', 'NotificationController@destroy');

	// oferts
	Route::get('/oferts', 'ProductController@showOferts');

    // Admin products Filter
    Route::get('/adm/products/filters/name', 'ProductController@nameFilter');





// Auth ------------------------------------------------------------------
Auth::routes();

//Route::get('/home', 'HomeController@index');//->name('index');
