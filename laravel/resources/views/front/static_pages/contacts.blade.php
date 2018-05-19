@extends('front')

@section('content')


<section class="page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-about.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>Contacts</h2>
            <h3>The very center of healthcare starts at the core</br>
                fundamentals of diagnostic testing.</h3>
        </div>
    </div>
</section>
<section class="about-area pt50 pb50" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <span class="main-head whole-sale-head">Contact Us</span>
                <div class="txt-back">
                    <span class="descrp">You can reach us any time by email <span class="drkgreen-colo"><a href="mailto:support@newcenturylabs.com">support@newcenturylabs.com</a></span>.</br>
                        We have office hours 
                        <span class="pink-col">Mon-Fri 9am - 5pm PST</span> and can <span class="green-color">call 702-522-0487</span>.
                        If we do not answer the phone, we may simply have the machines running and cannot hear the phone.</span>
                    <span class="descrp descrp2">We check out email several times a day, and this is the best way to contact us</br> <span class="drkgreen-colo"><a href="mailto:support@newcenturylabs.com">support@newcenturylabs.com</a></span></span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection