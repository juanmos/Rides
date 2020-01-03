@extends('layouts.app')

@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Google API</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Maps</a></li>
                                    <li class="breadcrumb-item"><a href="#!">Google Map Search API</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- [ Map-API ] start -->
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Google Map Search</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="">
                                            <form method="post" id="address-search">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Enter address">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary m-0">Search</button>
                                                    </span>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                            <br>
                                            <div class="gmap1 full-page-google-map">
                                                <div id="map-1" style='max-height:600px;height:1067px;'></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <br>
                                        </div>
                                        <div class="map-toolbar">
                                            <div class="row">
                                                <div class="col-xl-12 text-center location-mob-btn">
                                                    <div class="btn-group m-b-5">
                                                        <button type="button" class="btn btn-danger" id="map-unzoom">-</button>
                                                        <button type="button" class="btn btn-danger" id="map-resetzoom">Reset</button>
                                                        <button type="button" class="btn btn-danger" id="map-zoom">+</button>
                                                    </div>
                                                    &nbsp;
                                                    <a href="#!" class="btn btn-primary m-r-10" id="go-sthlm">Go to Stockholm</a>
                                                    <a href="#!" class="btn btn-warning" id="go-bln">Go to Berlin</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ Map-API ] end -->
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&key=AIzaSyCxeMSYxHSrqPKg0eSFUTmNoXU-Br9AriY"></script>
<script src="{{asset('assets/plugins/google-maps/js/gmaps.js')}}"></script>
<script src="{{asset('assets/js/pages/map-api.js')}}"></script>
@endpush