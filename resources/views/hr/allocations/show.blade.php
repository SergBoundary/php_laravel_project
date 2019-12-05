@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Allocations $menu, $title, $allocationsList */
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
                                    <label for='personal_card' class="col-form-label col-form-label-sm">Работник</label>
                                    <input name='personal_card' value='{{ $allocationsList->personal_card }}, {{ $allocationsList->surname }} {{ $allocationsList->first_name }}' id='personal_card' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object' class="col-form-label col-form-label-sm">Определен на объект</label>
                                    <input name='object' value='{{ $allocationsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Определен на объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team' class="col-form-label col-form-label-sm">Определен в бригаду</label>
                                    <input name='team' value='{{ $allocationsList->team }}' id='team' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Определен в бригаду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start' class="col-form-label col-form-label-sm">Дата прикрепления</label>
                                    <input name='start' value='{{ $allocationsList->start }}' id='start' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Дата прикрепления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry' class="col-form-label col-form-label-sm">Дата открепления</label>
                                    <input name='expiry' value='{{ $allocationsList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Дата открепления'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
                        <form name="delete" method="POST" action="{{ route('hr.allocations.destroy', $allocationsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.edit', $allocationsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('hr.allocations.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection