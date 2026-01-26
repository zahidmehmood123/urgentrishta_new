<?php

// app/Http/Controllers/PackageController.php
namespace App\Http\Controllers;

use App\MasterData; // Assuming your Package model is named 'Package'

class PackageController extends Controller
{
    public function show($id)
    {
        // Retrieve the package by its ID
        $package = Package::findOrFail($id);

        // Pass the package data to the view
        return view('packages.show', compact('package'));
    }
}
