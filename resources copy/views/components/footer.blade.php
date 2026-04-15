{{-- Footer --}}
<footer class="section py-5" style="background: linear-gradient(to bottom,#1B1B1B ,#111111)">
  <div class="b-container">
    <div class="row g-4 g-xl-5 mt-5">

      <div class="col-12 col-xl-4 pe-xl-5 mt-0">
        <div class="footer-logo-box">
          <img src="{{ asset('assets/img/Main-Logo.png') }}" alt="Footer Logo" class="h-100 object-fit-contain d-block">
        </div>
        <p class="mt-4 text-center text-xl-start">Providing Premium Car Detailing Services That
          Bring Out the Best in Your Vehicle, Ensuring a Showroom Shine Every Time.</p>
        <a href="{{ route('contact-us') }}" class="btn btn-lg btn-cta-secondary d-block mt-4">Contact Us <i
            class="bi bi-arrow-right-short"></i></a>
      </div>

      <div class="col-12 col-md-6 col-xl-4 px-3 px-xl-5 mt-5 mt-xl-0">
        <h5 class="heading">Navigation</h5>
        <hr class="border-2">
        <ul class="list-unstyled">
          <li class="mt-3"><a class="text-color-2 links-primary {{ request()->is(['/', 'index']) ? 'active' : '' }}"
              href="{{ route('index') }}">Homepage</a></li>
          <li class="mt-3"><a class="text-color-2 links-primary {{ request()->is('services') ? 'active' : '' }}"
              href="{{ route('services') }}">Services</a></li>
          <li class="mt-3"><a class="text-color-2 links-primary {{ request()->is('gallery') ? 'active' : '' }}"
              href="{{ route('gallery') }}">Gallery</a></li>
          <li class="mt-3"><a class="text-color-2 links-primary {{ request()->is('faqs') ? 'active' : '' }}"
              href="{{ route('faqs') }}">FAQs</a></li>
          <li class="mt-3"><a class="text-color-2 links-primary {{ request()->is('contact-us') ? 'active' : '' }}"
              href="{{ route('contact-us') }}">Contact Us</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-6 col-xl-4 px-3 px-xl-5 mt-5 mt-xl-0">
        <div class="mt-2">
          <h5 class="heading">Visit Our Office</h5>
          <hr class="border-2 my-2">
          <p class="text-color-2">123 Serenity Lane, Blissfield, CA 90210, United States</p>
        </div>
        <div class="mt-5">
          <h5 class="heading">Contact Info</h5>
          <hr class="border-2">
          <a class="links-primary text-color-2 fw-normal" href="tel:(555)123-4567">(555) 123-4567</a> <br>
          <a class="links-primary text-color-2 fw-normal" href="mailto:Info@Yourmail.com">Info@Yourmail.com</a>
        </div>
      </div>
    </div>

    <div class="row mt-4 pt-0 pt-xl-5 text-center">
      <p class="text-color-2">Copyright © 2025 Widagdos. All Rights Reserved.</p>
    </div>

  </div>
</footer>
{{-- #footer end --}}