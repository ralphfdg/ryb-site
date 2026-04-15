{{-- Header --}}
<header class="header">
  <div class="b-container">
    <nav class="navbar navbar-expand-lg bg-accent-color" aria-label="Offcanvas navbar large">
      <div class="container-fluid">
        <div class="logo-box">
          <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/img/Main-Logo.png') }}"
              alt="Main Logo" class="img-fluid"></a>
        </div>
        <button class="navbar-toggler bg-primary-color" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start bg-accent-color" tabindex="-1" id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header" id="offcanvasNavbarLabel">
            <div class="logo-box">
              <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/img/Main-Logo.png') }}"
                  alt="Drawer Logo" class="img-fluid"></a>
            </div>
            <button type="button" class="btn-close bg-primary-color py-2 px-3" data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav mx-auto my-lg-4 gap-lg-2 gap-xl-4">
              <li class="nav-item">
                <a class="nav-link {{ request()->is(['/', 'index']) ? 'active' : '' }}" aria-current="page"
                  href="{{ route('index') }}">Homepage</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('about-us') }}">About
                  Us</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is(['services', 'service-detail']) ? 'active' : '' }}"
                  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item {{ request()->is('services') ? 'active' : '' }}"
                      href="{{ route('services') }}">Our Services</a></li>
                  <li><a class="dropdown-item {{ request()->is('service-detail') ? 'active' : '' }}"
                      href="{{ route('service-detail') }}">Service Detail</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is(['pricing', 'team', 'testimonial', 'faqs', 'blogs', 'blog-detail', 'gallery']) ? 'active' : '' }}"
                  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item {{ request()->is('pricing') ? 'active' : '' }}"
                      href="{{ route('pricing') }}">Pricing Plan</a></li>
                  <li><a class="dropdown-item {{ request()->is('team') ? 'active' : '' }}"
                      href="{{ route('team') }}">Team</a></li>
                  <li><a class="dropdown-item {{ request()->is('testimonial') ? 'active' : '' }}"
                      href="{{ route('testimonial') }}">Testimonial</a></li>
                  <li><a class="dropdown-item {{ request()->is('faqs') ? 'active' : '' }}"
                      href="{{ route('faqs') }}">FAQs</a></li>
                  <li><a class="dropdown-item {{ request()->is('blogs') ? 'active' : '' }}"
                      href="{{ route('blogs') }}">Blogs</a></li>
                  <li><a class="dropdown-item {{ request()->is('blog-detail') ? 'active' : '' }}"
                      href="{{ route('blog-detail') }}">Blog Detail</a></li>
                  <li><a class="dropdown-item {{ request()->is('gallery') ? 'active' : '' }}"
                      href="{{ route('gallery') }}">Gallery</a></li>
                  <li><a class="dropdown-item" href="{{ route('error-404') }}">Error 404</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}"
                  href="{{ route('contact-us') }}">Contact Us</a>
              </li>
            </ul>
            <div class="mt-3">
              <a href="{{ route('contact-us') }}" class="btn btn-lg btn-cta-secondary d-none d-lg-block">Make
                Appointment</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>
{{-- #header end --}}