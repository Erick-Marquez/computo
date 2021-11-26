<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Http\Resources\BranchProductResource;
use App\Http\Resources\BranchResource;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Product;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        return BranchResource::collection($branches);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        $branch = Branch::create([
            'cod_sunat' => $request->cod_sunat,
            'description' => $request->description,
            'phone' => $request->phone,
            'direction' => $request->direction,
            'ubigeo' => $request->ubigeo,
        ]);

        foreach ($request->series as $branchSerie) {
            
            $branch->series()->create([
                'serie' => $branchSerie['serie'],
                'current_number' => $branchSerie['current_number'] - 1,

                'have_igv' => $branchSerie['have_igv'],
                
                'voucher_type_id' => $branchSerie['voucher_type_id']
            ]);

        }

        return response()->json($branch);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'description' => 'required',
            'direction' => 'required',
        ]);

        $branch->update([
            'cod_sunat' => $request->cod_sunat,
            'description' => $request->description,
            'direction' => $request->direction,
            'ubigeo' => $request->ubigeo,
            'phone' => $request->phone,
        ]);

        return $branch;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return $branch;
    }

    /**
     * Display the products of specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function products($branch)  
    {
        $branchProducts = BranchProduct::where('branch_id', $branch)->with('product.brandLine.brand')->get();
        return BranchProductResource::collection($branchProducts);
    }

    public function productsAdd(Branch $branch)  
    {
        
        return view('inventory.branches.create');
    }

    public function productsDestroy(BranchProduct $branchProduct)  
    {
        $branch = $branchProduct->branch;
        $branchProduct->delete();
        return $branchProduct;
    }
}
