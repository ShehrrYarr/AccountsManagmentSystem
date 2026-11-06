@extends('partials.layouts.master2')

    @section('title', 'UI Media Player | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Media Player' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/plyr/plyr.css') }}">
@endsection

    @section('content')

    <div class="row">

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">YouTube Video Player</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-2">Enter a YouTube URL below to watch the video.</p>
                    <p class="text-muted mb-4">Embed a YouTube video with custom controls using <code>Plyr.io</code>. Simply include a YouTube <code>&lt;iframe&gt;</code> and initialize <code>Plyr</code> for a sleek, customizable video player experience.</p>
                    <div class="input-group mb-5 pb-5">
                        <input type="text" class="form-control" id="url-input" placeholder="Enter YouTube URL" aria-label="Username" aria-describedby="basic-addon1">
                        <span class="input-group-text btn btn-primary" id="load-video">Load Video</span>
                    </div>
                    <div id="video_player" class="plyr__video-embed">
                        <iframe id="video-frame" src="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com" allowfullscreen allowtransparency allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
            <!--end::card-->
            <div class="card mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Audio</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a custom audio player using <code>Plyr.io</code>. Wrap your <code>&lt;audio&gt;</code> element and initialize <code>Plyr</code> to provide a modern, feature-rich audio playback experience.</p>
                    <div class="plyr__audio-embed" id="plyr__audio">
                        <audio controls playsinline crossorigin>
                            <source src="https://cdn.plyr.io/static/demo/Kishi_Bashi_-_It_All_Began_With_a_Burst.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

    </div>
@endsection

@section('js')

    <!-- Plyr js -->
    <script src="{{ asset('assets/libs/plyr/plyr.min.js') }}"></script>

    <!-- Player init -->
    <script type="module" src="{{ asset('assets/js/plugins/player.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection