@extends('layouts.user_type.auth')

<style>
    .min-vh-500 {
        min-height: 400px;
    }

    .page-header {
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        height: 100%;
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    @media (max-width: 768px) {
        .page-header {
            padding-top: 3rem;
            padding-bottom: 3rem;
            background-position: center center;
        }
        .min-vh-500 {
            min-height: 300px;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding-top: 2rem;
            padding-bottom: 2rem;
            background-position: center center;
        }
        .min-vh-500 {
            min-height: 250px;
        }
    }
</style>

@section('content')

<section class="min-vh-500 mb-8">
  <div class="page-header align-items-start min-vh-500 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/logos/coming4.png');">
    <span class="mask bg-gradient-dark opacity-4"></span>
    <div class="container">
      <!-- Konten di sini -->
    </div>
  </div>
</section>

@endsection
