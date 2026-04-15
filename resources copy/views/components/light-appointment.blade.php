<section class="section bg-secondary-color" style="padding: 10vh 0;">
  <div class="b-container">
    <div class="row g-5 mt-0 mt-xl-5 mx-auto">
      <div class="col-12 col-xl-6 pt-0 mt-0">
        {{-- title --}}
        <h6 class="text-color-2">HOW IT WORKS</h6>
        <h2 class="heading" data-aos="fade-right" data-aos-delay="500" data-aos-duration="3000">
          Obtain Your Car's History In Just Three Easy Steps.
        </h2>
        <div class="mt-4">
          <a href="{{ route('contact-us') }}" class="btn btn-lg btn-cta-primary">Let's Get In Touch</a>
        </div>
        {{-- #title end --}}
        <div class="accordion mt-5" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                01.&nbsp;Book Your Appointment
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
              data-bs-parent="#accordionExample">
              <div class="accordion-body-2">
                <p>Choose the detailing service that best fits your needs and schedule an
                  appointment at your
                  convenience. You can book online, call us, or visit our location. We’ll confirm your booking
                  and
                  provide any necessary preparation details.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                02. We Detail Your Car
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
              data-bs-parent="#accordionExample">
              <div class="accordion-body-2">
                <p>Our professional detailers will carefully clean, restore, and protect
                  your
                  vehicle using
                  high-quality products and advanced techniques. From deep interior cleaning to exterior
                  polishing
                  and paint protection, we ensure every inch of your car looks flawless.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                03. Enjoy the Shine
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
              data-bs-parent="#accordionExample">
              <div class="accordion-body-2">
                <p>Once the detailing is complete, your car will be spotless, refreshed,
                  and
                  protected.
                  Pick up your
                  vehicle or enjoy our delivery service (if available), and drive away with confidence, knowing
                  your
                  car looks as good as new.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-6 mt-5 mt-xl-0">
        <div class="img-wrapper position-relative mx-auto">
          <div class="img-ratio-121">
            <img src="{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}" alt="Car Grille and Headlight"
              class="w-100 h-100 position-absolute rounded-4" style="inset: 0;">
          </div>
          <div class=" position-absolute info-lb-overlay" data-aos="fade-up" data-aos-delay="500"
            data-aos-duration="3000">
            <div class="d-flex flex-row text-white p-4 align-items-center">
              <h4 class="mb-2"><em>“Your car deserves more than a quick wash. Our detailing services are
                  designed to go the extra mile, restoring its beauty and protecting it from the elements, so it
                  continues to turn heads wherever you go.”</em></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>