<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Charts\OrderChart;
use Carbon\Carbon;
use App\Models\Food;
use App\Models\FoodType;
use App\Models\User;
use App\CentralLogics\Helpers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{

    public function Index(OrderChart $chart){
        $itemsId = Order::where('payment_status', 'confirmed')->pluck('id');
        $tahun = date('Y');
        $bulan = date('m');
        for ($i=1; $i <= $bulan; $i++) {
            $totalPesanan = Order::whereIn('id', $itemsId)->whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('order_amount');
            $dataBulan[] = Helpers::ubahAngkaToBulan($i);
            $dataTotalPesanan[] = $totalPesanan;

        };
        $data['dataBulan'] = $dataBulan;
        $data['dataTotalPesanan'] = $dataTotalPesanan;
        // $data['data'];
        $data['chart'] = $chart->build();
        // $data['order'] = Order::


        $totalRevenue = Order::whereIn('id', $itemsId)->sum('order_amount');


        $totalFoods = Food::count();
        $totalTypeFoods = FoodType::count();

        $totalAllUsers = User::count();
        // $totalUser = User::where('role_id','0')->count();
        // $totalAdmin = User::where('role_id','1')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrders = Order::count();
        $items = Order::all();

        // $totalRevenue = {{ $order->products->sum('order_amount') }};
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $todayMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $todayYearOrder = Order::whereYear('created_at', $thisYear)->count();
        // totalUser,
        // totalAdmin,
        return view("admin.dashboard", compact('totalFoods',
        'totalTypeFoods',
        'totalAllUsers',
        'items',
        'totalRevenue',
        'data',
        'dataBulan',
        'dataTotalPesanan',

        'todayDate',
        'thisMonth',
        'thisYear',
        'totalOrders',
        'todayOrder',
        'todayMonthOrder',
        'todayYearOrder'));
    }



    public function AdminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
