<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Kuisioner;
use App\Models\Question;
use App\Models\Alumni;
use App\Models\Answer;
use App\Models\QuestionList;

class RunCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running Conjob to Send Whatsapp Bot Message';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Cron Job running at ". now());
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $kuisioners = Kuisioner::where(['status_kuisioner' => 'pending', 'tanggal_kirim' => $today])->get();
        foreach ($kuisioners as $kuisioner) {
            $alumnis = Alumni::where('angkatan', $kuisioner->target_angkatan)->get();
            foreach ($alumnis as $alumni) {
                $answer_id = $alumni->telepon;
                $questions = QuestionList::where('questionnaire_id', $kuisioner->id)->get();
                foreach ($questions as $question) {
                    $pertanyaan = Question::find($question->question_id);
                    $answer = new Answer;
                    $answer->questionnaire_id = $kuisioner->id;
                    $answer->question_id = $question->question_id;
                    $answer->answer_id = $answer_id;
                    $answer->judul_pertanyaan = $kuisioner->judul_pertanyaan;
                    $answer->pertanyaan = $pertanyaan->pertanyaan;
                    $answer->save();
                }
                $update_kuisioner = Kuisioner::find($kuisioner->id);
                $update_kuisioner->status_kuisioner = 'terkirim';
                $update_kuisioner->save();
                $select_question = Answer::where(['questionnaire_id' => $kuisioner->id, 'answer_id' => $answer_id])->whereNull('jawaban')->get()->first();
                Http::post(env('CHATBOT_URL'), [
                    "number" => $answer_id,
                    "message" => "BOT Tracer Study JTI Polinema.\n\n" . $select_question->pertanyaan,
                ]);
            }
        }
        return 0;
    }
}
