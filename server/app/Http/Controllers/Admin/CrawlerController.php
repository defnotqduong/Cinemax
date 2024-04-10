<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CrawlerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => []]);
    // }

    public function fetch(Request $request)
    {
        try {
            $data = collect();

            $request['link'] = preg_split('/[\n\r]+/', $request['link']);

            if ($request['from'] > $request['to']) return response()->json(['success' => true, 'data' => $data], 200);

            foreach ($request['link'] as $link) {
                for ($i = $request['from']; $i <= $request['to']; $i++) {
                    $response = Http::withoutVerifying()->get($link, [
                        'page' => $i
                    ]);
                    $responseArray = $response->json();
                    if ($responseArray['status']) {
                        $data->push(...$responseArray['items']);
                    }
                }
            }

            return response()->json(['success' => true, 'movies' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
