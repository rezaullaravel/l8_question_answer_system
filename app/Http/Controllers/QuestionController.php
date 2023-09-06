<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\ApproveSetting;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //store question
    public function storeQuestion(Request $request){
        if(Auth::check()){
            $approveSetting = ApproveSetting::find(1);

            if( $approveSetting->approve_status==1){
                Question::insert([
                    'user_id' => Auth::user()->id,
                    'question' => $request->question,
                    'status' => 0,
                    'created_at' => date('Y-m-d  H:i:s'),
                   ]);

                   return redirect()->back()->with('info-success','Your question has been submitted to admin panel to approve. If an admin approve your question then it will be published...');
            } else{
                Question::insert([
                    'user_id' => Auth::user()->id,
                    'question' => $request->question,
                    'status' => 1,
                    'created_at' => date('Y-m-d  H:i:s'),
                   ]);

                   return redirect()->back()->with('info-success','Your question has been published');
            }

        } else {
            return redirect()->back()->with('info-msg','You have to login first to continue');
        }
    }//end method


    //delete question
    public function deleteQuestion($id){
        if(Auth::check()){
            Question::find($id)->delete();
            return redirect()->back()->with('info-success','Your question has been successfully deleted');
        }
    }//end method


    //view answer
    public function answerView($id){
        $question = Question::find($id);
        $answers = Answer::where('question_id',$question->id)->get();
        return view('answer_view',compact('question','answers'));
    }//end method


    //store answer
    public function answerStore(Request $request){


        if(Auth::check()){
            Answer::insert([
                'user_id' => Auth::user()->id,
                'question_id' => $request->question_id,
                'answer' => $request->answer,
                'created_at' => date('Y-m-d  H:i:s'),
            ]);
            return redirect()->back()->with('info-success','Your answer has been published');
        } else{
            return redirect()->back()->with('info-msg','You have to login first to continue');
        }
    }//end method


    //setting
    public function setting(){
        $approveSetting = ApproveSetting::find(1);
        $questions =  Question::orderBy('id','desc')->paginate(20);
        return view('setting',compact('approveSetting','questions'));
    }//end method


    //change approve status
    public function cahngeApproveStatus(Request $request,$id){


        if($request->approve_status==1){
            ApproveSetting::find($id)->update([
                'approve_status' => $request->approve_status,
            ]);

            return redirect()->back()->with('info-msg','Approve system has been turned on');
        } else{
            ApproveSetting::find($id)->update([
                'approve_status' => $request->approve_status,
            ]);

            return redirect()->back()->with('info-msg','Approve system has been turned off');
        }
    }//end method


    //question approve
    public function questionApprove($id){
        $question = Question::find($id);
        $question->status = 1;
        $question->save();

        return redirect()->back()->with('info-msg','Question has been successfully approved');
    }//end method


}
