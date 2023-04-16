<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Finance at its best!">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Title -->
    <title>Reset Password</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <script src="https://use.fontawesome.com/af31fc02ea.js"></script>
    

    
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/perfectscroll/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/pace/pace.css') }}">

    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/neptune.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/neptune.png') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div class="app-content">
        <div class="content-wrapper">
            <div class="container">
                    <div class="row">
                        <div class="col mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center">
                                        Please insert your new password.
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session()->has('status'))
                    <div class="text-center alert alert-success">
                        {{ session()->get('status') }}
                    </div>
                    @endif
                    @if (session()->has('errors'))
                    <div class="text-center alert alert-danger">
                        {{ session()->get('errors') }}
                    </div>
                    @endif  
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('password.update') }}" method="POST" id="rpass">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input name="email" type="email" class="form-control" id="inputEmail3">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input name="password" type="password" class="form-control" id="inputPassword3">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm New Password</label>
                                            <div class="col-sm-10">
                                                <input name="password_confirmation" type="password" class="form-control" id="inputPassword3">
                                            </div>
                                        </div>
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="submit" onclick="document.getElementById('rpass').submit();" class="btn btn-primary" value="Submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
</body>
</html>


