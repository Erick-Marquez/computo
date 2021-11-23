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

            $imageName = explode(' ', $request->name);
            $imageName = implode('-', $imageName);

            Image::make($request->image)
                    ->resize(500, null)
                    ->save(public_path('storage') . "/assemblies/$imageName.png", 70, 'png');

            $assembly->image()->create([
                'url' => "assemblies/$imageName.png",
            ]);

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
            // throw $th;
            return $th->getMessage();
        }
    }

    public function show(Assembly $assembly)
    {
        //
    }

    public function update(Request $request, Assembly $assembly)
    {
        //
    }

    public function destroy(Assembly $assembly)
    {
        //
    }

}
