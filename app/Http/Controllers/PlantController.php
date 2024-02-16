<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Plant  $plant
     * @return Response
     */
    public function show(Plant $plant)
    {
        $plant = Plant::with('category')->where('id', $plant->id)->get()->first();
        return view('plants.single', ['plant' => $plant]);
    }

    public function category($categoryId)
    {
        $plants = Plant::query()->where('category_id', $categoryId)->get();
        return view('main', ['plants' => $plants]);
    }

    public function buy($plantId)
    {
        $plant = Plant::query()->find($plantId);
        if (!$plant) {
            return redirect()->route('home');
        }

        $cart = new Cart();
        $cart->plant_id = $plantId;
        $cart->user_id = Auth::id();
        $cart->save();

        return redirect()->route('cart.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('plants.create');
    }

    public function fileUploadMove(Request $request)
    {
        $photo = $request->file('photo');

        $destinationPath = '/img/cover';

        $photoName = $photo->getClientOriginalName();
        $upload_success = $photo->move($destinationPath, $photoName);
        return $upload_success;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Plant::create($input);

        $photo = $request->file('photo');
        $lastId = Plant::query()->latest()->value('id');
        $photoName =  '/img/cover/plant-' . $lastId . '.' . $photo->getClientOriginalExtension();
        Plant::query()->find($lastId)->update([
            'photo' =>  $photoName
        ]);
        $photo->move(__DIR__ . '../../../../public/img/cover', $photoName); // эта строка для локального компьютера Win10
//        $photo->move('img/news', $photoName);  // эта строка для хостинга

        return view('plants.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Plant  $plant
     * @return Response
     */
    public function edit(Plant $plant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Plant  $plant
     * @return Response
     */
    public function update(Request $request, Plant $plant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Plant  $plant
     * @return Response
     */
    public function destroy(Plant $plant)
    {
        //
    }
}
