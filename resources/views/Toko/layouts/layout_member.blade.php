<!DOCTYPE html>
<html lang="en">
<head>
    <title>Toko Widiatno</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    
    <style>
            nav ul>li>a:hover{
                font-size: x-large;
                color: #fff;
            }

            nav ul>li>a:active {
                font-size: x-large;
            }
            .medsos{
                background-color: rgb(192, 192, 192);
            }
            .medsos ul li{
                display: inline;
                color: #fff;
                margin-right: 1px;
            }
    </style>
</head>
<body>
<div class='container-fluid bg-info text-white'>
    <i class='top-header-date-icon bi bi-calendar'></i>
        <script>
        var d=new Date();
        var weekday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
        var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
        document.write(weekday[d.getDay()] + ", ");
        document.write(monthname[d.getMonth()] + " ");
        document.write(d.getDate() + " ");
        document.write(d.getFullYear());
        </script>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-white text-primary mb-2 sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary" style="font-family:Brush Script MT;font-size:40px" href="/">
                <img src="{{ asset('images/logo.jpg') }}" alt="logo" width="50" height="50" href="/home"> Widiatno
            </a>
    
    <div>
    <div class="navbar-right">
        <!-- Right Side Of Navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <!--Menghitung jumlah cart-->
                                <?php
                                $list_cart = DB::table('cart_details')
                                            ->leftjoin('all_carts','all_carts.id','cart_details.cart_id')
                                            ->select('all_carts.status','cart_details.cart_id')
                                            ->where('status','cart')
                                            ->where('cart_details.user_id', Auth::user()->id)
                                            ->count();
                                ?>
                                <a class="nav-link text-primary" id="menuCart" href="{{ url('/cart_detail')}}"><i class="bi bi-cart3" aria-hidden="true"></i>
                                <span class="badge badge-pill badge-danger">{{$list_cart}}</span></a>
                            </li>
                            <li class="nav-item">
                                <!--Menghitung jumlah transaksi-->
                                <?php
                                 $list_transaksi = \App\all_cart::where('user_id', Auth::user()->id)->where('status','Checkout')->count();
                                ?>
                              <a class="nav-link text-primary" id="menuTransaksi" href="{{ url('/data_transaksi')}}"><i class="bi bi-bell"></i><span class="badge badge-pill badge-danger">{{ $list_transaksi }}</span></a>
                            </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('profile') }}">
                                        My Profile
                                    </a>
                                    <a class="dropdown-item" href="{{route('changePassword')}}">{{ __('Change Password') }}</a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
        </div>
        </div>
      </div>
    </div>
  </div>
</nav>

@yield('toko_eka')
<div class="container">
  <div class="row">
    <div class="col">
      <hr />
      <p>&copy Copyright Eka Ari Widiatno - 2022</p>
    </div>
  </div>
</div>
</body>  

</html>