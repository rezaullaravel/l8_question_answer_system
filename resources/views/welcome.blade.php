<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Question And Answer System</title>

    <style>
        .paraStyle{
            display: inline;
            padding-left: 15px;
        }

        .part {
            float: left;
            max-width: 80%;
            border: 1px solid #0000004f;
            margin-left: 6px;
            padding: 5px;
        }

        .part2 {
            float: right;
            max-width: 30%;
            border: 1px solid #0000004f;
            padding: 5px;
        }
    </style>
  </head>
  <body>
   <div class="container mt-5">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3>Ask Your Question.
                <a href="{{ route('setting') }}" class="btn btn-info" style="float: right;">Setting</a>
                @if(!Auth::check())
                <a href="{{ url('/login') }}" class="btn btn-secondary mr-2" style="float: right;">Login</a>
                @endif
            </h3>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">
            @if(Session('info-msg'))
             <div class="alert alert-danger">
                <h4 class="text-center">{{ Session::get('info-msg') }}</h4>
             </div>
            @endif

            @if(Session('info-success'))
            <div class="alert alert-success">
               <h4 class="text-center">{{ Session::get('info-success') }}</h4>
            </div>
           @endif
            <div class="card">
                <div class="card-header">
                    <h3>Ask Your Question here....</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('question.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="question" class="form-control" rows="5" required placeholder="Write your question....."></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="submit" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">
            <h3>Question List:</h3>
            @foreach ($questions as $question)

              @php
                  $answers = DB::table('answers')->where('question_id',$question->id)->get();
              @endphp
                <div class="card mb-3">
                    <div class="card-body">
                       <div class="part">
                            <h4><a href="{{ route('answer.view',$question->id) }}" style="color: #000;">{{ Str::limit($question->question,200) }}</a></h4>
                            <p class="paraStyle">{{ $question->user->name }}</p>
                            <p class="paraStyle">{{ $question->created_at }}</p>
                            <p class="paraStyle">Answer ({{ count( $answers ) }})</p> <br>
                            <a href="{{ route('answer.view',$question->id) }}" class="btn btn-success" style="float: right;">See Answers</a>
                       </div>

                       @if (Auth::check())
                            @if ($question->user_id==Auth::user()->id)
                                <div class="part2">
                                    <a href="{{ route('question.delete',$question->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this question???');">Delete</a>
                                </div>
                            @endif

                       @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>

   <div class="row">
     <div class="col-sm-8 offset-sm-2">
        {{ $questions->links() }}
     </div>
   </div>


   </div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  </body>
</html>
