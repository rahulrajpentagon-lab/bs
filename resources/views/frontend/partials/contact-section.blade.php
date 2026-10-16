<section class="contact-section section-padding"
         id="contact">

    <div class="container">

        <div class="section-title">

            <span class="section-label">
                START YOUR PROJECT
            </span>

            <h2>
                Tell Us About Your Business
            </h2>

            <p>
                Add your inquiry now. We will reply within one day with price
                details. Share your business details and ideas in the form below.
            </p>

        </div>
        <x-alert />

        @if ($errors->any())
            <div class="alert alert-danger">
                Please fix the errors below and try again.
            </div>
        @endif
<div class="contact-card">

            <div class="row g-5">

                <!-- CONTACT INFO -->

                <div class="col-lg-5">

                    <h3 class="fw-bold text-dark">

                        Let's Build Your Website.

                    </h3>


                    <p class="mt-3">

                        The more you share about your business and ideas,
                        the more useful our first reply will be.

                    </p>


                    <div class="contact-info">

                        <i class="bi bi-envelope"></i>

                        <div>

                            <strong>
                                Email
                            </strong>

                            <br>

                            <a href="mailto:{{ config('company.email') }}">

                                {{ config('company.email') }}

                            </a>

                        </div>

                    </div>


                    <div class="contact-info">

                        <i class="bi bi-telephone"></i>

                        <div>

                            <strong>
                                Phone
                            </strong>

                            <br>

                            <a href="tel:{{ config('company.phone') }}">

                                {{ config('company.phone') }}

                            </a>

                        </div>

                    </div>


                    <div class="contact-info">

                        <i class="bi bi-whatsapp"></i>

                        <div>

                            <strong>
                                WhatsApp
                            </strong>

                            <br>

                            <a
                                href="https://wa.me/{{ config('company.whatsapp') }}"
                                target="_blank">

                                Chat with us

                            </a>

                        </div>

                    </div>


                    <div class="contact-info">

                        <i class="bi bi-geo-alt"></i>

                        <div>

                            <strong>
                                Location
                            </strong>

                            <br>

                            {{ config('company.location') }}

                        </div>

                    </div>

                </div>


                <!-- FORM -->

                <div class="col-lg-7">

                    <form method="POST" action="{{ route('enquiry.store') }}" id="enquiry-form">
                        @csrf
                        <input type="hidden" name="_redirect" value="{{ url()->current() }}">

                        {{-- Honeypot --}}
                        <div class="d-none" aria-hidden="true">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label" for="business_name">
                                    Business Name *
                                </label>

                                <input
                                    type="text"
                                    name="company"
                                    id="business_name"
                                    class="form-control @error('company') is-invalid @enderror"
                                    placeholder="Your business name"
                                    value="{{ old('company') }}"
                                    required>

                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label" for="name">
                                    Your Name *
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter your name"
                                    value="{{ old('name') }}"
                                    required>

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label" for="email">
                                    Email *
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="you@example.com"
                                    value="{{ old('email') }}"
                                    required>

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label" for="phone">
                                    Phone
                                </label>

                                <input
                                    type="tel"
                                    name="phone"
                                    id="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="+91 XXXXX XXXXX"
                                    value="{{ old('phone') }}">

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-12">

                                <label class="form-label" for="service">
                                    Service
                                </label>

                                <select
                                    name="service"
                                    id="service"
                                    class="form-select @error('service') is-invalid @enderror">

                                    <option value="">
                                        Select Service
                                    </option>

                                    @foreach (['Business Website', 'Web Application', 'Mobile App', 'SEO', 'Maintenance', 'E-commerce Application'] as $serviceOption)
                                        <option value="{{ $serviceOption }}" @selected(old('service') === $serviceOption)>
                                            {{ $serviceOption }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('service')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-12">

                                <label class="form-label" for="message">
                                    Tell us about your project *
                                </label>

                                <textarea
                                    name="message"
                                    id="message"
                                    rows="5"
                                    class="form-control @error('message') is-invalid @enderror"
                                    placeholder="What does your business do? What would you like your website or project to achieve? Include any ideas, features or examples you have in mind."
                                    required>{{ old('message') }}</textarea>

                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-12">

                                <button
                                    type="submit"
                                    class="btn-primary-custom"
                                    id="enquiry-submit">

                                    Send My Inquiry

                                    <i class="bi bi-arrow-right"></i>

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>



