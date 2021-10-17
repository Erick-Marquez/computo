<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'direction' => 'required',
        ]);

        Branch::create([
            'description' => $request->description,
            'phone' => $request->phone,
            'direction' => $request->direction,
            'ubigeo' => $request->ubigeo,
        ]);

        return redirect()->route('branches.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('inventory.branches.edit', compact('branch'));
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

        $branch->update($request->all());

        return redirect()->route('branches.index');
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
