<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .customize-form{
                width: 40%;
                margin: auto;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                    </li>
                    @endforeach
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="{{__('massage.search')}}" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">{{__('massage.search')}}</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="title m-b-md">
            {{__('massage.edit')}}
        </div>

        <div class="customize-form">

            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{\Illuminate\Support\Facades\Session::get('success')}}</strong>
                </div>
            @endif

           <form method="POST" action="{{ route('offers.update',$offer['id'])}}">
            @csrf

            <div class="mb-3">
                <label for="name_ar" class="form-label">{{__('massage.Offer name ar')}} </label>
                <input type="text" class="form-control" id="name_ar" value="{{$offer['name_ar']}}" name="name_ar" autofocus>
                @error('name_ar')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                       <div>
                        {{ $message }}
                       </div>
                   </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name_en" class="form-label">{{__('massage.Offer name en')}}</label>
                <input type="text" class="form-control" id="name_en" value="{{$offer['name_en']}}" name="name_en" autofocus>
                @error('name_en')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">{{__('massage.Price')}}</label>
                <input id="price" type="text" class="form-control " name="price" value="{{$offer['price']}}" >
                @error('price')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="details_ar" class="form-label">{{__('massage.Details ar')}}</label>
                <input id="details_ar" type="text" class="form-control " name="details_ar"  value="{{$offer['details_ar']}}">
                @error('details_ar')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="details_ar" class="form-label">{{__('massage.Details en')}}</label>
                <input id="details_en" type="text" class="form-control " name="details_en" value="{{$offer['details_en']}}" >
                @error('details_en')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                {{__('massage.save')}}
            </button>

        </form>
        </div>

    </div>
    </body>
</html>
