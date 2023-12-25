<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Offer;
use App\Models\forms\OfferForm;

class OfferController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::orderBy('created_at', 'desc')->get();
        $offersCounter = $offers->count();
    
        return view('offers.index', compact('offers', 'offersCounter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offer = new Offer();

        $offerForm = new OfferForm($offer);
        if ($offerForm->loadAndValidate($request) && $offerForm->save()) {
            return $this->index();
        }
        $errors = $offerForm->errors;
        return view('offers.create')->withErrors($errors);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = Offer::find($id); // Use find() method to fetch the offer by ID
        
        if (!$offer) {
            abort(404); // Offer not found, return a 404 error
        }
        
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offer = Offer::findOrFail($id); // Find the offer by ID
        
        return view('offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $offer = Offer::findOrFail($id); // Find the offer by ID
    
        $offerForm = new OfferForm($offer);
        if ($offerForm->loadAndValidate($request) && $offerForm->save()) {
            return redirect()->route('offers.index')->with('success', 'Offer updated successfully');
        }
        
        $errors = $offerForm->errors;
        return view('offers.edit', compact('offer'))->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the offer by ID and delete it
        $offer = Offer::findOrFail($id);
        $offer->delete();

        // Redirect to the desired route after deletion (e.g., index or any other route)
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully');
    }
}
