<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HoursBalancesCreateRequest: Правила записи распределения часов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class HoursBalancesCreateRequest extends FormRequest {

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
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'hours_balance_classifier_id' => 'required|integer|exists:hours_balance_classifiers,id',
            'balance_days' => 'required|integer',
            'balance_hours' => 'required|numeric',
            'day_1' => 'string|max:5',
            'day_2' => 'string|max:5',
            'day_3' => 'string|max:5',
            'day_4' => 'string|max:5',
            'day_5' => 'string|max:5',
            'day_6' => 'string|max:5',
            'day_7' => 'string|max:5',
            'day_8' => 'string|max:5',
            'day_9' => 'string|max:5',
            'day_10' => 'string|max:5',
            'day_11' => 'string|max:5',
            'day_12' => 'string|max:5',
            'day_13' => 'string|max:5',
            'day_14' => 'string|max:5',
            'day_15' => 'string|max:5',
            'day_16' => 'string|max:5',
            'day_17' => 'string|max:5',
            'day_18' => 'string|max:5',
            'day_19' => 'string|max:5',
            'day_20' => 'string|max:5',
            'day_21' => 'string|max:5',
            'day_22' => 'string|max:5',
            'day_23' => 'string|max:5',
            'day_24' => 'string|max:5',
            'day_25' => 'string|max:5',
            'day_26' => 'string|max:5',
            'day_27' => 'string|max:5',
            'day_28' => 'string|max:5',
            'day_29' => 'string|max:5',
            'day_30' => 'string|max:5',
            'day_31' => 'string|max:5',
            'evening_1' => 'string|max:5',
            'evening_2' => 'string|max:5',
            'evening_3' => 'string|max:5',
            'evening_4' => 'string|max:5',
            'evening_5' => 'string|max:5',
            'evening_6' => 'string|max:5',
            'evening_7' => 'string|max:5',
            'evening_8' => 'string|max:5',
            'evening_9' => 'string|max:5',
            'evening_10' => 'string|max:5',
            'evening_11' => 'string|max:5',
            'evening_12' => 'string|max:5',
            'evening_13' => 'string|max:5',
            'evening_14' => 'string|max:5',
            'evening_15' => 'string|max:5',
            'evening_16' => 'string|max:5',
            'evening_17' => 'string|max:5',
            'evening_18' => 'string|max:5',
            'evening_19' => 'string|max:5',
            'evening_20' => 'string|max:5',
            'evening_21' => 'string|max:5',
            'evening_22' => 'string|max:5',
            'evening_23' => 'string|max:5',
            'evening_24' => 'string|max:5',
            'evening_25' => 'string|max:5',
            'evening_26' => 'string|max:5',
            'evening_27' => 'string|max:5',
            'evening_28' => 'string|max:5',
            'evening_29' => 'string|max:5',
            'evening_30' => 'string|max:5',
            'evening_31' => 'string|max:5',
            'night_1' => 'string|max:5',
            'night_2' => 'string|max:5',
            'night_3' => 'string|max:5',
            'night_4' => 'string|max:5',
            'night_5' => 'string|max:5',
            'night_6' => 'string|max:5',
            'night_7' => 'string|max:5',
            'night_8' => 'string|max:5',
            'night_9' => 'string|max:5',
            'night_10' => 'string|max:5',
            'night_11' => 'string|max:5',
            'night_12' => 'string|max:5',
            'night_13' => 'string|max:5',
            'night_14' => 'string|max:5',
            'night_15' => 'string|max:5',
            'night_16' => 'string|max:5',
            'night_17' => 'string|max:5',
            'night_18' => 'string|max:5',
            'night_19' => 'string|max:5',
            'night_20' => 'string|max:5',
            'night_21' => 'string|max:5',
            'night_22' => 'string|max:5',
            'night_23' => 'string|max:5',
            'night_24' => 'string|max:5',
            'night_25' => 'string|max:5',
            'night_26' => 'string|max:5',
            'night_27' => 'string|max:5',
            'night_28' => 'string|max:5',
            'night_29' => 'string|max:5',
            'night_30' => 'string|max:5',
            'night_31' => 'string|max:5',
            'holiday_1' => 'string|max:5',
            'holiday_2' => 'string|max:5',
            'holiday_3' => 'string|max:5',
            'holiday_4' => 'string|max:5',
            'holiday_5' => 'string|max:5',
            'holiday_6' => 'string|max:5',
            'holiday_7' => 'string|max:5',
            'holiday_8' => 'string|max:5',
            'holiday_9' => 'string|max:5',
            'holiday_10' => 'string|max:5',
            'holiday_11' => 'string|max:5',
            'holiday_12' => 'string|max:5',
            'holiday_13' => 'string|max:5',
            'holiday_14' => 'string|max:5',
            'holiday_15' => 'string|max:5',
            'holiday_16' => 'string|max:5',
            'holiday_17' => 'string|max:5',
            'holiday_18' => 'string|max:5',
            'holiday_19' => 'string|max:5',
            'holiday_20' => 'string|max:5',
            'holiday_21' => 'string|max:5',
            'holiday_22' => 'string|max:5',
            'holiday_23' => 'string|max:5',
            'holiday_24' => 'string|max:5',
            'holiday_25' => 'string|max:5',
            'holiday_26' => 'string|max:5',
            'holiday_27' => 'string|max:5',
            'holiday_28' => 'string|max:5',
            'holiday_29' => 'string|max:5',
            'holiday_30' => 'string|max:5',
            'holiday_31' => 'string|max:5',
            'weekends' => 'required|integer',
            'holidays' => 'required|integer',
            'balance_evening' => 'required|numeric',
            'balance_night' => 'required|numeric',
        ];
    }
}