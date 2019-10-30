@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Objects $menu, $title, $objectsList */
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
                                    <label for='object_group'>Группа объектов</label>
                                    <input name='object_group' value='{{ $objectsList->object_group }}' id='object_group' type='text' maxlength="50" readonly class="form-control" title='Группа объектов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Объект выполнения работ</label>
                                    <input name='title' value='{{ $objectsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Объект выполнения работ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Аббривиатура</label>
                                    <input name='abbr' value='{{ $objectsList->abbr }}' id='abbr' type='text' maxlength="50" readonly class="form-control" title='Аббривиатура'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.objects.destroy', $objectsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.objects.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.objects.edit', $objectsList->id) }}">{{ __('Изменить') }}</a>
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