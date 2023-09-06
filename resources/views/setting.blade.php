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
            @if (Session('info-msg'))
                <div class="alert alert-success">
                    <h4 class="text-center">{{ Session::get('info-msg') }}</h4>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Trun Off/On Question Approval System.</h4>
                </div>
                <div class="card-body">
                   <div class="row">
                     <div class="col-sm-4 offset-sm-4">
                          <form action="{{ route('change.approve.status',$approveSetting->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="radio" name="approve_status" value="1" {{ $approveSetting->approve_status==1 ? 'checked':'' }}>ON
                                </div>

                                <div class="form-group">
                                    <input type="radio" name="approve_status" value="0" {{ $approveSetting->approve_status==0 ? 'checked':'' }}>OFF
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" value="Apply Now" class="btn btn-success">
                                </div>
                         </form>
                     </div>
                   </div>
                </div>
            </div>
        </div>
      </div>{{-- row --}}

      <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-header">
                    <h4>All questions</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Question</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{  $question->id }}</td>
                                    <td>{{  $question->question }}</td>
                                    <td>
                                       @if ($question->status==1)
                                          <p class="text-success">Approved</p>
                                       @else
                                       <p class="text-danger">Pending</p>
                                       @endif
                                    </td>
                                    <td>
                                        @if($question->status==0 && $approveSetting->approve_status==1 )
                                         <a href="{{ route('question.approve',$question->id) }}" class="btn btn-success">Approve</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{   $questions->links() }}
                </div>
            </div>
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
