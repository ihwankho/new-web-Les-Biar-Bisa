    @php
        $page = request()->segment(1);
    @endphp

    <nav class="shadow-md h-screen overflow-y-auto relative w-80" style="background-image: url('/assets/background/english.png'); z-index: -0; background-size: auto; background-repeat: no-repeat; background-position: bottom; background-color: #F3C2C2;">
        <h1 class="text-3xl w-max p-5 my-12 font-extrabold text-primary text-center">LES BIAR BISA</h1>
        <div class="pr-5 flex flex-col gap-4 menu-sidebar">
            <a class="item-nav {{ $page == 'dashboard' ? 'text-white bg-primary' : 'text-primary' }}" href="/dashboard">
                <img src="{{ $page == 'dashboard' ? asset('assets/icon/home-light.png') : asset('assets/icon/home-dark.png') }}"
                    alt="images">
                <p class="text-base">DASHBOARD</p>
            </a>

            <a class="item-nav {{ $page == 'mycourse' ? 'text-white bg-primary' : 'text-primary' }}" href="/mycourse">
                <img src="{{ $page == 'mycourse' ? asset('assets/icon/course-light.png') : asset('assets/icon/course-dark.png') }}"
                    alt="images">
                <p class="text-base">MY COURSE</p>
            </a>
            <a class="item-nav {{ $page == 'assignment' ? 'text-white bg-primary' : 'text-primary' }}"
                href="/assignment">
                <img src="{{ $page == 'assignment' ? asset('assets/icon/assignment-light.png') : asset('assets/icon/assignment-dark.png') }}"
                    alt="images">
                <p class="text-base">ASSIGNMENT</p>
            </a>

            <a class="item-nav {{ $page == 'quiz' ? 'text-white bg-primary' : 'text-primary' }}" href="/quizzess">
                <img src="{{ $page == 'quiz' ? asset('assets/icon/quiz.png') : asset('assets/icon/quiz.png') }}" alt="">
                <p class="text-base">QUIZez</p>
            </a>  

            <a class="item-nav {{ $page == 'payment' ? 'text-white bg-primary' : 'text-primary' }}" href="/payment">
                <img src="{{ $page == 'payment' ? asset('assets/icon/payment-light.png') : asset('assets/icon/payment-dark.png') }}"
                    alt="images">
                <p class="text-base">PAYMENT</p>
            </a>
            <a class="item-nav {{ $page == 'logout' ? 'text-white bg-primary' : 'text-primary' }}" href="/logout">
                <img src="{{ asset('assets/icon/logout.png') }}" alt="images">
                <p class="text-base">LOGOUT</p>
            </a>
        </div>
    </nav>
