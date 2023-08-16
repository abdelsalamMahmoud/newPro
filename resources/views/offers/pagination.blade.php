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
            .image{
                width: 70px;
                height: 70px;
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
    @if(\Illuminate\Support\Facades\Session::has('deleted'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{\Illuminate\Support\Facades\Session::get('deleted')}}</strong>
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('massage.Offer name')}}</th>
            <th scope="col">{{__('massage.Offer Price')}}</th>
            <th scope="col">{{__('massage.Offer Details')}}</th>
            <th scope="col">{{__('massage.photo')}}</th>
            <th scope="col">{{__('massage.operation')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr>
                <th scope="row">{{$offer['id']}}</th>
                <td>{{$offer['name']}}</td>
                <td>{{$offer['price']}}</td>
                <td>{{$offer['details']}}</td>
                <td><img src="{{asset('images/offers/'.$offer->photo)}}" class="image"></td>
                <td>
                    <a href="{{url('offers/edit/'.$offer['id'])}}" class="btn btn-success">{{__('massage.update')}}</a>
                    <a href="{{route('offers.delete',$offer['id'])}}" class="btn btn-danger">{{__('massage.delete')}}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $offers->links() !!}
    </div>
    </body>
</html>
