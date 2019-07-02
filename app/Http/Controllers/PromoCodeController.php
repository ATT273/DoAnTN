<?php

namespace App\Http\Controllers;
use App\Tag;
use App\ProductTag;
use App\PromoCode;
use Validator;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{

	public function getDanhsach(){
		$pcodes = PromoCode::all();
		return view('admin.promo_code.danhsach_code',['pcodes'=>$pcodes]);
	}

	public function getAdd(){
		return view('admin.promo_code.them_code');
	}

	public function postAdd(Request $request){
		$this->validate($request,
			[
				'code_name' => 'required',
				'code_discount' =>'required|numeric',
				'code_exp_date' => 'required|after:yesterday',
			],
			[
				'code_name.required' => 'Please Enter Your Promo Code',
				'code_discount.required' => 'Please Enter Your Discount Amount',
				'code_discount.numeric' => 'Discount Amount must be a number',
				'code_exp_date.required' => 'Please Enter Your Code Expiration Date',
				'code_exp_date.after' => ' Code Expiration Date must be today or anyday in the future',
			]);

		$pcode = new PromoCode;
		$pcode->name = $request->code_name;
		$pcode->expiration_date = $request->code_exp_date;
		if($request->code_type == 1){
			$pcode->fixed = $request->code_discount;
			$pcode->percentage = 0;
		}elseif($request->code_type == 2){
			$pcode->fixed = 0;
			if($request->code_discount > 100 || $request->code_discount <= 0){
				return redirect('admin/promo_code/add')->with('loi','Discount percentage must be greater than 0 and less than 100');
			}elseif($request->code_discount < 100 && $request->code_discount > 0){
				$pcode->percentage = $request->code_discount;
			}
			
		}

		$pcode->save();

		return redirect('admin/promo_code/danhsach-code')->with('thongbao','Added Successfully');
		// $today = date('Y-m-d');
		// $eday =  $request->code_exp_date;
		// if($eday > $today){
		// 	echo $eday.' > '.$today.'- available';
		// }elseif($eday < $today){
		// 	echo $eday.' < '.$today.'- expired';
		// }
		// echo '<br>'.$request->code_type;
	}

}