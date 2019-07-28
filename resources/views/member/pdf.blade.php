<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h1>Laporan Anggota</h1>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kota</th>
				<th>Alamat</th>
				<th>Nomer Telepone</th>
				
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($member as $members)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{$members->name}}</td>
          <td>{{$members->city}}</td>
          <td>{{$members->address}}</td>
          <td>{{$members->phone_number}}</td>
          
        </tr>
			@endforeach
		</tbody>
	</table>
	
 <center><p class="text-muted"> Total Anggota {{ count($member)}}</p></center>














