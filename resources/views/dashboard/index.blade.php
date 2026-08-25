@extends('layouts.app')

@section('title', 'Dashboard | Radar de Integración')

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h1 class="page-title fw-semibold fs-20 mb-0">
                Radar de Integraciónes
            </h1>
            <div class="">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            Inicio
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header Close -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Radar de Integración
                    </div>
                </div>

                <div class="card-body">
                    <h5>Integración de Nowa completada</h5>
                    <p class="mb-0">
                        Laravel 13 + Blade + Nowa
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
