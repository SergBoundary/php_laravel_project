@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Documents $menu, $title, $documentsList */
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
                                    <label for='document'>Номер связанного документа</label>
                                    <input name='document' value='{{ $documentsList->document }}' id='document' type='text' maxlength="50" readonly class="form-control" title='Номер связанного документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер документа</label>
                                    <input name='number' value='{{ $documentsList->number }}' id='number' type='text' maxlength="50" readonly class="form-control" title='Номер документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date'>Дата выписки документа</label>
                                    <input name='date' value='{{ $documentsList->date }}' id='date' type='text' maxlength="50" readonly class="form-control" title='Дата выписки документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='annotation'>Аннотация к документу</label>
                                    <input name='annotation' value='{{ $documentsList->annotation }}' id='annotation' type='text' maxlength="50" readonly class="form-control" title='Аннотация к документу'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание документа</label>
                                    <input name='description' value='{{ $documentsList->description }}' id='description' type='text' maxlength="50" readonly class="form-control" title='Описание документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='print'>Статус печати документа</label>
                                    <input name='print' value='{{ $documentsList->print }}' id='print' type='text' maxlength="50" readonly class="form-control" title='Статус печати документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='document_type'>Тип документа</label>
                                    <input name='document_type' value='{{ $documentsList->document_type }}' id='document_type' type='text' maxlength="50" readonly class="form-control" title='Тип документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $documentsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='create_user'>Автор документа</label>
                                    <input name='create_user' value='{{ $documentsList->create_user }}' id='create_user' type='text' maxlength="50" readonly class="form-control" title='Автор документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='editor_user'>Автор изменения документа</label>
                                    <input name='editor_user' value='{{ $documentsList->editor_user }}' id='editor_user' type='text' maxlength="50" readonly class="form-control" title='Автор изменения документа'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.documents.destroy', $documentsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.documents.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.documents.edit', $documentsList->id) }}">{{ __('Изменить') }}</a>
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