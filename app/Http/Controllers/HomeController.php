<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Form;
use App\SaveForm;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();

        $user=User::find($id);
        $user->login_count=$user->login_count+1;
        $user->save();

        $form_count = Form::select('content', 'style')->count();
        $form = Form::select('content', 'style')->first();
        if ($form_count > 0) {
            return view('home', ["content" => $form->content, "style" => $form->style]);
        } else {

            return view('home', ["content" => '0', "style" => '0']);
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $submission_exist = SaveForm::where('user_id', $data['user_id'])->first();
        if ($submission_exist) {
            return response()->json(['msg' => '0']);
        } else {
            $saveform = new SaveForm;
            $labels = collect($data['labels'])->implode('-');
            $values = collect($data['values'])->implode('-');
            $saveform->user_id = $data['user_id'];
            $saveform->label = $labels;
            $saveform->values = $values;
            $saveform->submitted_count = $data['submitted_count'];
            $saveform->open_count = 1;
            $saveform->save();
            return response()->json(['msg' => '1']);
        }
    }
}
