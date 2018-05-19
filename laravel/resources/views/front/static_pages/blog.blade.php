@extends('front')

@section('content')


<section class="blogs-area">
		<div class="container">
			<div class="bpost__heading text-center col-sm-12 pt50">
				<h2>BLOG PAGE</h2>
				<h3>Lorem Ipsum is simply dummy text of the printing.</h3>
			</div>
		</div>
	</section>
	
	<section class="blogs-cont-area">
		<div class="container">
			<div class="blogs__featured col-sm-8">
			
				<div class="blogs__articles col-sm-12">
					<div class="blogs__img col-sm-4">
						<div class="blogs__imginner">
							<img src="{{ asset('front/images/blograrticle1.png') }}" alt="blog-article">
						</div>
					</div>
					<div class="blogs__cont col-sm-8">
						<h3>REGULAR BLOG POST</h3>
						<div class="dtl__postDay">
							<ul>
								<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
								<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
							</ul>
						</div>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the specimen book.</p>
						<div class="dtl__postDayHover">
							<ul class="dtl__hoverList">
								<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
								<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
							</ul>
						</div>
						<div class="blogs__readMore">
							<a href="#_">Read More >></a>
						</div>
						<div class="blogs__commLike">
							<div class="blogs__like">
								<i class="fa fa-heart-o" aria-hidden="true"></i>105
							</div>
							<div class="blogs__comment">
								<i class="fa fa-comments-o" aria-hidden="true"></i>35
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				
			<div class="blogs__articles col-sm-12">
				<div class="blogs__img col-sm-4">
					<div class="blogs__imginner">
						<img src="{{ asset('front/images/blograrticle4.png') }}" alt="blog-article">
					</div>
				</div>
				<div class="blogs__cont col-sm-8">
					<h3>REGULAR BLOG POST</h3>
					<div class="dtl__postDay">
						<ul>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
							<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
						</ul>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the specimen book. 
</p>
					<div class="dtl__postDayHover">
						<ul class="dtl__hoverList">
							<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
							<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
						</ul>
					</div>
					<div class="blogs__readMore">
						<a href="blog-detail.php">Read More >></a>
					</div>
					<div class="blogs__commLike">
						<div class="blogs__like">
							<i class="fa fa-heart-o" aria-hidden="true"></i>105
						</div>
						<div class="blogs__comment">
							<i class="fa fa-comments-o" aria-hidden="true"></i>35
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="blogs__articles col-sm-12 post__featured">
				<div class="blogs__img col-sm-4">
					<div class="blogs__imginner">
						<img src="{{ asset('front/images/blograrticle1.png') }}" alt="blog-article">
					</div>
				</div>
				<div class="blogs__cont col-sm-8">
					<h3>REGULAR BLOG POST</h3>
					<div class="dtl__postDay">
						<ul>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
							<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
						</ul>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the specimen book. 
</p>
					<div class="blogs__readMore">
						<a href="#_">Read More >></a>
					</div>
					<div class="blogs__commLike">
						<div class="blogs__like">
							<i class="fa fa-heart-o" aria-hidden="true"></i>105
						</div>
						<div class="blogs__comment">
							<i class="fa fa-comments-o" aria-hidden="true"></i>35
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="blogs__articles col-sm-12">
				<div class="blogs__img col-sm-4">
					<div class="blogs__imginner">
                                            
						<img src="{{ asset('front/images/blograrticle3.png') }}" alt="blog-article">
					</div>
				</div>
				<div class="blogs__cont col-sm-8">
					<h3>REGULAR BLOG POST</h3>
					<div class="dtl__postDay">
						<ul>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
							<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
						</ul>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the specimen book. 
</p>
					<div class="blogs__readMore">
						<a href="blog-detail.php">Read More >></a>
					</div>
					<div class="blogs__commLike">
						<div class="blogs__like">
							<i class="fa fa-heart-o" aria-hidden="true"></i>105
						</div>
						<div class="blogs__comment">
							<i class="fa fa-comments-o" aria-hidden="true"></i>35
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="blogs__articles col-sm-12">
				<div class="blogs__img col-sm-4">
					<div class="blogs__imginner blogs__video">
						<video width="240" height="194" controls poster="images/videothumbnail.png">
						  <source src="images/Wildlife.mp4" type="video/mp4">
						  Your browser does not support the video tag.
						</video>
						<i class="fa fa-play" aria-hidden="true"></i>
					</div>
				</div>
				<div class="blogs__cont col-sm-8">
					<h3>REGULAR BLOG POST</h3>
					<div class="dtl__postDay">
						<ul>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
							<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
						</ul>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the specimen book. 
