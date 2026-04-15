@extends('layouts.default')

@section('title', 'Team | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Team" />
{{-- #page-title end --}}

{{-- Team section --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <div class="row text-center mb-5">
      <h6 class="text-color-2">OUR TEAMS</h6>
      <h2 class="heading mt-3" data-aos="fade-up" data-aos-delay="500" data-aos-duration="3000">Meet the Car <span
          class="text-primary-color">Care Enthusiasts</span> Who Bring Out
        the
        Best in Your Vehicle</h2>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mx-auto">
      <div class="col">
        <div class="card rounded-4 overflow-hidden position-relative" data-aos="fade-right" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-600x900.jpg') }}" alt="Raul Axios" class="img-fluid">
          </div>
          <div class="card-img-overlay d-flex flex-column justify-content-between p-4">
            <div class="social-box flex-column">
              <a href="http://www.facebook.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-facebook fs-5"></i></a>
              <a href="http://x.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-twitter-x fs-5"></i></a>
              <a href="http://www.youtube.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-youtube fs-5"></i></a>
            </div>

            <div class="card-team-label text-center rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-1">Raul Axios</h5>
              <p class="m-0">Founder & Head Detailer</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card rounded-4 overflow-hidden position-relative" data-aos="fade-up" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-600x900.jpg') }}" alt="Ubeid Una" class="img-fluid">
          </div>
          <div class="card-img-overlay d-flex flex-column justify-content-between p-4">
            <div class="social-box flex-column">
              <a href="http://www.facebook.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-facebook fs-5"></i></a>
              <a href="http://x.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-twitter-x fs-5"></i></a>
              <a href="http://www.youtube.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-youtube fs-5"></i></a>
            </div>

            <div class="card-team-label text-center rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-1">Ubeid Una</h5>
              <p class="m-0">Customer Relation Manager</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card rounded-4 overflow-hidden position-relative" data-aos="fade-left" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-600x900.jpg') }}" alt="Taki Wanabe" class="img-fluid">
          </div>
          <div class="card-img-overlay d-flex flex-column justify-content-between p-4">
            <div class="social-box flex-column">
              <a href="http://www.facebook.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-facebook fs-5"></i></a>
              <a href="http://x.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-twitter-x fs-5"></i></a>
              <a href="http://www.youtube.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-youtube fs-5"></i></a>
            </div>

            <div class="card-team-label text-center rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-1">Taki Wanabe</h5>
              <p class="m-0">Lead Technician & Paint Protection Specialist</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card rounded-4 overflow-hidden position-relative" data-aos="fade-right" data-aos-delay="1000"
          data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-600x900.jpg') }}" alt="Hafsha Jasmine" class="img-fluid">
          </div>
          <div class="card-img-overlay d-flex flex-column justify-content-between p-4">
            <div class="social-box flex-column">
              <a href="http://www.facebook.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-facebook fs-5"></i></a>
              <a href="http://x.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-twitter-x fs-5"></i></a>
              <a href="http://www.youtube.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-youtube fs-5"></i></a>
            </div>

            <div class="card-team-label text-center rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-1">Hafsha Jasmine</h5>
              <p class="m-0">Marketing & Branding Manager</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card rounded-4 overflow-hidden position-relative" data-aos="fade-up" data-aos-delay="1000"
          data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-600x900.jpg') }}" alt="Akio Mirfaq" class="img-fluid">
          </div>
          <div class="card-img-overlay d-flex flex-column justify-content-between p-4">
            <div class="social-box flex-column">
              <a href="http://www.facebook.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-facebook fs-5"></i></a>
              <a href="http://x.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-twitter-x fs-5"></i></a>
              <a href="http://www.youtube.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-youtube fs-5"></i></a>
            </div>

            <div class="card-team-label text-center rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-1">Akio Mirfaq</h5>
              <p class="m-0">Interior Detailing Specialist</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card rounded-4 overflow-hidden position-relative" data-aos="fade-left" data-aos-delay="1000"
          data-aos-duration="3000">
          <div class="img-ratio-113">
            <img src="{{ asset('assets/img/Place-Holder-600x900.jpg') }}" alt="Rizzy Alvarez" class="img-fluid">
          </div>
          <div class="card-img-overlay d-flex flex-column justify-content-between p-4">
            <div class="social-box flex-column">
              <a href="http://www.facebook.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-facebook fs-5"></i></a>
              <a href="http://x.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-twitter-x fs-5"></i></a>
              <a href="http://www.youtube.com" class="rounded-2" style="width: 40px; height: 40px;"><i
                  class="bi bi-youtube fs-5"></i></a>
            </div>

            <div class="card-team-label text-center rounded-4 px-4 py-3">
              <h5 class="heading text-primary-color mb-1">Rizzy Alvarez</h5>
              <p class="m-0">Mobile Detailing Coordinator</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
{{-- #team end --}}

{{-- Ads-CTA section --}}
<x-ads-cta />
{{-- #ads-cta end --}}

@endsection