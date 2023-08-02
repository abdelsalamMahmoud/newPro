@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            {{__('massage.add')}}
        </div>

        <div class="customize-form">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{\Illuminate\Support\Facades\Session::get('success')}}</strong>
                </div>
            @endif
            <form enctype="multipart/form-data" id="offerForm">
                @csrf

                <div class="mb-3">
                    <label for="name_ar" class="form-label">{{__('massage.Offer name ar')}} </label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" autofocus>
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
                    <input type="text" class="form-control" id="name_en" name="name_en" autofocus>
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
                    <input id="price" type="text" class="form-control " name="price" >
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
                    <input id="details_ar" type="text" class="form-control " name="details_ar" >
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
                    <input id="details_en" type="text" class="form-control " name="details_en" >
                    @error('details_en')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">{{__('massage.photo')}}</label>
                    <input id="photo" type="file" class="form-control " name="photo" >
                    @error('photo')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                    @enderror
                </div>

                <button id="save_offer" class="btn btn-primary">
                    {{__('massage.save')}}
                </button>

            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click','#save_offer',function (e){
            e.preventDefault();
            var fromData = new fromData($('#offerForm')[0]);
            $.ajax({
                type :'POST',
                enctype :'multipart/form-data',
                url :"{{ route('ajax.offers.store') }}",
                data :fromData,
                processData:false,
                contentType:false,
                cache : false,
                success : function (data){
                }, error: function (reject){
                }
            });
        });

    </script>
@stop
