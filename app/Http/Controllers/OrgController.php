<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Org;

class OrgController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orgs = Org::all();
        return $orgs;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Org  org
     * @return \Illuminate\Http\Response
     */
    public function show($org_id) {
        $org = Org::find($org_id);

        if (!$org) {
            return response()->json([
                'success' => false,
                'message' => 'NOT_FOUND'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'FOUND',
            'data' => [
                'org' => $org
            ]
        ], 200);
    }
}
