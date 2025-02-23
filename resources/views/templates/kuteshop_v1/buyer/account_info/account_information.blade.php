@extends('templates.kuteshop_v2.layouts.frontend.master')

@section('Title','Account Information')

@section('PageCss')

@endsection

@section('Content')
    <main class="site-main">

        <div class="columns container">
            <ol class="breadcrumb no-hide">
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li><a href="{{ route('buyer.home') }}">Dashboard</a></li>
                <li class="active">Account Info</li>
            </ol>
            <div class="row">
                <div class="col-md-9 col-md-push-3 col-main">
                    <div class="col-main">
                        <h2 class="page-heading">
                            <span class="page-heading-title2">Account Information</span>
                        </h2>
                        <div class="content-text clearfix wow bounceInUp animated">
                            <account-info-update></account-info-update>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-3 col-md-pull-9   col-sidebar">
                    @include('templates.kuteshop_v2.buyer.partials.right_side')
                </div>
                <!-- Sidebar -->
            </div>
        </div>
    </main>
@endsection

@section('PageJs')

@endsection
