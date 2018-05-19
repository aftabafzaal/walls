@extends('front')
<?php
$title = $post->name;
$description = $post->metaDescription;
$keywords = $post->keywords;
?>
@include('front/common/meta')
@section('content')
<section class="blog-post-area">
    <div class="container">
        <div class="bpost__heading text-center col-sm-12 pt50">
            <h2><?php echo $post->name; ?></h2>
        </div>
    </div>
</section>
<section class="blog-dtl-area">
    <div class="container">
        <div class="dtl__main col-sm-12">
            <div class="dtl__img">
                <img src="{{ asset('/uploads/blog/posts') }}/<?php echo $post->image; ?>" alt="<?php echo $post->name; ?>">
            </div>
            <div class="dtl__postDay">
                <ul>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("h:m a", strtotime($post->created_at)) ?>, </li>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y", strtotime($post->created_at)) ?> </li>
                </ul>
            </div>
            <div class="dtl__content">
                <div class="dtl__content">
                    <?php echo $post->description; ?>
                </div>
            </div>
        </div>
    </div>		
</section>	
<section class="blog-posted-area pt50 pb50" >
    <div class="container">
        <div class="row">
            <?php
            foreach ($similarPosts as $post) {
                ?>
                <div class="posted-box col-sm-4">
                    <div class="posted__img">
                        <img src="{{ asset('/uploads/blog/posts/thumbnail') }}/<?php echo $post->image; ?>" alt="<?php echo $post->name; ?>" />
                        <div class="posted__hover">
                            <a href="{{ url("blog/post/")}}/<?php echo $post->id; ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="posted__cont">
                        <div class="dtl__postDay">
                            <ul>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("h:m a", strtotime($post->created_at)) ?>, </li>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y", strtotime($post->created_at)) ?> </li>
                            </ul>
                            <h3><?php echo $post->name; ?></h3>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>


    </div>
</section>
@endsection