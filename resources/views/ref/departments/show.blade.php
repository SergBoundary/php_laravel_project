@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Departments $menu, $title, $departmentsList */
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
                                    <label for='department_group'>Группа подразделений</label>
                                    <input name='department_group' value='{{ $departmentsList->department_group }}' id='department_group' type='text' maxlength="50" readonly class="form-control" title='Группа подразделений'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Подразделение</label>
                                    <input name='title' value='{{ $departmentsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Аббривиатура</label>
                                    <input name='abbr' value='{{ $departmentsList->abbr }}' id='abbr' type='text' maxlength="50" readonly class="form-control" title='Аббривиатура'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department_attribute'>Признак</label>
                                    <input name='department_attribute' value='{{ $departmentsList->department_attribute }}' id='department_attribute' type='text' maxlength="50" readonly class="form-control" title='Признак'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='print_order'>Номер очереди печати</label>
                                    <input name='print_order' value='{{ $departmentsList->print_order }}' id='print_order' type='text' maxlength="50" readonly class="form-control" title='Номер очереди печати'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.departments.destroy', $departmentsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.departments.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.departments.edit', $departmentsList->id) }}">{{ __('Изменить') }}</a>
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