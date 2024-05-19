
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Kloud DOS - Hotel & Agent Platform">
        <meta name="author" content="Kloud DOS">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="/favicon.ico" />

        <title>Kloud DOS</title>
        
    {{-- @include('layout.head') --}}
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style>	/* Coded with love by Mutiullah Samim */
		body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			background: #ecf0f1; !important;
		}
		.user_card {
			/* height: 400px; */
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: white;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			/* padding: 10px; */
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #ecf0f1;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			/* background: #c0392b !important; */
			/* color: white !important; */
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			/* background: #c0392b !important; */
			/* color: white !important; */
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			/* background-color: #c0392b !important; */
            
        }
        .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        /* background-color: red; */
        /* color: white; */
        text-align: center;
        }
    </style>	 
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="../assets-admin/images/KD_logo.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
                    <form id="resetForm" class="form-horizontal m-t-20" action="/reset/new" method="post">
                        @csrf
                        <input type="hidden" id="reset_token" name="reset_token" value="{{ $reset_token }}" />
                        <div class="form-group ml-5 mr-5">
                            <div class="input-group-append">
                                <input class="form-control" id="password1" name="password1" type="password" required="" placeholder="New Password" />
                            </div>
                        </div>

                        <div class="form-group ml-5 mr-5">
                            <div class="input-group-append">
                                <input class="form-control" id="password2" name="password2"  type="password" required="" placeholder="Confirm Password" />
                            </div>
                        </div>

                        <div class="form-group text-center m-t-30 ml-5 mr-5">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-custom btn-bordred btn-block waves-effect waves-light" id="login">Reset</button>
                            </div>
                        </div>

                    </form>
				</div>

                @if (session('message'))
                    <div class="d-flex justify-content-center  alert alert-warning ml-0 mr-0" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="javascript:history.back()" class="text-muted"><i class="fa fa-lock m-r-5"></i> back to Login</a>
                    </div>
                </div>

			</div>
		</div>
    </div>
    <div class="footer">
            <div>Copyrights 2020, klouddos.com</div>
    </div>
    {{-- @include('layout.footer') --}}
</body>
</html>
