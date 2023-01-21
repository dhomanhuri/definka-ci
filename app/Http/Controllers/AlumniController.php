<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $alumni = Alumni::all()->sortBy('name');
        $total_count = $alumni->count();
        $total_bekerja = Alumni::where('pekerjaan', 'Bekerja')->get()->count();
        $total_berwirausaha = Alumni::where('pekerjaan', 'Berwirausaha')->get()->count();
        $data['data'] = $alumni;
        $data['total_count'] = $total_count;
        $data['total_bekerja'] = $total_bekerja;
        $data['total_berwirausaha'] = $total_berwirausaha;
        return view('datas.index')->with('alumni', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->get('role') == "Admin") {
            return view('datas.create');
        } else {
            return redirect('/data');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
                'name' => 'required',
                'nim' => 'required|unique:alumnis,nim',
                'angkatan' => 'required|min:4|max:4',
                'prodi' => 'required',
                'telepon' => 'required',
                'jenis_kelamin' => 'required',
                'pekerjaan' => 'required',
                'tempat_kerja' => 'required',
            ]);

        $input = $request->all();
        $create = Alumni::create($input);
        if ($create->exists) {
            return redirect('/data')->withErrors(['Data telah ditambahkan.']); 
        } else {
            return redirect('/data')->withErrors(['Data gagal ditambahkan.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (session()->get('role') == "Admin") {
            $alumni = Alumni::find($id);
            return view('datas.show')->with('alumni', $alumni);
        } else {
            return redirect('/data');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        if (session()->get('role') == "Admin") {
            $alumni = Alumni::find($id);
            return view('datas.edit')->with('alumni', $alumni);
        } else {
            return redirect('/data');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $alumni = Alumni::find($id);
        $input = $request->all();
        $alumni->update($input);
        return redirect('/data')->withErrors(['Data berhasil diperbaharui.']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alumni::destroy($id);
        return redirect('/data'); 
    }

    public function get_all_year()
    {
        $year_array = array();
        $years = Alumni::orderBy('angkatan', 'ASC')->pluck('angkatan');
        $years = json_decode($years);
        foreach ($years as $year) {
            $year_array[$year] = $year;
        }
        return $year_array;
    }

    public function get_data_year_count($year)
    {
        $data_year_count = Alumni::where('angkatan', '=', $year)->get()->count();
        return $data_year_count;
    }

    public function get_grafik_data()
    {
        $year_array = array();
        $get_all_years = $this->get_all_year();
        $count_array = array();
        foreach ($get_all_years as $year) {
            $year_count = $this->get_data_year_count($year);
            array_push($count_array, $year_count);
            array_push($year_array, $year);
        }
        $count = !empty($count_array) ? $count_array : [0];
        $max = round(( max($count) + 10/2 ) / 10 ) * 10;
        $data_array = array(
            'years' => $year_array,
            'count_per_year' => $count_array,
            'max' => $max
        );
        return $data_array;
    }

    public function get_all_place()
    {
        $place_array = array();
        $places = Alumni::orderBy('tempat_kerja', 'ASC')->pluck('tempat_kerja');
        $places = json_decode($places);
        foreach ($places as $place) {
            $place_array[$place] = $place;
        }
        return $place_array;
    }

    public function get_data_place_count($place)
    {
        $data_place_count = Alumni::where('tempat_kerja', '=', $place)->get()->count();
        return $data_place_count;
    }

    public function get_maps()
    {
        $place_array = array();
        $get_all_place = $this->get_all_place();
        foreach ($get_all_place as $place) {
            $place_count = $this->get_data_place_count($place);
            $data = array(
                'place' => $place,
                'count' => $place_count
            );
            array_push($place_array, $data);

        }
        return ['data' => $place_array];
    }

    public function persebaran()
    {
        if (session()->has('id')) {
            return redirect('/persebaran-data');
        } else {
            return view('persebaran');
        }
    }

    public function import()
    {
        request()->validate([
            'file' => 'required'
        ]);
        Excel::import(new AlumniImport, request()->file('file'));
        return redirect('/data')->withErrors(['Import data telah berhasil.']);
    }
}
