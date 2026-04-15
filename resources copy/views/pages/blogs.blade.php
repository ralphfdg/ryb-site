@extends('layouts.default')

@section('title', 'Blogs | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Blogs" />
{{-- #page-title end --}}

{{-- Blogs section --}}
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
            <a href="{{route('blog-detail')}}" class="blogs-title">
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
            <a href="{{route('blog-detail')}}" class="blogs-title">
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
            <a href="{{route('blog-detail')}}" class="blogs-title">
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

      <div class="col">
        <div class="card blogs text-white overflow-hidden rounded-4">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" class="blogs-cover img-fluid"
              alt="Best Waxing Methods for a Glossy Finish">
          </div>
          <div class="card-body p-4">
            <a href="{{route('blog-detail')}}" class="blogs-title">
              <h5 class="fw-bolder">Best Waxing Methods for a Glossy Finish</h5>
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

      <div class="col">
        <div class="card blogs text-white overflow-hidden rounded-4">
          <div class="overflow-hidden">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" class="blogs-cover img-fluid"
              alt="How to Keep Your Car Interior Spotless">
          </div>
          <div class="card-body p-4">
            <a href="{{route('blog-detail')}}" class="blogs-title">
              <h5 class="fw-bolder">How to Keep Your Car Interior Spotless</h5>
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
              alt="Top Car Detailing Tips for Lasting Shine">
          </div>
          <div class="card-body p-4">
            <a href="{{route('blog-detail')}}" class="blogs-title">
              <h5 class="fw-bolder">Top Car Detailing Tips for Lasting Shine</h5>
            </a>
            <div class="d-flex align-items-center fs-5 gap-4 my-3">
              <h6><i class="bi bi-person text-primary-color"></i> H. Jasmine</h6>
              <h6><i class="bi bi-folder text-primary-color"></i> Detailing</h6>
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
{{-- #end blogs --}}

{{-- Subscribe section --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <div class="row d-flex justify-content-center text-center mx-auto">
      <div class="col-12 col-xl-9 bg-secondary-color rounded-4 p-5">
        <h2 class="heading">Subscribe For Our <span class="text-primary-color">Latest</span> Blogs & Articles That
          Might Help You </h2>
        {{-- Success message --}}
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast success_msg_subscribe text-bg-light" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                <i class="bi bi-check-circle-fill"></i> Your Subscribe Send Successfully.
              </div>
              <button type="button" class="btn me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">
                <i class="bi bi-x-lg"></i>
              </button>
            </div>
          </div>
        </div>
        {{-- #success msg end --}}

        {{-- Form --}}
        <form class="form needs-validation mt-4">
          @csrf
          <input type="text" name="action" value="subscribe" hidden>
          <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Your email here"
            required>
          <div class="invalid-feedback text-white">
            Please provide a valid email format (e.g.,
            user@example.com).
          </div>
          <button type="submit" class="btn btn-cta-primary w-100 submit_subscribe mt-4">Subscribe now</button>
        </form>
        {{-- #form end --}}

      </div>
    </div>
  </div>
</section>
{{-- #subscribe end --}}

@endsection
