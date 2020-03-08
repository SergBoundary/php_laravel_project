@extends('layouts.layout')

@section('content')
    <div id="interface-modul" modul="guest-menu"></div>
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mr-auto">
                <br>
                <h4 id="guest-menu-version">{{ $interface['guest-menu']['guest-menu-version'] }}</h4>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="accordion" id="accordionGuest">
                    <div class="form-row">
                        <div class='col-md-12'>
                            <a id="headingResults" class="btn btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapseResults" href="#collapseResults" role="button" aria-expanded="false" aria-controls="collapseResults">
                                <span id="guest-menu-results">{{ $interface['guest-menu']['guest-menu-results'] }}</span> <span class="badge badge-secondary">12</span>
                            </a><br>
                            <div id="collapseResults" class="collapse show" aria-labelledby="headingResults" data-parent="#accordionGuest">
                                <div class="card card-body">
                                    <p><a href="#" class="btn btn-outline-success">Human resources</a>
                                    <a href="#" class="btn btn-outline-success">Teams</a>
                                    <a href="#" class="btn btn-outline-success">Appointments</a>
                                    <a href="#" class="btn btn-outline-success">Allocations</a>
                                    <a href="#" class="btn btn-outline-success">Billeting</a>
                                    <a href="#" class="btn btn-outline-success">Vacations</a></p>
                                    <p><a href="#" class="btn btn-outline-success">Piecework</a>
                                    <a href="#" class="btn btn-outline-success">Time-work</a>
                                    <a href="#" class="btn btn-outline-success">Accruals</a>
                                    <a href="#" class="btn btn-outline-success">Deductions</a>
                                    <a href="#" class="btn btn-outline-success">Payroll</a>
                                    <a href="#" class="btn btn-outline-success">Paycheck</a></p>
                                </div><br>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class='col-md-12'>
                            <a id="headingTasks" class="btn btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapseTasks" href="#collapseTasks" role="button" aria-expanded="false" aria-controls="collapseTasks">
                                <span id="guest-menu-tasks">{{ $interface['guest-menu']['guest-menu-tasks'] }}</span> <span class="badge badge-secondary">2410</span>
                            </a><br>
                            <div id="collapseTasks" class="collapse" aria-labelledby="headingTasks" data-parent="#accordionGuest">
                                <div class="card card-body">
                                    <p><a href="#" class="btn btn-outline-success">Teams <span class="badge badge-success">100</span></a>
                                    <a href="#" class="btn btn-outline-success">Firms <span class="badge badge-success">10</span></a>
                                    <a href="#" class="btn btn-outline-success">People <span class="badge badge-success">1200</span></a>
                                    <a href="#" class="btn btn-outline-success">Projects <span class="badge badge-success">1100</span></a></p>
                                </div><br>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class='col-md-12'>
                            <a id="headingStatistics" class="btn btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapseStatistics" href="#collapseStatistics" role="button" aria-expanded="false" aria-controls="collapseStatistics">
                                <span id="guest-menu-statistics">{{ $interface['guest-menu']['guest-menu-statistics'] }}</span> <span class="badge badge-secondary">1</span>
                            </a><br>
                            <div id="collapseStatistics" class="collapse" aria-labelledby="headingStatistics" data-parent="#accordionGuest">
                                <div class="card card-body">
                                    <p><a href="#" class="btn btn-outline-success">Multilingualism</a></p>
                                </div><br>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class='col-md-12'>
                            <a id="headingFunctional" class="btn btn-outline-secondary btn-block" data-toggle="collapse" data-target="#collapseFunctional" href="#collapseFunctional" role="button" aria-expanded="false" aria-controls="collapseFunctional">
                                <span id="guest-menu-functional">{{ $interface['guest-menu']['guest-menu-functional'] }}</span> <span class="badge badge-secondary">1</span>
                            </a><br>
                            <div id="collapseFunctional" class="collapse" aria-labelledby="headingFunctional" data-parent="#accordionGuest">
                                <div class="card card-body">
                                    <p><a href="#" class="btn btn-outline-success">Multilingualism</a></p>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection