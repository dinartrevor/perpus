<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
// function addForm() {
      //   save_method = "add";
      //   $('input[name=_method]').val('POST');
      //   $('#modal-form').modal('show');
      //   $('#modal-form form')[0].reset();
      //   $('.modal-title').text('Add Contact');
      // }
      // function editForm(id) {
      //   save_method = 'edit';
      //   $('input[name=_method]').val('PATCH');
      //   $('#modal-form form')[0].reset();
      //   $.ajax({
      //     url: "{{ url('contact') }}" + '/' + id + "/edit",
      //     type: "GET",
      //     dataType: "JSON",
      //     success: function(data) {
      //       $('#modal-form').modal('show');
      //       $('.modal-title').text('Edit Contact');
      //       $('#id').val(data.id);
      //       $('#name').val(data.name);
      //       $('#email').val(data.email);
      //     },
      //     error : function() {
      //       alert("tidak ada Data");
      //     }
      //   });
      // }
      // function deleteData(id){
      //   var popup = confirm("Apa kamu bener-bener ingin menghapus data ini?");
      //   var csrf_token = $('meta[name="csrf-token"]').attr('content');
      //   if (popup == true ){
      //     $.ajax({
      //       url  : "{{ url('contact') }}" + '/' + id,
      //       type : "POST",
      //       data : {'_method' : 'DELETE', '_token' : csrf_token},
      //       success : function($data) {
      //         table.ajax.reload();
      //         console.log($data);
      //       },
      //       error : function () {
      //         alert("ADA YANG SALAH");
      //       }
      //     });
      //   }
      // }
      // function deleteData(id){
      //   var csrf_token = $('meta[name="csrf-token"]').attr('content');
      //   swal({
      //     title: 'Apakah kamu yakin dude?',
      //     text: "Anda tidak akan dapat mengembalikan ini dude!",
      //     type: 'warning',
      //     showCancelButton: true,
      //     cancelButtonColor: '#d33',
      //     confirmButtonColor: '#3085d6',
      //     confirmButtonText: 'Hapus Weh lah!'
      //   }).
      //   then(function () {
      //     $.ajax({
      //       url : "{{ url('contact') }}" + '/' + id,
      //       type : "POST",
      //       data : {'_method' : 'DELETE', '_token' : csrf_token},
      //       success : function(data) {
      //         table.ajax.reload();
      //         swal({
      //           title: 'Berhasil Hore!',
      //           text: data.message,
      //           type: 'success',
      //           timer: '1500'
      //         })
      //       },
      //       error : function () {
      //         swal({
      //           title: 'Error Guys',
      //           text: data.message,
      //           type: 'error',
      //           timer: '1500'
      //         })
      //       }
      //     });
      //   });
      // }
      // $(function(){
      //   $('#modal-form form').validator().on('submit', function(e){
      //     if(!e.isDefaultPrevented()){
      //       // xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
      //       var id = $('#id').val();
      //       if (save_method == 'add') url = "{{ url('contact') }}";
      //       else url ="{{ url('contact') . '/' }}" + id;
      //       $.ajax({
      //         url  : url,
      //         type : "POST",
      //         // data : $('#modal-form form').serialize(),
      //         data: new FormData($("#modal-form form")[0]),
      //         contentType: false,
      //         processData: false,
      //         success : function(data) {
      //           // alert("data telah disampan")
      //           $('#modal-form').modal('hide');
      //           table.ajax.reload();
      //           swal({
      //             title: 'Berhasil Dude!',
      //             text: 'data berhasil',
      //             type: 'success',
      //             timer: '1500'
      //           })
      //         },
      //         error : function(){
      //           swal({
      //             title: 'Oops...',
      //             text: 'ada yang salah',
      //             type: 'error',
      //             timer: '1500'
      //           })
      //         }
      //       });
      //       return false;
      //     }          
      //   });  
      // });
