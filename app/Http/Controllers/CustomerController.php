<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function createCustomer(Request $request){
        // dd($request->all());
        // dd($request->get('name'));
        $name = $request->get('name');
        $email = $request->get('email');

        $customer = Customer::create([
            'name'=> $name,
            'email' => $email
            ]
        );

        return response()->json(['data' =>$customer , 'status' => 200, 'msg' => 'created successfully' ]);
    }
    public function getCustomers()
    {
        // dd(1);
        $customers = Customer::all();
        // dd($customers);
        return response()->json(['customers' =>$customers , 'status' => 200, 'msg' => 'customers data' ]);
    }

    public function updateCustomer(Request $request){
        // dd($request->all());
        $id = $request->get('id');
        $name = $request->get('name');
        $email = $request->get('email');

        $customer = Customer::whereId($id)->update([
            'name' => $name,
            'email' => $email
        ]);

        return response()->json(['customer'=>$customer, 'status' => 200, 'msg' => 'customer updated']);
    }

    public function deleteCustomer(Request $request){
        // dd($request);
        $id = $request->get('id');
        $customer = Customer::find($id);
        // dd($customer);
        $customer->delete();

        return response()->json(['customer'=>$customer, 'status'=>200, 'msg'=>'deleted']);
    }
}
