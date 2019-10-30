@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\LogAccrualErrors $menu, $title, $logAccrualErrorsList */
        $personalCards = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($logAccrualErrorsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Сообщение об ошибке</th>
                        <th class="align-middle" scope="col">Статус ошибки</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.log-accrual-errors.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($logAccrualErrorsList as $logAccrualErrorsRow)
                        @if ($personalCards != $logAccrualErrorsRow->personal_card)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em> {{ $logAccrualErrorsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $logAccrualErrorsRow->message }}</td>
                            <td>{{ $logAccrualErrorsRow->error_type }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.log-accrual-errors.destroy', $logAccrualErrorsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.log-accrual-errors.show', $logAccrualErrorsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.log-accrual-errors.edit', $logAccrualErrorsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $logAccrualErrorsRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.log-accrual-errors.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection