@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\TaxScales $menu, $title, $taxScalesList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($taxScalesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Описание диапазона</th>
                        <th class="align-middle" scope="col">Нижняя сумма диапазона</th>
                        <th class="align-middle" scope="col">Верхняя сумма диапазона</th>
                        <th class="align-middle" scope="col">Процент налога</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-scales.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($taxScalesList as $taxScalesRow)
                        <tr>
                            <td>{{ $taxScalesRow->title }}</td>
                            <td>{{ $taxScalesRow->lower amount }}</td>
                            <td>{{ $taxScalesRow->top amount }}</td>
                            <td>{{ $taxScalesRow->tax percentage }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.tax-scales.destroy', $taxScalesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-scales.show', $taxScalesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-scales.edit', $taxScalesRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-scales.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection