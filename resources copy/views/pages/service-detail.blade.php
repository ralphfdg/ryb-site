@extends('layouts.default')

@section('title', 'Service Detail | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Service Detail" />
{{-- #page-title end --}}

{{-- Service detail section --}}
<section class="section py-5 my-5">
  <div class="b-container">
    <div class="row mx-auto g-5">
      {{-- Service Sidebar --}}
      <div class="col-12 col-lg-4 order-2 order-lg-1">
        <div class="row mx-auto d-flex flex-column">
          <x-service-widget />
        </div>
      </div>
      <!-- #sidebar end -->

      {{-- Detail Content --}}
      <div class="col-12 col-lg-8 order-1">
        <div class="ratio ratio-16x9">
          <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Service Detail Cover"
            class="img-fluid rounded-4">
        </div>
        <h2 class="heading mt-3">Flawless Finish, Long-Lasting Protection <span class="text-primary-color">Exterior
            Detailing at Its Best!</span></h2>
        <p class="text-color-2">Experience the ultimate in vehicle care with our Flawless Finish, Long-Lasting
          Protection – Exterior Detailing at Its Best! Our expert detailing service is designed to restore your
          car’s original shine while applying premium protective coatings that guard against weather, UV rays, and
          daily wear. From meticulous washing and polishing to advanced paint protection, we ensure every inch of
          your vehicle’s exterior looks stunning and stays protected for the long haul. Let your car turn heads with
          a finish that truly lasts.</p>

        <div class="row bg-secondary-color mx-auto g-3 pt-3 px-3 pb-4 rounded-4 mt-5">
          <div class="col-md-6">
            <div class="bg-accent-color-2 text-white p-4 rounded-4 h-100">
              <h5 class="bg-accent-color heading rounded-3 p-3 mb-4" style="width: 105px; height: 55px;">Step 1
              </h5>
              <h6 class="heading">Deep Cleaning & Decontamination</h6>
              <p class="text-color-2 mb-0">Integer lacinia consectetur leo, sed egestas neque lobortis nec. Praesent
                risus
                sapien, gravida sit amet vestibulum mattis.</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="bg-accent-color-2 text-white p-4 rounded-4 h-100">
              <h5 class="bg-accent-color heading rounded-3 p-3 mb-4" style="width: 105px; height: 55px;">Step 2
              </h5>
              <h6 class="heading">Paint Correction & Swirl Removal</h6>
              <p class="text-color-2 mb-0">Integer lacinia consectetur leo, sed egestas neque lobortis nec.
                Praesent risus
                sapien, gravida sit amet vestibulum mattis.</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="bg-accent-color-2 text-white p-4 rounded-4 h-100">
              <h5 class="bg-accent-color heading rounded-3 p-3 mb-4" style="width: 105px; height: 55px;">Step 3
              </h5>
              <h6 class="heading">Protective Coating Application</h6>
              <p class="text-color-2 mb-0">Integer lacinia consectetur leo, sed egestas neque lobortis nec.
                Praesent risus
                sapien, gravida sit amet vestibulum mattis.</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="bg-accent-color-2 text-white p-4 rounded-4 h-100">
              <h5 class="bg-accent-color heading rounded-3 p-3 mb-4" style="width: 105px; height: 55px;">Step 4
              </h5>
              <h6 class="heading">Finishing Touches & Quality Inspection</h6>
              <p class="text-color-2 mb-0">Integer lacinia consectetur leo, sed egestas neque lobortis nec.
                Praesent risus
                sapien, gravida sit amet vestibulum mattis.</p>
            </div>
          </div>
        </div>

        <h3 class="heading mt-5">FAQs : Anything about Exterior Detailing</h3>

        <div class="accordion" id="accordionGeneral">

          <div class="accordion-item">
            <h5 class="accordion-header" id="gen-heading-1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#gen-collapse-1"
                aria-expanded="true" aria-controls="gen-collapse-1">
                What is car detailing?
              </button>
            </h5>
            <div id="gen-collapse-1" class="accordion-collapse collapse show" aria-labelledby="gen-heading-1"
              data-bs-parent="#accordionGeneral">
              <div class="accordion-body">
                <p>Car detailing is a deep cleaning process that restores, protects, and enhances both the
                  interior
                  and exterior of your vehicle, going beyond a regular car wash.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h5 class="accordion-header" id="gen-heading-2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#gen-collapse-2" aria-expanded="false" aria-controls="gen-collapse-2">
                How often should I get my car detailed?
              </button>
            </h5>
            <div id="gen-collapse-2" class="accordion-collapse collapse" aria-labelledby="gen-heading-2"
              data-bs-parent="#accordionGeneral">
              <div class="accordion-body">
                <p>It depends on your driving habits and environment, but we recommend a full detail every 3–6
                  months to maintain your car’s condition.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h5 class="accordion-header" id="gen-heading-3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#gen-collapse-3" aria-expanded="false" aria-controls="gen-collapse-3">
                How long does a car detailing service take?
              </button>
            </h5>
            <div id="gen-collapse-3" class="accordion-collapse collapse" aria-labelledby="gen-heading-3"
              data-bs-parent="#accordionGeneral">
              <div class="accordion-body">
                <p>The time varies depending on the package you choose. A basic detailing takes about 1.5–2
                  hours,
                  while a full detailing can take 4–6 hours or more.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h5 class="accordion-header" id="gen-heading-4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#gen-collapse-4" aria-expanded="false" aria-controls="gen-collapse-4">
                Do you use eco-friendly products?
              </button>
            </h5>
            <div id="gen-collapse-4" class="accordion-collapse collapse" aria-labelledby="gen-heading-4"
              data-bs-parent="#accordionGeneral">
              <div class="accordion-body">
                <p>Yes! We prioritize high-quality, biodegradable, and eco-friendly products that are safe for
                  both
                  your car and the environment.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h5 class="accordion-header" id="gen-heading-5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#gen-collapse-5" aria-expanded="false" aria-controls="gen-collapse-5">
                Do I need to make an appointment for a detailing service?
              </button>
            </h5>
            <div id="gen-collapse-5" class="accordion-collapse collapse" aria-labelledby="gen-heading-5"
              data-bs-parent="#accordionGeneral">
              <div class="accordion-body">
                <p>Yes, we recommend booking an appointment to ensure availability and the best service.
                  However,
                  we do accept walk-ins based on availability.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
      {{-- #detail end --}}

    </div>
  </div>
</section>
{{-- #service-detail end --}}

@endsection