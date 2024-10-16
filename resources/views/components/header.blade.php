<div class="relative">
    <div class="absolute inset-0 bg-cover bg-center ms-0 h-41" style="background-image: url('/assets/background/Coveri.png'); z-index: -1; background-size: cover; left: 10px;"></div>

    <header class="flex justify-between items-center w-full">
        <h1 class="font-extrabold text-xl text-primary">Good Morning, {{ Session::get('fullname') }}</h1>
        {{-- <div class="flex gap-3">
            <img width="24" src="{{ asset('/assets/icon/person.png') }}" alt="person-icon">
            <img width="24" src="{{ asset('/assets/icon/notification.png') }}" alt="notification-icon">
        </div> --}}
    </header>
</div>
