<?php

namespace App\Http\Controllers;

use App\db_bills;
use App\db_close_day;
use App\db_credit;
use App\db_summary;
use App\db_supervisor_has_agent;
use App\db_wallet;
use App\db_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // Helper functions for this controller
        $today = Carbon::now();

        Carbon::createFromDate();
            $temp_month = 0;
            $temp_year = 0;

            if($today->month >= 5 && $today->month <= $today->daysInMonth) {
                $temp_month = $today->month + 1;
                $gastos_startDate = Carbon::createFromDate($today->year,$today->month,5);
                $gastos_endDate = Carbon::createFromDate($today->year,$temp_month,5);
            } else {
                $temp_month = $today->month - 1;
                $gastos_startDate = Carbon::createFromDate($today->year,$temp_month,5);
                $gastos_endDate = Carbon::createFromDate($today->year,$month,5);
            }
        

        // Get in a specific
        $sqlga = array(
            ['id_agent', '=', Auth::id()]
        );
        $sqlga[] = ['summary.created_at', '>=', $gastos_startDate];
        $sqlga[] = ['summary.created_at', '<=', $gastos_endDate];

        $ganancia = db_summary::where($sqlga)
            ->select('ganancia')
            ->get();

        $credit = db_credit::where('id_agent',Auth::id())
            ->where('status', '=', 'inprogress');

        //Get the remain amount of credits
        $get_total_amount = db_credit::where('id_agent',Auth::id())
            ->where('status', '=', 'inprogress')
            ->select(DB::raw('SUM(amount_neto * (1+utility)) as total'))
            ->get();


        //Select amount from summary s join credit c on s.id_credit = c.id where c.status = 'inprogress' and s.id_agent = 3
        $get_total_payments = db_summary::where('summary.id_agent', Auth::id())
            ->where('credit.status','=', 'inprogress')
            ->join('credit', 'summary.id_credit','=','credit.id')
            ->select(
                'amount'
            );

        $customers = db_users::where('level','user')
            ->count('id');


        $data_summary = db_summary::whereDate('summary.created_at',
            Carbon::now()->toDateString())
            ->where('credit.id_agent', Auth::id())
            ->join('credit', 'summary.id_credit', '=', 'credit.id')
            ->join('users', 'credit.id_user', '=', 'users.id')
            ->select(
                'users.name',
                'users.last_name',
                'credit.payment_number',
                'credit.utility',
                'credit.amount_neto',
                'credit.id as id_credit',
                'summary.number_index',
                'summary.amount',
                'summary.created_at'
            )
            ->groupBy('summary.id')
            ->get();

        $close_day = db_close_day::whereDate('created_at', Carbon::now()->toDateString())
            ->where('id_agent', Auth::id())
            ->first();

        $base = db_supervisor_has_agent::where('id_user_agent', Auth::id())->first()->base ?? 0;
        $base_credit = db_credit::whereDate('created_at', Carbon::now()->toDateString())
            ->where('id_agent', Auth::id())
            ->sum('amount_neto');
        $base -= $base_credit;

        $total_summary = $data_summary->sum('amount');
        
        //get today bills

        $sql = array(
            ['id_agent', '=', Auth::id()]
        );
        $sql[] = ['bills.created_at', '>=', $gastos_startDate];
        $sql[] = ['bills.created_at', '<=', $gastos_endDate];


        $bill = db_bills::where($sql)
            ->join('wallet', 'bills.id_wallet', '=', 'wallet.id')
            ->select('bills.*', 'wallet.name as wallet_name')
            ->get();
        
        //Data will be sent
        $data = [
            'base_agent'    => $base,
            'credit'        => $get_total_amount,
            'total_bill'    => $bill->sum('amount'),
            'customers'     => $customers,
            'total_summary' => $total_summary,
            'total_payments' => $get_total_payments->sum('summary.amount'),
            'ganancia'      => $ganancia->sum('ganancia'),
            'inicio'         => $gastos_startDate->format('d/m/y'),
            'final'         => $gastos_endDate->format('d/m/y'),
            'close_day'     => $close_day,            
        ];

        return view('home',$data);
    }
}
