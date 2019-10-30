@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\DocumentTypes $menu, $title, $documentTypesList */
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
                                    <label for='title'>Название документа</label>
                                    <input name='title' value='{{ $documentTypesList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Абривиатура документа</label>
                                    <input name='abbr' value='{{ $documentTypesList->abbr }}' id='abbr' type='text' maxlength="50" readonly class="form-control" title='Абривиатура документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='standart_status'>Стандартный документ</label>
                                    <input name='standart_status' value='{{ $documentTypesList->standart_status }}' id='standart_status' type='text' maxlength="50" readonly class="form-control" title='Стандартный документ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='standart_number'>Неизменная часть номера документа</label>
                                    <input name='standart_number' value='{{ $documentTypesList->standart_number }}' id='standart_number' type='text' maxlength="50" readonly class="form-control" title='Неизменная часть номера документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='template_form'>Название и адрес формы ввода данных</label>
                                    <input name='template_form' value='{{ $documentTypesList->template_form }}' id='template_form' type='text' maxlength="50" readonly class="form-control" title='Название и адрес формы ввода данных'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='template_view'>Название и адрес view-шаблона документа</label>
                                    <input name='template_view' value='{{ $documentTypesList->template_view }}' id='template_view' type='text' maxlength="50" readonly class="form-control" title='Название и адрес view-шаблона документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='template_print'>Название и адрес pdf-шаблона документа</label>
                                    <input name='template_print' value='{{ $documentTypesList->template_print }}' id='template_print' type='text' maxlength="50" readonly class="form-control" title='Название и адрес pdf-шаблона документа'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.document-types.destroy', $documentTypesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.document-types.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.document-types.edit', $documentTypesList->id) }}">{{ __('Изменить') }}</a>
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