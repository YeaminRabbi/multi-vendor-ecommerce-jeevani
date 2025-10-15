@extends('frontend.layouts.master')
@section('content')
    <div id="app" class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Question @{{ currentIndex + 1 }} of @{{ totalQuestions }}</h4>
            </div>
            <form action="{{route('recommand.product.for.you')}}" method="post">
                @csrf
                <div class="card-body questionnaire">
                    <p class="lead">@{{ currentQuestion.section }}</p>
                    <p class="lead">@{{ currentQuestion.question_text }}</p>
                    <div class="d-flex">
                        <div class="form-group answer-block" v-for="(answer, index) in currentQuestion.answers" :key="index">
                            <input type="radio"
                                   :id="'answer-' + index"
                                   :value="answer"
                                   v-model="selectedAnswer"
                                   class="form-check-input ">
                            <label @click="doAnswer" :for="'answer-' + index" class="form-check-label">@{{ answer.answer_text }}</label>
                        </div>
                    </div>

                    <!-- Hidden Inputs to Submit -->
                    <div v-for="(answer, index) in answeredQuestions" :key="index">
                        <input type="hidden" :name="'answers[' + answer.question_id + ']'" :value="answer.id">
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" @click="prevQuestion" :disabled="currentIndex === 0">Previous</button>
                    <button type="button" v-if="!checkLastStage" class="btn btn-primary" @click="nextQuestion" :disabled="!selectedAnswer">Next</button>
                    <button v-if="checkLastStage" class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
            <!-- Progress Bar -->
            <div class="mt-3">
                <div class="progress">
                    <div class="progress-bar"
                         :class="progressBarClass"
                         role="progressbar"
                         :style="{ width: progress + '%' }"
                         aria-valuenow="progress"
                         aria-valuemin="0" aria-valuemax="100">
                        @{{ progress }}%
                    </div>
                </div>
                <p class="text-center mt-2">@{{ answeredQuestions.length }} out of @{{ totalQuestions }} answered</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    currentIndex: 0,  // Index of the current question
                    selectedAnswer: '',  // Holds the selected answer for the current question
                    questions : [],
                    answeredQuestions: [],  // Store answers for each question
                    answerQuestionsComplete: 0,
                    questionsComplete: 0,
                    lastStage : false,
                };
            },
            computed: {
                checkLastStage() {
                    return this.progress == 100 ? true : false;
                    return  (this.currentIndex + 1) == this.totalQuestions ? true : false;
                },

                currentQuestion() {
                    return this.questions[this.currentIndex];
                },
                totalQuestions() {
                    return this.questions.length;
                },
                progress() {
                    // Calculate the percentage of questions answered
                    this.answerQuestionsComplete = this.answeredQuestions.length
                    return Math.round((this.answerQuestionsComplete / this.totalQuestions) * 100);
                },
                progressBarClass() {
                    // Dynamically set the class based on progress
                    if (this.progress <= 25) {
                        return 'bg-danger';  //  for 0-25%
                    } else if (this.progress <= 50) {
                        return 'bg-warning';  //  for 26-50%
                    } else if (this.progress <= 75) {
                        return 'bg-info';  // for 51-75%
                    } else {
                        return 'bg-success';  // for 76-100%
                    }
                }
            },
            methods: {
                renderQuestion(){
                    let datas = {!! json_encode($questionsAnswer) !!};
                    let mkQuestions = [];
                    datas.forEach((question, sectionIndex) => {
                        let section = question.section;
                        let answers = []
                        question.answers.forEach((answer, item) => {
                            answers[item] = {
                                id : answer.id,
                                answer_text : answer.answer_text,
                                question_id : question.id,
                            }
                        });
                        let obj = {
                            section: section.name,
                            question_text: question.question_text,
                            answers: answers
                        }
                        mkQuestions[sectionIndex] = obj //datasQuestion
                    })
                    this.questions = mkQuestions;
                },
                nextQuestion() {
                    // Save the answer if selected
                    this.answeredQuestions[this.currentIndex] = this.selectedAnswer;
                    // Move to the next question
                    if (this.currentIndex < this.totalQuestions - 1) {
                        this.currentIndex++;
                        this.selectedAnswer = this.answeredQuestions[this.currentIndex] || '';
                    }
                    this.answerQuestionsComplete = this.answeredQuestions.length
                },
                doAnswer(){
                    /*
                    this.answeredQuestions[this.currentIndex] = this.selectedAnswer;
                    if (this.currentIndex < this.totalQuestions - 1) {
                        this.currentIndex++;
                        this.selectedAnswer = this.answeredQuestions[this.currentIndex] || '';
                    }
                    this.answerQuestionsComplete = this.answeredQuestions.length

                     */
                },
                prevQuestion() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                        this.selectedAnswer = this.answeredQuestions[this.currentIndex] || '';
                    }
                    //this.answerQuestionsComplete = this.answeredQuestions.length
                },
            },
            created(){
                this.renderQuestion()
            }
        });
    </script>

    <style>
        .questionnaire .lead{
            font-size: 25px;
            color: #000;
        }
        .answer-block {
            background: #d8efe3;
            padding: 10px;
            margin-right: 10px;
            border-radius: 17px;
            color: #000000;
            font-size: 18px;
        }
    </style>

@endsection
