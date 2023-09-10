<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Category = Category::all();
        return CategoryResource::collection($Category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $CategoryModel = new Category();

        try {
            $CategoryModel->fill($request->all())
                ->save();
        } catch (\Exception $exception) {
            return response()->json(
                'Ocorreu um erro ao salvar',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return new CategoryResource($CategoryModel);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Category = Category::findOrFail($id);
        return new CategoryResource($Category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $Category = Category::findOrFail($id);

        $Category->update($data);
        return new CategoryResource($Category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Category = Category::findOrFail($id);

        $Category->delete();
        return response()->json(['Removido com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
