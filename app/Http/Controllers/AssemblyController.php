<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssemblyRequest;
use App\Http\Resources\AssemblyResource;
use App\Models\Assembly;
use App\Models\AssemblyProduct;
use Illuminate\Http\Request;

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
