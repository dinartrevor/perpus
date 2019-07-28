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
                  <label for="no_loan" class="col-md-3 control-label">Nomer Anggota</label>
                  <div class="col-md-6">
                    <input type="text" id="no_member" class="form-control" disabled="disabled">
                    <span class="help-block with-errors"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="member_id" class="col-md-3 control-label">Nama Anggota</label>
                  <div class="col-md-6">
                    <select class="form-control" name="member_id" id="nama_anggota">
                    <option value="">Pilih Anggota</option>
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
                  <div class="form-group">
                    <label for="punishment" class="col-md-3 control-label">Denda Hilang</label>
                    <div class="col-md-6">
                      <input type="text" id="denda_hilang" name="denda_hilang" class="form-control" autofocus value="0">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="select book" class="col-md-3 control-label">Buku</label>
                  <div class="col-md-6">
                    <input type="text" id="book_loan" disabled>
                  </div>
                </div>
                @else
                <div class="form-group">
                  <label for="select book" class="col-md-3 control-label">Pilih Buku</label>
                  <div class="col-md-6">
                    <select name="book_id" class="form-control" id="book_id">
                      <option value="">Pilih Buku</option>
                      @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                @endif
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_date" class="col-md-3 control-label">Tanggal Peminjaman</label>
                  <div class="col-md-6">
                      <input type="text" id="start_date"  name="start_date" class="form-control" value="{{ $date }}" required>
                      <span class="text-block with-errors"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="end_date" class="col-md-3 control-label">Tanggal harus kembali</label>
                  <div class="col-md-6">
                    <input type="text" id="end_date" name="end_date" class="form-control" autofocus required autocomplete="off">
                    <span class="help-block with-errors"></span>
                  </div>
                </div>
              </div>
            </div>
          <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-save" id="btn_ok_loan">OK</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cancel_loan">Cancel</button>
        </div>
      </form>
    </div>
  </div>
    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script>
    $(document).ready(function(){
      var startDate = new Date('01/01/2012');
    var FromEndDate = new Date();
    var ToEndDate = new Date();
    ToEndDate.setDate(ToEndDate.getDate() + 365);

    $('#start_date').datepicker({
    weekStart: 1,
    startDate: '01/01/2012',
    endDate: FromEndDate,
    autoclose: true
    })
    .on('changeDate', function (selected) {
            startDate = new Date(selected.date.valueOf());
            startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
            $('#end_date').datepicker('setStartDate', startDate);
        });
    $('#end_date')
        .datepicker({
            weekStart: 1,
            startDate: startDate,
            endDate: ToEndDate,
            autoclose: true
        })
        .on('changeDate', function (selected) {
            FromEndDate = new Date(selected.date.valueOf());
            FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
            $('#start_date').datepicker('setEndDate', FromEndDate);
        });
    });

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

      $('#nama_anggota').change(function(){
        $.ajax({
          url: "/api/loan/anggota/" + this.value,
          type: 'get',
          success: function(response) {
            $('#no_member').val(response.no_member);
          },
          error: function(response) {
            $('#no_member').val('');
          }
        })
      })
    </script>
</div>