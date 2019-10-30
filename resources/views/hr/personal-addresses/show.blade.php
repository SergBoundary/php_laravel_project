@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalAddresses $menu, $title, $personalAddressesList */
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
                                    <input name='personal_card' value='{{ $personalAddressesList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='postcode'>Индекс</label>
                                    <input name='postcode' value='{{ $personalAddressesList->postcode }}' id='postcode' type='text' maxlength="50" readonly class="form-control" title='Индекс'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='city'>Город</label>
                                    <input name='city' value='{{ $personalAddressesList->city }}' id='city' type='text' maxlength="50" readonly class="form-control" title='Город'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='street'>Улица</label>
                                    <input name='street' value='{{ $personalAddressesList->street }}' id='street' type='text' maxlength="50" readonly class="form-control" title='Улица'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='house'>Дом</label>
                                    <input name='house' value='{{ $personalAddressesList->house }}' id='house' type='text' maxlength="50" readonly class="form-control" title='Дом'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='apartment'>Квартира</label>
                                    <input name='apartment' value='{{ $personalAddressesList->apartment }}' id='apartment' type='text' maxlength="50" readonly class="form-control" title='Квартира'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.personal-addresses.destroy', $personalAddressesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-addresses.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-addresses.edit', $personalAddressesList->id) }}">{{ __('Изменить') }}</a>
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