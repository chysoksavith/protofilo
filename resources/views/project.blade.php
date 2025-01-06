@extends('main')
@section('content')
    <section class="world">
        <div class="left-star col-star">
            <h1 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                Welcome to my project
            </h1>
            <p id="simpleUsage"></p>

        </div>
        <div class="right-star col-star">
            <iframe class="spline" src="https://my.spline.design/ai-80c00133d0f087793256a49ff6a09cff/"
                frameborder="0"></iframe>
        </div>

    </section>
    <div class="container">
        <section class="services">
            <div class="service-header">
                <div class="col"></div>
                <div class="col">
                    <h1 class="h1_detail">All Project</h1>
                </div>
            </div>
            @forelse ($getProject as $item)
                <    <div class="service">
                    <div class="service-info">
                        <h1 class="h1_detail">{{ $item->name }} / {{ $item->project_list }}</h1>
                        <p class="p_detail">{{ $item->description }}</p>
                    </div>
                    <div class="service-image">
                        <div class="img_style">
                            @if ($item->images->isNotEmpty())
                                <!-- Display the first image of the project -->
                                <a href="{{ url('/projects/' . $item->id) }}">
                                    <img class="img_detail" src="{{ asset('storage/images/' . $item->images[0]->image) }}" alt="Project Image" width="200">
                                </a>
                            @else
                                <!-- Default image if no images are available -->
                                <img src="https://www.designscene.net/wp-content/uploads/2023/11/Fear-of-God-Athletics-2023-14.jpg" alt="Default Image" class="primary-image">
                            @endif
                        </div>
                    </div>
                </div>

            @empty
                <div class="service">
                    <div class="service-info">
                        <h1 class="h1_detail">No Project Avaliable</h1>
                        <p class="p_detail">Test</p>
                    </div>
                    <div class="service-image">
                        <div class="img_style">
                            <img class="img_detail"
                                src="https://cdn.prod.website-files.com/65cdce1948e4112d27a91093/6627d01878e8c42ed4238a73_pre-footer-image-p-1080.webp"
                                alt="" />
                        </div>
                    </div>
                </div>
            @endforelse

        </section>
        <section class="footer"></section>
    </div>
@endsection
@section('script')
    <script>
        document.querySelector('.spline').addEventListener('load', function() {
            this.classList.add('spline-loaded');
        });
    </script>
@endsection
