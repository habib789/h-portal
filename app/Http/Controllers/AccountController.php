<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\models\Patient;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    public function index()
    {
        $data            = [];
        $data['sidebar'] = true;
        return view('frontend.dashboard.accounts', $data);
    }

    public function showOrder()
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['orders']  = Order::with('user')->where('user_id', auth()->user()->id)->paginate(8);
        return view('frontend.dashboard.customerOrders', $data);
    }

    public function OrderDetails($id)
    {
        $data             = [];
        $data['sidebar']  = true;
        $data['order']    = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        return view('frontend.dashboard.orderDetails', $data);
    }

    public function generatePdf($id)
    {
        $data             = [];
        $data['order']    = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        $pdf              = PDF::loadView('frontend.dashboard.pdf.orderdetails', $data);
        return $pdf->download('invoice.pdf');
//        return view('frontend.dashboard.pdf.orderdetails',$data);
    }

    public function PatientAccountInformation()
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['patient'] = Patient::find(auth()->user()->patient->id);
        return view('frontend.patient.info', $data);
    }

    public function UserUpdateInfoShow($id)
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['patient'] = Patient::find($id);
        return view('frontend.patient.infoUpdate', $data);
    }

    public function UserInfoUpdate(Request $request, $id)
    {
        $before = today();
        $com    = strtotime($before) - 3153600000;
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone'         => 'required|min:11|max:14|unique:patients,phone,' . $id,
            'blood_group'   => 'required',
            'address'       => 'required',
            'gender'        => 'required',
            'date_of_birth' => 'required|date|before_or_equal:today|after_or_equal:' . date('Y-m-d', $com),
        ]);
        $info_update = Patient::find($id);
        try {
            $info_update->update([
                'first_name'    => trim($request->input('first_name')),
                'last_name'     => trim($request->input('last_name')),
                'phone'         => trim($request->input('phone')),
                'address'       => trim($request->input('address')),
                'gender'        => trim($request->input('gender')),
                'blood_group'   => trim($request->input('blood_group')),
                'date_of_birth' => trim($request->input('date_of_birth')),
            ]);
            return redirect()->route('account.information')->with('success', 'Account info updated');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

}
