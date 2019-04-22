 <table border="1">
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
Total Kategori {{count($category)}}