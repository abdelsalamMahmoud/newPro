@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            {{__('massage.add')}}
        </div>

        <div class="customize-form">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert_success" style="display: none">
                    <strong>offer added successfully</strong>
                </div>
            <form id="offerForm" enctype="multipart/form-data" >
                @csrf

                <div class="mb-3">
                    <label for="name_ar" class="form-label">{{__('massage.Offer name ar')}} </label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" autofocus>
                    <div id="name_ar_error" class="text-bg-danger" role="alert">
                        <div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name_en" class="form-label">{{__('massage.Offer name en')}}</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" autofocus>
                    <div id="name_en_error" class="text-bg-danger" role="alert">
                        <div>

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">{{__('massage.Price')}}</label>
                    <input id="price" type="text" class="form-control " name="price" >
                    <div id="price_error" class="text-bg-danger" role="alert">
                        <div>

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="details_ar" class="form-label">{{__('massage.Details ar')}}</label>
                    <input id="details_ar" type="text" class="form-control " name="details_ar" >
                    <div id="details_ar_error" class="text-bg-danger" role="alert">
                        <div>

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="details_en" class="form-label">{{__('massage.Details en')}}</label>
                    <input id="details_en" type="text" class="form-control " name="details_en" >

                    <div id="details_en_error" class="text-bg-danger" role="alert">
                        <div>

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">{{__('massage.photo')}}</label>
                    <input id="photo" type="file" class="form-control " name="photo" >
                    <div id="photo_error" class="text-bg-danger" role="alert">
                        <div>

                        </div>
                    </div>
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
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            $('#photo_error').text('');
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type :'POST',
                enctype :'multipart/form-data',
                url :"{{ route('ajax.offers.store') }}",
                data :formData,
                processData:false,
                contentType:false,
                cache : false,
                success : function (data){
                    if(data.status == true){
                        $('#alert_success').show();
                    }

                }, error: function (reject){
                    var response = $.parseJSON (reject.responseText);
                    $.each (response.errors, function (key ,val){
                        $("#"+key+ "_error").text(val[0]);
                    });
                }
            });
        });

    </script>
@stop
