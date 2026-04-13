<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    function test(){
        $jsonData = array([
            'AWB_NUMBER' => "45325234", 
            'ORDER_NUMBER' => "432", 
            'PRODUCT' => "COD", 
            'CONSIGNEE' => 'TEST',
            'CONSIGNEE_ADDRESS1' => 'TEST', 
            'CONSIGNEE_ADDRESS2' => 'TEST', 
            'CONSIGNEE_ADDRESS3' => 'TEST', 
            'DESTINATION_CITY' => 'FARIDABAD', 
            'PINCODE' => "121001",
            'STATE' => "HR",
            'MOBILE' => '9999999999',
            'TELEPHONE' => '1111111111', 
            'ITEM_DESCRIPTION' => "test",
            'PIECES' => 1,
            'COLLECTABLE_VALUE' => 0, 
            'DECLARED_VALUE' => 100, 
            'ACTUAL_WEIGHT' => 1,
            'VOLUMETRIC_WEIGHT' => 0, 
            'LENGTH' => 12,
            'BREADTH' => 5,
            'HEIGHT' => 2,
            'PICKUP_NAME' => 'Test Pickup Name', 
            'PICKUP_ADDRESS_LINE1' => 'test', 
            'PICKUP_ADDRESS_LINE2' => 'test', 
            'PICKUP_PINCODE' => '110001', 
            'PICKUP_PHONE' => '44444444444', 
            'PICKUP_MOBILE' => '7777777777', 
            'RETURN_NAME' => 'fsdafsa', 
            'RETURN_ADDRESS_LINE1' => 'fasdf', 
            'RETURN_ADDRESS_LINE2' => 'fsafsd', 
            'RETURN_PINCODE' => '121001', 
            'RETURN_MOBILE' => '8989898987', 
            'DG_SHIPMENT' => 'false'
         ]);
        print_R($jsonData);
        $urlOrder = "https://api.ecomexpress.in/apiv2/manifest_awb";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlOrder);
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "&username=SANYASIAYURVEDAPRIVATELIMITED(EXS)131452&password=PsGyT7U1PA&json_input=" . json_encode($jsonData));
        $result = curl_exec($ch);
        $error_msg = curl_error($ch);
        curl_close($ch);
        echo 'ss';
       // $resultData = json_decode($result);
        echo '<pre>'; print_R($error_msg);
         print_R($result);die;
    }

    function items_add(){
        return view('employee.add');
    }

    function employee_save(Request $request){

        if(!empty($request->name)){
            $errorsData = [];
            $successData = [];

            foreach($request->name as $key => $item){
                $name = $item ?? '';
                $state = $request->state[$key] ?? '';
                $designation = $request->designation[$key] ?? '';

                $row = [
                    'name' => $name,
                    'state' => $state,
                    'designation' => $designation,
                ];
                
                $validator =  Validator::make($row, [
                    'name' => ['required', 'min:3', 'max:50'],
                    'state' => ['required'],
                    'designation' => ['required', 'min:3', 'max:50'],
                ],[
                    'name.required' => 'This emp name is required',
                    'state.required' => 'This emp state is required',
                    'designation.required' => 'emp designation is required',
                ]);
        
                if($validator->fails()){
                    // retur
                    $errorsData[] = $validator->errors();
                }else{
                    $successData[] = $row;
                }
            }

            if(!empty($successData)){
                DB::table('employee')->insert($row);
            }

            return json_encode(['status'=>true, 'insert'=>count($successData), 'failed'=>count($errorsData), 'error'=>$errorsData]);

        }

        return json_encode(['status'=>false, 'message'=>'Please enter details']);
    }
    
}
