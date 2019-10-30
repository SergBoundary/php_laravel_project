<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HoursBalanceClassifiersUpdateRequest: Справочник. Классификатор графиков распределения рабочих часов в периоде
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class HoursBalanceClassifiersUpdateRequest extends FormRequest {

    /**
     * Создает реквест, если пользователь авторизован.
     *
     * @return bool
     */
    public function authorize() {
        return auth()->check();
    }

    /**
     * Получает правила проверки данных для реквеста.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|string|max:50',
            'monday_day' => 'required|string|max:5',
            'tuesday_day' => 'required|string|max:5',
            'wednesday_day' => 'required|string|max:5',
            'thursday_day' => 'required|string|max:5',
            'friday_day' => 'required|string|max:5',
            'saturday_day' => 'required|string|max:5',
            'sunday_day' => 'required|string|max:5',
            'hours_reduction' => 'required|string|max:5',
            'hourly_rate' => 'required|numeric',
            'period' => 'required|integer',
            'monday_evening' => 'required|string|max:5',
            'tuesday_evening' => 'required|string|max:5',
            'wednesday_evening' => 'required|string|max:5',
            'thursday_evening' => 'required|string|max:5',
            'friday_evening' => 'required|string|max:5',
            'saturday_evening' => 'required|string|max:5',
            'sunday_evening' => 'required|string|max:5',
            'monday_night' => 'required|string|max:5',
            'tuesday_night' => 'required|string|max:5',
            'wednesday_night' => 'required|string|max:5',
            'thursday_night' => 'required|string|max:5',
            'friday_night' => 'required|string|max:5',
            'saturday_night' => 'required|string|max:5',
            'sunday_night' => 'required|string|max:5',
        ];
    }
}