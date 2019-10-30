@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalEducations $menu, $title, $personalEducationsList */
        $personalCards = "";
        $educationTypes = "";
        $studyModes = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($personalEducationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Специальность</th>
                        <th class="align-middle" scope="col">Аббривиатура квалификации</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-educations.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($personalEducationsList as $personalEducationsRow)
                        @if ($personalCards != $personalEducationsRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $personalEducationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($educationTypes != $personalEducationsRow->education_type)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $personalEducationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($studyModes != $personalEducationsRow->study_mode)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>   {{ $personalEducationsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $personalEducationsRow->specialty }}</td>
                            <td>{{ $personalEducationsRow->degree_abbr }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.personal-educations.destroy', $personalEducationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-educations.show', $personalEducationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-educations.edit', $personalEducationsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $personalEducationsRow->personal_card;
                            $educationTypes = $personalEducationsRow->education_type;
                            $studyModes = $personalEducationsRow->study_mode;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-educations.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection