<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SebastianBergmann\Environment\Console;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::find(1);
        return $company;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {   //validar
        $request->validate([
            'ruc' => 'min:11|max:11|required',
            'name' => 'string|required',
            'ubigeo' => 'required',
            'address' => 'string|required',
            'demo' => 'boolean|required',
        ]);

        if (!$request->demo) {
            $request->validate([
                'user_sol' => 'required',
                'password_sol' => 'required',
                //'electronic_certificate' => 'required',
                'password_electronic_certificate' => 'required',
            ]);
        }

        // Datos para el update
        $data['ruc'] = $request->ruc;
        $data['name'] = $request->name;
        $data['comercial_name'] = $request->comercial_name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['ubigeo'] = $request->ubigeo;
        $data['urbanization'] = $request->urbanization;
        $data['address'] = $request->address;
        $data['demo'] = $request->demo;

        if (!$request->demo) {
            $data['user_sol'] = $request->user_sol;
            $data['password_sol'] = $request->password_sol;
            $data['electronic_certificate'] = $request->electronic_certificate;
            $data['password_electronic_certificate'] = $request->password_electronic_certificate;
        }

        try {
            if (!is_null($request->img)) {
                Image::make($request->img)->save(public_path() . "/images/Logo.png");
            }

            $company = Company::findOrFail($id);

            $company->update($data);

            return $company;
        } catch (\Throwable $th) {
            return abort(405, $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
