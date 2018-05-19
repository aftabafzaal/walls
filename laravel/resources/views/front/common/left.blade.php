<?php
namespace App\Http\Controllers;
use App\Categories;
use DB;
use Auth;
use App\Functions\Functions;
$categories=Categories::orderBy('sortOrder','asc')->get();
?>
<div class="col-lg-3 col-md-3 left text-left center-block">
    <div class="left"> 
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <h3 class="hide-mobile">Let's Shop</h3>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="topnav">
            <nav class="sbnav_vertical">
              <ul>
                
                <?php
                foreach($categories as $category)
                {                        
                ?>
                <li>
                    <a href="<?php echo url('products/'.$category->id);?>" class="catcolor"><?php echo $category->name?></a>
                </li>            
                <?php
                }
                ?>
                </ul>
            </nav>
          </li>
        </ul>
      </div>
      <div class="hide-mobile">
        <h2> Information</h2>
        <nav class="sbnav_horizontal sb_pages sb_hlinks">
          <ul>
            <li><a href="{{ url('size-chart')}}" class="pagelinkcolor">SHIRT SIZE CHART</a></li>
             <li class="sel"><a href="{{ url('page/faqs')}}" class="sel_pagelinkcolor">faqs</a></li>
          </ul>
        </nav>
      </div>
      <div class="hide-mobile">
        <h4>Questions?</h4>
        <nav class="sbnav_horizontal sb_pages sb_hlinks">
          <ul>
            <li><a href="{{ url('size-chart')}}" class="pagelinkcolor">SHIRT SIZE CHART</a></li>
            <li><a href="{{ url('page/TUTULENGTHSIZECHART')}}" class="pagelinkcolor">TUTU LENGTH SIZE CHART</a></li>
            <li><a href="{{ url('page/SHIPPINGTIMES')}}" class="pagelinkcolor">SHIPPING TIMES</a></li>
            <li><a href="{{ url('page/weblinks')}}" class="pagelinkcolor">Weblinks</a></li>
            <li><a href="{{ url('wholesale')}}" class="pagelinkcolor">Wholesale</a></li>
            <li><a href="{{ url('page/faqs')}}" class="pagelinkcolor">FAQs</a></li>
            <li><a href="{{ url('guestbook')}}" class="pagelinkcolor">Guestbook</a></li>
            <li><a href="{{ url('contact')}}" class="pagelinkcolor">Contact</a></li>
            
            
          </ul>
        </nav>
      </div>
      <div class="hide-mobile">
        <h4>My Account</h4>
        <nav class="sbnav_horizontal sb_pages sb_hlinks">
          <ul>
            <?php
            if(isset(Auth::user()->id))
            {
            ?>
                <li><a href="{{ url('myorders')}}" class="pagelinkcolor">My Orders</a></li>
                <li><a href="{{ url('changepassword')}}" class="pagelinkcolor">Change Password</a></li>
                <li><a href="{{ url('profile')}}" class="pagelinkcolor">Profile</a></li>
                <li><a href="{{ url('auth/logout')}}" class="pagelinkcolor">Log Out</a></li>
            <?php
            }
            else
            {
            ?>
                <li><a href="{{ url('signup')}}" class="pagelinkcolor">Log In</a></li>
            <?php
            }
            ?>
          </ul>
        </nav>
      </div>
    </div>
</div>