<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
</style>
<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
       
        <th>Kategori Buku</th>
				<th>Judul Buku</th>
				<th>Pengarang </th>
				<th>Isbn</th>
        <th>Tahun Terbit</th>
        <th>Penerbit</th>
				<th>Tersedia</th>
			</tr>
		</thead>
		<tbody>
      @php $i=1 @endphp
      @foreach($book as $books)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $books->category->name }}</td>
          <td>{{ $books->title }}</td>
          <td>{{ $books->author }}</td>
          <th>{{ $books->isbn }}</th>
          <td>{{ $books->public_year }}</td>
          <td>{{ $books->publisher }}</td>
          <td>{{ $books->available }}</td>
        </tr>
			@endforeach
		</tbody>
	</table>
  <h3>Total Buku {{ count($book)}}</h3>

 
	
 














