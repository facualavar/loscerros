@extends('layouts.appLogin')
@section('content')

    <div class="col-xl-6 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
        <div class="lavalite-bg" style="background-image: url('../img/auth/nature-7.jpg')">
            <div class="lavalite-overlay"></div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-7 my-auto p-0">
        <div class="authentication-form mx-auto">
            <div class="logo-centered">
                <a href="{{ route('login') }}"><img src="../img/logoB.png" alt="" width="230px;"></a>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre">

                   @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <i class="ik ik-user"></i>
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <i class="ik ik-user"></i>
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password" placeholder="Contraseña">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <i class="ik ik-lock"></i>
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
                    <i class="ik ik-eye-off"></i>
                </div>

                <div class="sign-btn text-center">
                    <button type="submit" class="btn btn-theme">Registrarse</button>
                </div>
            </form>
            <div class="register">
                <p>Ya tenes una cuenta? <a href="{{route('login')}}">Entrar</a></p>
            </div>
        </div>
    </div>

@endsection
