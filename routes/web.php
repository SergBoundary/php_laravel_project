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

//Route::get('/', function () {
//    return view('menu');
//});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'HumanResources', 'prefix' => 'hr'], function(){
    Route::resource('personal-cards', 'PersonalCardsController')->names('hr.personal-cards');
    Route::resource('allocations', 'AllocationsController')->names('hr.allocations');
    Route::resource('manning-orders', 'ManningOrdersController')->names('hr.manning-orders');
    Route::resource('teams', 'TeamsController')->names('hr.teams');
	
    //Route::resource('hr-analytics', 'TeamsController')->names('hr.hr-analytics');
});

Route::group(['namespace' => 'Accounting', 'prefix' => 'acc'], function(){
    Route::resource('pieceworks', 'PieceworksController')->names('acc.pieceworks');
    Route::resource('base-timesheets', 'BaseTimesheetsController')->names('acc.base-timesheets');
    Route::resource('accruals', 'AccrualsController')->names('acc.accruals');
    Route::resource('retentions', 'RetentionsController')->names('acc.retentions');
});

Route::group(['namespace' => 'Calculations', 'prefix' => 'calc'], function(){
    Route::resource('payrolls', 'PayrollsController')->names('calc.payrolls');
    Route::resource('paychecks', 'PaychecksController')->names('calc.paychecks');
	
    //Route::resource('fin-analytics', 'PaychecksController')->names('calc.fin-analytics');
});

Route::group(['namespace' => 'References', 'prefix' => 'ref'], function(){
    Route::resource('months', 'MonthsController')->names('ref.months');
    Route::resource('years', 'YearsController')->names('ref.years');
    Route::resource('objects', 'ObjectsController')->names('ref.objects');
    Route::resource('departments', 'DepartmentsController')->names('ref.departments');
    Route::resource('position-professions', 'PositionProfessionsController')->names('ref.position-professions');
    Route::resource('positions', 'PositionsController')->names('ref.positions');
    Route::resource('accrual-types', 'AccrualTypesController')->names('ref.accrual-types');
    Route::resource('retention-types', 'RetentionTypesController')->names('ref.retention-types');
});

Route::group(['namespace' => 'Settings', 'prefix' => 'set'], function(){
    Route::resource('users', 'UsersController')->names('set.users');
    Route::resource('menu', 'MenuController')->names('set.menu');
});

Route::group(['namespace' => 'Settings', 'prefix' => ''], function(){
    Route::resource('/', 'MenuController')->names('menu');
    Route::resource('/', 'MenuController')->names('guest');
    Route::resource('human-resources', 'MenuController')->names('menu.hr');
    Route::resource('accounting', 'MenuController')->names('menu.acc');
    Route::resource('calculations', 'MenuController')->names('menu.calc');
    Route::resource('references', 'MenuController')->names('menu.ref');
    Route::resource('settings', 'MenuController')->names('menu.set');
});
