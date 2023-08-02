<?php

namespace App\Http\Controllers;
use App\Traits\OfferTraits;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use OfferTraits;

    public function create(){
        //view form to add offer
        return view('AJAXoffers.create');
    }

    public function store(Request $request){
        //save offer to database using AJAX
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
}
