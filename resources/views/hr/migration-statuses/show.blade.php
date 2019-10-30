@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\MigrationStatuses $menu, $title, $migrationStatusesList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $migrationStatusesList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country'>Страна легального пребывания</label>
                                    <input name='country' value='{{ $migrationStatusesList->country }}' id='country' type='text' maxlength="50" readonly class="form-control" title='Страна легального пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='status_ol'>Текущий статус пребывания</label>
                                    <input name='status_ol' value='{{ $migrationStatusesList->status_ol }}' id='status_ol' type='text' maxlength="50" readonly class="form-control" title='Текущий статус пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='status_new'>Новый статус пребывания</label>
                                    <input name='status_new' value='{{ $migrationStatusesList->status_new }}' id='status_new' type='text' maxlength="50" readonly class="form-control" title='Новый статус пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='opening_reason'>Основание получения нового статуса</label>
                                    <input name='opening_reason' value='{{ $migrationStatusesList->opening_reason }}' id='opening_reason' type='text' maxlength="50" readonly class="form-control" title='Основание получения нового статуса'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='submitte'>Дата подачи документов в орган легализации пребывания</label>
                                    <input name='submitte' value='{{ $migrationStatusesList->submitte }}' id='submitte' type='text' maxlength="50" readonly class="form-control" title='Дата подачи документов в орган легализации пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='incomplete'>Дата требования подать недостающие документы</label>
                                    <input name='incomplete' value='{{ $migrationStatusesList->incomplete }}' id='incomplete' type='text' maxlength="50" readonly class="form-control" title='Дата требования подать недостающие документы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='decision_number'>Номер решения о легализации пребывания</label>
                                    <input name='decision_number' value='{{ $migrationStatusesList->decision_number }}' id='decision_number' type='text' maxlength="50" readonly class="form-control" title='Номер решения о легализации пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='decision_date'>Дата выдачи решения о легализации пребывания</label>
                                    <input name='decision_date' value='{{ $migrationStatusesList->decision_date }}' id='decision_date' type='text' maxlength="50" readonly class="form-control" title='Дата выдачи решения о легализации пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_opening'>Дата открытия пребывания в стране</label>
                                    <input name='date_opening' value='{{ $migrationStatusesList->date_opening }}' id='date_opening' type='text' maxlength="50" readonly class="form-control" title='Дата открытия пребывания в стране'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_closing'>Дата закрытия пребывания в стране</label>
                                    <input name='date_closing' value='{{ $migrationStatusesList->date_closing }}' id='date_closing' type='text' maxlength="50" readonly class="form-control" title='Дата закрытия пребывания в стране'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='closing_reason'>Основание анулирования пребывания</label>
                                    <input name='closing_reason' value='{{ $migrationStatusesList->closing_reason }}' id='closing_reason' type='text' maxlength="50" readonly class="form-control" title='Основание анулирования пребывания'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.migration-statuses.destroy', $migrationStatusesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.migration-statuses.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.migration-statuses.edit', $migrationStatusesList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection