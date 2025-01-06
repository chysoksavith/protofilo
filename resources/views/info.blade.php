@extends('main')
@section('content')
    <div class="about">
        <div class="profile">
            <img src="{{ asset('storage/' . $getRecord->image) }}" alt="">
        </div>
        <div class="letterdetail">
            <div class="text-medium">
                {{ $getRecord->description }}
            </div>
        </div>
    </div>

    <div class="main-infinite">
        <div class="menu">
            <ul class="menu-wrapper">
                @foreach ($getCertificate as $item)
                    <li class="menu-item">
                        <div class="item-category">
                            <p>{{ $item->name }}</p>
                        </div>
                        <div class="item-name">
                            <img src="{{ asset('storage/' . $item->image) }}" />
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="absolute_text">
            <p data-aos="zoom-in">
                Create Positive Goal in Your Life & <br />
                Reach them as happy as you can
            </p>
        </div>
        <div class="absolute_text2">
            <p data-aos="zoom-in">certification </p>
        </div>
    </div>


    <div class="software" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
        <h1>Programs & Softwares</h1>
        <div class="software-wrapper">
            @foreach ($getSoftware as $item)
                <div class="text-block-pill">
                    {{ $item->name }}
                </div>
            @endforeach
        </div>
    </div>
    <div class="personal">
        <h1 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">Personal Skills</h1>
        <div class="personal-main" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <div class="soft-wrapper">
                <h1>Soft</h1>
                <div class="wrap-skills">
                    @foreach ($getSoft as $item)
                        <div class="text-block-pill">
                            {{ $item->name }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="hard-wrapper" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                <h1>hard</h1>
                <div class="wrap-skills">
                    @foreach ($getHard as $item)
                        <div class="text-block-pill">
                            {{ $item->name }}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
