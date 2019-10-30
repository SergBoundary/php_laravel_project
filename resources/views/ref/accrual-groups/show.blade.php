@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\AccrualGroups $menu, $title, $accrualGroupsList */
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
                                    <label for='title'>Группа начисления</label>
                                    <input name='title' value='{{ $accrualGroupsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Группа начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание группы расчета</label>
                                    <input name='description' value='{{ $accrualGroupsList->description }}' id='description' type='text' maxlength="50" readonly class="form-control" title='Описание группы расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='type'>Тип начисления</label>
                                    <input name='type' value='{{ $accrualGroupsList->type }}' id='type' type='text' maxlength="50" readonly class="form-control" title='Тип начисления'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.accrual-groups.destroy', $accrualGroupsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.accrual-groups.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.accrual-groups.edit', $accrualGroupsList->id) }}">{{ __('Изменить') }}</a>
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