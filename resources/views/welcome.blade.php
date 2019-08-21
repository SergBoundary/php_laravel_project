@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/allocations') }}'>1. 1. Allocations</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/documents') }}'>1. 2. Documents</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/employee-families') }}'>1. 3. Employee Families</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/insurance-certificates') }}'>1. 4. Insurance Certificates</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/last-jobs') }}'>1. 5. Last Jobs</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/manning-orders') }}'>1. 6. Manning Orders</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/military-accountings') }}'>1. 7. Military Accountings</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/personal-addresses') }}'>1. 8. Personal Addresses</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/personal-cards') }}'>1. 9. Personal Cards</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/personal-citizenships') }}'>1. 10. Personal Citizenships</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/personal-communications') }}'>1. 11. Personal Communications</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/personal-educations') }}'>1. 12. Personal Educations</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/personal-pasports') }}'>1. 13. Personal Pasports</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/personal-taxes') }}'>1. 14. Personal Taxes</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/provisions') }}'>1. 15. Provisions</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/recruitment-orders') }}'>1. 16. Recruitment Orders</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/salary-cards') }}'>1. 17. Salary Cards</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('hr/work-experiences') }}'>1. 18. Work Experiences</a><br />
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/absence-from-works') }}'>2. 1. Absence From Works</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/accrual-timesheets') }}'>2. 2. Accrual Timesheets</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/base-timesheets') }}'>2. 3. Base Timesheets</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/closing-financial-periods') }}'>2. 4. Closing Financial Periods</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/department-accruals') }}'>2. 5. Department Accruals</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/employee-accrual-calculations') }}'>2. 6. Employee Accrual Calculations</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/employee-accrual-changes') }}'>2. 7. Employee Accrual Changes</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/employee-accrual-months') }}'>2. 8. Employee Accrual Months</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/employee-accrual-years') }}'>2. 9. Employee Accrual Years</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/employee-accruals') }}'>2. 10. Employee Accruals</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/hours-balances') }}'>2. 11. Hours Balances</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/log-accrual-errors') }}'>2. 12. Log Accrual Errors</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/payroll-preparations') }}'>2. 13. Payroll Preparations</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/special-eatings') }}'>2. 14. Special Eatings</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/vacation-amounts') }}'>2. 15. Vacation Amounts</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/vacations') }}'>2. 16. Vacations</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/work-orders') }}'>2. 17. Work Orders</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('acc/work-orders-amounts') }}'>2. 18. Work Orders Amounts</a><br />
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('calc/paychecks') }}'>3. 1. Paychecks</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('calc/payrolls') }}'>3. 2. Payrolls</a><br />
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/absence-classifiers') }}'>4. 1. Absence Classifiers</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/accounts') }}'>4. 2. Accounts</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/accrual-groups') }}'>4. 3. Accrual Groups</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/accrual-relations') }}'>4. 4. Accrual Relations</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/accruals') }}'>4. 5. Accruals</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/algorithms') }}'>4. 6. Algorithms</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/calculation-groups') }}'>4. 7. Calculation Groups</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/cities') }}'>4. 8. Cities</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/clothing-sizes') }}'>4. 9. Clothing Sizes</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/communication-types') }}'>4. 10. Communication Types</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/countries') }}'>4. 11. Countries</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/currencies') }}'>4. 12. Currencies</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/currency-kurses') }}'>4. 13. Currency Kurses</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/department-groups') }}'>4. 14. Department Groups</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/departments') }}'>4. 15. Departments</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/disabilities') }}'>4. 16. Disabilities</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/dismissal-reasons') }}'>4. 17. Dismissal Reasons</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/districts') }}'>4. 18. Districts</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/document-types') }}'>4. 19. Document Types</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/education-types') }}'>4. 20. Education Types</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/employment-types') }}'>4. 21. Employment Types</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/family-relation-types') }}'>4. 22. Family Relation Types</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/grouping-types-of-absences') }}'>4. 23. Grouping Types Of Absences</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/holidays') }}'>4. 24. Holidays</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/hours-balance-classifiers') }}'>4. 25. Hours Balance Classifiers</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/manning-tables') }}'>4. 26. Manning Tables</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/marital-statuses') }}'>4. 27. Marital Statuses</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/months') }}'>4. 28. Months</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/nationalities') }}'>4. 29. Nationalities</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/object-groups') }}'>4. 30. Object Groups</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/objects') }}'>4. 31. Objects</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/phrase-list-groups') }}'>4. 32. Phrase List Groups</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/phrase-lists') }}'>4. 33. Phrase Lists</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/piecework-units') }}'>4. 34. Piecework Units</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/pieceworks') }}'>4. 35. Pieceworks</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/position-categories') }}'>4. 36. Position Categories</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/position-professions') }}'>4. 37. Position Professions</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/positions') }}'>4. 38. Positions</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/ranks') }}'>4. 39. Ranks</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/regions') }}'>4. 40. Regions</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/shoe-sizes') }}'>4. 41. Shoe Sizes</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/study-modes') }}'>4. 42. Study Modes</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/subordinations') }}'>4. 43. Subordinations</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/tax-offices') }}'>4. 44. Tax Offices</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/tax-rate-amounts') }}'>4. 45. Tax Rate Amounts</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/tax-rates') }}'>4. 46. Tax Rates</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/tax-recipients') }}'>4. 47. Tax Recipients</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/tax-scales') }}'>4. 48. Tax Scales</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/teams') }}'>4. 49. Teams</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/work-week-types') }}'>4. 50. Work Week Types</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('ref/years') }}'>4. 51. Years</a><br />
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('set/calculation-setups') }}'>5. 1. Calculation Setups</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('set/company-datas') }}'>5. 2. Company Datas</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('set/constants') }}'>5. 3. Constants</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('set/restore-databases') }}'>5. 4. Restore Databases</a>
                <a class="btn btn-outline-secondary btn-toolbar btn-sm" href='{{ url('set/save-databases') }}'>5. 5. Save Databases</a>
            </div>
        </div>
    </div>
            
@endsection