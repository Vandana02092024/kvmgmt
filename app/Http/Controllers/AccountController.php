<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Account;
use App\User;
use App\User_location;
use App\Location;
use Mail;
use Session;
use Validator;
use PDF;

class AccountController extends Controller
{	

public function index()
    {	
		return view('accounts.index');
	}
    public function create()
    {
		/* $data = session()->all();
		echo "<pre>";
		print_r($data);
		exit; */
		
		return view('accounts.create');
	}

    
	
	
}