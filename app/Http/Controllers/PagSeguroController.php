<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagSeguro;

class PagSeguroController extends Controller
{
    public function pagseguro(PagSeguro $pagseguro)
    {
        $code = $pagseguro->generate();
        
        $urlRedirect = config('pagseguro.url_redirect_after_request').$code;
        
        return redirect()->away($urlRedirect);
    }

    public function lightbox()
    {
        return view('pagseguro-lightbox');
    }

    public function lightboxCode(PagSeguro $pagseguro)
    {
        return $pagseguro->generate();
    }
}
