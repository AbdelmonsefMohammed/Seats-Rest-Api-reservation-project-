<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function edit()
    {

        $code = QrCode::generate('https://www.simplesoftware.io');
        // dd($code);
        return view('Dashboard.settings.qrcode.edit',compact('code'));
    }

    public function update(Request $request)
    {
        dd($request->all());
    }
}
