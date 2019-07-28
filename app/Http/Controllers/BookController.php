<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Category;
use PDF;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $booknomor = time();
        $categories = Category::all();
        return view('book.books', compact('categories','booknomor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'isbn' => 'required|unique:books'    
        ));
        $data=[
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'author' => $request['author'],
            'isbn' => $request['isbn'],
            'public_year' => $request['public_year'],
            'publisher' => $request['publisher'],
            'available' => $request['available']
        ];
       return Book::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        
        
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->category_id = $request['category_id'];
        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->isbn = $request['isbn'];
        $book->public_year = $request['public_year'];
        $book->publisher = $request['publisher'];
        $book->available = $request['available'];
        $book->update();
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
    }

    public function apiBook(Request $request){
        // dd($request);
        // if($request["category_id"].exists()){
        //     $book = Book::where('category_id', $request["category_id"]);
        // }else{

        // }
        $book = Book::all();

        return Datatables::of($book)
        ->addColumn('category', function (Book $book) {
            return $book->category->name;
        })
        ->addColumn('action', function($book){
            return 
                    
                    '<a onclick="editForm('. $book->id .')" class="btn btn-primary btn-xs">Edit</a>' .
                    '<a onclick="deleteData('. $book->id .')" class="btn btn-danger btn-xs">Delete</a>';
        })->make(true);
    }

    public function apiBookCheckbox(){
        $book = Book::all();

        return Datatables::of($book)
        ->addColumn('category', function (Book $book) {
            return $book->category->name;
        })
        
        ->addColumn('action', '<input type="checkbox" name="book_ids[]" class="book_ids" value="{{$id}}" />')
        ->rawColumns(['action'])->make(true);
    }
    public function bukupdf()
    {

        $book=Book::all();
       
        $pdf = PDF::loadView('book.bookpdf', compact('book'));
        $pdf->setPaper('a4','potrait');

        return $pdf->stream();
    }
}
