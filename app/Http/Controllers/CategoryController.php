<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Category;
use PDF;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('category.category') ; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'name' => $request['name']
        ];
       return Category::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request['name'];
        $category->update();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
    }
    
    public function apiCategory(){
        $category = Category::all();

        return Datatables::of($category)
        ->addColumn('action', function($category){
            return 
                    '<a onclick="editForm('. $category->id .')" class="btn-primary btn-xs">Edit</a> | ' .
                    '<a onclick="deleteData('. $category->id .')" class="btn-danger btn-xs">Delete</a>';
        })->make(true);
    }
    public function categorypdf()
    {

        $category=Category::all();
       
        $pdf = PDF::loadView('category.pdfcategory', compact('category'));
        $pdf->setPaper('a4','potrait');

        return $pdf->stream();
    }
}
