@extends('layouts.app')
@section('content')

<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
       
        <th>Nomer Peminjaman</th>
				<th>Tanggal Peminjaman</th>
				<th>Tanggal Harus Kembali </th>
				<th>Tanggal kembali</th>
        
				
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($book->loans as $loans)
        <tr>
          <td>{{ $i++ }}</td>
         
          <td>{{$loans->no_loan}}</td>
          <td>{{date('d-m-Y',strtotime($loans->start_date)) }}</td>
          <td>{{date('d-m-Y',strtotime($loans->end_date)) }}</td>
          <td>{{date('d-m-Y',strtotime($loans->return_date)) }}</td>
  
  
        </tr>
			@endforeach
		</tbody>
	</table>

@endsection