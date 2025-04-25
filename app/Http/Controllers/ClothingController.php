<?php

namespace App\Http\Controllers;

use App\Models\Clothing;
use Illuminate\Http\Request;

class ClothingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clothing = Clothing::all();

        return response()->json([
            'succes' => true,
            'msg' => 'Clothings retrieved sucessfully',
            'dataCount' => $clothing->count(),
            'clothes' => $clothing->load('collection')
        ], 200);
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
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'collection_id' => 'required|exists:collections,id',
                ],
                [
                    'name.required' => "Clothing's name is required",
                    'collection_id.required' => 'Collection is required',
                    'message_id.required' => 'Message is required',
                ]
            );

            $clothing = Clothing::create($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while sending Clothting',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Clothings retrieved sucessfully',
            'collection' => $clothing->load('collection'),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Clothing $clothing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clothing $clothing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'collection_id' => 'required|exists:collections,id',
                    'message' => 'required|string',
                ],
                [
                    'name.required' => "Clothing's name is required",
                    'collection_id.required' => 'Collection is required',
                    'message_id.required' => 'Message is required',
                ]
            );

            $clothing = Clothing::findOrFail($id);
            $clothing->update($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'succes' => false,
                'msg' => "Error occurred while sending Clothing",
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'succes' => true,
            'msg' => "Clothing updated successfully",
            'collection' => $clothing->load('collection'),
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            $clothing = Clothing::findOrFail($id);
            $clothing->delete();
    
            return response()->json([
                'success' => true,
                'msg' => "Clothing deleted successfully"
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => "Error occurred while deleting Clothing",
                'error' => $error->getMessage(),
            ], 500);
        }
    }
}
