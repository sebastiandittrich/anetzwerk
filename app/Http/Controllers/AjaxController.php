<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function deleteElement($dimension) {
        $this->validate(request(), [
            'object_id' => 'required',
            'object_name' => 'required|string',
        ]);
        try {
            ('\\'.request('object_name'))::find(intval(request('object_id')))->deleteAll($dimension);
        } catch(Exception $e) {
            return "false";
        }
        return "true";
    }
}
