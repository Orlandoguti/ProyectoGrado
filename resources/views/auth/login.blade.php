@extends('auth.contenido')

@section('login')
    <div class="limiter">
        <div class="container-login100">
            <div class="login-container">
                <img src="../auth/images/logo.png" alt="Imagen de inicio de sesión" class="login-image">
            </div>
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <span class="login100-form-title p-b-1">
                        INICIAR SESION
                    </span>
                    <div class="wrap-input100 validate-input"
                         data-validate="Ingrese el Email">
                        <input value="{{ old('email') }}" class="input100" type="email" name="email" id="email">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Ingrese la Contraseña">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="contraseña" id="contraseña">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                    @if($errors->has('message'))
                        <div class="alert alert-danger mt-2 error-message">{{ $errors->first('message') }}</div>
                    @endif
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Iniciar Sesion
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-30">
                        <span class="txt1">
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
