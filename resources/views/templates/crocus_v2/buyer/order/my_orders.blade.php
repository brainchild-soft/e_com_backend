@extends('templates.crocus_v2.layouts.frontend.master')

@section('Title','My Orders')

@section('PageCss')
    <style>
        #invoice{
            padding: 30px;
        }
        .text-semibold{
            font-weight: 600!important;
        }
        .list-condensed h5{
            margin-bottom: 0;
            font-weight:700;
        }
        .text-bold{
            font-weight: 700!important;
        }
    </style>
@endsection

@section('Content')
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9 wow bounceInUp animated">
                <div class="col-main">
                    <my-order-page></my-order-page>
                </div>
            </section>

            <!-- right side -->
            @include('templates.crocus_v2.buyer.partials.right_side')
        </div>
    </div>
</div>
@endsection

@section('PageJs')

@endsection
