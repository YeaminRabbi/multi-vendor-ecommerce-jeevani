@extends('frontend.layouts.master')

@section('content')
    <div class="container mt-5">
        <h2>Patient Questionnaire</h2>

        <div id="question-container" class="py-5">
            @foreach($sections as $section)
                <div class="section" id="section_{{ $section->id }}" data-section="{{ $loop->index }}" style="{{ $loop->first ? '' : 'display:none;' }}">
                    <h3>{{ $section->name }}</h3>
                    <p>{{ $section->description }}</p>

                    @foreach($section->questions as $question)
                        <div class="question" data-question="{{ $loop->index }}" id="question_{{ $question->id }}" style="{{ $loop->first ? '' : 'display:none;' }}">
                            <p><strong>{{ $question->question_text }}</strong></p>
                            @foreach($question->answers as $answer)
                                <label class="d-block">
                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}">
                                    {{ $answer->answer_text }}
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button id="next-button" class="btn btn-primary mt-3">Next</button>
        </div>
    </div>
@endsection

@section('js')
    <style>
        .question { margin-top: 20px; }
        .section { margin-bottom: 40px; }
        #next-button { display: block;  }
    </style>
    <script>
        let currentSectionIndex = 0;
        let currentQuestionIndex = 0;

        // Handle the Next button click
        $('#next-button').on('click', function() {
            let currentSection = $('.section').eq(currentSectionIndex);
            let currentQuestion = currentSection.find('.question').eq(currentQuestionIndex);

            // Validate if the user has selected an answer
            let selectedAnswer = currentQuestion.find('input[type="radio"]:checked');
            if (!selectedAnswer.length) {
                alert('Please select an answer before proceeding.');
                return;
            }


            // Store the answer via AJAX
            $.ajax({
                url: "{{ route('questionnaire.store') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    phone: "{{ $phone }}",
                    answer_id: selectedAnswer.val(),
                    question_id: currentQuestion.attr('id').split('_')[1]
                },
                success: function(response) {
                    if (response.success) {
                        moveToNextQuestion();
                    }
                }
            });

        });

        function moveToNextQuestion() {
            let currentSection = $('.section').eq(currentSectionIndex);
            let currentQuestion = currentSection.find('.question').eq(currentQuestionIndex);

            // Hide current question
            currentQuestion.hide();

            // Move to the next question in the same section, or to the next section
            if (currentSection.find('.question').length > currentQuestionIndex + 1) {
                // Next question in the current section
                currentQuestionIndex++;
                currentSection.find('.question').eq(currentQuestionIndex).show();
            } else if ($('.section').length > currentSectionIndex + 1) {
                // Move to the next section
                    currentSectionIndex++;
                currentQuestionIndex = 0;
                $('.section').hide();
                $('.section').eq(currentSectionIndex).show();
            } else {
                // All sections and questions are done
                $('#next-button').hide();
                alert('You have completed the questionnaire.');
                // Optionally, redirect to a results page or show recommendations
            }
        }
    </script>
@endsection
