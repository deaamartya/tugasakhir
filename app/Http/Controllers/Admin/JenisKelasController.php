<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKelas;
use Illuminate\Http\Request;

class JenisKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "lalala";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\JenisKelas  $jenisKelas
     * @return \Illuminate\Http\Response
     */
    public function show(JenisKelas $jenisKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisKelas  $jenisKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisKelas $jenisKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisKelas  $jenisKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisKelas $jenisKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisKelas  $jenisKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisKelas $jenisKelas)
    {
        //
    }
}
