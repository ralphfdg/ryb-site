@extends('layouts.default')

@section('title', 'Pricing Plan | Axemobile')

@section('content')

{{-- Page title --}}
<x-page-title title="Pricing Plan" />
{{-- #page-title end --}}

{{-- Pricing section --}}
<x-pricing-plan />
{{-- Pricing section end --}}

{{-- Appoinment section --}}
<x-light-appointment />
{{-- #appointment end --}}

{{-- FAQs --}}
<x-faqs />
{{-- #faqs end --}}

@endsection