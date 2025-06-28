<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAns;
use App\Models\IndependentAd;
use App\Models\Advertisement;

class QuizController extends Controller
{
    public function index(){
        $allQuizs = Quiz::orderBy('quiz_no')->get();
        $quizs = $allQuizs->groupBy('quiz_no');
        $independentAd = IndependentAd::where('id' , 1)->first();
        return view('quiz.index',compact('quizs','independentAd'));

    }

    public function totalQuiz(Request $request){
        $request->validate([
            // 'total_quiz' => 'required|regex:/^[1-9]\d*$/|max:191',
            'quiz_time' => 'required|numeric|digits_between:4,7|min:5000|max:3600000'
        ], [
            // 'total_quiz.regex' => 'The quiz count must be a positive number greater than zero, with no special characters or alphabets.',
            // 'total_quiz.max' => 'The quiz count must not exceed 191.',
            'quiz_time.required' => 'Quiz time is required.',
            'quiz_time.numeric' => 'Quiz time must be a number.',
            'quiz_time.digits_between' => 'Quiz time must be between 4 and 7 digits.',
            'quiz_time.min' => 'Quiz time must be at least 5000 milliseconds (5 seconds).',
            'quiz_time.max' => 'Quiz time must not exceed 3600000 milliseconds (1 hour).',
        ]);


        $update = IndependentAd::where('id', 1)->update([
            // 'total_quiz' => $request->total_quiz,
            'quiz_time' => $request->quiz_time,
        ]);

        return redirect()->route('quiz.add')->with('success', 'Quiz count updated!');
    }



    public function create(){
        $advertiseMents = Advertisement::all();
        return view('quiz.create',compact('advertiseMents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_no' => 'required|numeric|min:1',
            'question' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'answers' => 'required|array|min:1',
            'answers.*' => 'required|string|max:255',
            'tag' => 'required|array',
            'tag.*' => 'array',
        ]);

        // dd($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('storage/quiz');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'storage/quiz/' . $imageName;
        }




        $quiz = Quiz::create([
            'quiz_no' => $request->quiz_no,
            'question' => $request->question,
            'image' => $imagePath,
        ]);

        foreach ($request->answers as $index => $answer) {
            $newAnswer = QuizAns::create([
                'quiz_id' => $quiz->id,
                'ans' => $answer,
                'is_correct' => $index === (int) $request->is_correct ? true : false, // Assuming is_correct is passed in the request
                'is_first' => $index === 0 ? true : false,
            ]);

            $tagIds = isset($request->tag[$index]) && !empty($request->tag[$index])
                      ? $request->tag[$index]
                      : [];

            $tagIdsString = !empty($tagIds) ? implode(',', $tagIds) : '';

            if (!empty($tagIdsString)) {
                $newAnswer->update(['advertisement_id' => $tagIdsString]);
            }
        }


        return redirect()->route('quiz.add')->with('success', 'Quiz created successfully!');
    }


    public function edit($id){
        $advertiseMents = Advertisement::all();
        $quiz = Quiz::where('id',$id)->firstorfail();
        $quizAns = QuizAns::where('quiz_id',$id)->get();
        // dd($quizAns);
        $quizAnsCount = QuizAns::where('quiz_id',$id)->count();
        return view('quiz.edit',compact('advertiseMents','quiz','quizAns','quizAnsCount'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'quiz_no' => 'required|numeric|min:1',
            'question' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'answers' => 'required|array',
            'answers.*' => 'required|string',
            'tag' => 'required|array',
            'tag.*' => 'array',
            'tag.*.*' => 'required|integer',
        ]);

        // dd($request->all());
        $quiz = Quiz::findOrFail($id);
        $quiz->quiz_no = $request->quiz_no;
        $quiz->question = $request->question;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('storage/quiz');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $quiz->image = 'storage/quiz/' . $imageName;
        }

        $quiz->save();

        $quizAnsData = $request->answers;
        $tags = $request->tag;

        $quiz->answers()->delete();

        foreach ($quizAnsData as $key => $answer) {
            if (isset($tags[$key])) {
                $answerTags = implode(',', $tags[$key]);
            } else {
                $answerTags = '';
            }

            QuizAns::create([
                'quiz_id' => $quiz->id,
                'advertisement_id' => $answerTags,
                'ans' => $answer,
                'is_correct' => $key === (int) $request->is_correct ? true : false,
                'is_first' => $key === 0 ? true : false,
            ]);
        }


        return redirect()->route('quiz.add')->with('success', 'Quiz updated successfully!');
    }

    public function delete($id){
        $quiz = Quiz::where('id',$id)->first();
        $quizAns = QuizAns::where('quiz_id',$id)->get();

        if($quiz){
            $quiz->delete();
            $quiz->answers()->delete();

            return redirect()->route('quiz.add')->with('success', 'Quiz deleted successfully!');
        }else{
            return redirect()->back()->with('error', '404 Not found');
        }

    }
}
