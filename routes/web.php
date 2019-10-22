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
    Route::resource('documents', 'DocumentsController')->names('hr.documents');
    Route::resource('provisions', 'ProvisionsController')->names('hr.provisions');
    Route::resource('recruitment-orders', 'RecruitmentOrdersController')->names('hr.recruitment-orders');
    Route::resource('employee-families', 'EmployeeFamiliesController')->names('hr.employee-families');
    Route::resource('manning-orders', 'ManningOrdersController')->names('hr.manning-orders');
    Route::resource('personal-pasports', 'PersonalPasportsController')->names('hr.personal-pasports');
    Route::resource('personal-addresses', 'PersonalAddressesController')->names('hr.personal-addresses');
    Route::resource('personal-communications', 'PersonalCommunicationsController')->names('hr.personal-communications');
    Route::resource('personal-citizenships', 'PersonalCitizenshipsController')->names('hr.personal-citizenships');
    Route::resource('personal-educations', 'PersonalEducationsController')->names('hr.personal-educations');
    Route::resource('personal-taxes', 'PersonalTaxesController')->names('hr.personal-taxes');
    Route::resource('work-experiences', 'WorkExperiencesController')->names('hr.work-experiences');
    Route::resource('last-jobs', 'LastJobsController')->names('hr.last-jobs');
    Route::resource('insurance-certificates', 'InsuranceCertificatesController')->names('hr.insurance-certificates');
    Route::resource('salary-cards', 'SalaryCardsController')->names('hr.salary-cards');
    Route::resource('military-accountings', 'MilitaryAccountingsController')->names('hr.military-accountings');
    Route::resource('visa-statuses', 'VisaStatusesController')->names('hr.visa-statuses');
    Route::resource('visa-documents', 'VisaDocumentsController')->names('hr.visa-documents');
    Route::resource('border-crossings', 'BorderCrossingsController')->names('hr.border-crossings');
    Route::resource('migration-statuses', 'MigrationStatusesController')->names('hr.migration-statuses');
    Route::resource('migration-documents', 'MigrationDocumentsController')->names('hr.migration-documents');
});
Route::group(['namespace' => 'Accounting', 'prefix' => 'acc'], function(){
    Route::resource('base-timesheets', 'BaseTimesheetsController')->names('acc.base-timesheets');
    Route::resource('accrual-timesheets', 'AccrualTimesheetsController')->names('acc.accrual-timesheets');
    Route::resource('department-accruals', 'DepartmentAccrualsController')->names('acc.department-accruals');
    Route::resource('work-orders', 'WorkOrdersController')->names('acc.work-orders');
    Route::resource('work-orders-amounts', 'WorkOrdersAmountsController')->names('acc.work-orders-amounts');
    Route::resource('hours-balances', 'HoursBalancesController')->names('acc.hours-balances');
    Route::resource('employee-accruals', 'EmployeeAccrualsController')->names('acc.employee-accruals');
    Route::resource('employee-accrual-calculations', 'EmployeeAccrualCalculationsController')->names('acc.employee-accrual-calculations');
    Route::resource('employee-accrual-months', 'EmployeeAccrualMonthsController')->names('acc.employee-accrual-months');
    Route::resource('employee-accrual-years', 'EmployeeAccrualYearsController')->names('acc.employee-accrual-years');
    Route::resource('employee-accrual-changes', 'EmployeeAccrualChangesController')->names('acc.employee-accrual-changes');
    Route::resource('log-accrual-errors', 'LogAccrualErrorsController')->names('acc.log-accrual-errors');
    Route::resource('vacations', 'VacationsController')->names('acc.vacations');
    Route::resource('vacation-amounts', 'VacationAmountsController')->names('acc.vacation-amounts');
    Route::resource('absence-from-works', 'AbsenceFromWorksController')->names('acc.absence-from-works');
    Route::resource('special-eatings', 'SpecialEatingsController')->names('acc.special-eatings');
});
Route::group(['namespace' => 'Calculations', 'prefix' => 'calc'], function(){
    Route::resource('payroll-preparations', 'PayrollPreparationsController')->names('calc.payroll-preparations');
    Route::resource('closing-financial-periods', 'ClosingFinancialPeriodsController')->names('calc.closing-financial-periods');
    Route::resource('payrolls', 'PayrollsController')->names('calc.payrolls');
    Route::resource('paychecks', 'PaychecksController')->names('calc.paychecks');
});
Route::group(['namespace' => 'References', 'prefix' => 'ref'], function(){
    Route::resource('departments', 'DepartmentsController')->names('ref.departments');
    Route::resource('department-groups', 'DepartmentGroupsController')->names('ref.department-groups');
    Route::resource('teams', 'TeamsController')->names('ref.teams');
    Route::resource('objects', 'ObjectsController')->names('ref.objects');
    Route::resource('currencies', 'CurrenciesController')->names('ref.currencies');
    Route::resource('currency-kurses', 'CurrencyKursesController')->names('ref.currency-kurses');
    Route::resource('document-types', 'DocumentTypesController')->names('ref.document-types');
    Route::resource('phrase-lists', 'PhraseListsController')->names('ref.phrase-lists');
    Route::resource('position-categories', 'PositionCategoriesController')->names('ref.position-categories');
    Route::resource('position-professions', 'PositionProfessionsController')->names('ref.position-professions');
    Route::resource('positions', 'PositionsController')->names('ref.positions');
    Route::resource('holidays', 'HolidaysController')->names('ref.holidays');
    Route::resource('hours-balance-classifiers', 'HoursBalanceClassifiersController')->names('ref.hours-balance-classifiers');
    Route::resource('absence-classifiers', 'AbsenceClassifiersController')->names('ref.absence-classifiers');
    Route::resource('grouping-types-of-absences', 'GroupingTypesOfAbsencesController')->names('ref.grouping-types-of-absences');
    Route::resource('tax-rates', 'TaxRatesController')->names('ref.tax-rates');
    Route::resource('tax-rate-amounts', 'TaxRateAmountsController')->names('ref.tax-rate-amounts');
    Route::resource('accruals', 'AccrualsController')->names('ref.accruals');
    Route::resource('accrual-groups', 'AccrualGroupsController')->names('ref.accrual-groups');
    Route::resource('accrual-relations', 'AccrualRelationsController')->names('ref.accrual-relations');
    Route::resource('calculation-groups', 'CalculationGroupsController')->names('ref.calculation-groups');
    Route::resource('pieceworks', 'PieceworksController')->names('ref.pieceworks');
    Route::resource('piecework-units', 'PieceworkUnitsController')->names('ref.piecework-units');
    Route::resource('accounts', 'AccountsController')->names('ref.accounts');
    Route::resource('months', 'MonthsController')->names('ref.months');
    Route::resource('years', 'YearsController')->names('ref.years');
    Route::resource('algorithms', 'AlgorithmsController')->names('ref.algorithms');
    Route::resource('ranks', 'RanksController')->names('ref.ranks');
    Route::resource('phrase-list-groups', 'PhraseListGroupsController')->names('ref.phrase-list-groups');
    Route::resource('dismissal-reasons', 'DismissalReasonsController')->names('ref.dismissal-reasons');
    Route::resource('family-relation-types', 'FamilyRelationTypesController')->names('ref.family-relation-types');
    Route::resource('communication-types', 'CommunicationTypesController')->names('ref.communication-types');
    Route::resource('employment-types', 'EmploymentTypesController')->names('ref.employment-types');
    Route::resource('education-types', 'EducationTypesController')->names('ref.education-types');
    Route::resource('study-modes', 'StudyModesController')->names('ref.study-modes');
    Route::resource('tax-offices', 'TaxOfficesController')->names('ref.tax-offices');
    Route::resource('tax-recipients', 'TaxRecipientsController')->names('ref.tax-recipients');
    Route::resource('object-groups', 'ObjectGroupsController')->names('ref.object-groups');
    Route::resource('subordinations', 'SubordinationsController')->names('ref.subordinations');
    Route::resource('work-week-types', 'WorkWeekTypesController')->names('ref.work-week-types');
    Route::resource('nationalities', 'NationalitiesController')->names('ref.nationalities');
    Route::resource('cities', 'CitiesController')->names('ref.cities');
    Route::resource('regions', 'RegionsController')->names('ref.regions');
    Route::resource('districts', 'DistrictsController')->names('ref.districts');
    Route::resource('countries', 'CountriesController')->names('ref.countries');
    Route::resource('marital-statuses', 'MaritalStatusesController')->names('ref.marital-statuses');
    Route::resource('clothing-sizes', 'ClothingSizesController')->names('ref.clothing-sizes');
    Route::resource('shoe-sizes', 'ShoeSizesController')->names('ref.shoe-sizes');
    Route::resource('disabilities', 'DisabilitiesController')->names('ref.disabilities');
    Route::resource('manning-tables', 'ManningTablesController')->names('ref.manning-tables');
    Route::resource('tax-scales', 'TaxScalesController')->names('ref.tax-scales');
});
Route::group(['namespace' => 'Settings', 'prefix' => 'set'], function(){
    Route::resource('calculation-setups', 'CalculationSetupsController')->names('set.calculation-setups');
    Route::resource('company-datas', 'CompanyDatasController')->names('set.company-datas');
    Route::resource('constants', 'ConstantsController')->names('set.constants');
    Route::resource('restore-databases', 'RestoreDatabasesController')->names('set.restore-databases');
    Route::resource('save-databases', 'SaveDatabasesController')->names('set.save-databases');
});
Route::group(['namespace' => 'Settings', 'prefix' => ''], function(){
    Route::resource('/', 'MenuController')->names('menu');
    Route::resource('/', 'MenuController')->names('guest');
    Route::resource('human-resources', 'MenuController')->names('menu.hr');
    Route::resource('accounting', 'MenuController')->names('menu.acc');
    Route::resource('references', 'MenuController')->names('menu.ref');
    Route::resource('settings', 'MenuController')->names('menu.set');
    
    Route::resource('calc/accounting', 'MenuController')->names('menu.calc.accounting');
    Route::resource('ref/human-resources', 'MenuController')->names('menu.ref.human-resources');
    Route::resource('ref/accounting', 'MenuController')->names('menu.ref.accounting');
    Route::resource('ref/general', 'MenuController')->names('menu.ref.general');
    Route::resource('ref/base', 'MenuController')->names('menu.ref.base');
});
