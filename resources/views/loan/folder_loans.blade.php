<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-contact" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('POST') }}
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id" name="id">
          <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="no_loan" class="col-md-3 control-label">Nomer Peminjaman</label>
                  <div class="col-md-6">
                    <input type="text" id="no_loan" name="no_loan" class="form-control" value="{{ $loanNomor }}" required>
                    <span class="help-block with-errors"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="member_id" class="col-md-3 control-label">Member id</label>
                  <div class="col-md-6">
                    <select class="form-control" name="member_id" id="member_id">
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block with-errors"></span>
                  </div>
                </div>
                @if($type == 'return_loan')
                  <div class="form-group">
                    <label for="return_date" class="col-md-3 control-label">Tanggal  kembali</label>
                    <div class="col-md-6">
                      <input type="date" id="return_date" name="return_date" class="form-control" required>
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="punishment" class="col-md-3 control-label">Denda</label>
                    <div class="col-md-6">
                      <input type="text" id="punishment" name="punishment" class="form-control" autofocus required readonly>
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
                @endif
                <div class="form-group">
                  <label for="select book" class="col-md-3 control-label">Pilih Buku</label>
                  <div class="col-md-6">
                    <select name="book_id" id="book_id">
                      <option value="">Pilih Buku</option>
                      @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="start_date" class="col-md-3 control-label">Tanggal Peminjaman</label>
                    <div class="col-md-6">
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $date }}" required>
                        <span class="text-block with-errors"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="end_date" class="col-md-3 control-label">Tanggal harus kembali</label>
                    <div class="col-md-6">
                      <input type="date" id="end_date" name="end_date" class="form-control" autofocus required>
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
              </div>
          </div>
          <div class="clearfix"></div>
<!--
          <div class="row">
            <div class="col-md-12">
              <table id="list-books" class="table table-responsive">
                <thead>
                  <tr>
                    <th width="30">Category</th>
                    <th>Title Book</th>
                    <th>Author</th>
                    <th>Isbn</th>
                    <th>Public Year</th>
                    <th>Publisher</th>
                    <th>Available</th>
                    <th>Acton</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div> -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-save" id="btn_ok_loan">OK</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cancel_loan">Cancel</button>
        </div>
      </form>
    </div>
  </div>
    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> -->
<!--     <link rel="stylesheet" type="text/css" href="{{ asset('datepicker/bootstrap-datepicker.css') }}">
    <script src="{{ asset('datepicker/jquery.min.js') }}"></script>
    <script src="{{ asset('datepicker/bootstrap-datepicker.js') }}"></script> -->

    <script>
      // $(document).ready(function(){
      //   $('#list-books').DataTable({
      //     processing: true,
      //     serverSide: true,
      //     ajax: "{{ route('api/book_checkbox') }}",
      //     data:{
      //       category_id: 2
      //     },
      //     columns: [
      //       // {data: 'id', name: 'id'},
      //       {data: 'category', name: 'category'},
      //       {data: 'title', name: 'title'},
      //       {data: 'author', name: 'author'},
      //       {data: 'isbn', name: 'isbn'},
      //       {data: 'public_year', name: 'public_year'},
      //       {data: 'publisher', name: 'publisher'},
      //       {data: 'available', name: 'available'},
      //       {data: 'action', name: 'action', orderable: false, searchable: false}
      //     ]
      //   });
      // });
      // $("#book_id").change(function(){
      //   // var cat_id = $("#book_id").val();


      // });
      $("#return_date").change(function(){
        console.log($(this).val());
        var end_date= $("#end_date").val();
        var return_date= $("#return_date").val();
        var from_date = end_date.split("-");

        var end = new Date(from_date[0], from_date[1], from_date[2]);

        var from_return = return_date.split("-");

        var start = new Date(from_return[0], from_return[1], from_return[2])

        days = (start - end) / (1000 * 60 * 60 * 24);
        total = Math.round(days);

        if(total > 0){
          punishment = 2000 * total

          $("#punishment").val(punishment);
        }
      });
    </script>
</div>