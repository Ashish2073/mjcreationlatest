@extends('website.layout.main')
@section('title', 'Mjcreation')
@section('content')





    <section>
        <div class="container-fluid">
            <div class="row">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('/img/mhbanner.png') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/img/mhbanner.png') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('/img/mhbanner.png') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container prod-sec">
            <div class="row">
                <div class="prod-collection mt-5">
                    <h5>DHOOP COLLECTION</h5>
                    <h5>View more<i class='fas fa-long-arrow-alt-right'></i></h5>
                </div>
                <hr />
            </div>
            <div class="row gx-5">
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-6.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-10.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-11.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-12.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
            </div>

            <div class="row gx-5 mt-5">
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-6.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-10.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-11.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-12.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-6.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Hari Darshan Deluxe <br>Doop 20 Sticks</span><br />
                        <span class="prod-title">₹23.00</span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-20.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Brass Kirti Mukha/ Keerthi Mukudu</span><br />
                        <span class="prod-title">₹1,501.00</span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-21.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">HANUMAN ABHISHEK POOJA</span><br />
                        <span class="prod-title">₹10-351</span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-22.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Pacha Kapoor / Camphor Flakes</span><br />
                        <span class="prod-title">₹25.00-250.00</span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-23.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Aarti Sangrah Hindi Book</span><br />
                        <span class="prod-title">₹30.00</span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="prod-box">
                        <img src="{{ asset('/img/image-24.png') }}" class="prod-img mb-2" />
                        <span class="prod-title">Balaji Chandanam Natural Flora Sticks</span><br />
                        <span class="prod-title">₹140.00</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container my-5">
            <div class="row">
                <img src="{{ asset('/img/shop-now.png') }}" class="img-fluid" />
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <h5>Pooja Materials</h5>
                <hr />
            </div>
        </div>
    </section>



@endsection
