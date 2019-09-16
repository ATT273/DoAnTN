<?php

namespace App\Http\Controllers;
use App\Tag;
use App\ProductTag;
use App\PromoCode;
use App\User;
use Validator;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
	public function checkExpired(){
		$codes = PromoCode::all();
		$today = date('Y-m-d');
		foreach($codes as $code){
			if($code->expiration_date < $today){
				$code->expired = 1;
				$code->save();
			}
		}
	}

	public function getDanhsach(){
		$this->checkExpired();
		$pcodes = PromoCode::paginate(5);
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

		//kiem tra loai ma giam gia
		if($request->code_type == 1){
			$pcode->fixed = $request->code_discount;
			$pcode->percentage = 0;
		}elseif($request->code_type == 2){
			$pcode->fixed = 0;
			//kiemtra neu % giam gia lon hon 100 hoac nho hon 0
			if($request->code_discount > 100 || $request->code_discount <= 0){
				return redirect('admin/promo_code/add')->with('loi','Discount percentage must be greater than 0 and less than 100');

			//kiem tra neu % giam gia nho hon 100 va lon hon 0
			}elseif($request->code_discount < 100 && $request->code_discount > 0){
				$pcode->percentage = $request->code_discount;
			}
			
		}

		$pcode->save();

		return redirect('admin/promo_code/danhsach-code')->with('thongbao','Added Successfully');
	}

	public function getEdit($id){
		$code = PromoCode::find($id);
		return view('admin.promo_code.sua_code',['code' => $code]);
	}

	public function postEdit(Request $request, $id){
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

		$checkname = PromoCode::where('name',$request->code_name)->get();
		if(count($checkname) == 0){
            $pcode = PromoCode::find($id);
            $pcode->name = $request->code_name;
			$pcode->expiration_date = $request->code_exp_date;
			$pcode->expired = 0;
	            //kiem tra loai ma giam gia
			if($request->code_type == 1){
				$pcode->fixed = $request->code_discount;
				$pcode->percentage = 0;
			}elseif($request->code_type == 2){
				$pcode->fixed = 0;
				//kiemtra neu % giam gia lon hon 100 hoac nho hon 0
				if($request->code_discount > 100 || $request->code_discount <= 0){
					return redirect('admin/promo_code/add')->with('loi','Discount percentage must be greater than 0 and less than 100');

				//kiem tra neu % giam gia nho hon 100 va lon hon 0
				}elseif($request->code_discount < 100 && $request->code_discount > 0){
					$pcode->percentage = $request->code_discount;
				}
			}

			$pcode->save();

			return redirect('admin/promo_code/danhsach-code')->with('thongbao','Updated Successfully');
        }

        if($checkname[0]->id == $id){
            $pcode = PromoCode::find($id);
            $pcode->name = $request->code_name;
			$pcode->expiration_date = $request->code_exp_date;
			$pcode->expired = 0;
	            //kiem tra loai ma giam gia
			if($request->code_type == 1){
				$pcode->fixed = $request->code_discount;
				$pcode->percentage = 0;
			}elseif($request->code_type == 2){
				$pcode->fixed = 0;
				//kiemtra neu % giam gia lon hon 100 hoac nho hon 0
				if($request->code_discount > 100 || $request->code_discount <= 0){
					return redirect('admin/promo_code/add')->with('loi','Discount percentage must be greater than 0 and less than 100');

				//kiem tra neu % giam gia nho hon 100 va lon hon 0
				}elseif($request->code_discount < 100 && $request->code_discount > 0){
					$pcode->percentage = $request->code_discount;
				}
			}

			$pcode->save();

			return redirect('admin/promo_code/danhsach-code')->with('thongbao','Updated Successfully');

        }elseif ($checkname[0]->id !== $id) {
            return redirect('admin/promo_code/edit/'.$id)->with('loi','This code has already been existed');
        }
	}

	public function getDel($id){
		$pcode = PromoCode::find($id);
		$pcode->delete();
		return redirect('admin/promo_code/danhsach-code')->with('thongbao','Deleted Successfully');
	}
	public function getSearchCode(Request $request){
        if($request->has('keyword')){
        	$codes = PromoCode::where('name','LIKE', '%'.$request->keyword.'%')->paginate(2);
	        $codes->appends(['keyword' => $request->keyword]);
	        return view('admin.promo_code.danhsach_code',['pcodes'=>$codes]);
        }else{
            return redirect('admin/promo_code/danhsach-code');
        }
        
    }
