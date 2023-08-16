@extends('layouts.app')

@section('content')
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none" id="DeleteS">
            <strong>offer deleted successfully</strong>
        </div>
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
            <tr class="offerRow{{$offer['id']}}">
                <th scope="row">{{$offer['id']}}</th>
                <td>{{$offer['name']}}</td>
                <td>{{$offer['price']}}</td>
                <td>{{$offer['details']}}</td>
                <td><img src="{{asset('images/offers/'.$offer->photo)}}" class="image"></td>
                <td>
                    <a href="{{url('offers/edit/'.$offer['id'])}}" class="btn btn-success">{{__('massage.update')}}</a>
                    <a href="{{route('offers.delete',$offer['id'])}}" class="btn btn-danger">{{__('massage.delete')}}</a>
                    <a href="" offer_id="{{$offer['id']}}" class="deleteAjax btn btn-danger">delete Ajax</a>
                    <a href="{{route('ajax.offer.edit',$offer['id'])}}" class="btn btn-danger">edit Ajax</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('scripts')
    <script>
        $(document).on('click','.deleteAjax',function (e){
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type :'POST',
                url :"{{ route('ajax.offers.delete') }}",
                data :{
                    '_token':"{{csrf_token()}}",
                    'id':offer_id,
                },
                success : function (data){
                    if(data.status == true){
                        $('#DeleteS').show();
                    }
                    $('.offerRow'+data.id).remove();

                }, error: function (reject){
                }
            });
        });

    </script>
@stop
