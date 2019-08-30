<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка бухгалтерских счетов
 */

class Accounts extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'account_balance_type',
        'balance_type',
        'task',
        'currency_status',
        'transaction_report',
        'choose_account',
        'inventory',
        'inventory_write_off',
        'clients',
        'account_objects',
        'fixed_assets',
        'main_warehouse',
        'amount_type',
        'type',
        'gross_costs',
    ];
}
