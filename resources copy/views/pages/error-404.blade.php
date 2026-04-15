@extends('layouts.error')

@section('title', 'Error 404 | Axemobile')

@section('content')

{{-- Error section --}}
<section class="d-flex justify-content-center align-items-center text-center overflow-hidden"
  style="background-image: url('{{ asset('assets/img/Place-Holder-1920x1280.jpg') }}'); background-size: cover; background-position: center; height: 100vh;">
  <div class="b-container" style="padding: 0 15px;">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8">
        <img src="{{ asset('assets/img/Place-Holder-600x400.png') }}" class="h-auto" alt="Error 404"
          style="width: 100%; max-width: 600px;" data-aos="flip-right" data-aos-easing="ease-in-sine"
          data-aos-delay="1000" data-aos-duration="5000">
        <h2 class="heading mt-0">
          Oops! Looks Like This Page Took a <span class="text-primary-color">Wrong Turn!</span>
        </h2>
        <a href="{{ route('index') }}" class="btn btn-lg btn-cta-primary mt-4 px-5 py-3">Back To Homepage</a>
      </div>
    </div>
  </div>
</section>
{{-- #error end --}}

@endsection