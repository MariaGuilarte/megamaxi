@extends('auth.contenido')

@section('login')
<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <form class="login100-form validate-form" method="post" action="{{route('login')}}">
                {{csrf_field()}}
                <span class="login100-form-title p-b-37">
                    Iniciar Sesión
                </span>

                <div class="wrap-input100 m-b-20 {{$errors->has('usuario' ? 'is-invalid' : '')}}" >
                    <input class="input100" type="text" name="usuario" id="usuario" placeholder="Ingrese el usuario" value="{{old('usuario')}}">
                      
                 {!! $errors->first('usuario','<div class="alert alert-danger" role="alert">:message</div>')!!}
                 

                </div>
             
                <div class="wrap-input100 m-b-25 {{$errors->has('password' ? 'is-invalid' : '')}}" >
                    <input class="input100" type="password" name="password" id="password" placeholder="Ingrese la contraseña">
               {!! $errors->first('password','<div class="alert alert-danger" role="alert">:message</div>')!!}
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Ingresar
                    </button>
                </div>

               

            
            </form>

            
        </div>
@endsection
