<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;
use App\Member;
use App\Loan;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_categories= Category::count();
        $total_book = Book::count();
        $total_member = Member::count();
        $total_loan = Loan::count();
        return view('home',['categories' => $total_categories, 'book' => $total_book, 'member' => $total_member, 'loan' => $total_loan]);
    }
}
