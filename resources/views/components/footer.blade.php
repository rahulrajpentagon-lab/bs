<!-- ==========================================================
     FOOTER
=========================================================== -->

<footer>

    <div class="container">

        <div class="row g-5">

            <div class="col-lg-4">

                <a href="{{ route('home') }}"
                   class="footer-brand">

                    <img
                        src="{{ asset('assets/images/logo/kayacode-logo-light.svg') }}"
                        alt="kayacode"
                        class="brand-logo brand-logo-footer"
                        width="190"
                        height="44"
                        loading="lazy"
                        decoding="async">

                </a>


                <p class="mt-3">

                    Affordable website development company in India offering
                    professional websites, custom web applications, mobile apps
                    and SEO for small businesses and startups across India.

                </p>


                <div class="social-links mt-4">

                    <a href="{{ route('home') }}"
                       aria-label="Facebook">

                        <i class="bi bi-facebook"></i>

                    </a>

                    <a href="{{ route('home') }}"
                       aria-label="Instagram">

                        <i class="bi bi-instagram"></i>

                    </a>

                    <a href="{{ route('home') }}"
                       aria-label="LinkedIn">

                        <i class="bi bi-linkedin"></i>

                    </a>

                    <a href="{{ route('home') }}"
                       aria-label="YouTube">

                        <i class="bi bi-youtube"></i>

                    </a>

                </div>

            </div>


            <div class="col-6 col-lg-2">

                <h5>
                    Services
                </h5>

                <ul>

                    <li>
                        <a href="{{ route('services') }}">
                            Websites
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('services') }}">
                            Web Apps
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('services') }}">
                            Mobile Apps
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('services') }}">
                            SEO
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-6 col-lg-2">

                <h5>
                    Company
                </h5>

                <ul>

                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('home') }}#pricing">
                            Your Quote
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('works') }}">
                            Our Works
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('home') }}#process">
                            Process
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('enquiry.create') }}">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-lg-4">

                <h5>
                    Ready to Get Started?
                </h5>

                <p>

                    Tell us about your business and receive
                    a tailored quote within one day.

                </p>


                <a href="{{ route('enquiry.create') }}"
                   class="btn-primary-custom mt-2">

                    Get a Free Quote

                </a>

            </div>

        </div>


        <div class="copyright text-center">

            &copy; {{ date('Y') }}

            {{ config('company.name') }}.

            All Rights Reserved.

        </div>

    </div>

</footer>


<!-- ==========================================================
     WHATSAPP
=========================================================== -->

<a
    href="https://wa.me/{{ config('company.whatsapp') }}"
    target="_blank"
    class="whatsapp"
    aria-label="Contact us on WhatsApp">

    <i class="bi bi-whatsapp"></i>

</a>


