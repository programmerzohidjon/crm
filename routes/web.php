<?php

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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id}', 'HomeController@myProfile')->name('profile');
Route::post('/myprofile','HomeController@editProfile')->name('myprofile_edit');

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){

	Route::get('/menu','Admin\MenuController@index')->name('admin.menu.index');
	Route::get('/menu/create','Admin\MenuController@create')->name('admin.menu.create');
	Route::post('/menu','Admin\MenuController@store')->name('admin.menu.store');
	Route::get('/menu/edit/{slug}','Admin\MenuController@edit')->name('admin.menu.edit');
	Route::post('/menu/update','Admin\MenuController@update')->name('admin.menu.update');
	Route::get('/menu/delete/{id}','Admin\MenuController@destroy')->name('admin.menu.destroy');

	Route::get('/teachers','Admin\TeacherController@index')->name('admin.teacher.index');
	Route::get('/teacher/create','Admin\TeacherController@create')->name('admin.teacher.create');
	Route::post('/teacher','Admin\TeacherController@store')->name('admin.teacher.store');
	Route::get('/teacher/edit/{id}','Admin\TeacherController@edit')->name('admin.teacher.edit');
	Route::post('/teacher/update','Admin\TeacherController@update')->name('admin.teacher.update');
	Route::get('/teacher/delete/{id}','Admin\TeacherController@destroy')->name('admin.teacher.destroy');

	Route::get('/subjects','Admin\SubjectController@index')->name('admin.subject.index');
	Route::get('/subject/create','Admin\SubjectController@create')->name('admin.subject.create');
	Route::post('/subject','Admin\SubjectController@store')->name('admin.subject.store');
	Route::get('/subject/edit/{slug}','Admin\SubjectController@edit')->name('admin.subject.edit');
	Route::post('/subject/update','Admin\SubjectController@update')->name('admin.subject.update');
	Route::get('/subject/delete/{id}','Admin\SubjectController@destroy')->name('admin.subject.destroy');

	Route::get('/groups','Admin\GroupController@index')->name('admin.group.index');
	Route::get('/group/create','Admin\GroupController@create')->name('admin.group.create');
	Route::post('/group','Admin\GroupController@store')->name('admin.group.store');
	Route::get('/group/edit/{id}','Admin\GroupController@edit')->name('admin.group.edit');
	Route::post('/group/update','Admin\GroupController@update')->name('admin.group.update');
	Route::get('/group/delete/{id}','Admin\GroupController@destroy')->name('admin.group.destroy');

	Route::get('/tutorials','Admin\TutorialController@index')->name('admin.tutorial.index');
	Route::get('/tutorial/create','Admin\TutorialController@create')->name('admin.tutorial.create');
	Route::post('/tutorial','Admin\TutorialController@store')->name('admin.tutorial.store');
	Route::get('/tutorial/edit/{slug}','Admin\TutorialController@edit')->name('admin.tutorial.edit');
	Route::post('/tutorial/update','Admin\TutorialController@update')->name('admin.tutorial.update');
	Route::get('/tutorial/delete/{id}','Admin\TutorialController@destroy')->name('admin.tutorial.destroy');

});
