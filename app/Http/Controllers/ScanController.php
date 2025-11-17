<?php

namespace App\Http\Controllers;

class ScanController extends Controller
{
    public function index()
    {
        // TODO: nanti isi mode scan (QuaggaJS/ZXing)
        return view('scan.index');
    }
}
