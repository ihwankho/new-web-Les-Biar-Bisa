@extends('layout.app')

@section('title', 'Detail Course')

@section('content')
    <h1 class="font-extrabold text-lg text-primary uppercase">{{ $course['nama'] }}</h1>
    <p class="font-semibold text-primary">{{ $course['deskripsi'] }}</p>
    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-3 justify-between">
        <div>
            @if ($file_course->count() > 0)
                @foreach ($file_course as $file)
                    <a class="flex gap-3 font-medium bg-slate-100 p-2 rounded-md text-primary items-center"
                        href="{{ $file['file'] }}" target="_blank" download="{{ $file['file'] }}">
                        <img src="{{ asset('/assets/icon/file.svg') }}" alt="file-icon" class="w-10 h-10">
                        <p>{{ $file['nama'] }}</p>
                    </a>
                @endforeach 
            @else
                <h6 class="font-semibold text-primary">Materi kosong...</h6>
            @endif
        </div>
        <br>
        <div class="mt-3 md:mt-0">
            <span class="font-semibold block mb-2">Link YouTube</span>
            <div class="flex items-center gap-3">
                <!-- Menampilkan thumbnail YouTube dan link -->
                <a id="youtubeLink" href="{{ $file['link'] }}" target="_blank" style="display: none;">{{ $file['link'] }}</a>
                <img id="youtubeThumbnail" src="" style="max-width: 100%; max-height: 200px; cursor: pointer;">
            </div>
        </div>
        <div>
            <br>
            <h3 class="font-extrabold text-xl text-primary"></h3>
            @if ($data->count() > 0)
                @foreach ($data as $task)
                    <!-- Konten task -->
                @endforeach
            @else
                <h6 class="font-semibold text-primary"></h6>
            @endif
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan thumbnail YouTube
        function showYouTubeThumbnail() {
            var linkInput = document.getElementById('youtubeLink').getAttribute('href');
            var youtubeThumbnail = document.getElementById('youtubeThumbnail');

            // Mengambil ID video YouTube dari link
            var videoId = linkInput.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/)[1];

            // Memperbarui URL thumbnail dengan ID video
            if (videoId) {
                youtubeThumbnail.src = "https://img.youtube.com/vi/" + videoId + "/0.jpg";
                youtubeThumbnail.style.display = 'inline-block'; // Menampilkan thumbnail
            } else {
                youtubeThumbnail.src = ""; // Membersihkan thumbnail jika link tidak valid
                youtubeThumbnail.style.display = 'none'; // Menyembunyikan thumbnail
            }
        }

        // Panggil fungsi saat halaman dimuat
        showYouTubeThumbnail();

        // Tambahkan event listener untuk membuka link saat thumbnail diklik
        document.getElementById('youtubeThumbnail').addEventListener('click', function() {
            var link = document.getElementById('youtubeLink').getAttribute('href');
            window.open(link, '_blank');
        });
    </script>

@endsection
