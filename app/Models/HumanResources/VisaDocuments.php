<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета документов работника для получения визы и въезда в страну
 */

class VisaDocuments extends Model
{
    use SoftDeletes;
}
