@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\VisaDocuments $menu, $title, $visaDocumentsList */
        $personalCards = "";
        $visaStatuses = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($visaDocumentsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Вид документа</th>
                        <th class="align-middle" scope="col">Номер документа</th>
                        <th class="align-middle" scope="col">Дата выдачи документа</th>
                        <th class="align-middle" scope="col">Дата включения документа в пакет</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.visa-documents.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($visaDocumentsList as $visaDocumentsRow)
                        @if ($personalCards != $visaDocumentsRow->personal_card)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $visaDocumentsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($visaStatuses != $visaDocumentsRow->visa_status)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $visaDocumentsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $visaDocumentsRow->type }}</td>
                            <td>{{ $visaDocumentsRow->number }}</td>
                            <td>{{ $visaDocumentsRow->date_issue }}</td>
                            <td>{{ $visaDocumentsRow->date_inclusion }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.visa-documents.destroy', $visaDocumentsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.visa-documents.show', $visaDocumentsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.visa-documents.edit', $visaDocumentsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $visaDocumentsRow->personal_card;
                            $visaStatuses = $visaDocumentsRow->visa_status;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.visa-documents.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection