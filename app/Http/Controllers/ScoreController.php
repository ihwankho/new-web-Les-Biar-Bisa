<?php

namespace App\Http\Controllers;

use App\Models\Score;

class ScoreController extends Controller
{
    public function destroy(String $id)
    {
        $score = Score::findOrFail($id);

        if ($score->file) {
            unlink(public_path('/assets/assignment/' . $score->file));
        }

        $score->delete();

        return redirect('/assignment');
    }
}
