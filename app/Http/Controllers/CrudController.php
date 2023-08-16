<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use OfferTraits;
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOffers()
    {
       return Offer::get();
    }

    public function create(){
        return view('offers.create');
    }

    public function store(offerRequest $request){
        //validate data
        //we make a validation logic in offerRequest class

        //save photo on its folder
        $file_name = $this->saveImage($request->photo ,'images/offers');

        //then insert
        Offer::create([
            'price'=>$request->price,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
            'photo'=>$file_name,
        ]);
        return redirect()->back()->with(['success'=>'offer added successfully']);
    }

    public function getAllOffers(){
//        $offers = Offer::select('id',
//            'price',
//            'photo',
//            'name_'.LaravelLocalization::getCurrentLocale().' as name',
//            'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();//this function will return collection with all results

        ###############paginate results################
        $offers = Offer::select('id',
            'price',
            'photo',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details')->paginate(PAGINATION_COUNT);

        return view('offers.pagination',compact('offers'));
    }

    public function editOffer($offer_id){
        //Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
        if(! $offer){
            return redirect()->back();
        }

        $offer=Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($offer_id);

        return view('offers.edit',compact('offer'));
    }

    public function delete($offer_id){
        $offer = Offer::find($offer_id);
        if(! $offer){
            return redirect()->back()->with(['error'=>__('massage.not')]);
        }

        $offer->delete();
        return redirect()
            ->route('offers.all')
            ->with(['deleted'=>__('massage.deleted')]);
    }

    public function updateOffer(offerRequest $request,$offer_id){
        //validation first
        //we make a validation logic in offerRequest class

        //check if it exists
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        //then update
        $offer->update($request->all());
        return redirect()->back()->with(['success'=>'offer updated successfully']);
    }

    public function getVideo(){
        $video = Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video',$video);
    }

}
