@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\InsuranceCertificates $menu, $title, $insuranceCertificatesList */
        $personalCards = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($insuranceCertificatesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Серия свидетельства</th>
                        <th class="align-middle" scope="col">Номер свидетельства</th>
                        <th class="align-middle" scope="col">Сумма взноса</th>
                        <th class="align-middle" scope="col">Истечение срока действия</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.insurance-certificates.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($insuranceCertificatesList as $insuranceCertificatesRow)
                        @if ($personalCards != $insuranceCertificatesRow->personal_card)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $insuranceCertificatesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $insuranceCertificatesRow->certificate_series }}</td>
                            <td>{{ $insuranceCertificatesRow->certificate_number }}</td>
                            <td>{{ $insuranceCertificatesRow->insurance_fee }}</td>
                            <td>{{ $insuranceCertificatesRow->certificate_expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.insurance-certificates.destroy', $insuranceCertificatesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.insurance-certificates.show', $insuranceCertificatesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.insurance-certificates.edit', $insuranceCertificatesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $insuranceCertificatesRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.insurance-certificates.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection