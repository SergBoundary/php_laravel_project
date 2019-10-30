@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\BorderCrossings $menu, $title, $borderCrossingsList */
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
                                    <input name='personal_card' value='{{ $borderCrossingsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country_out'>Страна выезда</label>
                                    <input name='country_out' value='{{ $borderCrossingsList->country_out }}' id='country_out' type='text' maxlength="50" readonly class="form-control" title='Страна выезда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country_in'>Страна въезда</label>
                                    <input name='country_in' value='{{ $borderCrossingsList->country_in }}' id='country_in' type='text' maxlength="50" readonly class="form-control" title='Страна въезда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date'>Дата пересечения</label>
                                    <input name='date' value='{{ $borderCrossingsList->date }}' id='date' type='text' maxlength="50" readonly class="form-control" title='Дата пересечения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comment'>Примечание</label>
                                    <input name='comment' value='{{ $borderCrossingsList->comment }}' id='comment' type='text' maxlength="50" readonly class="form-control" title='Примечание'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.border-crossings.destroy', $borderCrossingsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.border-crossings.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.border-crossings.edit', $borderCrossingsList->id) }}">{{ __('Изменить') }}</a>
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