<?php

namespace App\Http\Controllers;

use App\Http\Requests\EkskulStoreRequest;
use App\Models\Ekskul;
use App\Models\StudentEkskul;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function index()
    {
        $ekskul = Ekskul::with('students')->get();

        return view("ekskul",
        [
            "active"=> 'ekskul',
            'title'=> 'Ekstrakurikuler',
            'css'=> 
            [
                'kelas.css'
            ],
            'js' => ['ekskul/ekskul.js'],
            'plugin' => ['datatables', 'sweet-alert'],
            "ekskul"=> $ekskul
        ]);
    }

    function save(EkskulStoreRequest $request)
    {
        $ekskul = new Ekskul();
        $ekskul->name = $request->name;
        $ekskul->save();

        $request->session()->flash('status', 'success');
        $request->session()->flash('type', 'alert-success');
        $request->session()->flash('message', 'Berhasil Menambah Ekskul '.$request->name);

        return redirect("/ekskul");
    }

    function delete(Request $request)
    {
        // dd($id);
        $ekskul = Ekskul::findOrFail($request->id);
        $ekskul->delete();
        
        return redirect("/ekskul");
    }

    function edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);
    }

    function update(EkskulStoreRequest $request, $id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $ekskul->name = $request->name;
        $ekskul->update();

        $request->session()->flash('status', 'success');
        $request->session()->flash('type', 'alert-success');
        $request->session()->flash('message', 'Berhasil Mengubah Ekskul '.$request->name);
        return redirect('/ekskul');
    }
}
