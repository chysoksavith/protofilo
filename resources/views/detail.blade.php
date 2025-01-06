@extends('main')
@section('content')
    <div class="main-slider">
        <div class="slider">
            <div class="slider-wrapper">

                @forelse($getProjectDetail->images as $images)
                    <div class="slider-item">
                        <figure>
                            <img class="detail-project" src="{{ asset('storage/images/' .$images->image) }}" alt="" />
                        </figure>
                    </div>

                @empty
                    <div class="slider-item">
                        <figure>
                            <img class="detail-project"
                                src="https://cdn.prod.website-files.com/65cdce1948e4112d27a91093/6627d01878e8c42ed4238a73_pre-footer-image-p-1080.webp"
                                alt="" />
                        </figure>
                    </div>
                @endforelse

            </div>
            <div class="slider-progress">
                <div class="slider-progress-bar"></div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="detail-1">
        <div class="name-project">
            <h1>{{ $getProjectDetail->name }}</h1>
            <span class="list-project"> {{ $getProjectDetail->project_list }}</span>
            <a href="/detail.html">
                <button>visit</button>
            </a>
        </div>
        <div class="detail-2">
            <ul class="text-aggent">
                <li>Year</li>
                <li>
                    <p class="year2">
                        {{ $getProjectDetail->year }}
                    </p>
                </li>
            </ul>
            <ul class="text-aggent">
                <li>agency</li>
                <li>
                    <p>
                        {{ $getProjectDetail->agency }}
                    </p>
                </li>
            </ul>

            <ul class="text-aggent">
                <li>Role</li>
                <li>
                    <p>
                        {{ $getProjectDetail->role }}
                    </p>
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const lerp = (f0, f1, t) => (1 - t) * f0 + t * f1;
        const clamp = (val, min, max) => Math.max(min, Math.min(val, max));

        class DragScroll {
            constructor(obj) {
                this.el = document.querySelector(obj.el);
                this.wrap = document.querySelector(obj.wrap);
                this.items = document.querySelectorAll(obj.item);
                this.bar = document.querySelector(obj.bar);
                this.init();
            }

            init() {
                this.progress = 0;
                this.speed = 0;
                this.oldX = 0;
                this.x = 0;
                this.playrate = 0;
                this.lastLogTime = 0;
                this.logInterval = 100; // Interval in milliseconds for logging

                this.bindings();
                this.events();
                this.calculate();
                requestAnimationFrame(this.raf.bind(this));
            }

            bindings() {
                [
                    "events",
                    "calculate",
                    "raf",
                    "handleWheel",
                    "move",
                    "handleTouchStart",
                    "handleTouchMove",
                    "handleTouchEnd",
                ].forEach((method) => {
                    this[method] = this[method].bind(this);
                });
            }

            calculate() {
                this.progress = 0;
                if (this.items.length > 0) {
                    this.wrapWidth = this.items[0].clientWidth * this.items.length;
                    this.wrap.style.width = `${this.wrapWidth}px`;
                    this.maxScroll = this.wrapWidth - this.el.clientWidth;
                } else {
                    console.error("No items found. Check the selector for obj.item.");
                }
            }

            handleWheel(e) {
                this.progress += e.deltaY;
                this.move();
            }

            handleTouchStart(e) {
                e.preventDefault();
                this.dragging = true;
                this.startX = e.clientX || (e.touches && e.touches[0] && e.touches[0].clientX);
            }

            handleTouchMove(e) {
                if (!this.dragging) return false;
                const x = e.clientX || (e.touches && e.touches[0] && e.touches[0].clientX);
                if (x === undefined) return; // Avoid processing if x is undefined
                this.progress += (this.startX - x) * 2.5;
                this.startX = x;
                this.move();
            }

            handleTouchEnd() {
                this.dragging = false;
            }

            move() {
                this.progress = clamp(this.progress, 0, this.maxScroll);
            }

            events() {
                window.addEventListener("resize", this.calculate);
                window.addEventListener("wheel", this.handleWheel);

                this.el.addEventListener("touchstart", this.handleTouchStart);
                window.addEventListener("touchmove", this.handleTouchMove);
                window.addEventListener("touchend", this.handleTouchEnd);

                window.addEventListener("mousedown", this.handleTouchStart);
                window.addEventListener("mousemove", this.handleTouchMove);
                window.addEventListener("mouseup", this.handleTouchEnd);
                document.body.addEventListener("moveleave", this.handleTouchEnd);
            }

            raf() {
                this.x = lerp(this.x, this.progress, 0.1);
                this.playrate = clamp(this.x / this.maxScroll, 0, 1);

                const now = performance.now();
                if (now - this.lastLogTime > this.logInterval) {
                    if (this.playrate > 0.01 && this.playrate < 0.999) { // Adjust thresholds as needed
                        console.log("Playrate:", this.playrate);
                    }
                    this.lastLogTime = now;
                }

                this.wrap.style.transform = `translateX(${-this.x}px)`;
                this.bar.style.transform = `scaleX(${0.18 + this.playrate * 0.82})`;

                this.speed = Math.min(100, this.oldX - this.x);
                this.oldX = this.x;

                this.scale = lerp(this.scale, this.speed, 0.1);
                this.items.forEach((item) => {
                    item.style.transform = `scale(${1 - Math.abs(this.speed) * 0.005})`;
                    item.querySelector("img").style.transform = `scaleX(${1 + Math.abs(this.speed) * 0.004})`;
                });

                // Request the next frame
                requestAnimationFrame(this.raf.bind(this));
            }
        }

        const scroll = new DragScroll({
            el: ".slider",
            wrap: ".slider-wrapper",
            item: ".slider-item",
            bar: ".slider-progress-bar",
        });
    </script>
@endsection
