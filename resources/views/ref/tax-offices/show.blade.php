@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\TaxOffices $menu, $title, $taxOfficesList */
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
                                    <label for='country'>Название страны</label>
                                    <input name='country' value='{{ $taxOfficesList->country }}' id='country' type='text' maxlength="50" readonly class="form-control" title='Название страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='district'>Название области</label>
                                    <input name='district' value='{{ $taxOfficesList->district }}' id='district' type='text' maxlength="50" readonly class="form-control" title='Название области'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='region'>Название района</label>
                                    <input name='region' value='{{ $taxOfficesList->region }}' id='region' type='text' maxlength="50" readonly class="form-control" title='Название района'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='city'>Населенный пунк</label>
                                    <input name='city' value='{{ $taxOfficesList->city }}' id='city' type='text' maxlength="50" readonly class="form-control" title='Населенный пунк'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Налоговая инспекция</label>
                                    <input name='title' value='{{ $taxOfficesList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Налоговая инспекция'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.tax-offices.destroy', $taxOfficesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.tax-offices.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.tax-offices.edit', $taxOfficesList->id) }}">{{ __('Изменить') }}</a>
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