@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\LogAccrualErrors $menu, $title, $logAccrualErrorsList */
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
                                    <input name='personal_card' value='{{ $logAccrualErrorsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='message'>Сообщение об ошибке</label>
                                    <input name='message' value='{{ $logAccrualErrorsList->message }}' id='message' type='text' maxlength="50" readonly class="form-control" title='Сообщение об ошибке'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='error_type'>Статус ошибки</label>
                                    <input name='error_type' value='{{ $logAccrualErrorsList->error_type }}' id='error_type' type='text' maxlength="50" readonly class="form-control" title='Статус ошибки'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.log-accrual-errors.destroy', $logAccrualErrorsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.log-accrual-errors.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.log-accrual-errors.edit', $logAccrualErrorsList->id) }}">{{ __('Изменить') }}</a>
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