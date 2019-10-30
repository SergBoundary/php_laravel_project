@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\CurrencyKurses $menu, $title, $currencyKursesList */
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
                                    <label for='base currency'>Базовая валюта</label>
                                    <input name='base currency' value='{{ $currencyKursesList->base currency }}' id='base currency' type='text' maxlength="50" readonly class="form-control" title='Базовая валюта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='quoted currency'>Котируемая валюта</label>
                                    <input name='quoted currency' value='{{ $currencyKursesList->quoted currency }}' id='quoted currency' type='text' maxlength="50" readonly class="form-control" title='Котируемая валюта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='scale'>Масштаб котировки</label>
                                    <input name='scale' value='{{ $currencyKursesList->scale }}' id='scale' type='text' maxlength="50" readonly class="form-control" title='Масштаб котировки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='residual'>Курс</label>
                                    <input name='residual' value='{{ $currencyKursesList->residual }}' id='residual' type='text' maxlength="50" readonly class="form-control" title='Курс'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='bay'>Покупка</label>
                                    <input name='bay' value='{{ $currencyKursesList->bay }}' id='bay' type='text' maxlength="50" readonly class="form-control" title='Покупка'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sell'>Продажа</label>
                                    <input name='sell' value='{{ $currencyKursesList->sell }}' id='sell' type='text' maxlength="50" readonly class="form-control" title='Продажа'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.currency-kurses.destroy', $currencyKursesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.currency-kurses.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.currency-kurses.edit', $currencyKursesList->id) }}">{{ __('Изменить') }}</a>
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