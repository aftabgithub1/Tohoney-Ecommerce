<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Product;

class TrashController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'verified']);
	}

	public function trashIndex() {
		$faqs = Faq::onlyTrashed()->get();
		$categories = Category::onlyTrashed()->get();
		return view('accounts.trash', compact('faqs', 'categories'));
	}

	// public $faq = 'Faq::withTrashed()->find($id)';
	// public $category = 'Faq::withTrashed()->find($id)';


	public function restore($id) {
		if($faq = Faq::withTrashed()->find($id)) {
			$faq->restore();
		} elseif($category = Category::withTrashed()->find($id)) {
			$category->restore();
		}
		return back()->with('restore_success', 'Restored successfully!');
	}
	
	public function forceDelete($id) {
		if($faq = Faq::withTrashed()->find($id)) {
			$faq->forceDelete();
		} elseif($category = Category::withTrashed()->find($id)) {
			unlink(public_path('uploads/category/').$category->image);
			$category->forceDelete();
		}
		return back()->with('parmanent_delete_success', 'Deleted parmanenetly!');
	}
} 
