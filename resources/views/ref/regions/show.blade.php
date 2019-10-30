@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Regions $menu, $title, $regionsList */
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
                                    <input name='country' value='{{ $regionsList->country }}' id='country' type='text' maxlength="50" readonly class="form-control" title='Название страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='district'>Название области</label>
                                    <input name='district' value='{{ $regionsList->district }}' id='district' type='text' maxlength="50" readonly class="form-control" title='Название области'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название района</label>
                                    <input name='title' value='{{ $regionsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название района'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Национальное название района</label>
                                    <input name='national_name' value='{{ $regionsList->national_name }}' id='national_name' type='text' maxlength="50" readonly class="form-control" title='Национальное название района'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.regions.destroy', $regionsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.regions.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.regions.edit', $regionsList->id) }}">{{ __('Изменить') }}</a>
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