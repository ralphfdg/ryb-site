{{-- Option card --}}
<div class="card bg-secondary-color rounded-4 p-2">
  <div class="card-body">
    <h4 class="heading mb-3">Our Services</h4>
    <div class="border-top pt-4">
      <a href="{{ route('service-detail') }}"
        class="btn btn-lg btn-cta-secondary w-100 rounded-3 text-start mb-3">Exterior
        Detailing <i class="bi bi-arrow-right float-end"></i></a>
      <a href="{{ route('service-detail') }}"
        class="btn btn-lg btn-cta-secondary w-100 rounded-3 text-start mb-3">Interior
        Detailing <i class="bi bi-arrow-right float-end"></i></a>
      <a href="{{ route('service-detail') }}" class="btn btn-lg btn-cta-secondary w-100 rounded-3 text-start mb-3">Paint
        Correction <i class="bi bi-arrow-right float-end"></i></a>
      <a href="{{ route('service-detail') }}"
        class="btn btn-lg btn-cta-secondary w-100 rounded-3 text-start mb-3">Ceramic Coating
        <i class="bi bi-arrow-right float-end"></i></a>
      <a href="{{ route('service-detail') }}"
        class="btn btn-lg btn-cta-secondary w-100 rounded-3 text-start mb-3">Engine
        Bay Cleaning <i class="bi bi-arrow-right float-end"></i></a>
      <a href="{{ route('service-detail') }}"
        class="btn btn-lg btn-cta-secondary w-100 rounded-3 text-start mb-3">Headlight
        Restoration <i class="bi bi-arrow-right float-end"></i></a>
    </div>
  </div>
</div>
{{-- #option end --}}

{{-- CTA card --}}
<div class="card h-100 position-relative rounded-4 mt-5 overflow-hidden"
  style="background-image: url('{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}'); background-size: cover; background-position: center;">
  <div class="bg-overlay position-absolute top-0 start-0 w-100 h-100 z-1"></div>
  <div class="card-body position-relative z-2 py-5 px-2 text-center">
    <h3 class="heading">Experience the <span class="text-primary-color">Ultimate</span> Car
      Detailing
    </h3>
    <p class="card-text mt-3">Book Your Detailing Today! and get <span class="text-primary-color">30% cut
        off</span></p>
    <a href="contact-us.php" class="btn btn-lg btn-cta-primary mt-3">Book Now</a>
  </div>
</div>
{{-- #cta end --}}