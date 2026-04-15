@extends('layouts.default')

@section('title', 'Contact Us | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Contact Us" />
{{-- #page-title end --}}

{{-- Contact section --}}
<section class="section py-5 mt-5">
  <div class="b-container">
    <div class="row g-4 mx-auto">
      <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100 bg-secondary-color p-2 rounded-4" data-aos="fade-right" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="card-body mb-0">
            <div class="bg-primary-color rounded-2 align-content-center text-center"
              style="color: #111111; width: 70px; height: 70px;">
              <i class="bi bi-geo-alt-fill fs-2"></i>
            </div>
            <h5 class="heading mt-3">Workshop Address</h5>
            <p class="text-color-2 fs-5 mt-3 mb-0"><em>123 Serenity Lane, Blissfield, CA 90210, United States</em>
            </p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100 bg-secondary-color p-2 rounded-4" data-aos="fade-up" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="card-body mb-0">
            <div class="bg-primary-color rounded-2 align-content-center text-center"
              style="color: #111111; width: 70px; height: 70px;">
              <i class="bi bi-telephone-fill fs-2"></i>
            </div>
            <h5 class="heading mt-3">Call Us Anytime</h5>
            <p class="text-color-2 fs-5 mt-3 mb-0"><em>(555) 123-4567 ( First Contact) or
                +1 555-789-1234 (2nd Contact)</em></p>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-4">
        <div class="card h-100 bg-secondary-color p-2 rounded-4" data-aos="fade-left" data-aos-delay="500"
          data-aos-duration="3000">
          <div class="card-body mb-0">
            <div class="bg-primary-color rounded-2 align-content-center text-center"
              style="color: #111111; width: 70px; height: 70px;">
              <i class="bi bi-envelope-fill fs-2"></i>
            </div>
            <h5 class="heading mt-3">Send Us Email</h5>
            <p class="text-color-2 fs-5 mt-3 mb-0"><em>Info@Yourmail.com</em></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- #contact end --}}

{{-- Quotes section --}}
<section class="section py-5 mb-5">
  <div class="b-container">
    <div class="row row-cols-1 row-cols-xl-2 g-5 mx-auto">
      {{-- Contact Form --}}
      <div class="col order-2 order-xl-1">
        {{-- Success message --}}
        <div class="success_msg toast align-items-center w-100 shadow-none mb-3 border border-success rounded-pill my-4"
          role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex p-2">
            <div class="toast-body d-flex flex-row gap-3 align-items-center text-success">
              <i class="bi bi-check-circle-fill text-success"></i>
              Your Message Successfully Send.
            </div>
            <button type="button" class="me-2 m-auto bg-transparent border-0 ps-1 pe-0 text-success"
              data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg"></i></button>
          </div>
        </div>
        {{-- #success msg end --}}

        {{-- Error message --}}
        <div class="error_msg toast align-items-center w-100 shadow-none border-danger mb-3 my-4 border rounded-pill"
          role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex p-2">
            <div class="toast-body d-flex flex-row gap-3 align-items-center text-danger">
              <i class="bi bi-exclamation-triangle-fill text-danger"></i>
              Something Wrong ! Send Form Failed.
            </div>
            <button type="button" class="me-2 m-auto bg-transparent border-0 ps-1 pe-0 text-danger"
              data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg"></i></button>
          </div>
        </div>
        {{-- #error msg end --}}

        {{-- Form --}}
        <form class="form needs-validation" method="POST" novalidate>
          @csrf
          <input type="hidden" name="action" value="contact">
          <div class="row row-cols-1 row-cols-md-2 g-5 mb-5">
            <div class="col">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Your name here"
                aria-label="Name" required>
              <div class="invalid-feedback">
                Valid name is required.
              </div>
            </div>
            <div class="col">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control form-control-lg"
                placeholder="Your email here" aria-label="Email" required>
              <div class="invalid-feedback">
                Valid email is required.
              </div>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-md-2 g-5 mb-5">
            <div class="col">
              <label for="phone" class="form-label">Phone</label>
              <input type="number" name="phone" id="phone" class="form-control form-control-lg"
                placeholder="Your number here" aria-label="Phone" required>
              <div class="invalid-feedback">
                Valid phone is required.
              </div>
            </div>
            <div class="col">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" name="subject" id="subject" class="form-control form-control-lg"
                placeholder="Your subject here" aria-label="Subject" required>
              <div class="invalid-feedback">
                Valid subject is required.
              </div>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control form-control-lg" name="message" id="message" rows="8"
                placeholder="Tell us anything about your lovely car" required></textarea>
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-lg btn-cta-primary w-100 submit_form">Submit Now</button>
        </form>
        {{-- #form end --}}
      </div>
      {{-- #contact form end --}}

      {{-- Contact Info --}}
      <div class="col order-1">
        <h2 class="heading" data-aos="fade-right" data-aos-delay="500" data-aos-duration="3000"><span
            class="text-primary-color">Let’s Talk!</span> Your Car Deserves the Best Care</h2>
        <p class="text-color-2 mt-3">Have a question about our car detailing services? Need expert advice on how to
          keep your vehicle looking its best? We’re here to assist you! Whether you want to book an appointment, get
          a quote, or simply learn more about our services, don’t hesitate to reach out.</p>
        <h4 class="heading mt-4">Why Should Reach Us Out ?</h4>
        <p class="text-color-2 mt-3">Our professional car detailing and maintenance services help elevate your
          driving comfort, vehicle appearance, and long-term performance on every journey.</p>
        <ul class="list-unstyled fs-5 text-color-2">
          <li class="mb-3"><i class="bi bi-check-square-fill text-primary-color me-2"></i> Expert Detailing</li>
          <li class="mb-3"><i class="bi bi-check-square-fill text-primary-color me-2"></i> Personalized Service</li>
          <li class="mb-3"><i class="bi bi-check-square-fill text-primary-color me-2"></i> Experienced Team</li>
          <li class="mb-3"><i class="bi bi-check-square-fill text-primary-color me-2"></i> Easy & Fast Booking</li>
          <li class="mb-3"><i class="bi bi-check-square-fill text-primary-color me-2"></i> Customer First</li>
        </ul>
        <div class="social-box flex-row w-100 mt-5">
          <h5 class="heading align-content-center">Follow Our Social Media : </h5>
          <a href="http://www.facebook.com" class="rounded-2" style="width: 40px; height: 40px;"><i
              class="bi bi-facebook fs-5"></i></a>
          <a href="http://www.youtube.com" class="rounded-2" style="width: 40px; height: 40px;"><i
              class="bi bi-youtube fs-5"></i></a>
          <a href="http://x.com" class="rounded-2" style="width: 40px; height: 40px;"><i
              class="bi bi-twitter-x fs-5"></i></a>
          <a href="http://www.instagram.com" class="rounded-2" style="width: 40px; height: 40px;"><i
              class="bi bi-instagram fs-5"></i></a>
        </div>
      </div>
      {{-- #contact info end --}}

    </div>
  </div>
</section>
{{-- #quotes end --}}

@endsection
