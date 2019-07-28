<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no_member = time();
        return view('member.members', compact('no_member'));
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
            'no_member' => 'required|unique:members'    
        ));
        $data=[
            'no_member' => $request['no_member'],
            'name' => $request['name'],
            'city' => $request['city'],
            'address' => $request['address'],
            'phone_number' => $request['phone_number']
        ];
       return Member::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        return $member;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'no_member' => 'required|unique:members'    
        ));
        $member = Member::find($id);
        $member->no_member = $request['no_member'];
        $member->name = $request['name'];
        $member->city = $request['city'];
        $member->address = $request['address'];
        $member->phone_number = $request['phone_number'];
        $member->update();

        return $member;      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::destroy($id);
    }

    public function apiMember(){
        $member = Member::all();

        return Datatables::of($member)
        ->addColumn('action', function($member){
            return 
                    '<a onclick="editForm('. $member->id .')" class=" btn btn-primary btn-xs">Edit</a>  ' .
                    '<a onclick="deleteData('. $member->id .')" class=" btn btn-danger btn-xs">Delete</a>';
        })->make(true);
    }
    public function exportPDF()
    {
        $member = Member::limit(100)->get();
        $pdf = PDF::loadView('member.pdf', compact('member'));
        $pdf->setPaper('a4','potrait');
        
        return $pdf->stream();
    }
}
