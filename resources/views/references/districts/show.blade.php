@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Countries $menu, $title, $districtsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>
                    <div class="card-body">

                        <form name="show">
                            @method('PATCH')
                            @csrf
<!--                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp-->
                            <!--@include('references.districts.includes.result_messages')-->
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название страны</label>
                                    <input name='title' value='{{ $districtsList->country }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Наименование страна'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Название области</label>
                                    <input name='national_name' value='{{ $districtsList->title }}' id='national_name' type='text' maxlength="50" readonly class="form-control" title='Наименование области (штата, земли, воевудства)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='symbol_alfa2'>Национальное название</label>
                                    <input name='symbol_alfa3' value='{{ $districtsList->national_name }}' id='symbol_alfa3' type='text' maxlength="8" readonly class="form-control" title='Национальное наименование областии (штата, земли, воевудства)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number_iso'>Код страны ISO</label>
                                    <input name='number_iso' value='{{ $districtsList->number_iso }}' id='number_iso' type='text' maxlength="8" readonly class="form-control" title='Международный код области (штата, земли, воевудства)'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                                <div class='form-group col-md-10'>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.districts.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.districts.edit', $districtsList->id) }}">{{ __('Изменить') }}</a>
                                    <form name="delete" method="POST" action="{{ route('ref.districts.destroy', $districtsList->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>            
@endsection