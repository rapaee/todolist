<?php

namespace App\Http\Controllers\todolist;

use App\Http\Controllers\Controller;
use App\Models\todolist;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $max_data = 3;

    // Untuk pencarian
    if (request('search')) {
        $data = Todolist::where('task', 'like', '%' . request('search') . '%')
            ->paginate($max_data)
            ->withQueryString(); // Menjaga query string saat berpindah halaman
    } else {
        $data = Todolist::orderBy('task', 'asc')->paginate($max_data);
    }

    return view('todolist.todolist', compact('data'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi min itu untuk minimal text
        $request->validate([
            'task' => 'required|min:3|max:25'
        ],[
            'task.required' => 'Isian task wajib di isi',
            'task.min' => 'minimal huruf task 3 karakter',
            'task.max' => 'maximum huruf task 25 karakter'
        ]);

        $data = [
            'task' => $request ->input('task')
        ];

        todolist::create($data);
        //setelah sukses
        return redirect()-> route('todolist') -> with('success','Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3|max:25'
        ],[
            'task.required' => 'Isian task wajib di isi',
            'task.min' => 'minimal huruf task 3 karakter',
            'task.max' => 'maximum huruf task 25 karakter'
        ]);

        $data = [
            'task' => $request ->input('task'),
            'id_done' => $request -> input('id_done')
        ];

        todolist::where('id',$id)->update($data);
        return redirect()->route('todolist') ->with('success','Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        todolist::where('id',$id)->delete();
        return redirect()->route('todolist') ->with('success','Berhasil menghapus data');
    }
}
