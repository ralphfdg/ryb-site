@extends('layouts.default')

@section('title', 'About Us | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="About Us" />
{{-- #page-title end --}}

{{-- About Us --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <div class="row mx-auto">
      <div class="col-12 col-xl-9">
        <h6 class="text-color-2">KNOW US MORE</h6>
        <h2 class="heading" data-aos="fade-right" data-aos-delay="500" data-aos-duration="3000">
          Enhancing Your <span class="text-primary-color">Driving Experience</span> with Professional Car Detailing
          & Maintenance
        </h2>
      </div>
      <div class="col-12 col-xl-3 d-flex justify-content-start justify-content-xl-end align-items-xl-end pt-5">
        <a href="{{ route('contact-us') }}" class="btn btn-lg btn-cta-primary">Let's Get In Touch</a>
      </div>
    </div>

    <div class="row mt-5 mx-auto">
      <div class="col-12 col-xl-6 ps-0 pe-4">

        <p class="text-color-2 mb-5">Experience smoother, more enjoyable driving with expert car detailing and
          maintenance that keeps
          your
          vehicle clean, protected, and running at its best.</p>
        <div class="step-item d-flex mb-4">
          <div class="step-number">01</div>
          <div class="ms-3">
            <h5 class="heading mb-1">Passion For Perfection, Commitment To Quality</h5>
            <p class="text-color-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit
              tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
          </div>
        </div>
        <hr class="opacity-50">
        <div class="step-item d-flex my-4">
          <div class="step-number">02</div>
          <div class="ms-3">
            <h5 class="heading mb-1">Bringing New Life To Your Car, One Detail At A Time</h5>
            <p class="text-color-2">Morbi quis sapien commodo, convallis mi quis, pharetra dui. Nam
              finibus mi ligula, nec consequat felis pretium vel mauris eget bibendum massa.</p>
          </div>
        </div>
        <hr class="opacity-50">
        <div class="step-item d-flex mt-4">
          <div class="step-number">03</div>
          <div class="ms-3">
            <h5 class="heading mb-1">Your Car Deserves The Best – We Make It Happen</h5>
            <p class="text-color-2">Integer lacinia consectetur leo, sed egestas neque lobortis nec.
              Praesent risus sapien, gravida sit amet vestibulum mattis, venenatis vitae diam.</p>
          </div>
        </div>

      </div>

      <div class="col-12 col-xl-6 ps-4 pe-0 mt-5 mt-xl-0">
        <div class="img-wrapper position-relative mx-auto">
          <div class="img-ratio-121">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Car Detailing and Polishing"
              class="w-100 h-100 position-absolute rounded-4" style="inset: 0;">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- #about end --}}

{{-- Warranty section --}}
<x-warranty />
{{-- #warranty end --}}

{{-- Testimonials section --}}
<x-testimonials />
{{-- #testimonials end --}}

{{-- Appoinment section --}}
<x-light-appointment />
{{-- #appointment end --}}

{{-- FAQs --}}
<x-faqs />
{{-- #faqs end --}}

{{-- Ads-CTA section --}}
<x-ads-cta />
{{-- #ads-cta end --}}

@endsection