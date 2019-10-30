@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\CalculationGroups $menu, $title, $calculationGroupsList */
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
                                    <label for='accrual_groups'>Группа начиления</label>
                                    <input name='accrual_groups' value='{{ $calculationGroupsList->accrual_groups }}' id='accrual_groups' type='text' maxlength="50" readonly class="form-control" title='Группа начиления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Вид начиcления</label>
                                    <input name='accrual' value='{{ $calculationGroupsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начиcления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_attribute'>Признак использования</label>
                                    <input name='calculation_attribute' value='{{ $calculationGroupsList->calculation_attribute }}' id='calculation_attribute' type='text' maxlength="50" readonly class="form-control" title='Признак использования'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.calculation-groups.destroy', $calculationGroupsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.calculation-groups.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.calculation-groups.edit', $calculationGroupsList->id) }}">{{ __('Изменить') }}</a>
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