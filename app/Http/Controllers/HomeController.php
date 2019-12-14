<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Home;
use App\Repositories\Settings\HomeRepository;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * @var PersonalCardsRepository
     */
    private $homeRepository;
    
    public function __construct()
    {
        $this->middleware('auth');

        $this->homeRepository = app(HomeRepository::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        
        $user = Auth::user();
        
        $title ="Кабинет пользователя";
        
        $personalCardsData = $this->homeRepository->getPersonalActuality($user['id']);
        $manningOrderData = $this->homeRepository->getManningOrderActuality($user['id']);
        $allocationData = $this->homeRepository->getAllocationActuality($user['id']);
        $manningOrderList = $this->homeRepository->getManningOrderHistory($user['id']);
        $allocationList = $this->homeRepository->getAllocationHistory($user['id']);
        $manningOrderCount = $this->homeRepository->getManningOrderCount($user['id']);
        $allocationCount = $this->homeRepository->getAllocationCount($user['id']);

        return view('user', 
               compact('user', 'title', 
                       'personalCardsData', 
                       'manningOrderData', 
                       'allocationData', 
                       'manningOrderList', 
                       'allocationList', 
                       'manningOrderCount', 
                       'allocationCount'
                       ));
    }
}
