<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssemblyRequest;
use App\Http\Resources\AssemblyResource;
use App\Models\Assembly;
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
