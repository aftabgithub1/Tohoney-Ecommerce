<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use App\Models\User;
use App\Models\Faq;
use Auth;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'verified', 'role']);
	}
	
	public function adminPanel() {
		return view('layouts.accounts');
	}



	public function addFaq() {
		$faqs = Faq::all();
		$trashed_faqs = Faq::onlyTrashed()->get();
		return view('add_faq', compact('faqs', 'trashed_faqs'));
	}

	public function userList() {
		/*
			User::all();  shows all table data
			User::get();  shows all table data
			User::count();  shows total number of rows or users
		*/

		$users = User::where('id', '!=', Auth::id())->orderBy('name', 'asc')->paginate(5);
		$total_user = User::count();
		return view('accounts.user_list', compact('users', 'total_user'));
	}

	/**
	 * Carbon is a pre-installed packege in Laravel.
	 * 'created_at' => date('Y-m-d H:i:s') - Alternate way for inserting date in phpmyadmin.
	 */
	public function addFaqPost(FaqRequest $request) {
		Faq::insert([
			'question' => $request->question,
			'answer' => $request->answer,
			'created_at' => Carbon::now()
		]);

		return back()->with('success', 'FAQ added successfully!');
	}

	public function deleteFaq($id) {
		Faq::find($id)->delete();
		return back()->with('delete_success', 'FAQ deleted successfully!');
	}

	public function editFaq($id) {
		$faq = Faq::find($id);
		return view('accounts_of_admins.edit_faq', compact('faq'));
	}

	public function editFaqPost(FaqRequest $request) {
		// print_r($request->id); die();
		Faq::find($request->id)->update([
			'question' => $request->question,
			'answer' => $request->answer
		]);
		return redirect('add_faq')->with('faq_update_success', 'FAQ updated successfully!');
	}

}
