@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Years $menu, $title, $yearsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row col-md-12" style="margin-bottom: -10px">
                            <div class="mr-auto">
                                <h3>{{ $title }}</h3>
                            </div>
                            <div class="ml-auto">
                                @if ($access == 2)
                                <form name="delete" method="POST" action="{{ route('ref.years.destroy', $yearData->id) }}">
                                    <div class="form-row">
                                        <div class='form-group col-md-auto'>
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.years.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.years.edit', $yearData->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @if ($access == 1)
                                <div class="form-row">
                                    <div class='form-group col-md-auto'>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.years.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='number'>Год</label>
                                    <input name='number' value='{{ $yearData->number }}' id='number' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection