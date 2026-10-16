{{-- Our Works / Portfolio Slider --}}
@php
    $works = config('works.featured', []);
@endphp

<section class="works-section section-padding" id="works">
    <div class="container">
        <div class="section-title">
            <span class="section-label">OUR WORKS</span>
            <h2>Projects that help businesses grow online</h2>
            <p>
                Websites, web apps and mobile applications crafted for startups and
                growing brands — designed to look premium and convert better.
            </p>
        </div>

        <div
            id="worksCarousel"
            class="carousel slide carousel-fade works-carousel"
            data-bs-ride="carousel"
            data-bs-interval="4500"
            data-bs-pause="hover"
            data-bs-touch="true"
            data-bs-wrap="true">

            <div class="carousel-indicators works-indicators">
                @foreach ($works as $index => $work)
                    <button
                        type="button"
                        data-bs-target="#worksCarousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($works as $index => $work)
                    @php $isMobile = ($work['type'] ?? '') === 'mobile'; @endphp
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="works-slide">
                            <div class="row align-items-center g-4 g-xl-5">
                                <div class="col-lg-7">
                                    <div class="device-stage">
                                        @if ($isMobile)
                                            <div class="device-phone">
                                                <div class="device-phone-notch" aria-hidden="true"></div>
                                                <div class="device-phone-screen">
                                                    <img
                                                        src="{{ asset($work['image']) }}"
                                                        alt="{{ $work['title'] }} mobile app design"
                                                        class="device-screen-img"
                                                        width="864"
                                                        height="1152"
                                                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                                        decoding="async">
                                                </div>
                                            </div>
                                        @else
                                            <div class="device-laptop">
                                                <div class="device-laptop-screen">
                                                    <div class="device-laptop-camera" aria-hidden="true"></div>
                                                    <img
                                                        src="{{ asset($work['image']) }}"
                                                        alt="{{ $work['title'] }} website design"
                                                        class="device-screen-img"
                                                        width="1280"
                                                        height="720"
                                                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                                        decoding="async">
                                                </div>
                                                <div class="device-laptop-base" aria-hidden="true">
                                                    <div class="device-laptop-notch"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="works-copy">
                                        <span class="works-category">{{ $work['category'] }}</span>
                                        <h3>{{ $work['title'] }}</h3>
                                        <p>{{ $work['desc'] }}</p>
                                        <ul class="works-points">
                                            <li><i class="bi bi-check-circle-fill"></i> Clean professional design</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Laptop & mobile friendly</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Built for business results</li>
                                        </ul>
                                        <div class="d-flex flex-wrap gap-2 justify-content-lg-start justify-content-center">
                                            <a href="{{ route('enquiry.create') }}" class="btn-primary-custom">
                                                Start a Similar Project <i class="bi bi-arrow-right"></i>
                                            </a>
                                            <a href="{{ route('works') }}" class="btn-outline-custom">
                                                View All Works
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev works-control" type="button" data-bs-target="#worksCarousel" data-bs-slide="prev" aria-label="Previous project">
                <span class="works-control-btn"><i class="bi bi-chevron-left"></i></span>
            </button>
            <button class="carousel-control-next works-control" type="button" data-bs-target="#worksCarousel" data-bs-slide="next" aria-label="Next project">
                <span class="works-control-btn"><i class="bi bi-chevron-right"></i></span>
            </button>
        </div>
    </div>
</section>
