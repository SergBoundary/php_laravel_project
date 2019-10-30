@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\Menus $menu, $title, $menusList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('set.menus.update', $menusList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('set.menus.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='parent_id'>Код меню верхнего уровня: 0 - "гостевая страница" с роутом "/"</label>
                                    <input name='parent_id' value='{{ $menusList->parent_id }}' id='parent_id' type='text' maxlength="50" class="form-control" title='Код меню верхнего уровня: 0 - "гостевая страница" с роутом "/"'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sort'>Порядок сортировки пунктов меню</label>
                                    <input name='sort' value='{{ $menusList->sort }}' id='sort' type='text' maxlength="50" class="form-control" title='Порядок сортировки пунктов меню'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='name'>Название пункта меню</label>
                                    <input name='name' value='{{ $menusList->name }}' id='name' type='text' maxlength="50" class="form-control" title='Название пункта меню'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='path'>Путь к представлению</label>
                                    <input name='path' value='{{ $menusList->path }}' id='path' type='text' maxlength="50" class="form-control" title='Путь к представлению'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='access_0'>Право доступа администратора</label>
                                    <input name='access_0' value='{{ $menusList->access_0 }}' id='access_0' type='text' maxlength="50" class="form-control" title='Право доступа администратора'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='access_1'>Право доступа руководителя</label>
                                    <input name='access_1' value='{{ $menusList->access_1 }}' id='access_1' type='text' maxlength="50" class="form-control" title='Право доступа руководителя'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='access_2'>Право доступа специалиста</label>
                                    <input name='access_2' value='{{ $menusList->access_2 }}' id='access_2' type='text' maxlength="50" class="form-control" title='Право доступа специалиста'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='access_3'>Право доступаработник</label>
                                    <input name='access_3' value='{{ $menusList->access_3 }}' id='access_3' type='text' maxlength="50" class="form-control" title='Право доступаработник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.menus.show', $menusList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.menus.show', $menusList->id) }}">{{ __('Отмена') }}</a>
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