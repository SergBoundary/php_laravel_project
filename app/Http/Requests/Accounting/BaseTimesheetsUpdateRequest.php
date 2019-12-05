<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BaseTimesheetsUpdateRequest: Правила записи отработанного времени (табель)
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class BaseTimesheetsUpdateRequest extends FormRequest {

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
            //'personal_card_id' => 'required|integer|exists:personal_cards,id',
            //'year_id' => 'required|integer|exists:years,id',
            //'month_id' => 'required|integer|exists:months,id',
            //'object_id' => 'required|integer|exists:objects,id',
            //'day_1' => 'numeric',
            //'day_2' => 'numeric',
            //'day_3' => 'numeric',
            //'day_4' => 'numeric',
            //'day_5' => 'numeric',
            //'day_6' => 'numeric',
            //'day_7' => 'numeric',
            //'day_8' => 'numeric',
            //'day_9' => 'numeric',
            //'day_10' => 'numeric',
            //'day_11' => 'numeric',
            //'day_12' => 'numeric',
            //'day_13' => 'numeric',
            //'day_14' => 'numeric',
            //'day_15' => 'numeric',
            //'day_16' => 'numeric',
            //'day_17' => 'numeric',
            //'day_18' => 'numeric',
            //'day_19' => 'numeric',
            //'day_20' => 'numeric',
            //'day_21' => 'numeric',
            //'day_22' => 'numeric',
            //'day_23' => 'numeric',
            //'day_24' => 'numeric',
            //'day_25' => 'numeric',
            //'day_26' => 'numeric',
            //'day_27' => 'numeric',
            //'day_28' => 'numeric',
            //'day_29' => 'numeric',
            //'day_30' => 'numeric',
            //'day_31' => 'numeric',
            //'hours' => 'required|numeric',
            //'rate' => 'required|numeric',
            //'hourly' => 'required|numeric',
            //'piecework' => 'required|numeric',
            //'return_fix' => 'required|numeric',
            //'retention_fix' => 'required|numeric',
            //'penalty' => 'required|numeric',
            //'prepaid_expense' => 'required|numeric',
            //'food' => 'required|numeric',
            //'work_clothes' => 'required|numeric',
            //'total' => 'required|numeric',
        ];
    }
}