<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $today = Carbon::now()->startOfDay();
        $thisweek = Carbon::now()->startOfWeek();
        $endweek = Carbon::now()->endOfWeek();
        $thismonth = Carbon::now()->month;
        $startlastmonth = Carbon::now()->subMonth()->startOfMonth();
        $endlastmonth = Carbon::now()->subMonth()->endOfMonth();
        // $penerimaan = Penerimaan::whereBetween('created_at', [$thisweek, $endweek])->sum('subtotal');
        $penerimaanBulanIni = Penerimaan::whereMonth('created_at', $thismonth)->sum('subtotal');
        $penerimaanBulanLalu = Penerimaan::whereBetween('created_at', [$startlastmonth, $endlastmonth])->sum('subtotal');
        $pengeluaranBulanIni = Pengeluaran::whereMonth('created_at', $thismonth)->sum('subtotal');
        // dd($penerimaan);

        return view('dashboard',[
            'penerimaanBulanIni' => $penerimaanBulanIni,
            'penerimaanBulanLalu' => $penerimaanBulanLalu,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
        ]);
    }
}
