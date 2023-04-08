@extends('Toko.layouts.layout_member')

@section('toko_eka') 
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-user"></i> My Profile</h4>
                    <table class="table">
                        <tbody>
                        @if(session('profile'))
                            <div class="container alert alert-success text-center" role="alert">
                                {{session('profile')}}
                            </div>
                        @endif
                            <tr>
                                <td>Nama</td>
                                <td width="10">:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td>{{ $user->nohp }}
                                @if(session('Identitas'))
                                    <div class="container alert alert-danger text-center" role="alert">
                                            {{session('Identitas')}}
                                    </div>
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat Pengiriman</td>
                                <td>:</td>
                                <td>{{ $user->alamat }}<br />
                                    {{ $user->kelurahan}}, {{ $user->kecamatan}}<br />
                                    {{ $user->kota_kabupaten}}, {{ $user->provinsi}} - {{ $user->kode_pos}}
                                @if(session('Identitas'))
                                    <div class="container alert alert-danger text-center" role="alert">
                                            {{session('Identitas')}}
                                    </div>
                                @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-pencil-alt"></i> Edit Profile</h4>
                    <form method="POST" action="{{ url('profile') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nohp" class="col-md-2 col-form-label text-md-right">No. HP</label>

                            <div class="col-md-6">
                                <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{ $user->nohp }}" required autocomplete="nohp" autofocus>

                                @error('nohp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat, provinsi" class="col-md-2 col-form-label text-md-right">Alamat Pengiriman</label>

                            <div class="col-md-6">
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $user->alamat }}" required autocomplete="alamat" autofocus>
                            <table>
                                    <tr>
                                        <td>
                                        <input id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ $user->provinsi }}" placeholder="Provinsi" required autocomplete="provinsi" autofocus>
                                        </td>
                                        <td>
                                        <input id="kota_kabupaten" type="text" class="form-control @error('alamat') is-invalid @enderror" name="kota_kabupaten" value="{{ $user->kota_kabupaten }}" placeholder="Kota">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <input id="kecamatan" type="text" class="form-control @error('alamat') is-invalid @enderror" name="kecamatan" value="{{ $user->kecamatan }}" placeholder="Kecamatan">
                                        </td>
                                        <td>
                                        <input id="kelurahan" type="text" class="form-control @error('alamat') is-invalid @enderror" name="kelurahan" value="{{ $user->kelurahan }}" placeholder="Kelurahan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <input id="kode_pos" type="text" class="form-control @error('alamat') is-invalid @enderror" name="kode_pos" value="{{ $user->kode_pos }}" placeholder="Kode Pos">
                                        </td>
                                    </tr>
                                
                            </table>                    
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection