<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
</style>
<center><h1>Laporan Kategori Buku</h1></center>
 <table class='table table-bordered'>
      <thead>
        <tr>
          <th>No</th>
          <th>Kategori Buku</th>
        </tr>
      </thead>
      <tbody>
      <?php $no=1; ?> 
        @foreach($category as $categories)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $categories->name }}</td>
          </tr>
        @endforeach
      </tbody>
 </table>
<center><p class="text-muted"> Total Kategori {{count($category)}}</p><center>