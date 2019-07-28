<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/icon/Peminjaman.png') }}">

    <title>Loans</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- dataTables --}}
    <link href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    {{-- SweetAlert2 --}}
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('assets/bootstrap/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/bootstrap/css/navbar-fixed-top.css') }}" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="{{ asset('assets/bootstrap/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-laravel  navbar-fixed-top ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/home">Perpustakaan</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li ><a class="nav-link" href="{{ route('categories.index') }}">{{ __('Kategori Buku') }}</a></li>
            <li><a  class="nav-link" href="{{ route('books.index') }}">{{ __('Buku') }}</a></li>
            <li><a  class="nav-link" href="{{ route('members.index') }}">{{ __('Anggota') }}</a></li>
            <li><a class="nav-link" href="{{ route('loans.index') }}">{{ __('Peminjaman') }}</a></li>
            <li><a  class="nav-link" href="{{ route('loans.index', ['type'=>'return_loan']) }}">{{ __('Pengembalian') }}</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                <a class="dropdown-item logout" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>List
              @if($type != 'return_loan')
                <a href="/pdfloan" class="btn btn-info pull-right" style="margin-top: -8px;">Laporan</a>
                <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Tambah Pinjaman</a>
              @endif
              </h4>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="contact-table" class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nomer Anggota</th>
                      <th>Anggota </th>
                      <th>Buku</th>
                      <th>Nomer Peminjaman</th>
                      <th>Tanggal Peminjaman</th>
                      <th>Tanggal harus kembali</th>
                      @if($type && $type == 'return_loan')
                        <th>Tanggal  Kembali</th>
                        <th>Denda</th>
                        <th>Denda Hilang</th>
                        <th>Aksi</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('loan.folder_loans', ['members' => $members, 'books' => $books, 'type' => $type])
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-14.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- dataTables --}}
    <script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>
    @if($type && $type == 'return_loan')
    <!-- pengembalian -->
    <script type="text/javascript">
    var table=
      $('#contact-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api/loan') }}" + "?type=",
        columns: [
          // {data: 'id', name: 'id'},
          {data: 'nomer_members', name: 'members'},
          {data: 'members', name: 'members'},
          {data: 'books', name: 'books'},
          {data: 'no_loan', name: 'no_loan'},
          {data: 'start_date', name: 'start_date'},
          {data: 'end_date', name: 'end_date'},
          {data: 'return_date', name: 'return_date'},
          {data: 'punishment', name: 'punishment'},
          {data: 'denda_hilang', name: 'denda_hilang'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });
    </script>
    @else
    <!-- peminjaman -->
    <script type="text/javascript">
    var table=
      $('#contact-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api/loan') }}" + "?type=",
        columns: [
          // {data: 'id', name: 'id'},
          {data: 'nomer_members', name: 'members'},
          {data: 'members', name: 'members'},
          {data: 'books', name: 'books'},
          {data: 'no_loan', name: 'no_loan'},
          {data: 'start_date', name: 'start_date'},
          {data: 'end_date', name: 'end_date'}
        ]
      });
    </script>
    @endif
      <script>
      function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Tambah Peminjaman');
      }
      function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PUT');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('loans') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Peminjaman');
            $('#id').val(data.id);
            $('#member_id').val(data.member_id);
            $('#book_id').val(data.book_id);
            $('#no_loan').val(data.no_loan);
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
            $('#return_date').val(data.return_date);
            $('#punishment').val(data.punishment);
            $('#no_member').val(data.members.no_member);
            $('#nama_anggota').val(data.member_id);
            $('#book_loan').val(data.books.title)
          },
          error : function() {
            alert("tidak ada Data");
          }
        });
      }
      function deleteData(id){
        var popup = confirm("Apa kamu bener-bener ingin menghapus data ini?");
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        if (popup == true ){
          $.ajax({
            url  : "{{ url('loans') }}" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token},
            success : function($data) {
              table.ajax.reload();
              console.log($data);
            },
            error : function () {
              alert("ADA YANG SALAH");
            }
          });
        }
      }
      function deleteData(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
          title: 'Apakah kamu yakin dude?',
          text: "Anda tidak akan dapat mengembalikan ini dude!",
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Hapus Weh lah!'
        }).
        then(function () {
          $.ajax({
            url : "{{ url('loans') }}" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token},
            success : function(data) {
              table.ajax.reload();
              swal({
                title: 'Berhasil Hore!',
                text: data.message,
                type: 'success',
                timer: '1500'
              })
            },
            error : function () {
              swal({
                title: 'Error Guys',
                text: data.message,
                type: 'error',
                timer: '1500'
              })
            }
          });
        });
      }
      $(function(){
        $('#modal-form form').validator().on('submit', function(e){
          if(!e.isDefaultPrevented()){
            // xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            console.log(save_method);
            console.log($('#modal-form form').serialize());
            var id = $('#id').val();
            if (save_method == 'add') url = "{{ url('loans') }}";
            else url ="{{ url('loans') . '/' }}" + id;
            $.ajax({
              url  : url,
              type : "POST",
              data : $('#modal-form form').serialize(),
              success : function($data) {
                // console.log($data);
                $('#modal-form').modal('hide');
                table.ajax.reload();
                if ($data.status == 'error' ) {
                swal({
                  title: 'Buku tidak tersedia!',
                  text: 'data error',
                  type: 'error',
                  timer: '2000'
                })
                } else {
                  swal({
                  title: 'Berhasil Dude!',
                  text: 'data berhasil',
                  type: 'success',
                  timer: '1500'
                })
                }
              },
              error : function(){
                swal({
                  title: 'Oops...',
                  text: 'erro kamu error',
                  type: 'error',
                  timer: '2500'
                })
              }
            });
            return false;
          }
        });
      });
    </script>
  </body>
</html>
