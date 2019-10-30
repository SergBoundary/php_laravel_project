@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\EmployeeFamilies $menu, $title, $employeeFamiliesList */
        $personalCards = "";
        $familyRelationTypes = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($employeeFamiliesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Фамилия</th>
                        <th class="align-middle" scope="col">Имя (первое имя)</th>
                        <th class="align-middle" scope="col">Дата рождения</th>
                        <th class="align-middle" scope="col">Пол</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.employee-families.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($employeeFamiliesList as $employeeFamiliesRow)
                        @if ($personalCards != $employeeFamiliesRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $employeeFamiliesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($familyRelationTypes != $employeeFamiliesRow->family_relation_type)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $employeeFamiliesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $employeeFamiliesRow->surname }}</td>
                            <td>{{ $employeeFamiliesRow->first_name }}</td>
                            <td>{{ $employeeFamiliesRow->born_date }}</td>
                            <td>{{ $employeeFamiliesRow->sex }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.employee-families.destroy', $employeeFamiliesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.employee-families.show', $employeeFamiliesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.employee-families.edit', $employeeFamiliesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $employeeFamiliesRow->personal_card;
                            $familyRelationTypes = $employeeFamiliesRow->family_relation_type;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.employee-families.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection