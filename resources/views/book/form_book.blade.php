<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-contact" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
        {{ csrf_field() }} 
        {{ method_field('POST') }}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="category_id" class="col-md-3 control-label">Kategori</label>
            <div class="col-md-6">
              <select class="form-control" name="category_id" id="category_id">
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="Title" class="col-md-3 control-label">Judul Buku</label>
            <div class="col-md-6">
              <input type="text" id="title" name="title" autocomplete="off" class="form-control" autofocus required>
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="author" class="col-md-3 control-label">Pengarang</label>
            <div class="col-md-6">
              <input type="text" id="author" autocomplete="off" name="author" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="isbn" class="col-md-3 control-label">Isbn</label>
            <div class="col-md-6">
            <input type="text" id="isbn" autocomplete="off" name="isbn" onkeypress="return isNumberKey(event)" class="form-control"  required>
              <span class="text-block with-errors"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
            <label for="public_year" class="col-md-3 control-label">Tahun Terbit</label>
            <div class="col-md-6">
              <input type="text" id="public_year" autocomplete="off" name="public_year" class="form-control" autofocus required>
              <span class="help-block with-errors"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="publisher"  class="col-md-3 control-label">Penerbit</label>
            <div class="col-md-6">
              <input type="text" id="publisher" autocomplete="off" name="publisher" class="form-control" autofocus required>
              <span class="help-block with-errors"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="available" class="col-md-3 control-label">Tersedia</label>
            <div class="col-md-6">
              <input type="number" id="available" autocomplete="off" name="available" class="form-control" autofocus required>
              <span class="help-block with-errors"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-save" id="btn-ok">OK</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cancel">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
<SCRIPT>
  <!--
  function isNumberKey(evt)
  {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

      return true;
  }
</script>