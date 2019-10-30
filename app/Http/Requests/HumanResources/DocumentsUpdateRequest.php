<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DocumentsUpdateRequest: Правила записи кадровых документов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class DocumentsUpdateRequest extends FormRequest {

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
            'document_id' => 'required|integer|exists:documents,id',
            'number' => 'required|string|max:10',
            'date' => 'required|date',
            'annotation' => 'required|string|max:100',
            'description' => 'required|string',
            'print' => 'required|boolean',
            'document_type_id' => 'required|integer|exists:document_types,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'create_user_id' => 'required|integer|exists:users,id',
            'editor_user_id' => 'required|integer|exists:users,id',
        ];
    }
}