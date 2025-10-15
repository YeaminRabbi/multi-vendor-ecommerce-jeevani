@if (isset($widget))
    @if ($widget->is_active == 1)
    <div class="col">
        <div class="pt-8 px-6 px-xl-8 rounded"
            style="background: url({{ \App\Helpers\Frontend::filePath($widget->meta_value) }}) no-repeat; background-size: cover; height: 470px">
            <div>
                <h3 class="fw-bold text-white">{{ $widget->settings['title'] ?? '' }}</h3>
                <p class="text-white">{{ $widget->settings['description'] ?? '' }}</p>
                @if ($widget->settings['button-status'] && $widget->settings['button-status'] == 'on')
                    <a href="{{ $widget->settings['button-url'] }}" class="btn btn-primary">
                        {{ $widget->settings['button-label'] }}
                        <i class="feather-icon icon-arrow-right ms-1"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
    @endif
@endif