</p>
					<div class="blogs__readMore">
						<a href="blog-detail.php">Read More >></a>
					</div>
					<div class="blogs__commLike">
						<div class="blogs__like">
							<i class="fa fa-heart-o" aria-hidden="true"></i>105
						</div>
						<div class="blogs__comment">
							<i class="fa fa-comments-o" aria-hidden="true"></i>35
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="blogs__articles col-sm-12">
				<div class="blogs__img col-sm-4">
					<div class="blogs__imginner">
						<img src="{{ asset('front/images/blograrticle2.png') }}" alt="blog-article">
					</div>
				</div>
				<div class="blogs__cont col-sm-8">
					<h3>REGULAR BLOG POST</h3>
					<div class="dtl__postDay">
						<ul>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Day ago, </li>
							<li><i class="fa fa-calendar" aria-hidden="true"></i> September 29, 2016 </li>
						</ul>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the specimen book. 
</p>
					<div class="blogs__readMore">
						<a href="blog-detail.php">Read More >></a>
					</div>
					<div class="blogs__commLike">
						<div class="blogs__like">
							<i class="fa fa-heart-o" aria-hidden="true"></i>105
						</div>
						<div class="blogs__comment">
							<i class="fa fa-comments-o" aria-hidden="true"></i>35
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			
			
			<div class="blogs__pagination">
				<ul class="pagination">
				  <li><a href="#">&laquo;</a></li>
				  <li><a href="#">1</a></li>
				  <li><a href="#">2</a></li>
				  <li><a href="#">3</a></li>
				  <li><a href="#">4</a></li>
				  <li><a href="#">5</a></li>
				  <li><a href="#">&raquo;</a></li>
				</ul>

			</div>
			
			
			</div>
			<div class="col-sm-4 blogs__sidebar">
				<div class="sidebar__srch">
					<input type="text" class="form-control" placeholder="Search for...">
					<i class="fa fa-search" aria-hidden="true"></i>
				</div>
				<div class="siderbar__category">
					<h3>Categories</h3>
					<ul>
						<li><a href="about.php">About Us</a></li>
						<li><a href="blog.php">Blog</a></li>
						<li><a href="location.php">Locations</a></li>
						<li><a href="contacts">Contact Us</a></li>
						<li><a href="#">Uncategorized</a></li>
					</ul>
				</div>
				<div class="sidebar__quote">
					<h3>Quote Of The Week</h3>
					<div class="sidebar__quotations">
						<i class="fa fa-quote-left" aria-hidden="true"></i>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
industry when an unknown printer</p>
				</div>
				<div class="sidebar__posts">
					<h3>Latest Posts</h3>
					<div class="sidebar__postLinks">
						<div class="sidebar__imgs">
							<img src="{{ asset('front/images/latestPost1.png') }}" alt="latest-post">
						</div>
						<div class="sidebar__latest">
							<h5>Style & Events Organizer</h5>
							<p>Sep 29, 2016</p>
							<a href="blog-detail.php">Read More >> </a>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="sidebar__postLinks">
						<div class="sidebar__imgs">
							<img src="{{ asset('front/images/latestPost2.png') }}" alt="latest-post">
						</div>
						<div class="sidebar__latest">
							<h5>Style & Events Organizer</h5>
							<p>Sep 29, 2016</p>
							<a href="blog-detail.php">Read More >> </a>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="sidebar__postLinks">
						<div class="sidebar__imgs">
							<img src="{{ asset('front/images/latestPost3.png') }}" alt="latest-post">
						</div>
						<div class="sidebar__latest">
							<h5>Style & Events Organizer</h5>
							<p>Sep 29, 2016</p>
							<a href="blog-detail.php">Read More >> </a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="sidebar__banner">
					<h3>ADD YOUR Banner</h3>
					<img src="{{ asset('front/images/postBanner.png') }}" alt="post-banner">
				</div>
			</div>
			
			
			
			
		</div>
	</section>	
@endsection