<div>
    <h2 class="mt-2 mb-2">Últimos vídeos publicados no Canal do Youtube</h2>
    <ul class="list-group">
        @foreach ($videos as $video)
        <li class="list-group-item">
            <a href="https://www.youtube.com/watch?v={{ $video['id']['videoId'] }}" target="_blank">
                <img src="{{ $video['snippet']['thumbnails']['default']['url'] }}"
                    alt="{{ $video['snippet']['title'] }}" />
                {{ $video['snippet']['title'] }} - {{ substr($video['snippet']['publishedAt'], 0, 10) }}

            </a>
        </li>
        @endforeach
    </ul>
</div>