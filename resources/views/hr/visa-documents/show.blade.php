@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\VisaDocuments $menu, $title, $visaDocumentsList */
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
                                    <input name='personal_card' value='{{ $visaDocumentsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='visa_status'>Запись в учете виз</label>
                                    <input name='visa_status' value='{{ $visaDocumentsList->visa_status }}' id='visa_status' type='text' maxlength="50" readonly class="form-control" title='Запись в учете виз'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='type'>Вид документа</label>
                                    <input name='type' value='{{ $visaDocumentsList->type }}' id='type' type='text' maxlength="50" readonly class="form-control" title='Вид документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер документа</label>
                                    <input name='number' value='{{ $visaDocumentsList->number }}' id='number' type='text' maxlength="50" readonly class="form-control" title='Номер документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_issue'>Дата выдачи документа</label>
                                    <input name='date_issue' value='{{ $visaDocumentsList->date_issue }}' id='date_issue' type='text' maxlength="50" readonly class="form-control" title='Дата выдачи документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_expiration'>Дата окончания действия документа</label>
                                    <input name='date_expiration' value='{{ $visaDocumentsList->date_expiration }}' id='date_expiration' type='text' maxlength="50" readonly class="form-control" title='Дата окончания действия документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_inclusion'>Дата включения документа в пакет</label>
                                    <input name='date_inclusion' value='{{ $visaDocumentsList->date_inclusion }}' id='date_inclusion' type='text' maxlength="50" readonly class="form-control" title='Дата включения документа в пакет'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_seizure'>Дата изъятия документа из пакета</label>
                                    <input name='date_seizure' value='{{ $visaDocumentsList->date_seizure }}' id='date_seizure' type='text' maxlength="50" readonly class="form-control" title='Дата изъятия документа из пакета'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.visa-documents.destroy', $visaDocumentsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.visa-documents.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.visa-documents.edit', $visaDocumentsList->id) }}">{{ __('Изменить') }}</a>
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