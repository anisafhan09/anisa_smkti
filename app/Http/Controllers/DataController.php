<?php

namespace App\Http\Controllers;

use App\Models\data;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['project'] = data::all();

        $data['project'] = data::with('client')->get();
        // $data['page'] = data::paginate(5);
        $data['page'] = DB::table('tb_m_project')->Paginate(5);
        return view('/project', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['tambah'] = client::select('client_id', 'client_name')->get();
        return view('tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = data::create($request->all());
        $data = new data;
        $data->project_id = $request->project_id;
        $data->project_name = $request->project_name;
        $data->client_id = $request->client_id;
        $data->project_start = $request->project_start;
        $data->project_end = $request->project_end;
        $data->project_status = $request->project_status;
        $data->save();
        return redirect('/project');
    }

    /**
     * Display the specified resource.
     */
    public function show(data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $project_id)
    {
        $data['project'] = data::findOrFail($project_id);
        // $data['client'] = client::where('client_id', '!=', $data['project']->client_id)->get(['client_id', 'client_name']);
        return view('edit', $data);
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $project_id)
    {
        $data = data::findOrFail($project_id);
        //mass update
        $data->update($request->all());
        return redirect('/project')->withSuccess('Data Ter-Update');
    }

    public function deletedata(Request $request)
    {
        $id = $request->project_id;
        // data::whereIn(['project_id', $id])->delete();

        $data = data::where('project_id', $id)->delete();
        // return response()->json(["success"=> "Data Berhasil dihapus!"]);
        return redirect('/project')->withSuccess('Data Berhasil Dihapus');
    }

    public function searchproject(Request $request)
    {
        $name = $request->input('project_name');

        $users = data::where(function ($query) use ($name) {
            $query->where('project_name', 'LIKE', '%' . $name . '%');
        })->get();

        return view('/project', compact('users'));
        // $search = $request->search;
        // $post = data::where(function($query) use ($search){
        //     $query->where('project_name', 'like', "%$search%");

        // })->get();
        // return view('/project', compact('post', 'search'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data $data)
    {
        //
    }
}
