<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssemblyRequest;
use App\Http\Resources\AssemblyResource;
use App\Models\Assembly;
use App\Models\AssemblyProduct;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Image as ImageModel;
use Illuminate\Support\Facades\Storage;

class AssemblyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assemblies = Assembly::included()
            ->filter()
            ->search()
            ->sort()
            ->getOrPaginate();

        return AssemblyResource::collection($assemblies);
    }

    public function store(AssemblyRequest $request)
    {

        try {
            $assembly = Assembly::create([
                'cod' => $request->cod,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description
            ]);

            if (!is_null($request->image)) {
                $imageName = explode(' ', $request->name);
                $imageName = implode('-', $imageName);

                Image::make($request->image)->save(public_path('storage') . "/assemblies/$imageName.png");

                $assembly->image()->create([
                    'url' => "assemblies/$imageName.png",
                ]);
            }

            foreach ($request->products as $product) {
                AssemblyProduct::create([
                    'product_id' => $product['id'],
                    'assembly_id' => $assembly['id'],
                    'sale_price' => $product['sale_price'],
                    'quantity' => $product['quantity']
                ]);
            }

            return response()->json(['message' => 'Ensamblaje registrado']);
        } catch (\Throwable $th) {
            return $th->getMessage(); # !NO E ES ASI CREO
        }
    }

    public function show($id)
    {
        $assembly = Assembly::included()->findOrFail($id);
        return AssemblyResource::make($assembly);
    }

    public function update(AssemblyRequest $request, Assembly $assembly)
    {
        try {
            $assembly->update([
                'cod' => $request->cod,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description
            ]);

            if (!is_null($request->image) && !is_object($request->image)) {
                $imageName = explode(' ', $assembly->name);
                $imageName = implode('-', $imageName);

                Image::make($request->image)->save(public_path('storage') . "/assemblies/$imageName.png");

                $assembly->image()->create([
                    'url' => "assemblies/$imageName.png",
                ]);
            }

            AssemblyProduct::where('assembly_id', $assembly->id)->delete();

            foreach ($request->products as $product) {
                AssemblyProduct::create([
                    'product_id' => $product['id'],
                    'assembly_id' => $assembly['id'],
                    'sale_price' => $product['sale_price'],
                    'quantity' => $product['quantity']
                ]);
            }

            return response()->json(['message' => 'Ensamblaje Editado'], 201);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 405);
        }
    }

    public function destroy(Assembly $assembly)
    {
        //
    }
}
