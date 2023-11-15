<nav class="shadow-md h-screen overflow-y-auto relative w-80">
    <h1 class="text-3xl w-max p-5 my-12 font-extrabold text-primary text-center">LES BIAR BISA</h1>
    <div class="pr-5 flex flex-col gap-4 menu-sidebar">
        <a class="text-white bg-primary item-nav" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/icon/home-light.png') }}" alt="images">
            <p class="text-base">DASHBOARD</p>
        </a>
        <a class="item-nav text-primary" href="{{ route('mycourse.index') }}">
            <img src="{{ asset('assets/icon/course-dark.png') }}" alt="images">
            <p class="text-base">MY COURSE</p>
        </a>
        <a class="item-nav text-primary" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/icon/schedule-dark.png') }}" alt="images">
            <p class="text-base">SCHEDULE</p>
        </a>
        <a class="item-nav text-primary" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/icon/assignment-dark.png') }}" alt="images">
            <p class="text-base">ASSIGNMENT</p>
        </a>
        <a class="item-nav text-primary" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/icon/payment-dark.png') }}" alt="images">
            <p class="text-base">PAYMENT</p>
        </a>
        <a class="item-nav text-primary" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/icon/logout.png') }}" alt="images">
            <p class="text-base">LOGOUT</p>
        </a>
    </div>
</nav>
