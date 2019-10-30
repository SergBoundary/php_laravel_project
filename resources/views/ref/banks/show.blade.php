@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Banks $menu, $title, $banksList */
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
                                    <label for='country'>Название страны</label>
                                    <input name='country' value='{{ $banksList->country }}' id='country' type='text' maxlength="50" readonly class="form-control" title='Название страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название банка</label>
                                    <input name='title' value='{{ $banksList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название банка'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='commission'>Комиссия зачисления</label>
                                    <input name='commission' value='{{ $banksList->commission }}' id='commission' type='text' maxlength="50" readonly class="form-control" title='Комиссия зачисления'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.banks.destroy', $banksList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.banks.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.banks.edit', $banksList->id) }}">{{ __('Изменить') }}</a>
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