<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Базовый контроллер финансового учета
 */

abstract class BaseAccountingController extends Controller
{
    /**
     * BaseAccountingController constructor
     */
    public function __construct() {
        
    }
}
