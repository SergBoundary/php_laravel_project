@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Objects $menu, $title, $objectsList
         * @var \Illuminate\Database\Eloquent $objectGroupsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.objects.update', $objectsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.objects.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='object_group_id'>Группа объектов</label>
                                    <div class="input-group mb-3"
>                                        <select name='object_group_id' value='{{ $objectsList->object_groups_id }}' id='object_group_id' type='text' placeholder="Группа объектов" class="form-control" title='Группа объектов' required>
                                            @foreach($objectGroupsList as $objectGroupsOption)
                                            <option value="{{ $object_groupsOption->id }}" 
                                                @if($objectGroupsOption->id == $objectsList->object_group_id) selected @endif>
                                                {{ $objectGroupsOption->object_group }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.object-groups.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Объект выполнения работ</label>
                                    <input name='title' value='{{ $objectsList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Объект выполнения работ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Аббривиатура</label>
                                    <input name='abbr' value='{{ $objectsList->abbr }}' id='abbr' type='text' maxlength="50" class="form-control" title='Аббривиатура'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.objects.show', $objectsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.objects.show', $objectsList->id) }}">{{ __('Отмена') }}</a>
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