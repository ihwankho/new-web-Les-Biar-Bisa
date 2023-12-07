<header class="flex justify-between items-center w-full">
    <h1 class="font-extrabold text-xl text-primary">Good Morning, {{ Session::get('fullname') }}</h1>
    <div class="flex gap-3">
        <img width="24" src="{{ asset('/assets/icon/person.png') }}" alt="person-icon">
        <img width="24" src="{{ asset('/assets/icon/notification.png') }}" alt="notification-icon">
    </div>
</header>
