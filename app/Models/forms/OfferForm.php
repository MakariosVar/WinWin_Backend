<?php

namespace App\Models\forms;

use Illuminate\Http\Request;

class OfferForm
{
    private $offer;

    public $id;
    public $name;

    public $amount;
    public $image;
    public $sponsored;
    public $repeated;
    public $expired_at;

    public $errors;


    public function __construct($offer) {
        $this->setOffer($offer);
    }

    public function setOffer($offer) {
        $this->offer = $offer;
    }
    
    public function getOffer() {
        return $this->offer;
    }

    public function loadAndValidate(Request $request) {
    
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'amount' => 'nullable|numeric',
            'sponsored' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048'
        ]);
        
        // Custom error message for the 'name' attribute
        $customMessages = [
            'name.required' => 'Το όνομα είναι απαραίτητο πεδίο.',
            'image.image' => 'Το αρχείο πρέπει να είναι εικόνα.',
            'image.max' => 'Το μέγιστο μέγεθος εικόνας είναι 2MB.'
        ];
    
        // Apply custom messages to the validator
        $validator->setCustomMessages($customMessages);
        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            return false; // Validation failed
        }
    
        // If validation passes, set the properties with the data
        $this->name = request('name');
        $this->amount = request('amount');
        $this->sponsored = $request->has('sponsored'); 
        $this->repeated = empty($this->amount);

        // Handle file upload (image)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public'); // Adjust the storage path as needed
            $this->image = $imagePath;
        } elseif ($request->input('image') === null) {
            // If the image field is empty in the request, keep the existing image
            $this->image = $this->getOffer()->image;
        }

        return true; // Validation successful
    }

    public function save() {
        $offer  = $this->getOffer();

        $offer->name = $this->name;
        $offer->amount = $this->amount;
        $offer->sponsored = $this->sponsored;
        $offer->repeated = $this->repeated;
        $offer->image = $this->image;

        if ($offer->save()) {
            return true;
        }
        return false;
    }
}