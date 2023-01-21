<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use App\Models\Question;
use App\Models\Alumni;
use App\Models\Answer;
use App\Models\QuestionList;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function index()
    {
        return redirect('/kuisioner/broadcast');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function question()
    {
        $year_array = array();
        $years = Alumni::orderBy('angkatan', 'ASC')->pluck('angkatan');
        $years = json_decode($years);
        foreach ($years as $year) {
            $year_array[$year] = $year;
        }
        $question_array = array();
        $questions = Question::orderBy('judul_pertanyaan', 'ASC')->pluck('judul_pertanyaan');
        $questions = json_decode($questions);
        foreach ($questions as $question) {
            $question_array[$question] = $question;
        }
        return view('questionnaire.create', ['years' => $year_array, 'questions' => $question_array]);
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
                'judul_kuisioner' => 'required|unique:questionnaires,judul_kuisioner',
                'tanggal_kirim' => 'required',
                'status_kuisioner' => 'required',
                'target_angkatan' => 'required',
                'judul_pertanyaan' => 'required'
            ]);
        $kuisioner = new Kuisioner;
        $kuisioner->judul_kuisioner = $request->judul_kuisioner;
        $kuisioner->tanggal_kirim = $request->tanggal_kirim;
        $kuisioner->status_kuisioner = $request->status_kuisioner;
        $kuisioner->target_angkatan = $request->target_angkatan;
        $kuisioner->judul_pertanyaan = $request->judul_pertanyaan;
        $kuisioner->save();

        $questions = Question::where('judul_pertanyaan', $request->judul_pertanyaan)->get();
        $kuisioner_id = Kuisioner::where('judul_kuisioner', $request->judul_kuisioner)->get()->first();
        foreach ($questions as $question) {
            $question_list = new QuestionList;
            $question_list->questionnaire_id = $kuisioner_id->id;
            $question_list->question_id = $question->id;
            $question_list->save();
        }
        return redirect('/kuisioner/broadcast');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kuisioner = Kuisioner::find($id);
        return view('questionnaire.show', ['kuisioner' => $kuisioner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kuisioner = Kuisioner::find($id);
        $question_array = array();
        $questions = Question::orderBy('judul_pertanyaan', 'ASC')->pluck('judul_pertanyaan');
        $questions = json_decode($questions);
        foreach ($questions as $question) {
            $question_array[$question] = $question;
        }
        $year_array = array();
        $years = Alumni::orderBy('angkatan', 'ASC')->pluck('angkatan');
        $years = json_decode($years);
        foreach ($years as $year) {
            $year_array[$year] = $year;
        }
        return view('questionnaire.edit', ['kuisioner' => $kuisioner, 'years' => $year_array, 'questions' => $question_array]);
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
        request()->validate(
            [
                'judul_kuisioner' => 'required',
                'tanggal_kirim' => 'required',
                'judul_pertanyaan' => 'required',
                'target_angkatan' => 'required'
            ]);
        $kuisioner = Kuisioner::find($id);
        $kuisioner->judul_kuisioner = $request->judul_kuisioner;
        $kuisioner->tanggal_kirim = $request->tanggal_kirim;
        $kuisioner->target_angkatan = $request->target_angkatan;
        $kuisioner->judul_pertanyaan = $request->judul_pertanyaan;
        $kuisioner->save();

        $questions = Question::where('judul_pertanyaan', $request->judul_pertanyaan)->get();
        $kuisioner_id = Kuisioner::where('judul_kuisioner', $request->judul_kuisioner)->get()->first();
        QuestionList::where('questionnaire_id', $kuisioner_id->id)->delete();
        foreach ($questions as $question) {
            $question_list = new QuestionList;
            $question_list->questionnaire_id = $kuisioner_id->id;
            $question_list->question_id = $question->id;
            $question_list->save();
        }
        return redirect('/kuisioner/broadcast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kuisioner::destroy($id);
        QuestionList::where('questionnaire_id', $id)->delete();
        Answer::where('questionnaire_id', $id)->delete();
        return redirect('/kuisioner/broadcast'); 
    }

    public function broadcast()
    {
        $kuisioners = Kuisioner::all()->sortBy('created_at');
        return view('questionnaire.broadcast')->with('kuisioners', $kuisioners);
    }

    public function send_post(Request $request)
    {
        $answer_id = $request->answer_id;
        $body = $request->body;

        $fields = Answer::where('answer_id', $answer_id)->whereNull('jawaban');
        if ($fields->exists()) {
            $answer = $fields->get()->first();
            $answer->update(['jawaban' => $body]);

            $question = Answer::where('answer_id', $answer_id)->whereNull('jawaban');
            if ($question->exists()) {
                $message = $question->get()->first();
                return response()->json(['number' => $answer_id, 'message' => $message->pertanyaan]);
            } else {
                return response()->json(['number' => $answer_id, 'message' => 'Terima kasih. Kuisioner telah selesai diisi.']);
            }
        } else {
            return response()->json(['number' => $answer_id, 'message' => 'Terima kasih. Kuisioner telah selesai diisi.']);
        }
    }
}
