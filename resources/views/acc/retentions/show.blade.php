@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\Retentions $menu, $title, $retentionsList */
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
                                    <input name='personal_card' value='{{ $retentionsList->personal_card }}, {{ $retentionsList->surname }} {{ $retentionsList->first_name }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год</label>
                                    <input name='year' value='{{ $retentionsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц</label>
                                    <input name='month' value='{{ $retentionsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_type'>Вид удержания</label>
                                    <input name='retention_type' value='{{ $retentionsList->retention_type }}, {{ $retentionsList->retention_description }}' id='retention_type' type='text' maxlength="50" readonly class="form-control" title='Вид удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма удержания</label>
                                    <input name='amount' value='{{ $retentionsList->amount }}' id='amount' type='text' maxlength="50" readonly class="form-control" title='Сумма удержания'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
                        <form name="delete" method="POST" action="{{ route('acc.retentions.destroy', $retentionsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.retentions.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.retentions.edit', $retentionsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('acc.retentions.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection