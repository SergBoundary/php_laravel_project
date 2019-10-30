@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Months $menu, $title, $monthsList */
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
                                    <label for='number'>Номер месяца</label>
                                    <input name='number' value='{{ $monthsList->number }}' id='number' type='text' maxlength="50" readonly class="form-control" title='Номер месяца'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название месяца</label>
                                    <input name='title' value='{{ $monthsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название месяца'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.months.destroy', $monthsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.months.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.months.edit', $monthsList->id) }}">{{ __('Изменить') }}</a>
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