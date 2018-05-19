<?php
$blogCategories = App\BlogCategories::where("status", "=", 1)->get();
$latestPosts = App\BlogPosts::where("status", "=", 1)->orderBy('id', 'desc')->limit(5)->get();
?>
<div class="sidebar__srch">
    <form action="{{ url('blog')}}" >
        <input type="text" name="q" class="form-control" placeholder="Search for...">
        <i class="fa fa-search" aria-hidden="true"></i>
    </form>
</div>
<div class="siderbar__category">
    <h3>Categories</h3>
    <ul>

        <?php
        foreach ($blogCategories as $category) {
            ?>
            <li><a href="{{ url('blog')}}/<?php echo $category->url ?>"><?php echo $category->name ?></a></li>
            <?php
        }
        ?>


    </ul>
</div>
<div class="sidebar__posts">
    <h3>Latest Posts</h3>
    <?php foreach ($latestPosts as $post) { ?>
        <div class="sidebar__postLinks">
            <div class="sidebar__imgs">
                <img src="{{ asset('/uploads/blog/posts/thumbnail/') }}/<?php echo $post->image; ?>" alt="<?php echo $post->name; ?>">
            </div>
            <div class="sidebar__latest">
                <h5><?php echo $post->name; ?></h5>
                <p><?php echo date("M d, Y", strtotime($post->created_at)) ?></p>
                <a href="{{ url("blog/post/")}}/<?php echo $post->id; ?>">Read More >> </a>
            </div>
        </div>
        <div class="clearfix"></div>
    <?php } ?>
</div>