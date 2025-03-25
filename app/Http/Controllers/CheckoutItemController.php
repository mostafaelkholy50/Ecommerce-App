<?php

namespace App\Http\Controllers;

use App\Models\CheckoutItem;
use App\Http\Requests\StoreCheckoutItemRequest;
use App\Http\Requests\UpdateCheckoutItemRequest;

class CheckoutItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCheckoutItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckoutItem $checkoutItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CheckoutItem $checkoutItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCheckoutItemRequest $request, CheckoutItem $checkoutItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutItem $checkoutItem)
    {
        //
    }
}
