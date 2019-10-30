@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Allocations $menu, $title, $allocationsList */
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
                                    <input name='personal_card' value='{{ $allocationsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Определен на объект</label>
                                    <input name='object' value='{{ $allocationsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Определен на объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team'>Определен в бригаду</label>
                                    <input name='team' value='{{ $allocationsList->team }}' id='team' type='text' maxlength="50" readonly class="form-control" title='Определен в бригаду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='document'>Номер документа</label>
                                    <input name='document' value='{{ $allocationsList->document }}' id='document' type='text' maxlength="50" readonly class="form-control" title='Номер документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date'>Дата распределения</label>
                                    <input name='date' value='{{ $allocationsList->date }}' id='date' type='text' maxlength="50" readonly class="form-control" title='Дата распределения'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.allocations.destroy', $allocationsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.allocations.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.allocations.edit', $allocationsList->id) }}">{{ __('Изменить') }}</a>
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