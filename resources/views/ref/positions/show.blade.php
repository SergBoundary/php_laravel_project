@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Positions $menu, $title, $positionsList */
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
                                    <label for='subordination'>Уровень управления</label>
                                    <input name='subordination' value='{{ $positionsList->subordination }}' id='subordination' type='text' maxlength="50" readonly class="form-control" title='Уровень управления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_profession'>Профессия в классификаторе</label>
                                    <input name='position_profession' value='{{ $positionsList->position_profession }}' id='position_profession' type='text' maxlength="50" readonly class="form-control" title='Профессия в классификаторе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_category'>Категория профессии</label>
                                    <input name='position_category' value='{{ $positionsList->position_category }}' id='position_category' type='text' maxlength="50" readonly class="form-control" title='Категория профессии'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название должности</label>
                                    <input name='title' value='{{ $positionsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название должности'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.positions.destroy', $positionsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.positions.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.positions.edit', $positionsList->id) }}">{{ __('Изменить') }}</a>
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