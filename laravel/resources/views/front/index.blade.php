@extends('front')
<?php
$title = $model->metaTitle;
$description = $model->metaDescription;
$keywords = $model->keywords;
?>
@include('front/common/meta')
@section('content')
<!--
<section class="hero-area">
    <div class="container">
        <div class="row">

        </div>
    </div>
</section>
-->

<section class="feature section">
    <div class="container">
        <div class="row" id="bundle_products">
             
        </div>
    </div>
    <!-- .container close --></section>
<!-- #service close -->

<section class="promo-details section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center"><img alt="" src="{{asset('')}}frontlte/images/watch.png" /></div>

            <div class="col-md-6">
                <div class="content mt-100">
                    <h2 class="subheading">Designed by professional , the benefit for creative gigs</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia vel labore, deleniti minima nisi, velit atque quaerat impedit ea maxime sunt accusamus at obcaecati dolor iure iusto omnis quis eum.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis commodi odit, illo, qui aliquam dol</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-list section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Why Choose Apple Watch</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 text-center"><img alt="" src="{{asset('')}}frontlte/images/showcase-4.png" /></div>

            <div class="col-md-6">
                <div class="content mt-100">
                    <h4 class="subheading">Lorem ipsum dolor sit amet.</h4>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, sed, assumenda. Tenetur sed esse, voluptas voluptate est veniam numquam, quis magni. Architecto minus suscipit quas, quo harum deserunt consequatur cumque!</p>
                    <a class="btn btn-main btn-main-sm" href="">Check Features</a></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="content mt-100">
                    <h4 class="subheading">Lorem ipsum dolor sit amet.</h4>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, sed, assumenda. Tenetur sed esse, voluptas voluptate est veniam numquam, quis magni. Architecto minus suscipit quas, quo harum deserunt consequatur cumque!</p>
                    <a class="btn btn-main btn-main-sm" href="">Check Features</a></div>
            </div>

            <div class="col-md-6 text-center"><img alt="" class="img-responsive" src="{{asset('')}}frontlte/images/showcase-3.png" /></div>
        </div>
    </div>
</section>

<section class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Checkout some amazing Shorts</h2>
                </div>

                <div class="gallery-slider">
                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-3.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-4.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-5.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-6.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-7.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-3.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-4.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-5.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-6.png" /></div>

                    <div class="block">
                        <div class="gallery-overlay">&nbsp;</div>
                        <img alt="" class="img-fluid" src="{{asset('')}}frontlte/images/showcase-7.png" /></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="call-to-action section bg-opacity bg-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wow text-center">
                <div class="block">
                    <h2 class="subheading">Get Product Updates</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>

                    <div class="col-lg-6 offset-lg-3">
                        <div class="input-group"><input class="form-control" placeholder="Your Email Address Here" type="text" /> <span class="input-group-btn"><button class="btn btn-default btn-main" type="button">Subscribe</button> </span></div>
                        <!-- /input-group --></div>
                    <!-- /.col-lg-6 --></div>
            </div>
        </div>
    </div>
</section>
<!-- #call-to-action close -->

<section class="testimonials section">
    <div class="container">
        <div class="row">
            <div class="heading">
                <h2>Watch Review</h2>
            </div>

            <div class="col-md-4 text-center">
                <div class="testimonial-block">
                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>

                    <div class="author-details"><img alt="" src="{{asset('')}}frontlte/images/avater.png" />
                        <h4>Jonathon Andrew</h4>
                        <span>CEO, Themefisher</span></div>
                </div>
            </div>

            <div class="col-md-4 text-center">
                <div class="testimonial-block">
                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, perferendis.</p>

                    <div class="author-details"><img alt="" src="{{asset('')}}frontlte/images/avater.png" />
                        <h4>Jonathon Andrew</h4>
                        <span>CEO, Themefisher</span></div>
                </div>
            </div>

            <div class="col-md-4 text-center">
                <div class="testimonial-block">
                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>

                    <div class="author-details"><img alt="" src="{{asset('')}}frontlte/images/avater.png" />
                        <h4>Jonathon Andrew</h4>
                        <span>CEO, Themefisher</span></div>
                </div>
            </div>
        </div>

        <div class="row mt-100">
            <div class="col-md-12 text-center"><a class="btn btn-main" href="">Grab You Product Now</a></div>
        </div>
    </div>
</section>

@endsection