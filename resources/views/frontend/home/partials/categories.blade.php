<section class="my-lg-14 my-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-6">
                    <!-- heading    -->
                    <h3 class="mb-0">Shop By Categories</h3>
                </div>
            </div>
            <div class="row">
                @foreach($shopByCategories as $data)
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="text-center mb-10">
                        <!-- img -->
                        <a href="{{route('shop.list')}}?category={{$data->slug}}"><img src="{{$Media($data->icon)}}" alt="" class="card-image rounded-circle"></a>
                        <div class="mt-4">
                            <h5 class="fs-6 mb-0"><a href="{{route('shop.list')}}?category={{$data->slug}}" class="text-inherit">{{$data->name}}</a></h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
