@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Currencies $menu, $title, $currenciesList */
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
                                    <label for='title'>Название валюты</label>
                                    <input name='title' value='{{ $currenciesList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название валюты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='symbol'>Символ валюты</label>
                                    <input name='symbol' value='{{ $currenciesList->symbol }}' id='symbol' type='text' maxlength="50" readonly class="form-control" title='Символ валюты'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.currencies.destroy', $currenciesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.currencies.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.currencies.edit', $currenciesList->id) }}">{{ __('Изменить') }}</a>
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