<section class="section position-relative"
  style="background-image: url('{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}'); min-height: 40vh;">
  <div class="bg-overlay"></div>
  <div class="b-container h-100 position-relative z-2">
    <div class="d-flex flex-column justify-content-center align-items-center mx-auto text-center text-white gap-4"
      style="max-width: 895px;">
      <h1 class="heading fw-bold">{{ $title ?? 'Welcome'}}</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('index') }}">Homepage</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Go to homepage' }}</li>
        </ol>
      </nav>
    </div>
  </div>
</section>