///////////////////
    // API Functions //
    ///////////////////
    public function getDanhsachApi(){
		$pcodes = PromoCode::all();
        $response["status"] = 200;
        $response["pcodes"] = $pcodes;
        return response()->json($response);
	}

	public function postAddApi(Request $request){
		$id = explode('_', $request->apiToken)[0];
        $user = User::find($id);
        if ($request->apiToken != $user->api_token) {
            $response["status"] = 250;
            $response["message"] = 'token timeout';
            return response()->json($response);
        }
		$rules = [
                'code_name' => 'required',
				'code_discount' =>'required|numeric',
				'code_exp_date' => 'required|after:yesterday',
            ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
			$pcode = new PromoCode;
			$pcode->name = $request->code_name;
			$pcode->expiration_date = $request->code_exp_date;

		//kiem tra loai ma giam gia
		if($request->code_type == 1){
			$pcode->fixed = $request->code_discount;
			$pcode->percentage = 0;
		}elseif($request->code_type == 2){
			$pcode->fixed = 0;
			//kiemtra neu % giam gia lon hon 100 hoac nho hon 0
			if($request->code_discount > 100 || $request->code_discount <= 0){
				$response["status"] = 500;
            	$response["message"] = 'Discount percentage must be greater than 0 and less than 100';
            return response()->json($response);
			//kiem tra neu % giam gia nho hon 100 va lon hon 0
			}elseif($request->code_discount < 100 && $request->code_discount > 0){
				$pcode->percentage = $request->code_discount;
			}
			
		}

		$pcode->save();
			$response["status"] = 200;
            $response["message"] = "success";
            return response()->json($response);
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
            return response()->json($response);
        }
        return response()->json($response);
	}

	public function postEditApi(Request $request, $id){
		$uid = explode('_', $request->apiToken)[0];
        $user = User::find($uid);
        if ($request->apiToken != $user->api_token) {
            $response["status"] = 250;
            $response["message"] = 'token timeout';
            return response()->json($response);
        }
		$rules = [
                'code_name' => 'required',
				'code_discount' =>'required|numeric',
				'code_exp_date' => 'required|after:yesterday',
            ];

            $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
		$checkname = PromoCode::where('name',$request->code_name)->get();
		if(count($checkname) == 0){
            $pcode = PromoCode::find($id);
            $pcode->name = $request->code_name;
			$pcode->expiration_date = $request->code_exp_date;
			$pcode->expired = 0;
	            //kiem tra loai ma giam gia
			if($request->code_type == 1){
				$pcode->fixed = $request->code_discount;
				$pcode->percentage = 0;
		} elseif($request->code_type == 2){
			$pcode->fixed = 0;
			//kiemtra neu % giam gia lon hon 100 hoac nho hon 0
			if($request->code_discount > 100 || $request->code_discount <= 0){
				$response["status"] = 500;
            	$response["message"] = 'Discount percentage must be greater than 0 and less than 100';
            	return response()->json($response);

			//kiem tra neu % giam gia nho hon 100 va lon hon 0
			}elseif($request->code_discount < 100 && $request->code_discount > 0){
				$pcode->percentage = $request->code_discount;
			}
		}

			$pcode->save();

			$response["status"] = 200;
            $response["message"] = "success";
            return response()->json($response);
        }

         if($checkname[0]->id == $id){
            $pcode = PromoCode::find($id);
            $pcode->name = $request->code_name;
			$pcode->expiration_date = $request->code_exp_date;
			$pcode->expired = 0;
	            //kiem tra loai ma giam gia
			if($request->code_type == 1){
				$pcode->fixed = $request->code_discount;
				$pcode->percentage = 0;
		}elseif($request->code_type == 2){
			$pcode->fixed = 0;
			//kiemtra neu % giam gia lon hon 100 hoac nho hon 0
			if($request->code_discount > 100 || $request->code_discount <= 0){
				$response["status"] = 500;
            	$response["message"] = 'Discount percentage must be greater than 0 and less than 100';
            	return response()->json($response);

			//kiem tra neu % giam gia nho hon 100 va lon hon 0
			}elseif($request->code_discount < 100 && $request->code_discount > 0){
				$pcode->percentage = $request->code_discount;
			}
		}

			$pcode->save();

			$response["status"] = 200;
            $response["message"] = "success";
            return response()->json($response);

        } elseif ($checkname[0]->id !== $id) {
			$response["status"] = 500;
            $response["message"] = 'This code has already been existed';
            return response()->json($response);
        }

        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
            return response()->json($response);
        }
        return response()->json($response);
	}

	public function getDelApi($id){
		$pcode = PromoCode::find($id);
		$pcode->delete();

		$response["status"] = 200;
        $response["message"] = "success";

        return response()->json($response);
	}
}