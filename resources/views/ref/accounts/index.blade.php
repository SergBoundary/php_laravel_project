@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Accounts $menu, $title, $accountsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($accountsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Код счета</th>
                        <th class="align-middle" scope="col">Название счета</th>
                        <th class="align-middle" scope="col">Счет валютный</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accounts.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($accountsList as $accountsRow)
                        <tr>
                            <td>{{ $accountsRow->title }}</td>
                            <td>{{ $accountsRow->description }}</td>
                            <td>{{ $accountsRow->currency_status }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.accounts.destroy', $accountsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accounts.show', $accountsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accounts.edit', $accountsRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accounts.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection