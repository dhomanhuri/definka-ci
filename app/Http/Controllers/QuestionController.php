<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all()->unique('judul_pertanyaan');
        return view('questionnaire.index_question')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questionnaire.create_question');
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
                'judul_pertanyaan' => 'required',
            ]);
        foreach ($request->questions as $question) {
            $pertanyaan = new Question;
            $pertanyaan->judul_pertanyaan = $request->judul_pertanyaan;
            $pertanyaan->pertanyaan = $question;
            $pertanyaan->save();
        }
        return redirect('/question');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $get = Question::find($id);
        $questions = Question::where('judul_pertanyaan', $get->judul_pertanyaan)->get();
        return view('questionnaire.show_question')->with('questions', $questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $questions = Question::where('judul_pertanyaan', $question->judul_pertanyaan)->get();
        return view('questionnaire.edit_question', ['question' => $question, 'questions' => $questions]);
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
        request()->validate([
            'judul_pertanyaan' => 'required'
        ]);
        $get = Question::find($id);
        Question::where('judul_pertanyaan', $get->judul_pertanyaan)->delete();
        foreach ($request->questions as $question) {
            $pertanyaan = new Question;
            $pertanyaan->judul_pertanyaan = $request->judul_pertanyaan;
            $pertanyaan->pertanyaan = $question;
            $pertanyaan->save();
        }
        return redirect('/question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $get = Question::find($id);
        Question::where('judul_pertanyaan', $get->judul_pertanyaan)->delete();
        return redirect('/question');
    }
}
