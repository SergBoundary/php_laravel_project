@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\PhraseLists $menu, $title, $phraseListsList
         * @var \Illuminate\Database\Eloquent $phraseListGroupsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.phrase-lists.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.phrase-lists.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='phrase_group_id'>Группа фраз</label>
                                    <div class="input-group mb-3"
>                                        <select name='phrase_group_id' value='phrase_group_id' id='phrase_group_id' type='text' placeholder="Группа фраз" class="form-control" title='Группа фраз' required>
                                            @foreach($phraseListGroupsList as $phraseListGroupsOption)
                                            <option value="{{ $phrase_list_groupsOption->id }}" >
                                                {{ $phraseListGroupsOption->phrase_group }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.phrase-list-groups.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Текст фразы</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Текст фразы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.phrase-lists.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.phrase-lists.index') }}">{{ __('Отмена') }}</a>
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