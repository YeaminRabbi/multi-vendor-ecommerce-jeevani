<section>
    <div class="container" id="survey">
        <hr class="my-lg-14 my-8">
        <!-- row -->
        <div class="row align-items-center">
            <div class=" col-lg-6 col-md-6">
                <div class="text-center">
                    <!-- img -->
                    <img src="{{asset('frontend_asset/images/dosa-vata-pitta-kapha.jpg')}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mb-6">
                    <div class="mb-7">
                        <!-- heading -->
                        <h2>Create Your Ayurvedic Profile</h2>
                        <p class="mb-0">Know Yourself: Your Ayurvedic Body Type</p>
                    </div>
                    <div class="mb-5">
                        <!-- form check -->
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">--}}
{{--                            <label class="form-check-label" for="flexRadioDefault1">Email</label>--}}
{{--                        </div>--}}
                        <!-- form check -->
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked="">--}}
{{--                            <label class="form-check-label" for="flexRadioDefault2">Phone</label>--}}
{{--                        </div>--}}
                        <!-- form -->
                        <form method="post" action="{{route('question.survey')}}" class="row g-3 mt-1">
                            @csrf
                            <!-- col -->
                            <div class="col-lg-6 col-7">
                                <!-- input -->
                                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number">
                            </div>
                            <!-- col -->
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">START NOW</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <!-- app -->
                        <small></small>
                        <ul class="list-inline mb-0 mt-3">
                            <!-- list item -->
                            <li class="list-inline-item">
                                <!-- img -->
                                <a href="#!"><img src="../assets/images/appbutton/appstore-btn.svg" alt="" style="width: 140px"></a>
                            </li>
                            <li class="list-inline-item">
                                <!-- img -->
                                <a href="#!"><img src="../assets/images/appbutton/googleplay-btn.svg" alt="" style="width: 140px"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-lg-14 my-8">
    </div>
</section>
