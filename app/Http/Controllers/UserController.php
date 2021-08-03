<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Mail\PasswordChangeConfirm;
use Mail;
use Auth;
use Hash;


class UserController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'verified']);
	}
	
	
	public function profile() {
		$user = Auth::user();
		return view('accounts.profile', compact('user'));
	}

	public function changePassword() {
		return view('accounts.change_password');
	}

	public function changePasswordPost(UserRequest $request) {
		if(Hash::check($request->old_password, Auth::user()->password)) {
			user::find(Auth::id())->update([
				'password' => Hash::make($request->password)
			]);
			
			Mail::to(Auth::user()->email)->send(new PasswordChangeConfirm);

			return back()->with('password_change_success', 'Password changed successfully!');
		} else {
			return back()->with('old_password_error', 'Password didn\'t match with the account');
		}
	}
}
