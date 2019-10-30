<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BaseTimesheetsCreateRequest: Правила записи отработанного времени (табель)
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class BaseTimesheetsCreateRequest extends FormRequest {

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
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'accrual_id' => 'required|integer|exists:accruals,id',
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
            'hours_balance_classifier_id' => 'required|integer|exists:hours_balance_classifiers,id',
            'department_id' => 'required|integer|exists:departments,id',
            'amount' => 'required|numeric',
            'actual_days' => 'required|integer',
            'vacation_days' => 'required|integer',
            'childbirth_leave' => 'required|integer',
            'sick_days' => 'required|integer',
            'other_days' => 'required|integer',
            'unpaid_leave' => 'required|integer',
            'absense from work' => 'required|integer',
            'weekend' => 'required|integer',
            'holidays' => 'required|integer',
            'hours' => 'required|numeric',
            'night_hours' => 'required|numeric',
            'overtime' => 'required|numeric',
            'account_id' => 'required|integer|exists:accounts,id',
            'position_id' => 'required|integer|exists:positions,id',
            'object_id' => 'required|integer|exists:objects,id',
        ];
    }
}