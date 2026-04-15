@extends('layouts.default')

@section('title', 'Testimonial | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Testimonial" />
{{-- #page-title end --}}

{{-- Testimonial section --}}
<x-testimonials />
{{-- #testimonial end --}}

{{-- Ads-CTA section --}}
<x-ads-cta />
{{-- #ads-cta end --}}

@endsection