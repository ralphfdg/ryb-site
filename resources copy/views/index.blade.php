@extends('layouts.default')

@section('title', 'Axemobile - Car Detailing Service & Car Repair Laravel 12 Template | Homepage')

@section('content')

{{-- Hero section --}}
<section class="section hero position-relative bg-size-cover bg-position-center bg-repeat-no-repeat py-5"
  style="background-image: url('{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}');">
  <div class="bg-overlay"></div>
  <div class="b-container h-100 position-relative z-2">
    <div class="row">
      <div class="col-12 col-xl-8 d-flex flex-column justify-content-start text-center text-xl-start"
        style="padding-top: 23vh;">
        <h1 class="fw-bolder mb-4" data-aos="fade-right" data-aos-delay="500" data-aos-duration="3000">
          Bring Back the New Car Feel with Our Professional Detailing
        </h1>
        <a href="{{ route('services') }}"
          class="btn btn-xl btn-cta-primary align-self-center align-self-xl-start mt-4">Let's
          Get
          Started</a>
      </div>
    </div>
  </div>
</section>
{{-- #hero end --}}

{{-- Feature section --}}
<section class="feature position-relative">
  <div class="b-container">
    <div class="row d-flex justify-content-end align-items-end feature-box-wrapper g-0 mx-4">
      <div class="col-12 col-md-6 col-xl-3 p-0">
        <div class="feature-box w-100 rounded-start-4" style="background-color: #303030;">
          <h5 class="feature-title">Advanced Detailing Technology</h5>
          <p>Our professional detailing restores your car’s original beauty, leaving it fresh, clean, and like new.
          </p>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3 p-0">
        <div class="feature-box w-100" style="background-color: #3F3F3F;">
          <h5 class="feature-title">Eco-Friendly Products</h5>
          <p>Experience that brand-new car feeling again with our expert detailing that revitalizes every inch.</p>
        </div>
      </div>
      <div class="col-12 col-xl-3 p-0">
        <div class="feature-box w-100 rounded-end-4" style="background-color: #4F4F4F;">
          <h5 class="feature-title">Satisfaction Guarantee</h5>
          <p>We bring back your car’s shine, comfort, and cleanliness through professional detailing services.</p>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- #feature end --}}

{{-- About section --}}
<section class="section py-5 mt-5">
  <div class="b-container">
    <div class="row justify-content-between">
      <div class="col-12 col-xl-2 text-center text-xl-start mb-4 mb-xl-0">
        <h6 class="text-color-2">ABOUT US</h6>
      </div>
      <div class="col-12 col-xl-10 text-center text-lg-start">
        <div class="row">
          <h2 class="heading" data-aos="fade-right" data-aos-delay="500" data-aos-duration="3000">Our Commitment to
            Providing Premium Car
            Detailing Services That
            <span class="text-primary-color">Bring Out the Best in Your Vehicle, Ensuring a Showroom Shine Every
              Time</span>
          </h2>
        </div>
        <div class="row">
          <div class="col-12 col-xl-3 order-2 order-xl-1">
            <hr class="hr-style-1 mb-4 border-2">
          </div>
          <div class="col-12 col-xl-9 order-1 order-xl-2">
            <p class="text-color-2 mt-5">We are committed to delivering premium car detailing services that bring
              out the very best in your vehicle. With meticulous attention to every detail, we ensure your car is
              cleaned, restored, and maintained to the highest standards. Our goal is not just to make your car look
              clean, but to give it a showroom-quality shine that turns heads. Every service is backed by
              professional techniques and top-grade products to ensure long-lasting, impressive results.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- #about end --}}

{{-- Services section --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <h6 class="text-color-2 text-center">OUR TOP SOLUTION</h6>
    <h2 class="heading text-center" data-aos="fade-up" data-aos-delay="500" data-aos-duration="3000">
      Comprehensive Car Detailing Solutions for<br>A Flawless Finish</h2>
    <p class="text-color-2 text-center my-4">Experience comprehensive car detailing solutions designed to restore,
      protect, and enhance your vehicle’s appearance. Our expert team ensures every surface is treated with
      precision, delivering a flawless finish that looks and feels like new.</p>

    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <img src="{{ asset('assets/img/Place-Holder-900x424.png') }}" class="img-fluid"
          alt="Crossover Sports Car Yellow" style="width: 100%; max-width: 900px;">
      </div>
    </div>

    <div class="row justify-content-center g-4">
      {{-- Service Box --}}
      <div class="col-12 col-md-6 col-xl-3">
        <div class="service-box top-left position-relative h-100" data-aos="fade-right" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="service-icon position-absolute">
            <i class="bi bi-arrow-right-short"></i>
          </div>
          <div class="p-3"></div>
          <h5 class="heading mt-5">Exterior Detailing</h5>
          <p class="text-color-2 my-4">
            Thorough cleaning, polishing, and waxing to restore your car’s shine and protect its paint.
          </p>
          <a href="{{ route('service-detail') }}" class="links-primary text-white">Read More</a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-3 pe-xl-4">
        <div class="service-box position-relative h-100" data-aos="fade-up" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="service-icon position-absolute">
            <i class="bi bi-arrow-right-short"></i>
          </div>
          <div class="p-3"></div>
          <h5 class="heading mt-5">Interior Detailing</h5>
          <p class="text-color-2 my-4">
            Deep cleaning of seats, carpets, dashboard, and all interior surfaces for a fresh, spotless cabin.
          </p>
          <a href="{{ route('service-detail') }}" class="links-primary text-white">Read More</a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-3 ps-xl-4">
        <div class="service-box position-relative h-100" data-aos="fade-up" data-aos-delay="1000"
          data-aos-duration="3000">
          <div class="service-icon position-absolute">
            <i class="bi bi-arrow-right-short"></i>
          </div>
          <div class="p-3"></div>
          <h5 class="heading mt-5">Paint Correction</h5>
          <p class="text-color-2 my-4">
            Removing swirl marks, scratches, and oxidation to bring back a flawless, mirror-like finish.
          </p>
          <a href="{{ route('service-detail') }}" class="links-primary text-white">Read More</a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-3">
        <div class="service-box top-right p-4 position-relative h-100" data-aos="fade-left" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="service-icon position-absolute">
            <i class="bi bi-arrow-right-short"></i>
          </div>
          <div class="p-3"></div>
          <h5 class="heading mt-5">Ceramic Coating</h5>
          <p class="text-color-2 my-4">
            Long-lasting protection against dirt, UV rays, and water spots while enhancing gloss.
          </p>
          <a href="{{ route('service-detail') }}" class="links-primary text-white">Read More</a>
        </div>
      </div>
      {{-- #service box end --}}

    </div>
  </div>
</section>
{{-- #services end --}}

{{-- Warranty section --}}
<x-warranty />
{{-- #warranty end --}}

{{-- Appoinment section --}}
<x-dark-appointment />
{{-- #appointment end --}}

{{-- Testimonials section --}}
<section class="section reviews position-relative text-white py-5">
  {{-- Background Video --}}
  <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1">
    <source src="{{ asset('assets/video/video-background.mp4') }}" type="video/mp4">
  </video>
  {{-- Background Overlay --}}
  <div class="position-absolute w-100 h-100 top-0 start-0 z-0"
    style="background: linear-gradient(to top,#111111 50%,#111111 65%, transparent)">
  </div>
  {{-- Testimonials Content --}}
  <div class="b-container position-relative z-1 my-5">
    <h6 class="text-color-2 text-center pt-4">CUSTOMER REVIEWS</h6>
    <h2 class="heading text-center mt-2" data-aos="fade-up" data-aos-delay="500" data-aos-duration="3000">
      Customer <span class="text-primary-color">Experiences</span> That<br>Speak For Themselves
    </h2>

    <div class="row g-4 g-xl-5 my-5 pb-5">
      {{-- Testimonial Cards --}}
      <div class="col-12 col-md-6 col-xl-4" data-aos="fade-right" data-aos-delay="600" data-aos-duration="3000">
        <div class="d-flex flex-column h-100 gap-4">
          <div class="card p-4">
            <p>Absolutely incredible service! My car looks brand new inside and out. The attention to detail was
              phenomenal. I couldn’t be happier with the results. Highly recommend!</p>
            <div class="d-flex align-items-center mt-auto pt-3">
              <img src="{{ asset('assets/img/Place-Holder-64x64.jpg') }}" alt="Raul Axios" class="rounded-circle me-3"
                width="60" height="60">
              <div>
                <h5 class="mb-0">Raul Axios</h5>
                <small class="text-color-2">Auto Dealer</small>
              </div>
            </div>
          </div>

          <div class="card p-4">
            <p>I’ve used many car detailing services before, but this one exceeded my expectations. The team was
              professional, friendly, and did an amazing job on my vehicle. It looks flawless!</p>
            <div class="d-flex align-items-center mt-auto pt-3">
              <img src="{{ asset('assets/img/Place-Holder-64x64.jpg') }}" alt="Ubeid Una" class="rounded-circle me-3"
                width="60" height="60">
              <div>
                <h5 class="mb-0">Ubeid Una</h5>
                <small class="text-color-2">Car Owner</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="1000" data-aos-duration="3000">
        <div class="d-flex flex-column h-100 gap-4">
          <div class="card p-4">
            <p>I was blown away by the transformation! From the deep clean of the interior to the shiny, protected
              exterior, my car looks better than when I first bought it. Truly exceptional work!</p>
            <div class="d-flex align-items-center mt-4">
              <img src="{{ asset('assets/img/Place-Holder-64x64.jpg') }}" alt="Taki Wanabe" class="rounded-circle me-3"
                width="60" height="60">
              <div>
                <h5 class="mb-0">Taki Wanabe</h5>
                <small class="text-color-2">Vintage Car Owner</small>
              </div>
            </div>
          </div>
          <div class="card p-4">
            <p>The service here is outstanding. The team took extra care in detailing my car, and the results are
              nothing short of amazing. I will definitely return for regular maintenance!</p>
            <div class="d-flex align-items-center mt-auto pt-3">
              <img src="{{ asset('assets/img/Place-Holder-64x64.jpg') }}" alt="Hafsha Jasmine"
                class="rounded-circle me-3" width="60" height="60">
              <div>
                <h5 class="mb-0">Hafsha Jasmine</h5>
                <small class="text-color-2">Auto Dealer</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-4" data-aos="fade-left" data-aos-delay="750" data-aos-duration="3000">
        <div class="d-flex flex-column h-100 gap-4">
          <div class="card p-4">
            <p>This is the best detailing service I’ve ever had. My car looks immaculate, and it feels like I’m
              driving a completely different vehicle. I’ll be a loyal customer from now on!</p>
            <div class="d-flex align-items-center mt-auto pt-3">
              <img src="{{ asset('assets/img/Place-Holder-64x64.jpg') }}" alt="Akio Mirfaq" class="rounded-circle me-3"
                width="60" height="60">
              <div>
                <h5 class="mb-0">Akio Mirfaq</h5>
                <small class="text-color-2">Car Owner</small>
              </div>
            </div>
          </div>
          <div class="card p-4">
            <p>From the moment I walked in, I knew I was in good hands. The staff was knowledgeable and friendly,
              and
              they did an incredible job on my car. It’s spotless, inside and out!</p>
            <div class="d-flex align-items-center mt-auto pt-3">
              <img src="{{ asset('assets/img/Place-Holder-64x64.jpg') }}" alt="Olivia Seamo" class="rounded-circle me-3"
                width="60" height="60">
              <div>
                <h5 class="mb-0">Olivia Seamo</h5>
                <small class="text-color-2">Car Collector</small>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
{{-- #testimonials end --}}

{{-- Pricing section --}}
<x-pricing-plan />
{{-- #pricing end --}}

{{-- Ads-CTA section --}}
<x-ads-cta />
{{-- #ads-cta end --}}

{{-- FAQs --}}
<x-faqs />
{{-- #faqs end --}}

{{-- Blog section --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <h6 class="text-color-2 text-center pt-4">BLOGS & ARTICLES</h6>
    <h2 class="heading text-center mt-2" data-aos="fade-up" data-aos-delay="500" data-aos-duration="3000">
      Expert Tips & Insights for Car Enthusiasts</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-5 pt-2">
      <div class="col">
        <div class="card blogs text-white overflow-hidden rounded-4">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" class="blogs-cover img-fluid"
              alt="The Ultimate Guide To Engine Cleaning">
          </div>
          <div class="card-body p-4">
            <a href="{{ route('blog-detail') }}" class="blogs-title">
              <h5 class="fw-bolder">The Ultimate Guide To Engine Cleaning</h5>
            </a>
            <div class="d-flex align-items-center gap-4 my-3">
              <h6><i class="bi bi-person text-primary-color"></i> H. Jasmine</h6>
              <h6><i class="bi bi-folder text-primary-color"></i> Cleaning</h6>
            </div>
            <p class="card-text text-color mb-2">
              Keeping your car in top shape requires more than just occasional washing. Regular car detailing...
            </p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card blogs text-white overflow-hidden rounded-4">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" class="blogs-cover img-fluid"
              alt="Essential Car Maintenance Tips for Longevity">
          </div>
          <div class="card-body p-4">
            <a href="{{ route('blog-detail') }}" class="blogs-title">
              <h5 class="fw-bolder">Essential Car Maintenance Tips for Longevity</h5>
            </a>
            <div class="d-flex align-items-center fs-5 gap-4 my-3">
              <h6><i class="bi bi-person text-primary-color"></i> H. Jasmine</h6>
              <h6><i class="bi bi-folder text-primary-color"></i> Maintenance</h6>
            </div>
            <p class="card-text text-color mb-2">
              Keeping your car in top shape requires more than just occasional washing. Regular car detailing...
            </p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card blogs text-white overflow-hidden rounded-4">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" class="blogs-cover img-fluid"
              alt="Protecting Your Car Paint from Sun Damage">
          </div>
          <div class="card-body p-4">
            <a href="{{ route('blog-detail') }}" class="blogs-title">
              <h5 class="fw-bolder">Protecting Your Car Paint from Sun Damage</h5>
            </a>
            <div class="d-flex align-items-center fs-5 gap-4 my-3">
              <h6><i class="bi bi-person text-primary-color"></i> H. Jasmine</h6>
              <h6><i class="bi bi-folder text-primary-color"></i> Protection</h6>
            </div>
            <p class="card-text text-color mb-2">
              Keeping your car in top shape requires more than just occasional washing. Regular car detailing...
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
{{-- #blog end --}}

@endsection