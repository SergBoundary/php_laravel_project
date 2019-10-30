@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Banks $menu, $title, $banksList */
        $countries = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($banksList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Название банка</th>
                        <th class="align-middle" scope="col">Комиссия зачисления</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.banks.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($banksList as $banksRow)
                        @if ($countries != $banksRow->country)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em> {{ $banksRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $banksRow->title }}</td>
                            <td>{{ $banksRow->commission }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.banks.destroy', $banksRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.banks.show', $banksRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.banks.edit', $banksRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $countries = $banksRow->country;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.banks.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection