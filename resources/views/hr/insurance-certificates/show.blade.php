@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\InsuranceCertificates $menu, $title, $insuranceCertificatesList */
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
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $insuranceCertificatesList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='certificate_series'>Серия свидетельства</label>
                                    <input name='certificate_series' value='{{ $insuranceCertificatesList->certificate_series }}' id='certificate_series' type='text' maxlength="50" readonly class="form-control" title='Серия свидетельства'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='certificate_number'>Номер свидетельства</label>
                                    <input name='certificate_number' value='{{ $insuranceCertificatesList->certificate_number }}' id='certificate_number' type='text' maxlength="50" readonly class="form-control" title='Номер свидетельства'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='insurance_fee'>Сумма взноса</label>
                                    <input name='insurance_fee' value='{{ $insuranceCertificatesList->insurance_fee }}' id='insurance_fee' type='text' maxlength="50" readonly class="form-control" title='Сумма взноса'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='certificate_expiry'>Истечение срока действия</label>
                                    <input name='certificate_expiry' value='{{ $insuranceCertificatesList->certificate_expiry }}' id='certificate_expiry' type='text' maxlength="50" readonly class="form-control" title='Истечение срока действия'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.insurance-certificates.destroy', $insuranceCertificatesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.insurance-certificates.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.insurance-certificates.edit', $insuranceCertificatesList->id) }}">{{ __('Изменить') }}</a>
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