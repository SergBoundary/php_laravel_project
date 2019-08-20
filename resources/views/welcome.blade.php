<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: Helvetica, Arial, sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="links">
                    <a href='{{ url('hr/allocations') }}'>1. 1. Allocations</a><br />
                    <a href='{{ url('hr/documents') }}'>1. 2. Documents</a><br />
                    <a href='{{ url('hr/employee-families') }}'>1. 3. Employee Families</a><br />
                    <a href='{{ url('hr/insurance-certificates') }}'>1. 4. Insurance Certificates</a><br />
                    <a href='{{ url('hr/last-jobs') }}'>1. 5. Last Jobs</a><br />
                    <a href='{{ url('hr/manning-orders') }}'>1. 6. Manning Orders</a><br />
                    <a href='{{ url('hr/military-accounting') }}'>1. 7. Military Accounting</a><br />
                    <a href='{{ url('hr/personal-addresses') }}'>1. 8. Personal Addresses</a><br />
                    <a href='{{ url('hr/personal-cards') }}'>1. 9. Personal Cards</a><br />
                    <a href='{{ url('hr/personal-citizenships') }}'>1. 10. Personal Citizenships</a><br />
                    <a href='{{ url('hr/personal-communications') }}'>1. 11. Personal Communications</a><br />
                    <a href='{{ url('hr/personal-educations') }}'>1. 12. Personal Educations</a><br />
                    <a href='{{ url('hr/personal-pasports') }}'>1. 13. Personal Pasports</a><br />
                    <a href='{{ url('hr/personal-taxes') }}'>1. 14. Personal Taxes</a><br />
                    <a href='{{ url('hr/provisions') }}'>1. 15. Provisions</a><br />
                    <a href='{{ url('hr/recruitment-orders') }}'>1. 16. Recruitment Orders</a><br />
                    <a href='{{ url('hr/salary-cards') }}'>1. 17. Salary Cards</a><br />
                    <a href='{{ url('hr/work-experiences') }}'>1. 18. Work Experiences</a><br /><br />
                    <a href='{{ url('acc/absence-from-works') }}'>2. 1. Absence From Works</a><br />
                    <a href='{{ url('acc/accrual-timesheets') }}'>2. 2. Accrual Timesheets</a><br />
                    <a href='{{ url('acc/base-timesheets') }}'>2. 3. Base Timesheets</a><br />
                    <a href='{{ url('acc/closing-financial-periods') }}'>2. 4. Closing Financial Periods</a><br />
                    <a href='{{ url('acc/department-accruals') }}'>2. 5. Department Accruals</a><br />
                    <a href='{{ url('acc/employee-accrual-calculations') }}'>2. 6. Employee Accrual Calculations</a><br />
                    <a href='{{ url('acc/employee-accrual-changes') }}'>2. 7. Employee Accrual Changes</a><br />
                    <a href='{{ url('acc/employee-accrual-months') }}'>2. 8. Employee Accrual Months</a><br />
                    <a href='{{ url('acc/employee-accrual-years') }}'>2. 9. Employee Accrual Years</a><br />
                    <a href='{{ url('acc/employee-accruals') }}'>2. 10. Employee Accruals</a><br />
                    <a href='{{ url('acc/hours-balances') }}'>2. 11. Hours Balances</a><br />
                    <a href='{{ url('acc/log-accrual-errors') }}'>2. 12. Log Accrual Errors</a><br />
                    <a href='{{ url('acc/payroll-preparations') }}'>2. 13. Payroll Preparations</a><br />
                    <a href='{{ url('acc/special-eatings') }}'>2. 14. Special Eatings</a><br />
                    <a href='{{ url('acc/vacation-amounts') }}'>2. 15. Vacation Amounts</a><br />
                    <a href='{{ url('acc/vacations') }}'>2. 16. Vacations</a><br />
                    <a href='{{ url('acc/work-orders') }}'>2. 17. Work Orders</a><br />
                    <a href='{{ url('acc/work-orders-amounts') }}'>2. 18. Work Orders Amounts</a><br /><br />
                    <a href='{{ url('calc/paychecks') }}'>3. 1. Paychecks</a><br />
                    <a href='{{ url('calc/payrolls') }}'>3. 2. Payrolls</a><br /><br />
                    <a href='{{ url('ref/absence-classifiers') }}'>4. 1. Absence Classifiers</a><br />
                    <a href='{{ url('ref/accounts') }}'>4. 2. Accounts</a><br />
                    <a href='{{ url('ref/accrual-groups') }}'>4. 3. Accrual Groups</a><br />
                    <a href='{{ url('ref/accrual-relations') }}'>4. 4. Accrual Relations</a><br />
                    <a href='{{ url('ref/accruals') }}'>4. 5. Accruals</a><br />
                    <a href='{{ url('ref/algorithms') }}'>4. 6. Algorithms</a><br />
                    <a href='{{ url('ref/calculation-groups') }}'>4. 7. Calculation Groups</a><br />
                    <a href='{{ url('ref/cities') }}'>4. 8. Cities</a><br />
                    <a href='{{ url('ref/clothing-sizes') }}'>4. 9. Clothing Sizes</a><br />
                    <a href='{{ url('ref/communication-types') }}'>4. 10. Communication Types</a><br />
                    <a href='{{ url('ref/countries') }}'>4. 11. Countries</a><br />
                    <a href='{{ url('ref/currencies') }}'>4. 12. Currencies</a><br />
                    <a href='{{ url('ref/currency-kurses') }}'>4. 13. Currency Kurses</a><br />
                    <a href='{{ url('ref/department-groups') }}'>4. 14. Department Groups</a><br />
                    <a href='{{ url('ref/departments') }}'>4. 15. Departments</a><br />
                    <a href='{{ url('ref/disabilities') }}'>4. 16. Disabilities</a><br />
                    <a href='{{ url('ref/dismissal-reasons') }}'>4. 17. Dismissal Reasons</a><br />
                    <a href='{{ url('ref/districts') }}'>4. 18. Districts</a><br />
                    <a href='{{ url('ref/document-types') }}'>4. 19. Document Types</a><br />
                    <a href='{{ url('ref/education-types') }}'>4. 20. Education Types</a><br />
                    <a href='{{ url('ref/employment-types') }}'>4. 21. Employment Types</a><br />
                    <a href='{{ url('ref/family-relation-types') }}'>4. 22. Family Relation Types</a><br />
                    <a href='{{ url('ref/grouping-types-of-absences') }}'>4. 23. Grouping Types Of Absences</a><br />
                    <a href='{{ url('ref/holidays') }}'>4. 24. Holidays</a><br />
                    <a href='{{ url('ref/hours-balance-classifiers') }}'>4. 25. Hours Balance Classifiers</a><br />
                    <a href='{{ url('ref/manning-tables') }}'>4. 26. Manning Tables</a><br />
                    <a href='{{ url('ref/marital-statuses') }}'>4. 27. Marital Statuses</a><br />
                    <a href='{{ url('ref/months') }}'>4. 28. Months</a><br />
                    <a href='{{ url('ref/nationalities') }}'>4. 29. Nationalities</a><br />
                    <a href='{{ url('ref/object-groups') }}'>4. 30. Object Groups</a><br />
                    <a href='{{ url('ref/objects') }}'>4. 31. Objects</a><br />
                    <a href='{{ url('ref/phrase-list-groups') }}'>4. 32. Phrase List Groups</a><br />
                    <a href='{{ url('ref/phrase-lists') }}'>4. 33. Phrase Lists</a><br />
                    <a href='{{ url('ref/piecework-units') }}'>4. 34. Piecework Units</a><br />
                    <a href='{{ url('ref/pieceworks') }}'>4. 35. Pieceworks</a><br />
                    <a href='{{ url('ref/position-categories') }}'>4. 36. Position Categories</a><br />
                    <a href='{{ url('ref/position-professions') }}'>4. 37. Position Professions</a><br />
                    <a href='{{ url('ref/positions') }}'>4. 38. Positions</a><br />
                    <a href='{{ url('ref/ranks') }}'>4. 39. Ranks</a><br />
                    <a href='{{ url('ref/regions') }}'>4. 40. Regions</a><br />
                    <a href='{{ url('ref/shoe-sizes') }}'>4. 41. Shoe Sizes</a><br />
                    <a href='{{ url('ref/study-modes') }}'>4. 42. Study Modes</a><br />
                    <a href='{{ url('ref/subordinations') }}'>4. 43. Subordinations</a><br />
                    <a href='{{ url('ref/tax-offices') }}'>4. 44. Tax Offices</a><br />
                    <a href='{{ url('ref/tax-rate-amounts') }}'>4. 45. Tax Rate Amounts</a><br />
                    <a href='{{ url('ref/tax-rates') }}'>4. 46. Tax Rates</a><br />
                    <a href='{{ url('ref/tax-recipients') }}'>4. 47. Tax Recipients</a><br />
                    <a href='{{ url('ref/tax-scales') }}'>4. 48. Tax Scales</a><br />
                    <a href='{{ url('ref/teams') }}'>4. 49. Teams</a><br />
                    <a href='{{ url('ref/work-week-types') }}'>4. 50. Work Week Types</a><br />
                    <a href='{{ url('ref/years') }}'>4. 51. Years</a><br /><br />
                    <a href='{{ url('set/calculation-setups') }}'>5. 1. Calculation Setups</a><br />
                    <a href='{{ url('set/company-datas') }}'>5. 2. Company Datas</a><br />
                    <a href='{{ url('set/constants') }}'>5. 3. Constants</a><br />
                    <a href='{{ url('set/restore-databases') }}'>5. 4. Restore Databases</a><br />
                    <a href='{{ url('set/save-databases') }}'>5. 5. Save Databases</a><br />
                </div>
            </div>
        </div>
    </body>
</html>
