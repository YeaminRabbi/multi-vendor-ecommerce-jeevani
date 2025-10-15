<section class="mt-8">
    <div class="container">
        <div class="hero-slider">

            @foreach($sliders as $data)
            <div style="background: url({{ $Media($data->featuredImage->id.'/'. $data->featuredImage->file_name) }}) no-repeat; background-size: cover; border-radius: 0.5rem; background-position: center">
                <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
{{--                    <span class="badge text-bg-warning">Opening Sale Discount 50%</span>--}}

{{--                    <h2 class="text-dark display-5 fw-bold mt-4">SuperMarket For Fresh Grocery</h2>--}}
{{--                    <p class="lead">Introduced a new model for online grocery shopping and convenient home delivery.</p>--}}

                    {!!  \App\Helpers\Frontend::convertMarkdownToHtml( $data->body )  !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
