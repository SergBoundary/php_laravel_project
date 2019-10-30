@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\LastJobs $menu, $title, $lastJobsList */
        $personalCards = "";
        $positionProfessions = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($lastJobsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Последнее место работы</th>
                        <th class="align-middle" scope="col">Дата увольнения</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.last-jobs.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($lastJobsList as $lastJobsRow)
                        @if ($personalCards != $lastJobsRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $lastJobsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positionProfessions != $lastJobsRow->position_profession)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $lastJobsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $lastJobsRow->last_job }}</td>
                            <td>{{ $lastJobsRow->dismissal_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.last-jobs.destroy', $lastJobsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.last-jobs.show', $lastJobsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.last-jobs.edit', $lastJobsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $lastJobsRow->personal_card;
                            $positionProfessions = $lastJobsRow->position_profession;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.last-jobs.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection