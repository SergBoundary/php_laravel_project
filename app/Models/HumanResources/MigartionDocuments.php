<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета документов работника для легализации пребывания в стране
 */

class MigartionDocuments extends Model
{
    use SoftDeletes;
}
