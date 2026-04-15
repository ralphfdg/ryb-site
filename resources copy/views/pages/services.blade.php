@extends('layouts.default')

@section('title', 'Our Services | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Our Services" />
{{-- #page-title end --}}

{{-- Services section --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <div class="row mx-auto text-center mb-5">
      <h6 class="text-color-2">OUR SOLUTIONS</h6>
      <h2 class="heading mt-3" data-aos="fade-up" data-aos-delay="500" data-aos-duration="3000">Comprehensive Car
        Detailing Solutions for a Flawless Finish</h2>
      <P class="text-color-2 mt-3">Drive with confidence and style through expert car care solutions that bring out
        the best in your vehicle’s appearance and condition.</P>
    </div>

    <div class="row mx-auto row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
      <div class="col">
        <div class="card group-card rounded-4 overflow-hidden position-relative" data-aos="fade-right"
          data-aos-delay="500" data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Exterior Detailing"
              class="img-fluid opacity-75 w-100 h-100 object-fit-cover">
          </div>

          <div class="card-img-overlay flex-column justify-content-between p-4">
            <h4 class="heading text-primary-color">01.</h4>

            <div class="card-service-label rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-3">Exterior Detailing</h5>
              <a href="service-detail.php" class="links-primary text-white d-inline-block mb-3">Read More <i
                  class="bi bi-arrow-right-circle-fill"></i></a>
              <p class="card-text m-0">Thorough cleaning, polishing, and waxing to restore your car’s shine and
                protect its paint.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card group-card rounded-4 overflow-hidden position-relative" data-aos="fade-up" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Interior Detailing"
              class="img-fluid opacity-75 w-100 h-100 object-fit-cover">
          </div>

          <div class="card-img-overlay flex-column justify-content-between p-4">
            <h4 class="heading text-primary-color">02.</h4>

            <div class="card-service-label rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-3">Interior Detailing</h5>
              <a href="service-detail.php" class="links-primary text-white d-inline-block mb-3">Read More <i
                  class="bi bi-arrow-right-circle-fill"></i></a>
              <p class="card-text m-0">Deep cleaning of seats, carpets, dashboard, and all interior surfaces for a
                fresh, spotless cabin.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card group-card rounded-4 overflow-hidden position-relative" data-aos="fade-left"
          data-aos-delay="500" data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Paint Correction"
              class="img-fluid opacity-75 w-100 h-100 object-fit-cover">
          </div>

          <div class="card-img-overlay flex-column justify-content-between p-4">
            <h4 class="heading text-primary-color">03.</h4>

            <div class="card-service-label rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-3">Paint Correction</h5>
              <a href="service-detail.php" class="links-primary text-white d-inline-block mb-3">Read More <i
                  class="bi bi-arrow-right-circle-fill"></i></a>
              <p class="card-text m-0">Deep cleaning of seats, carpets, dashboard, and all interior surfaces for a
                fresh, spotless cabin.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card group-card rounded-4 overflow-hidden position-relative" data-aos="fade-right"
          data-aos-delay="1000" data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Ceramic Coating"
              class="img-fluid opacity-75 w-100 h-100 object-fit-cover">
          </div>

          <div class="card-img-overlay flex-column justify-content-between p-4">
            <h4 class="heading text-primary-color">04.</h4>

            <div class="card-service-label rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-3">Ceramic Coating</h5>
              <a href="service-detail.php" class="links-primary text-white d-inline-block mb-3">Read More <i
                  class="bi bi-arrow-right-circle-fill"></i></a>
              <p class="card-text m-0">Long-lasting protection against dirt, UV rays, and water spots while
                enhancing gloss.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card group-card rounded-4 overflow-hidden position-relative" data-aos="fade-up"
          data-aos-delay="1000" data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Engine Bay Cleaning"
              class="img-fluid opacity-75 w-100 h-100 object-fit-cover">
          </div>

          <div class="card-img-overlay flex-column justify-content-between p-4">
            <h4 class="heading text-primary-color">05.</h4>

            <div class="card-service-label rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-3">Engine Bay Cleaning</h5>
              <a href="service-detail.php" class="links-primary text-white d-inline-block mb-3">Read More <i
                  class="bi bi-arrow-right-circle-fill"></i></a>
              <p class="card-text m-0">Safe and detailed cleaning of the engine bay to improve appearance and
                longevity.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card group-card rounded-4 overflow-hidden position-relative" data-aos="fade-left"
          data-aos-delay="500" data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Headlight Restoration"
              class="img-fluid opacity-75 w-100 h-100 object-fit-cover">
          </div>

          <div class="card-img-overlay flex-column justify-content-between p-4">
            <h4 class="heading text-primary-color">06.</h4>

            <div class="card-service-label rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-3">Headlight Restoration</h5>
              <a href="service-detail.php" class="links-primary text-white d-inline-block mb-3">Read More <i
                  class="bi bi-arrow-right-circle-fill"></i></a>
              <p class="card-text m-0">Removing oxidation and yellowing to restore clarity and improve night
                visibility.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
{{-- #services end --}}

{{-- Ads-CTA section --}}
<x-ads-cta />
{{-- #ads-cta end --}}

{{-- Appoinment section --}}
<x-dark-appointment />
{{-- #appointment end --}}

@endsection