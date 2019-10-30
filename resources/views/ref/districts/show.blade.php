@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Districts $menu, $title, $districtsList */
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
                                    <input name='country' value='{{ $districtsList->country }}' id='country' type='text' maxlength="50" readonly class="form-control" title='Название страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название области</label>
                                    <input name='title' value='{{ $districtsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название области'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Национальное название области</label>
                                    <input name='national_name' value='{{ $districtsList->national_name }}' id='national_name' type='text' maxlength="50" readonly class="form-control" title='Национальное название области'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number_iso'>Код области</label>
                                    <input name='number_iso' value='{{ $districtsList->number_iso }}' id='number_iso' type='text' maxlength="50" readonly class="form-control" title='Код области'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.districts.destroy', $districtsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.districts.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.districts.edit', $districtsList->id) }}">{{ __('Изменить') }}</a>
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