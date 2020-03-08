<?php

Auth::routes();

Route::get('/interface-test', function() {
    $language = "ua";
    $modul = "human-resources-index";

    session(['language' => $language]);
    session(['modul' => $modul]);
        
    $controller = new App\Http\Controllers\Controller();
    $result = $controller->setInterface($language, $modul);
    
    $interface["title"] = $result['title'];

    foreach ($result as $key => $value) {
        if($key == "nav-login") {
            $interface[$key] = $value;
        }
        if($key == "nav-menu") {
            $interface[$key] = $value;
        }
        if($key == "form-button") {
            $interface[$key] = $value;
        }
        if($key == "user-access-level") {
            $interface[$key] = $value;
        }
        if($key == $modul) {
            $interface[$modul] = $value;
        }
    }
    
    dd($language, $modul, $interface);
});

Route::post('/ajax-interface', function() {
    if(Request::ajax()) {
        $language = strtolower($_POST['language']);
        $modul = $_POST['modul'];
        
        session(['language' => $language]);
        session(['modul' => $modul]);
        
        $controller = new App\Http\Controllers\Controller();
        $result = $controller->setInterface($language, $modul);

        $interface["title"] = $result['tirle'];

        foreach ($result as $key => $value) {
            if($key == "nav-login") {
                $interface[$key] = $value;
            }
            if($key == "nav-menu") {
                $interface[$key] = $value;
            }
            if($key == "form-button") {
                $interface[$key] = $value;
            }
            if($key == "user-access-level") {
                $interface[$key] = $value;
            }
            if($key == $modul) {
                $interface[$modul] = $value;
            }
        }
        
        return Response::json($interface);
    }
});

Route::post('/ajax-team-leader/{id}', function($id) {
    if(Request::ajax()) {

        $leader = App\Models\HumanResources\PersonalCards::find($id);
        $user = App\Models\User::find($id);
        $manningOrder = App\Models\HumanResources\ManningOrders::where('personal_card_id', $id)
            ->whereNull('resignation_date')
            ->orderBy('assignment_date', 'desc')
            ->first();
        $department = App\Models\References\Departments::find($manningOrder['department_id']);
        $position = App\Models\References\Positions::find($manningOrder['position_id']);
        $profession = App\Models\References\PositionProfessions::find($manningOrder['position_profession_id']);
        
        $leader['email'] = $user['email'];
        $leader['department'] = $department['title'];
        $leader['position'] = $position['title'];
        $leader['assignment_date'] = $manningOrder['assignment_date'];
        $leader['profession'] = $profession['title'];
        $leader['profession_code'] = $profession['code'];
        
        return Response::json($leader);
    }
});

Route::get('/user', 'HomeController@index')->name('user');

Route::group(['namespace' => 'HumanResources', 'prefix' => 'hr'], function(){
    Route::resource('personal-cards', 'PersonalCardsController')->names('hr.personal-cards');
    Route::resource('allocations', 'AllocationsController')->names('hr.allocations');
    Route::resource('manning-orders', 'ManningOrdersController')->names('hr.manning-orders');
    Route::resource('teams', 'TeamsController')->names('hr.teams');
    Route::resource('billeteds', 'BilletedsController')->names('hr.billeteds');
    Route::resource('vacations', 'VacationsController')->names('hr.vacations');
	
    Route::resource('hr-analytics', 'TeamsController')->names('hr.hr-analytics');
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
    Route::resource('countries', 'CountriesController')->names('ref.countries');
    Route::resource('calendars', 'CalendarsController')->names('ref.calendars');
    Route::resource('departments', 'DepartmentsController')->names('ref.departments');
    Route::resource('objects', 'ObjectsController')->names('ref.objects');
    Route::resource('hotels', 'HotelsController')->names('ref.hotels');
    Route::resource('position-professions', 'PositionProfessionsController')->names('ref.position-professions');
    Route::resource('positions', 'PositionsController')->names('ref.positions');
    Route::resource('accrual-types', 'AccrualTypesController')->names('ref.accrual-types');
    Route::resource('retention-types', 'RetentionTypesController')->names('ref.retention-types');
});

Route::group(['namespace' => 'Settings', 'prefix' => 'set'], function(){
    Route::resource('users', 'UsersController')->names('set.users');
    Route::resource('menus', 'MenusController')->names('set.menus');
});

Route::group(['namespace' => 'Settings', 'prefix' => ''], function(){
    Route::resource('/', 'MenusController')->names('guest');
    Route::resource('human-resources', 'MenusController')->names('menus.hr');
    Route::resource('accounting', 'MenusController')->names('menus.acc');
    Route::resource('calculations', 'MenusController')->names('menus.calc');
    Route::resource('references', 'MenusController')->names('menus.ref');
    Route::resource('settings', 'MenusController')->names('menus.set');
});
