@extends('layouts.appLogin')
@section('content')

    <div class="col-xl-6 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
        <div class="lavalite-bg" style="background-image: url('./img/auth/labo.jpg')">
            <div class="lavalite-overlay"></div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-7 my-auto p-0 container-fluid">
        <div class="authentication-form mx-auto">
            <div class="text-center ">
                <a href="{{ route('login') }}"><img src="./img/logoB.png" class="img-responsive" width="200px;"></a>
            </div>

            <form method="POST" action="{{ route('login') }}"><br>
            @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <i class="ik ik-user"></i>
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="current-password" placeholder="Contraseña">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <i class="ik ik-lock"></i>
                </div>
                <div class="row">
                    <div class="col text-left">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            {{--<input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">--}}
                            <span class="custom-control-label">&nbsp;Recordarme</span>
                        </label>
                    </div>
                    <div class="col text-right">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Olvido su contraseña ?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="sign-btn text-center">
                    <button type="submit" class="btn btn-theme">Entrar</button>
                </div>
            </form>
            <!--div class="register">
                <p>No tiene una cuenta? <a href="{{ route('register') }}">Registrarme!</a></p>
            </div-->
        </div>
    </div>

@endsection
