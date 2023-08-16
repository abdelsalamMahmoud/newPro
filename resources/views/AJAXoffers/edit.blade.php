@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            {{__('massage.edit')}}
        </div>

        <div class="customize-form">
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert_success" style="display: none">
                <strong>offer updated successfully</strong>
            </div>
            <form method="POST" id="offerFormUpdate" action="">
                @csrf
                <input type="hidden" class="form-control" id="id" value="{{$offer['id']}}" name="id">
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

                <button id="update_offer" class="btn btn-primary">
                    update
                </button>

            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click','#update_offer',function (e){
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type :'POST',
                enctype :'multipart/form-data',
                url :"{{ route('ajax.offers.update') }}",
                data :formData,
                processData:false,
                contentType:false,
                cache : false,
                success : function (data){
                    if(data.status == true){
                        $('#alert_success').show();
                    }

                }, error: function (reject){
                }
            });
        });

    </script>
@stop
