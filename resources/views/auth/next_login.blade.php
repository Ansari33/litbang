<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title">Login</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<i aria-hidden="true" class="ki ki-close"></i>
		</button>
	</div>
	<div class="modal-body">

  <form class="form" novalidate="novalidate" id="kt_login_signin_form">
						<div class="pb-13 pt-lg-0 pt-5 text-center">
							<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Selamat Datang di Accounting</h3>
						</div>
						<div class="form-group">
							<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="email" autocomplete="off" value=""/>
						</div>
						<div class="form-group">
							<div class="d-flex justify-content-between mt-n5">
								<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
							</div>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" value=""/>
						</div>
						<div class="pb-lg-0 pb-5">
							<button type="button" id="kt_login_signin_submit" onclick="login()" class="btn btn-primary btn-block font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Login</button>
						</div>
		</form>

	</div>
	<!-- <div class="modal-footer">
		<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
		<button type="button" id="btn_add_barang_Jasa" class="btn btn-primary font-weight-bold">Tambah</button>
	</div> -->
</div>

<script>
	function login() {
    const $form = $('#kt_login_signin_form');
    var btn_login = KTUtil.getById("kt_login_signin_submit");
    KTUtil.btnWait(btn_login, "spinner spinner-right spinner-white pr-15", "Please wait");
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type: "POST",
      timeout: 50000,
      url: '{{ route('login') }}',
      data: $form.serialize(),
      success: function (res) {
        Swal.fire('Berhasil!', 'Anda Berhasil Login', 'success');
        $(`#loginModal`).modal('hide');
        //window.location.replace("{{ url('/')  }}");
     //   add_page('dashboard','dashboard','Dashboard');
        console.log(res);
      },
      error: function (res, textstatus) {
        KTUtil.btnRelease(btn_login);
        if (textstatus === "timeout") {
          swal.fire({
            text: "Response Time Out.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        } else {
          swal.fire({
            text: res.responseJSON.message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        }
        
      }
    });
  }
</script>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<base href="{{ url('/') }}">
	<meta charset="utf-8"/>
	<title>Accounting | Login</title>
	<meta name="description" content="Accounting Login"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
	
	<link href="{{ asset('css/pages/login/login-1.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('css/themes/layout/header/base/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('css/themes/layout/header/menu/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('css/themes/layout/brand/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('css/themes/layout/aside/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}"/>
</head> -->

<!-- <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<div class="d-flex flex-column flex-root">
	<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">

		<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
			<div class="d-flex flex-column-fluid flex-center">
				<div class="login-form login-signin">
					<form class="form" novalidate="novalidate" id="kt_login_signin_form">
						<div class="pb-13 pt-lg-0 pt-5 text-center">
							<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Selamat Datang di Accounting</h3>
						</div>
						<div class="form-group">
							<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="email" autocomplete="off" value=""/>
						</div>
						<div class="form-group">
							<div class="d-flex justify-content-between mt-n5">
								<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
								
							</div>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" value=""/>
						</div>
						<div class="pb-lg-0 pb-5">
							<button type="button" id="kt_login_signin_submit" class="btn btn-primary btn-block font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Login</button>
						</div>
            <a href="javascript:" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Lupa Password ?</a>
					</form>
				</div>
				<div class="login-form login-forgot">
					<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
						<div class="pb-13 pt-lg-0 pt-5">
							<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Lupa Password ?</h3>
							<p class="text-muted font-weight-bold font-size-h4">Masukan email anda untuk mereset password</p>
						</div>
						<div class="form-group">
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off"/>
						</div>
						<div class="form-group d-flex flex-wrap pb-lg-0">
							<button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Kirim</button>
							<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Batal</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(function(){
        $('#kt_login_signin_submit').on('click',function(){
            const $form = $('#kt_login_signin_form');
            var btn_login = KTUtil.getById("kt_login_signin_submit");
            KTUtil.btnWait(btn_login, "spinner spinner-right spinner-white pr-15", "Please wait");
            $.ajaxSetup({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({
              type: "POST",
              timeout: 50000,
              url: '{{ route('login') }}',
              data: $form.serialize(),
              success: function (res) {
                
              },
              error: function (res, textstatus) {
                KTUtil.btnRelease(btn_login);
                if (textstatus === "timeout") {
                  swal.fire({
                    text: "Response Time Out.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                      confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                  }).then(function () {
                    KTUtil.scrollTop();
                  });
                } else {
                  swal.fire({
                    text: res.responseJSON.message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                      confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                  }).then(function () {
                    KTUtil.scrollTop();
                  });
                }
                
              }
            });
        });
    });
  // function login() {
    
  // }
</script>

