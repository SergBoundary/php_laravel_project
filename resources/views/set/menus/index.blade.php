@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Settings\Menus $menu, $title, $menusList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($menusList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Код меню верхнего уровня: 0 - "гостевая страница" с роутом "/"</th>
                        <th class="align-middle" scope="col">Название пункта меню</th>
                        <th class="align-middle" scope="col">Путь к представлению</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.menus.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($menusList as $menusRow)
                        <tr>
                            <td>{{ $menusRow->parent }}</td>
                            <td>{{ $menusRow->name }}</td>
                            <td>{{ $menusRow->path }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('set.menus.destroy', $menusRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.menus.show', $menusRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.menus.edit', $menusRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.menus.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection