@extends('layouts.default')

@section('title', 'Gallery | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Gallery" />
{{-- #page-title end --}}

{{-- Gallery section --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <div class="row text-center text-lg-start mx-auto">
      <div class="col-12 col-xl-7">
        <h6 class="text-color-2">OUR WORK IN ACTION</h6>
        <h2 class="heading" data-aos="fade-right" data-aos-delay="500" data-aos-duration="3000">View Our Stunning
          Car Transformations</h2>
      </div>
      <div class="col-12 col-xl-5 pt-4">
        <p class="text-color-2">Discover the ideal detailing package tailored to your car’s needs and condition.
          Whether you’re looking for a quick refresh or a full restoration, our options are designed to deliver
          exceptional results and long-lasting protection. Let your vehicle shine with the care it truly deserves.
        </p>
      </div>
    </div>

    <div class="row mx-auto g-4 row-cols-1 row-cols-md-2 row-cols-xl-3 mt-4">
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="Service Station Worker Buffing Exterior">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="The Headlights And The Hood Of A Luxury Car">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="Person Wearing Gloves Cleaning The Car Engine">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="specialists applies car protection film on bumper">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="car detailing plastic care">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="car detailing and polishing">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="workers wiping vehicle body with microfiber">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="service station in the hands of master a device">
        </a>
      </div>
      <div class="col">
        <a href="{{asset('assets/img/Place-Holder-1920x1280.jpg')}}" class="glightbox" data-gallery="gallery1">
          <img src="{{asset('./assets/img/Place-Holder-600x400.png')}}" class="img-fluid rounded-4 shadow-sm"
            alt="sticker of a protective film on the headlight">
        </a>
      </div>
    </div>
  </div>
</section>
{{-- #gallery end --}}

{{-- Ads-CTA section --}}
<x-ads-cta />
{{-- #ads-cta end --}}


{{-- Testimonial section --}}
<x-testimonials />
{{-- #testimonial end --}}

@endsection