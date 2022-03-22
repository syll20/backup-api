<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScorerRequest;
use App\Models\Scorer;
use Illuminate\Http\Request;

class ScorerController extends Controller
{
    public function update(UpdateScorerRequest $request)
    {

        Scorer::find($request->id)->update([$request->location => $request->goal]);

        return redirect('/admin/standings')->with('success', 'Standings updated');
    }
}
