@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\Documents $menu, $title, $documentsList */
        $documents = "";
        $documentTypes = "";
        $personalCards = "";
        $users = "";
        $users = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($documentsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="6">Номер документа</th>
                        <th class="align-middle" scope="col">Дата выписки документа</th>
                        <th class="align-middle" scope="col">Аннотация к документу</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.documents.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($documentsList as $documentsRow)
                        @if ($documents != $documentsRow->document)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em> {{ $documentsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($documentTypes != $documentsRow->document_type)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>  {{ $documentsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($personalCards != $documentsRow->personal_card)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>   {{ $documentsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($users != $documentsRow->create_user)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>    {{ $documentsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($users != $documentsRow->editor_user)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>     {{ $documentsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $documentsRow->number }}</td>
                            <td>{{ $documentsRow->date }}</td>
                            <td>{{ $documentsRow->annotation }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.documents.destroy', $documentsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.documents.show', $documentsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.documents.edit', $documentsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $documents = $documentsRow->document;
                            $documentTypes = $documentsRow->document_type;
                            $personalCards = $documentsRow->personal_card;
                            $users = $documentsRow->create_user;
                            $users = $documentsRow->editor_user;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.documents.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection