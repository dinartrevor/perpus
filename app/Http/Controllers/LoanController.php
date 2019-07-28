<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Member;
use App\Book;
use PDF;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = Member::all();
        $books = Book::all();
        $loanNomor = time();
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $type = $request["type"];
        return view('loan.loans', compact('type', 'members', 'books', 'loanNomor', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $this->validate($request, array(
            'no_loan' => 'required|unique:loans'    
        ));

        $start_date = \Carbon\Carbon::parse($request['start_date'])->format('Y-m-d');
        $end_date = \Carbon\Carbon::parse($request['end_date'])->format('Y-m-d');
        $data=[
            'member_id' => $request['member_id'],
            'book_id' => $request['book_id'],
            'no_loan' => $request['no_loan'],
            'start_date' => $start_date,
            'end_date' => $end_date,
            'return_date' => null
        ];
        $book = Book::find($request['book_id']);
        if ($book && $book->available > 0) {
            $loan = Loan::create($data);
            if ($loan->save()) { 
                // update buku dengan mengurangi jumlah buku, jika sukses melakukan peminjaman
                $book->available -= 1;
                $book->save();
                return $loan;
            }
        }
        $data = array('message' => 'buku tidak tersedia', 'status' => 'error');
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::with('members')->find($id);
        return $loan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        $loan->member_id = $request['member_id'];
        $loan->book_id = $request['book_id'];
        $loan->no_loan = $request['no_loan'];
        $loan->start_date = $request['start_date'];
        $loan->end_date = $request['end_date'];
        $loan->return_date = $request['return_date'];
        $loan->punishment = $request['punishment'];
        if ($loan->update()) {
		// update buku dengan menambah jumlah buku, jika sukses melakukan pengembalian
		$book = Book::find($loan->book_id);
		if ($book) {
			$book->available += 1;
			$book->save();
		}
	}

        return $loan;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Loan::destroy($id);
    }

    public function apiLoan(){
        $loan = Loan::all();

        return Datatables::of($loan)

        ->addColumn('members', function (Loan $loan) {
            return $loan->members->name;
        })
        ->addColumn('nomer_members', function (Loan $loan) {
            return $loan->members->no_member;
        })
        ->addColumn('books', function (Loan $loan) {
            return $loan->books->title;
        })
        ->addColumn('start_date', function (Loan $loan) {
            return date('d-m-Y', strtotime($loan->start_date));
        })
        ->addColumn('end_date', function (Loan $loan) {
            return date('d-m-Y', strtotime($loan->end_date));
        })
        ->addColumn('return_date', function (Loan $loan) {
            return !is_null($loan->return_date) ? date('d-m-y', strtotime($loan->return_date)) : '-';
        })
        ->addColumn('punishment', function (Loan $loan) {
            return 'Rp. '.$loan->punishment;
        })

        ->addColumn('action', function($loan){
        // jika sudah melakukan pengembalian jangan ada edit
		if ($loan->return_date) {
            return 
                '<a onclick="deleteData('. $loan->id .')" class="btn-danger btn-xs">Delete</a>';
		} else {
            return 
                '<a onclick="editForm('. $loan->id .')" class="btn btn-primary">Edit</a>'.
                '<a onclick="deleteData('. $loan->id .')" class="btn btn-danger">Delete</a>';
        }
        })->make(true);
    }

    // laporan pdf
    public function pdfloan()
    {
        $loan=Loan::all();
       
        $pdf = PDF::loadView('loan.pdf_loan', compact('loan'));
        $pdf->setPaper('a4','potrait');
        return $pdf->stream();
    }

    // nomer anggota
    public function findMember($id)
    {
        $member = Member::find($id);
        return $member;
    }
}
