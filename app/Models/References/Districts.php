<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка областей (штатов, земель, воеводств)
 */

class Districts extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'country_id',
        'title',
        'national_name',
        'number_iso',  
    ];
    
    /**
     * Страна
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country() {
        // Запись принадлежит country
        return $this->belongsTo(Countries::class);
    }
}
