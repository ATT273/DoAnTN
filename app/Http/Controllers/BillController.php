<?php

namespace App\Http\Controllers;
use App\Bill;
use App\BillDetail;
use App\User;
use Validator;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function getDanhsach(){
    	$bills = Bill::orderBy('created_at','DESC')->paginate(5);
    	return view('admin.bill.danhsach_bill',['bills' => $bills]);
    }

    public function getDetail($id){
    	$bill = Bill::find($id);
    	$billDetails = BillDetail::where('bill_id',$id)->get();

    	return view('admin.bill.bill_detail',['bill' => $bill, 'billDetails' => $billDetails]);
    }

    public function getConfirm($action, $id){
        $bill = Bill::find($id);
        switch ($action) {
            // confirm
            case '1':
                $bill->confirmation = 1;
                $bill->save();

                echo '<strong>Confirmation: </strong>'.'<span class="label label-success">Da xac nhan</span>';
                break;
            // transfer
            case '2':
                $bill->transfer_status = 1;
                $bill->save();

                echo '<strong>Transfer status: </strong>'.'<span class="label label-success">Dang van chuyen</span>';
                break;
            // payment
            case '3':
                $bill->payment_status = 1;
                $bill->save();

                echo '<strong>Payment status: </strong>'.'<span class="label label-success">Da thanh toan</span>';
            break;
        }
        
    }


    //api function
    public function getDanhsachApi(){
        $bills = Bill::paginate(5);

        $response["status"] = 200;
        $response["bills"] = $bills;

        return response()->json($response);
    }

    public function getDetailApi($id){
        $billDetails = BillDetail::where('bill_id',$id)->get();

        $response["status"] = 200;
        $response["billDetails"] = $billDetails;

        return response()->json($response);
    }

    public function getConfirmApi($action, $id){
        $bill = Bill::find($id);
        switch ($action) {
            // confirm
            case '1':
                $bill->confirmation = 1;
                $bill->save();

                $response["status"] = 200;
                $response["message"] = "success";

                return response()->json($response);
            // transfer
            case '2':
                $bill->transfer_status = 1;
                $bill->save();

                $response["status"] = 200;
                $response["message"] = "success";

                return response()->json($response);
            // payment
            case '3':
                $bill->payment_status = 1;
                $bill->save();

                $response["status"] = 200;
                $response["message"] = "success";

                return response()->json($response);
        }
        
    }

}
