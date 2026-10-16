<!-- ==========================================================
     NAVIGATION
=========================================================== -->

<nav class="navbar navbar-expand-lg fixed-top">

    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                src="{{ asset('assets/images/logo/kayacode-logo.svg') }}"
                alt="kayacode"
                class="brand-logo"
                width="190"
                height="44"
                decoding="async">
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNav"
            aria-controls="mainNav"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="mainNav">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}"
                       href="{{ route('services') }}">
                        Services
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('works') ? 'active' : '' }}"
                       href="{{ route('works') }}">
                        Our Works
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('home') }}#process">
                        Process
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('home') }}#faq">
                        FAQ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}">
                        Contact
                    </a>
                </li>

            </ul>

            <a href="{{ route('enquiry.create') }}"
               class="btn-primary-custom">

                Get a Free Quote

            </a>

        </div>

    </div>

</nav>
