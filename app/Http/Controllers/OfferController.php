<?php

namespace App\Http\Controllers;
use App\Http\Requests\offerRequest;
use App\Traits\OfferTraits;
use App\Models\Offer;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTraits;

    public function create(){
        //view form to add offer
        return view('AJAXoffers.create');
    }

    public function store(offerRequest $request){
        //save offer to database using AJAX
        $file_name = $this->saveImage($request->photo ,'images/offers');

        //then insert
        $offer = Offer::create([
            'price'=>$request->price,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
            'photo'=>$file_name,
        ]);
        if($offer){
            return response()->json([
                'status'=>true,
                'msg'=>'offer added successfully',
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'offer cannot be added',
            ]);
        }
    }

    public function all(){
        $offers = Offer::select('id',
            'price',
            'photo',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();//this function will return collection
        return view('AJAXoffers.all',compact('offers'));
    }

    public function delete(Request $request){
        $offer = Offer::find($request->id);
        if(! $offer){
            return redirect()->back()->with(['error'=>__('massage.not')]);
        }

        $offer->delete();

        return response()->json([
            'status'=>true,
            'msg'=>'offer deleted successfully',
            'id'=>$request->id,
        ]);
    }

    public function edit(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer){

            return response()->json([
                'status'=>false,
                'msg'=>'there is no offer with this id',
            ]);
        }

        $offer=Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($request->id);

        return view('AJAXoffers.edit',compact('offer'));
    }

    public function update(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer){
            return response()->json([
                'status'=>false,
                'msg'=>'there is no offer with this id',
            ]);
        }
        //then update
        $offer->update($request->all());
        return response()->json([
            'status'=>true,
            'msg'=>'offer updated successfully',
        ]);
    }
}
