@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Positions $menu, $title, $positionsList
         * @var \Illuminate\Database\Eloquent $subordinationsList, $positionProfessionsList, $positionCategoriesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.positions.update', $positionsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.positions.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='subordination_id'>Уровень управления</label>
                                    <div class="input-group mb-3"
>                                        <select name='subordination_id' value='{{ $positionsList->subordinations_id }}' id='subordination_id' type='text' placeholder="Уровень управления" class="form-control" title='Уровень управления' required>
                                            @foreach($subordinationsList as $subordinationsOption)
                                            <option value="{{ $subordinationsOption->id }}" 
                                                @if($subordinationsOption->id == $positionsList->subordination_id) selected @endif>
                                                {{ $subordinationsOption->subordination }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.subordinations.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_profession_id'>Профессия в классификаторе</label>
                                    <div class="input-group mb-3"
>                                        <select name='position_profession_id' value='{{ $positionsList->position_professions_id }}' id='position_profession_id' type='text' placeholder="Профессия в классификаторе" class="form-control" title='Профессия в классификаторе' required>
                                            @foreach($positionProfessionsList as $positionProfessionsOption)
                                            <option value="{{ $position_professionsOption->id }}" 
                                                @if($positionProfessionsOption->id == $positionsList->position_profession_id) selected @endif>
                                                {{ $positionProfessionsOption->position_profession }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.position-professions.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_category_id'>Категория профессии</label>
                                    <div class="input-group mb-3"
>                                        <select name='position_category_id' value='{{ $positionsList->position_categories_id }}' id='position_category_id' type='text' placeholder="Категория профессии" class="form-control" title='Категория профессии' required>
                                            @foreach($positionCategoriesList as $positionCategoriesOption)
                                            <option value="{{ $position_categoriesOption->id }}" 
                                                @if($positionCategoriesOption->id == $positionsList->position_category_id) selected @endif>
                                                {{ $positionCategoriesOption->position_category }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.position-categories.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название должности</label>
                                    <input name='title' value='{{ $positionsList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Название должности'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.positions.show', $positionsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.positions.show', $positionsList->id) }}">{{ __('Отмена') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection