@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Settings\CompanyData $menu, $title, $companyDataList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($companyDataList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название реквизита</th>
                        <th class="align-middle" scope="col">Краткое описание</th>
                        <th class="align-middle" scope="col">Начало действия</th>
                        <th class="align-middle" scope="col">Окончание действия</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.company-data.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($companyDataList as $companyDataRow)
                        <tr>
                            <td>{{ $companyDataRow->title }}</td>
                            <td>{{ $companyDataRow->data_short }}</td>
                            <td>{{ $companyDataRow->start }}</td>
                            <td>{{ $companyDataRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('set.company-data.destroy', $companyDataRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.company-data.show', $companyDataRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.company-data.edit', $companyDataRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.company-data.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection