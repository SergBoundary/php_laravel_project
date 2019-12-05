@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Teams $menu, $title, $teamsList */
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
                                    <input name='personal_card' value='{{ $teamsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название бригады</label>
                                    <input name='title' value='{{ $teamsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название бригады'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Аббривиатура</label>
                                    <input name='abbr' value='{{ $teamsList->abbr }}' id='abbr' type='text' maxlength="50" readonly class="form-control" title='Аббривиатура'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Сформирована</label>
                                    <input name='start' value='{{ $teamsList->start }}' id='start' type='text' maxlength="50" readonly class="form-control" title='Сформирована'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Расформирована</label>
                                    <input name='expiry' value='{{ $teamsList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Расформирована'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
                        <form name="delete" method="POST" action="{{ route('hr.teams.destroy', $teamsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.teams.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.teams.edit', $teamsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('hr.teams.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection