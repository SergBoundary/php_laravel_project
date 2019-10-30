@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\TaxScales $menu, $title, $taxScalesList */
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
                                    <label for='title'>Описание диапазона</label>
                                    <input name='title' value='{{ $taxScalesList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Описание диапазона'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='lower amount'>Нижняя сумма диапазона</label>
                                    <input name='lower amount' value='{{ $taxScalesList->lower amount }}' id='lower amount' type='text' maxlength="50" readonly class="form-control" title='Нижняя сумма диапазона'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='top amount'>Верхняя сумма диапазона</label>
                                    <input name='top amount' value='{{ $taxScalesList->top amount }}' id='top amount' type='text' maxlength="50" readonly class="form-control" title='Верхняя сумма диапазона'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax percentage'>Процент налога</label>
                                    <input name='tax percentage' value='{{ $taxScalesList->tax percentage }}' id='tax percentage' type='text' maxlength="50" readonly class="form-control" title='Процент налога'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.tax-scales.destroy', $taxScalesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.tax-scales.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.tax-scales.edit', $taxScalesList->id) }}">{{ __('Изменить') }}</a>
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