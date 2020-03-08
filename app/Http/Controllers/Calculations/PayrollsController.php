<?php

namespace App\Http\Controllers\Calculations;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Calculations\Payrolls;
use App\Repositories\Calculations\PayrollsRepository;
use App\Http\Requests\Calculations\PayrollsCreateRequest;
use App\Http\Requests\Calculations\PayrollsUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class PayrollsController: Контроллер обслуживания расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Calculations
 */
class PayrollsController extends BaseCalculationsController {

    /**
     * @var PayrollsRepository
     */
    private $payrollsRepository;

    /**
     * @var path
     */
    private $path = 'calc/payrolls';

    public function __construct() {

        parent::__construct();

        $this->payrollsRepository = app(PayrollsRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest', compact('interface'));
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Расчетная ведомость";

        $payrollsList = $this->payrollsRepository->getTable();

        return view('calc.payrolls.index',  
               compact('menu', 'interface', 'title', 'access', 'payrollsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest', compact('interface'));
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка заполняемых полей input
        $payrollsList = $this->payrollsRepository->getShow($id);

        return view('calc.payrolls.show', 
               compact('menu', 'interface', 'title', 'access', 'payrollsList'));
    }

    /**
     * Метод создания представления новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->payrollsRepository->getListSelect(0);
        $yearsList = $this->payrollsRepository->getListSelect(1);
        $monthsList = $this->payrollsRepository->getListSelect(2);

        return view('calc.payrolls.create', 
               compact('menu', 'interface', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollsCreateRequest $request) {

        $data = $request->input();

        $result = (new Payrolls($data))->create($data);

        if($result) {
            return redirect()
                ->route('calc.payrolls.edit', $result->id)
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }

    /**
     * Метод создания представления изменения
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->payrollsRepository->getListSelect(0);
        $yearsList = $this->payrollsRepository->getListSelect(1);
        $monthsList = $this->payrollsRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $payrollsList = $this->payrollsRepository->getEdit($id);

        return view('calc.payrolls.edit', 
               compact('menu', 'interface', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'payrollsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PayrollsUpdateRequest $request, $id) {

        $item = $this->payrollsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('calc.payrolls.edit', $item->id)
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }

    /**
     * Удаление выбранной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $result = $this->payrollsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('calc.payrolls.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}