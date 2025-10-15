<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Product;
use App\Models\Question;
use App\Models\QuestionSection;
use App\Models\VisitorResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $sliders = Post::with('featuredImage')->where('type', 'slider')->where('is_published', 1)->get();
        $shopByCategories = Category::where('for', 'product')->where('type', 'category')->where('is_active', 1)->get();
        $trendingProducts = Product::with('featured')->where('type', 'product')->where('is_trend', 1)->where('is_activated', 1)->get();

        return view('frontend.home.index')->with([
            'shopByCategories' => $shopByCategories,
            'trendingProducts' => $trendingProducts,
            'sliders' => $sliders,
        ]);
    }

    public function error(){
        return view('frontend.pages.404');
    }

    public function survey(Request $request){

        if($request->isMethod('get')){
            return redirect('/#survey');
        }

        // Load the sections with their questions and answers
        $questionsAnswer = Question::with(['section', 'answers'])->get();
        $phone = $request->phone;
        // Store the phone number in session
        $request->session()->put('phone_number', $phone);
        return view('frontend.pages.questionnaire', compact('questionsAnswer', 'phone'));
    }

    //recommend Product
    public function recommendProduct(Request $request){

        if($request->isMethod('get')){
            return redirect('/#survey');
        }

        $phoneNumber = $request->session()->get('phone_number');
        $answersData = [];
        foreach($request->answers as $question => $answer){
            $answersData []= [
                'answer_id' => (int) $answer,
                'question_id' => $question,
                'phone_number' => $phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
//        dd($answersData);
        VisitorResponse::insert($answersData);

        // Fetch all answers given by the user
        $userAnswers = DB::table('visitor_responses')
            ->where('phone_number', $phoneNumber)  // Assuming you're tracking users by phone number
            ->join('answers', 'visitor_responses.answer_id', '=', 'answers.id')
            ->select('answers.patient_type')
            ->get();

        // Initialize score counters for each type
        $vataScore = 0;
        $pittaScore = 0;
        $kaphaScore = 0;

        // Tally up scores based on the user's answers
        foreach ($userAnswers as $answer) {
            if ($answer->patient_type === 'Vata') {
                $vataScore++;
            } elseif ($answer->patient_type === 'Pitta') {
                $pittaScore++;
            } elseif ($answer->patient_type === 'Kapha') {
                $kaphaScore++;
            }
        }

        // Determine the patient's dominant type based on the highest score
        if ($vataScore >= $pittaScore && $vataScore >= $kaphaScore) {
            $patientType = 'vata';
        } elseif ($pittaScore >= $vataScore && $pittaScore >= $kaphaScore) {
            $patientType = 'pitta';
        } else {
            $patientType = 'kapha';
        }

        $request->session()->forget('phone_number');
        // Fetch products that are suitable for the identified patient type

        // $recommendedProducts = Product::whereJsonContains('patient_type', $patientType)->get();
        return view('frontend.pages.recommand', compact('patientType'));
    }
}
