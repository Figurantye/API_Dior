<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = Collection::all();
        return response()->json([
            'success' => true,        
            'msg' => 'Collection listed successfully',
            'collectionCount' => $collection->count(),
            'clothes' => $collection->load('clothes'),
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
                    'year' => 'required|integer',
                    'season' => 'required|string',
                ],
                [
                    'year.required' => "Year name is required",
                    'season.required' => 'Season is required',
                ]
            );

            $collection = Collection::create($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while sending Collection',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Collection retrieved sucessfully',
            'collection' => $collection, 
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
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
                    'year' => 'required|string',
                    'season' => 'required|string',
                ],
                [
                    'year.required' => "Year name is required",
                    'season.required' => 'Season is required',
                ]
            );

            $collection = Collection::findOrFail($id);
            $collection->update($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'succes' => false,
                'msg' => "Error occurred while sending Collection",
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'succes' => true,
            'msg' => "Collection updated successfully",
            'collection' => $collection,
            'clothes' => $collection->load('clothes'),
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            $collection = Collection::findOrFail($id);
            $collection->delete();
    
            return response()->json([
                'success' => true,
                'msg' => "Collection deleted successfully"
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => "Error occurred while deleting Collection",
                'error' => $error->getMessage(),
            ], 500);
        }
    }
}
