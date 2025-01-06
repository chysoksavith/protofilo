<footer>
    <div class="name-footer1">
        <p class="getintocuh"> GET IN TOUCH </p>
    </div>
    <div class="line"></div>
    @php
        use App\Models\FooterModel;
        $getFooter = FooterModel::where('status', 1)->get();
    @endphp
    <div class="name-footer">
        @foreach ($getFooter as $item)
            <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer">
                <button>{{ $item->name }}</button> </a>
        @endforeach

    </div>
    <div class="credit">
        <p>@2024 by Savit.</p>
    </div>

</footer>
