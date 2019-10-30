@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\WorkExperiences $menu, $title, $workExperiencesList */
        $personalCards = "";
        $positionProfessions = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($workExperiencesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Количество лет стажа до поступления</th>
                        <th class="align-middle" scope="col">Количество месяцев стажа до поступления</th>
                        <th class="align-middle" scope="col">Количество дней стажа до поступления</th>
                        <th class="align-middle" scope="col">Количество дней непрерывного стажа</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.work-experiences.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($workExperiencesList as $workExperiencesRow)
                        @if ($personalCards != $workExperiencesRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $workExperiencesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positionProfessions != $workExperiencesRow->position_profession)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $workExperiencesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $workExperiencesRow->work_experience_years }}</td>
                            <td>{{ $workExperiencesRow->work_experience_months }}</td>
                            <td>{{ $workExperiencesRow->work_experience_days }}</td>
                            <td>{{ $workExperiencesRow->work_experience_continuous }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.work-experiences.destroy', $workExperiencesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.work-experiences.show', $workExperiencesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.work-experiences.edit', $workExperiencesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $workExperiencesRow->personal_card;
                            $positionProfessions = $workExperiencesRow->position_profession;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.work-experiences.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection