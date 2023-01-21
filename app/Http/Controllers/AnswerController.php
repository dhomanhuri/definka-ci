<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Alumni;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Kuisioner;
use App\Models\QuestionList;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('answer.index');
    }

    public function get_all_question($id)
    {
        $question_list = QuestionList::where('questionnaire_id', $id)->get();
        return $question_list;
    }

    public function get_all_answer_id($ids)
    {
        $answer_id_array = array();
        foreach ($ids as $id) {
            $answers_ids = Answer::where('question_id', $id->question_id)->get();
            foreach ($answers_ids as $answer_id) {
                array_push($answer_id_array, $answer_id->answer_id);
            }
        }
        $answer_id_array = array_unique($answer_id_array);
        return $answer_id_array;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $questions = $this->get_all_question($id);
        $all_answer_id = $this->get_all_answer_id($questions);
        if (empty($all_answer_id)) {
            return view('answer.index')->with('error', 'Jawaban tidak tersedia');
        }
        $answer_id = !empty($request->answer_id) ? $request->answer_id : $all_answer_id[0];
        $answer_array = array();
        $alumni = Alumni::where('telepon', $answer_id)->get()->first();
        foreach ($questions as $question)
        {
            $quest = Question::find($question->question_id);
            $answer = Answer::where(['questionnaire_id' => $id, 'pertanyaan' => $quest->pertanyaan, 'answer_id' => $answer_id]);
            if ($answer->exists()) {
                $answer = $answer->get()->first();
                $jawaban = !empty($answer->jawaban) ? $answer->jawaban : 'Belum dijawab.';
                array_push($answer_array, array('pertanyaan' => $quest->pertanyaan, 'jawaban' => $jawaban));
            } 
        }
        return view('answer.index')->with(['alumni' => $alumni, 'questions' => $answer_array, 'answers_id' => $all_answer_id]);
    }
}
