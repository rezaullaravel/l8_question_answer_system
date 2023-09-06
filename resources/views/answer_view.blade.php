
<!DOCTYPE html>
<html lang="zxx">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
      <meta name="author" content="themefisher.com">
      <title>View answer</title>
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
      <!-- bootstrap.min css -->
      <link rel="stylesheet" href="{{ asset('/') }}css/plugins/bootstrap/css/bootstrap.min.css">
      <!-- Icon Font Css -->
      <link rel="stylesheet" href="{{ asset('/') }}css/plugins/icofont/icofont.min.css">
      <!-- Slick Slider  CSS -->
      <link rel="stylesheet" href="{{ asset('/') }}css/plugins/slick-carousel/slick/slick.css">
      <link rel="stylesheet" href="{{ asset('/') }}css/plugins/slick-carousel/slick/slick-theme.css">
      <!-- Main Stylesheet -->
      <link rel="stylesheet" href="{{ asset('/') }}css/style.css">

       <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body id="top">

      <section class="section blog-wrap">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="row">
                     <div class="col-lg-12 mb-5">
                        <div class="single-blog-item">
                            <div class="comment-content mt-3">
                                <p style="font-size: 20px; text-align:justify;">{{  $question->question }} </p>
                             </div>
                           <div class="blog-item-content mt-5">
                              <div class="blog-item-meta mb-3">
                                 <span class="text-color-2 text-capitalize mr-3"><i class="icofont-book-mark mr-2"></i> {{  $question->user->name }} </span>
                                 <span class="text-muted text-capitalize mr-3"><i class="icofont-comment mr-2"></i>{{ count($answers) }} Answers</span>
                                 <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-2"></i> {{  $question->created_at }}</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="comment-area mt-4 mb-5">
                           <h4 class="mb-4">All Answer </h4>
                           <ul class="comment-tree list-unstyled">

                            @foreach ($answers as $answer)
                                <li class="mb-5">
                                    <div class="comment-area-box">
                                        <div class="comment-thumb float-left">
                                            <img alt="" src="images/blog/testimonial1.jpg" class="img-fluid">
                                        </div>
                                        <div class="comment-info">
                                            <h5 class="mb-1">{{ $answer->user->name }}</h5>
                                            <span class="date-comm">{{ $answer->created_at }}</span>
                                        </div>

                                        <div class="comment-content mt-3">
                                            <p> {{ $answer->answer }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                           </ul>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        @if (Session('info-msg'))
                            <div class="alert alert-danger">
                                <h5>{{ Session::get('info-msg') }}</h5>
                            </div>
                        @endif

                        @if (Session('info-success'))
                        <div class="alert alert-success">
                            <h5>{{ Session::get('info-success') }}</h5>
                        </div>
                    @endif
                        <form class="comment-form my-5" id="comment-form" action="{{ route('answer.store') }}" method="POST">
                            @csrf
                           <h4 class="mb-4">Write an answer</h4>
                           <input type="hidden" name="question_id" value="{{ $question->id }}">
                           <textarea class="form-control mb-4" name="answer"  cols="30" rows="5" placeholder="Write your answer......" required></textarea>
                           <input class="btn btn-success" type="submit" name="submit-contact" id="submit_contact" value="Submit">
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
{{-- js for Refresh Page and Keep Scroll Position --}}
      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

   </body>
</html>
