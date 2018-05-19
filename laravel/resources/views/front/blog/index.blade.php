@extends('front')
<?php
$title = 'Blog';
$description = '';
$keywords = '';
?>
@include('front/common/meta')
@section('content')


<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-blog.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>Blog</h2>
        </div>
    </div>
</section>
<section class="blogs-cont-area pt30">
    <div class="container">
        <div class="blogs__featured col-sm-8">
            <?php
            $i = 1;
            foreach ($posts as $post) {
                       if ($i % 3 == 0) {
                    ?>
                    <div class="blogs__articles col-sm-12 post__featured">
                        <div class="blogs__img col-sm-4">
                            <div class="blogs__imginner">
                                <img src="{{ asset('/uploads/blog/posts/') }}/<?php echo $post->image; ?>" alt="blog-article">
                            </div>
                        </div>
                        <div class="blogs__cont col-sm-8">
                            <h3><?php echo $post->name; ?></h3>
                            <div class="dtl__postDay">
                                <ul>
                                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("h:m a", strtotime($post->created_at)) ?>, </li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y", strtotime($post->created_at)) ?></li>
                                </ul>
                            </div>
                            <p><?php echo $post->teaser; ?>
                            </p>
                            <div class="blogs__readMore">
                                <a href="{{ url("blog/post/")}}/<?php echo $post->url; ?>">Read More >></a>
                            </div>
                            <!--
                            <div class="blogs__commLike">
                                <div class="blogs__like">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>105
                                </div>
                                <div class="blogs__comment">
                                    <i class="fa fa-comments-o" aria-hidden="true"></i>35
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <?php
                } else {
                    ?>
                    <div class="blogs__articles col-sm-12">
                        <div class="blogs__img col-sm-4">
                            <div class="blogs__imginner">
                                <img src="{{ asset('/uploads/blog/posts/thumbnail/') }}/<?php echo $post->image; ?>" alt="<?php echo $post->name; ?>">
                            </div>
                        </div>
                        <div class="blogs__cont col-sm-8">
                            <h3><?php echo $post->name; ?></h3>
                            <div class="dtl__postDay">
                                <ul>
                                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("h:m a", strtotime($post->created_at)) ?>, </li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y", strtotime($post->created_at)) ?></li>
                                </ul>
                            </div>
                            <p><?php echo $post->teaser; ?></p>
                            <div class="dtl__postDayHover">
                                <ul class="dtl__hoverList">
                                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("h:m a", strtotime($post->created_at)) ?>, </li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y", strtotime($post->created_at)) ?></li>
                                </ul>
                            </div>
                            <div class="blogs__readMore">
                                <a href="{{ url("blog/post/")}}/<?php echo $post->url; ?>">Read More >></a>
                            </div>
                            <div class="blogs__commLike">
                                <div class="blogs__like">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i><?php echo $post->likes; ?>
                                </div>
                                <div class="blogs__comment">
                                    <i class="fa fa-comments-o" aria-hidden="true"></i><?php echo $post->comments; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                }
                $i++;
            }
            ?>


            <div class="clearfix"></div>



            <div class="blogs__pagination">
                <?php echo $link; ?>
            </div>


        </div>
        <div class="col-sm-4 blogs__sidebar">
            @include('front.blog.right')
        </div>
    </div>
</section>	
@endsection