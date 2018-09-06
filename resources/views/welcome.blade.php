<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Smart House</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/material-icons.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/app.js') }}"></script>

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 74px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .banner {
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                height:65vh
            }

            @font-face {
              font-family: 'Material Icons';
              font-style: normal;
              font-weight: 400;
              src: url({{ asset( 'css/MaterialIcons-Regular.eot' ) }}); /* For IE6-8 */
              src: local('Material Icons'),
                   local('MaterialIcons-Regular'),
                   url({{ asset( 'css/MaterialIcons-Regular.woff2' )}} ) format('woff2'),
                   url({{ asset( 'css/MaterialIcons-Regular.woff' )}} ) format('woff'),
                   url({{ asset( 'css/MaterialIcons-Regular.ttf' )}} ) format('truetype');
            }

        </style>
    </head>
    <body>

        <div class="position-ref">

            <div class="content title">Smart House</div>

            <div class="content container-fluid">
                <div class="row">

                    <div class="col-sm-6 flex-center banner" style="background-image:url(images/img_login.jpg);">
                        @guest
                            <button type="button" class="btn btn-light btn-lg" data-toggle="modal" data-target="#LoginModal">
                              <h1><i class="material-icons md-18">account_circle</i> {{ __('Login') }}</h1>
                            </button>
                        @else
                            <a class="btn btn-light btn-lg" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" role="button">
                              <h1><i class="material-icons md-18">account_circle</i> {{ __('Logout') }}</h1>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                            </form>
                        @endguest
                    </div>

                    <div class="col-sm-6 flex-center banner" style="background-image:url(images/img_public.jpg);">
                        @guest
                              <a class="btn btn-dark btn-lg" href="{{ route('public') }}" role="button">
                                <h1><i class="material-icons md-18">public</i> {{ __('Público') }}</h1>
                              </a>
                        @else
                              <a class="btn btn-dark btn-lg" href="{{ route('home') }}" role="button">
                                  <h1><i class="material-icons md-18">dashboard</i> {{ __('Panel de Control') }}</h1>
                              </a>
                        @endguest
                    </div>

                </div>
            </div>
         </div>

           <!-- The Modal -->
           <div class="modal fade loginModal" id="LoginModal">
             <div class="modal-dialog">
               <div class="modal-content">

                 <div class="card">
                     <div class="card-header">{{ __('Login') }} <button type="button" class="close" data-dismiss="modal">&times;</button></div>

                     <div class="card-body">
                         <form method="POST" action="{{ route('login') }}">
                             @csrf

                             <div class="form-group row">
                                 <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                 <div class="col-md-6">
                                     <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                     @if ($errors->has('email'))
                                         <span class="invalid-feedback">
                                             <strong>{{ $errors->first('email') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group row">
                                 <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                 <div class="col-md-6">
                                     <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                     @if ($errors->has('password'))
                                         <span class="invalid-feedback">
                                             <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group row">
                                 <div class="col-md-6 offset-md-4">
                                     <div class="checkbox">
                                         <label>
                                             <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                         </label>
                                     </div>
                                 </div>
                             </div>

                             <div class="form-group row mb-0">
                                 <div class="col-md-8 offset-md-4">
                                     <button type="submit" class="btn btn-outline-success">
                                         {{ __('Login') }}
                                     </button>

                                     <a class="btn btn-link" href="{{ route('password.request') }}">
                                         {{ __('Forgot Your Password?') }}
                                     </a>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>

               </div>
             </div>
           </div>

        <footer class="flex-center container-fluid">
          <table>
              <tr class="flex-center font-weight-bold">
                <td>
                  John Alejandro Barahona Pineda
                </td>
              </tr>
              <tr class="flex-center font-weight-bold">
                <td>
                  <strong>César Ándres Tejada Torres</strong>
                </td>
              </tr>
              <tr class="flex-center">
                <td class="links">
                  <a href="#">Universidad del Quindío</a>
                </td>
              </tr>
          </table>
        </footer>

    </body>
</html>
