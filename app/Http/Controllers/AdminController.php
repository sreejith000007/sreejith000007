<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Admin;
use App\Form;
use App\User;
use App\SaveForm;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $authName = Admin::select('name')
            ->where('id', '=', $id)
            ->first();
        $userCount = User::select('name')->count();
        if ($userCount == 0) {
            $userCount = 0;
        }
        return view("admin", ["authName" => $authName->name, "userCount" => $userCount]);
    }
    public function page()
    {
        $form_count = Form::select('content', 'style')->count();
        $form = Form::select('content', 'style')->first();
        if ($form_count > 0) {
            return view('dynamic-page', ["content" => $form->content, "style" => $form->style]);
        } else {

            return view('dynamic-page', ["content" => '', "style" => '']);
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $form = Form::find(1);
        if (empty($form)) { // you can do this condition to check if is empty
            $form = new Form; //then create new object
        }
        $form->content = $data['content'];
        $form->style = $data['style'];
        $form->save();
        return response()->json(['success' => 'Ajax request submitted successfully']);
    }
    public function userDetails()
    {
        $id = Auth::id();
        $authName = Admin::select('name')
            ->where('id', '=', $id)
            ->first();
        $usersdetails = User::select('id','name','email')->get();
        return view("user", ["authName" => $authName->name,"usersdetails" => $usersdetails]);
    }
    public function userSubmitDetails()
    {
        $id = Auth::id();
        $authName = Admin::select('name')
            ->where('id', '=', $id)
            ->first();
        $usersdetails = User::select('id','name','email')->get();
        return view("user-details", ["authName" => $authName->name,"usersdetails" => $usersdetails]);
    }
    public function userSubmitDetailsAll($u_id)
    {
        $id = Auth::id();
        $user_id=$u_id;
        $authName = Admin::select('name')
            ->where('id', '=', $id)
            ->first();
        $login_count = User::find($user_id)->login_count;       
        $saveformdetails=SaveForm::where('user_id',$user_id)->get();           
        return view("user-details-all", ["authName" => $authName->name,"login_count" => $login_count ,"saveformdetails" => $saveformdetails]);
    }
}
