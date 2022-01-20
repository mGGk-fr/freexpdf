<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class PdfController extends Controller
{
    public function url(Request $request)
    {
        if(!$request->has('url')) {
            return response()->json([
                'error' => 'Missing url parameter'
            ], 400);
        }
        $filename = md5($request->input('url').time());
        Browsershot::url($request->input('url'))->save(sprintf('/tmp/%s.pdf', $filename));
        $blob = file_get_contents(sprintf('/tmp/%s.pdf', $filename));
        unlink(sprintf('/tmp/%s.pdf', $filename));
        return response()->make($blob, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('attachment; filename="%s.pdf"', $filename)
        ]);
    }

    public function dom(Request $request)
    {
        if(!$request->has('dom')) {
            return response()->json([
                'error' => 'Missing dom parameter'
            ], 400);
        }
        $filename = md5('dom'.md5(time()).time());
        Browsershot::html($request->input('dom'))->save(sprintf('/tmp/%s.pdf', $filename));
        $blob = file_get_contents(sprintf('/tmp/%s.pdf', $filename));
        unlink(sprintf('/tmp/%s.pdf', $filename));
        return response()->make($blob, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('attachment; filename="%s.pdf"', $filename)
        ]);
    }
}
