<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
// Route::get('/members', function () {
//   return view('members');
// });

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['register' => false, 'reset' =>false, 'remember' =>false]);

Route::middleware('auth')->group(function () {
  Route::resources([
    'books' => 'BookController',
    'categories' => 'CategoryController',
    'members' => 'MemberController',
    'loans' => 'LoanController'
  ]);
  Route::get('api/member', 'MemberController@apimember')->name('api/member');
  Route::get('api/book', 'BookController@apibook')->name('api/book');
  Route::get('api/category', 'CategoryController@apicategory')->name('api/category');
  Route::get('api/loan', 'LoanController@apiloan')->name('api/loan');
  Route::get('api/book_checkbox', 'BookController@apibookcheckbox')->name('api/book_checkbox');
  Route::get('/exportpdf','MemberController@exportPDF')->name('member.export');
  Route::get('/bukupdf','BookController@bukupdf')->name('buku.bukupdf');
  Route::get('/book/{book}','BookController@show')->name('book.show');
  Route::get('/pdfloan','LoanController@pdfloan')->name('loan.pdfloan');
  Route::get('/categorypdf','CategoryController@categorypdf')->name('category.categorypdf');
});