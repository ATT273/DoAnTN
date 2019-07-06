<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Report;
use Validator;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ReportController extends Controller
{

	private function checkReport($day){
		$check_report = Report::where('date',$day)->get();
		if (count($check_report) > 0) {

			$bills =  Bill::where('order_date',$day)->get();
			$number_of_orders = count($bills);
			$gross_revenue = 0;
			$discount_amount = 0;
			$received = 0;
			$number_products_sold = 0;
			foreach ($bills as $bill) {
				$gross_revenue = $gross_revenue + $bill->total;
				$discount_amount = $discount_amount + $bill->discount_amount;
				foreach($bill->bill_detail as $detail){
					$number_products_sold = $number_products_sold + $detail->quantity;
				}

				if($bill->payment_status == 1){
					$received = $received + $bill->total;
				}elseif($bill->payment_status == 0){
					$received = $received;
				}
			}

			$report = Report::find($check_report[0]->id);
			$report->date = $day;
			$report->gross_revenue = $gross_revenue;
			$report->number_of_orders = $number_of_orders;
			$report->discount_amount = $discount_amount;
			$report->received = $received;
			$report->number_products_sold = $number_products_sold;
			$report->save();
		
		}elseif( count($check_report) == 0 ){

			$new_report = new Report;
			$new_report->date = $day;
			$new_report->number_of_orders = 0;
			$new_report->gross_revenue = 0;
			$new_report->discount_amount = 0;
			$new_report->received = 0;
			$new_report->number_products_sold = 0;
			$new_report->save();
		}
	}



	// Report menu
	public function getMenu(){
		return view('admin.report.report_menu');
	}

	// Daily Report
	public function getDailyReportToday(){
		$today = date('Y-m-d');
		$bills =  Bill::where('created_at', '=', $today)->get();
		$this->checkReport($today);
		return view('admin.report.daily_report',['bills' => $bills]);
	}
	public function getDailyReportOther(Request $request){
		$day = $request->date;
		$bills =  Bill::where('created_at', 'like', $day.'%')->get();
		$report = Report::where('date',$day)->get();
		$this->checkReport($day);
		return view('admin.report.daily_report',['bills' => $bills,'report' => $report]);
	}

	public function getWeeklyReport(){
		$daysOfWeek = [];
		$today = Carbon::now();
		$week = $today->weekOfYear;
		$firstDay = $today->startOfWeek();
		$day1 = $firstDay;
		array_push($daysOfWeek, $day1->toDateString());
		for ($i=0; $i < 6; $i++) { 
			$day = $firstDay->addDay()->toDateString();
			array_push($daysOfWeek, $day);
		}
		
		$reports = Report::whereBetween('date',[$daysOfWeek[0],$daysOfWeek[6]])->get();
		return view('admin.report.weekly_report',['reports' => $reports, 'days' => $daysOfWeek, 'week' => $week]);
	}
	public function getMonthlyReport(){
		$today = Carbon::now();
		$daysOfMonth = [];
		$month = $today->month;
		$daysInMonth = $today->daysInMonth;
		$start = Carbon::parse($today)->startOfMonth();
		$end = Carbon::parse($today)->endOfMonth();
		$day1 = Carbon::parse($start)->toDateString();
		array_push($daysOfMonth, $day1);
		for ($i=0; $i < $daysInMonth-1 ; $i++) { 
			$day = $start->addDay()->toDateString();
			array_push($daysOfMonth, $day);
		}

		$reports = Report::whereBetween('date',[$daysOfMonth[0],$daysOfMonth[$daysInMonth-1]])->get();
		return view('admin.report.monthly_report',['reports' => $reports, 'days' => $daysOfMonth, 'month' => $month]);
	}

    //Import report
	public function postImport(){

	}

	// Export report
    public function getExport(){
    	
    }
}
