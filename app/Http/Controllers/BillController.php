<?php

namespace App\Http\Controllers;
use App\Bill;
use App\BillDetail;
use App\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function getDanhsach(){
    	$bills = Bill::paginate(5);
    	return view('admin.bill.danhsach_bill',['bills' => $bills]);
    }

    public function getDetail($id){
    	$bill = Bill::find($id);
    	$billDetails = BillDetail::where('bill_id',$id)->get();

    	return view('admin.bill.bill_detail',['bill' => $bill, 'billDetails' => $billDetails]);
    }

    public function getConfirm($id){
        $bill = Bill::find($id);
        $bill->confirmation = 1;
        $bill->save();

        echo 'Da xac nhan';
    }

}
