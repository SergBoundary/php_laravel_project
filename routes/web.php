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
    return view('welcome');
});

Route::group(['namespace' => 'HumanResources', 'prefix' => 'hr'], function(){
    Route::resource('personal-cards', 'PersonalCardsController');
    Route::resource('allocations', 'AllocationsController');
    Route::resource('documents', 'DocumentsController');
    Route::resource('provisions', 'ProvisionsController');
    Route::resource('recruitment-orders', 'RecruitmentOrdersController');
    Route::resource('employee-families', 'EmployeeFamiliesController');
    Route::resource('manning-orders', 'ManningOrdersController');
    Route::resource('personal-pasports', 'PersonalPasportsController');
    Route::resource('personal-addresses', 'PersonalAddressesController');
    Route::resource('personal-communications', 'PersonalCommunicationsController');
    Route::resource('personal-citizenships', 'PersonalCitizenshipsController');
    Route::resource('personal-educations', 'PersonalEducationsController');
    Route::resource('personal-taxes', 'PersonalTaxesController');
    Route::resource('work-experiences', 'WorkExperiencesController');
    Route::resource('last-jobs', 'LastJobsController');
    Route::resource('insurance-certificates', 'InsuranceCertificatesController');
    Route::resource('salary-cards', 'SalaryCardsController');
    Route::resource('military-accountings', 'MilitaryAccountingsController');
});

Route::group(['namespace' => 'Accounting', 'prefix' => 'acc'], function(){
    Route::resource('base-timesheets', 'BaseTimesheetsController');
    Route::resource('accrual-timesheets', 'AccrualTimesheetsController');
    Route::resource('department-accruals', 'DepartmentAccrualsController');
    Route::resource('work-orders', 'WorkOrdersController');
    Route::resource('work-orders-amounts', 'WorkOrdersAmountsController');
    Route::resource('hours-balances', 'HoursBalancesController');
    Route::resource('employee-accruals', 'EmployeeAccrualsController');
    Route::resource('employee-accrual-calculations', 'EmployeeAccrualCalculationsController');
    Route::resource('employee-accrual-months', 'EmployeeAccrualMonthsController');
    Route::resource('employee-accrual-years', 'EmployeeAccrualYearsController');
    Route::resource('employee-accrual-changes', 'EmployeeAccrualChangesController');
    Route::resource('log-accrual-errors', 'LogAccrualErrorsController');
    Route::resource('vacations', 'VacationsController');
    Route::resource('vacation-amounts', 'VacationAmountsController');
    Route::resource('absence-from-works', 'AbsenceFromWorksController');
    Route::resource('special-eatings', 'SpecialEatingsController');
    Route::resource('payroll-preparations', 'PayrollPreparationsController');
    Route::resource('closing-financial-periods', 'ClosingFinancialPeriodsController');
});

Route::group(['namespace' => 'Calculations', 'prefix' => 'calc'], function(){
    Route::resource('payrolls', 'PayrollsController');
    Route::resource('paychecks', 'PaychecksController');
});

Route::group(['namespace' => 'References', 'prefix' => 'ref'], function(){
    Route::resource('departments', 'DepartmentsController');
    Route::resource('department-groups', 'DepartmentGroupsController');
    Route::resource('teams', 'TeamsController');
    Route::resource('objects', 'ObjectsController');
    Route::resource('currencies', 'CurrenciesController');
    Route::resource('currency-kurses', 'CurrencyKursesController');
    Route::resource('document-types', 'DocumentTypesController');
    Route::resource('phrase-lists', 'PhraseListsController');
    Route::resource('position-categories', 'PositionCategoriesController');
    Route::resource('position-professions', 'PositionProfessionsController');
    Route::resource('positions', 'PositionsController');
    Route::resource('holidays', 'HolidaysController');
    Route::resource('hours-balance-classifiers', 'HoursBalanceClassifiersController');
    Route::resource('absence-classifiers', 'AbsenceClassifiersController');
    Route::resource('grouping-types-of-absences', 'GroupingTypesOfAbsencesController');
    Route::resource('tax-rates', 'TaxRatesController');
    Route::resource('tax-rate-amounts', 'TaxRateAmountsController');
    Route::resource('accruals', 'AccrualsController');
    Route::resource('accrual-groups', 'AccrualGroupsController');
    Route::resource('accrual-relations', 'AccrualRelationsController');
    Route::resource('calculation-groups', 'CalculationGroupsController');
    Route::resource('pieceworks', 'PieceworksController');
    Route::resource('piecework-units', 'PieceworkUnitsController');
    Route::resource('accounts', 'AccountsController');
    Route::resource('months', 'MonthsController');
    Route::resource('years', 'YearsController');
    Route::resource('algorithms', 'AlgorithmsController');
    Route::resource('ranks', 'RanksController');
    Route::resource('phrase-list-groups', 'PhraseListGroupsController');
    Route::resource('dismissal-reasons', 'DismissalReasonsController');
    Route::resource('family-relation-types', 'FamilyRelationTypesController');
    Route::resource('communication-types', 'CommunicationTypesController');
    Route::resource('employment-types', 'EmploymentTypesController');
    Route::resource('education-types', 'EducationTypesController');
    Route::resource('study-modes', 'StudyModesController');
    Route::resource('tax-offices', 'TaxOfficesController');
    Route::resource('tax-recipients', 'TaxRecipientsController');
    Route::resource('object-groups', 'ObjectGroupsController');
    Route::resource('subordinations', 'SubordinationsController');
    Route::resource('work-week-types', 'WorkWeekTypesController');
    Route::resource('nationalities', 'NationalitiesController');
    Route::resource('cities', 'CitiesController');
    Route::resource('regions', 'RegionsController');
    Route::resource('districts', 'DistrictsController');
    Route::resource('countries', 'CountriesController');
    Route::resource('marital-statuses', 'MaritalStatusesController');
    Route::resource('clothing-sizes', 'ClothingSizesController');
    Route::resource('shoe-sizes', 'ShoeSizesController');
    Route::resource('disabilities', 'DisabilitiesController');
    Route::resource('manning-tables', 'ManningTablesController');
    Route::resource('tax-scales', 'TaxScalesController');
});

Route::group(['namespace' => 'Settings', 'prefix' => 'set'], function(){
    Route::resource('calculation-setups', 'CalculationSetupsController');
    Route::resource('company-datas', 'CompanyDatasController');
    Route::resource('constants', 'ConstantsController');
    Route::resource('restore-databases', 'RestoreDatabasesController');
    Route::resource('save-databases', 'SaveDatabasesController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
