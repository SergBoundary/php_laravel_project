@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\Pieceworks $menu, $title, $pieceworksList */
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
                                    <input name='personal_card' value='{{ $pieceworksList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год</label>
                                    <input name='year' value='{{ $pieceworksList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц</label>
                                    <input name='month' value='{{ $pieceworksList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект выполнения работ</label>
                                    <input name='object' value='{{ $pieceworksList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект выполнения работ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='type'>Вид работы</label>
                                    <input name='type' value='{{ $pieceworksList->type }}' id='type' type='text' maxlength="50" readonly class="form-control" title='Вид работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='unit'>Единица измерения</label>
                                    <input name='unit' value='{{ $pieceworksList->unit }}' id='unit' type='text' maxlength="50" readonly class="form-control" title='Единица измерения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='quantity'>Количество выполных работ</label>
                                    <input name='quantity' value='{{ $pieceworksList->quantity }}' id='quantity' type='text' maxlength="50" readonly class="form-control" title='Количество выполных работ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='price'>Цена единицы</label>
                                    <input name='price' value='{{ $pieceworksList->price }}' id='price' type='text' maxlength="50" readonly class="form-control" title='Цена единицы'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
						<form name="delete" method="POST" action="{{ route('acc.pieceworks.destroy', $pieceworksList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.pieceworks.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.pieceworks.edit', $pieceworksList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('acc.pieceworks.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection