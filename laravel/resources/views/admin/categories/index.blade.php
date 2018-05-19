@extends('admin/admin_template')

@section('content')

<style>
 
 
ul#tree1 >li {
    border: 0px solid #ccc;
    padding: 5px;
}

ul#tree1 .product-title[href*="delete"] {
    color: #d00;
}
 
span.actions >a {
    background-color: #eee;
    display: inline-block;
    padding: 1px 8px;
    border-radius: 3px;
    margin: 0 0 10px 10px;
    font-size: 12px;
    border: 1px solid #ccc;
    line-height: 18px;
}

</style>

<!-- Main row -->
<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Categories( Total : {{ count($categories) }} ) </h3>
            </div>
            <div class="box-body">
                <ul class="products-list product-list-in-box" id="tree1">
                    <?php
                    $i = 1;
                    foreach ($categories as $id => $category) {
                        ?>
                        <li><?php echo '-' . $category['name']; ?>
                           <span class="actions"><a href="categories/edit/<?php echo $id ?>" class="product-title">Edit</a>   <a href="categories/delete/<?php echo $id ?>" class="product-title">Delete</a></span>

                            <ul>
                                <?php
                                if (!empty($category['categories'])) {

                                    foreach ($category['categories'] as $subCatId => $subCategory) {
                                        ?>
                                        <li><?php echo $subCategory; ?> <span class="actions"> <a href="categories/edit/<?php echo $subCatId ?>" class="product-title">Edit </a>   <a href="categories/delete/<?php echo $subCatId ?>" class="product-title">Delete </a></span> </li>
                                       
                                        <?php
                                    }
                                } else {
                                    echo "<li>no categories</li>";
                                }
                                ?>
                            </ul>
							
							</li>  
                        <?php
                        $i++;
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $.fn.extend({
            treed: function (o) {

                var openedClass = 'glyphicon-minus-sign';
                var closedClass = 'glyphicon-plus-sign';

                if (typeof o != 'undefined') {
                    if (typeof o.openedClass != 'undefined') {
                        openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined') {
                        closedClass = o.closedClass;
                    }
                }
                ;

                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                //fire event from the dynamically added icon
                tree.find('.branch .indicator').each(function () {
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                });
                //fire event to open branch if the li contains an anchor instead of text
                tree.find('.branch>a').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                //fire event to open branch if the li contains a button instead of text
                tree.find('.branch>button').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });

        //Initialization of treeviews

        $('#tree1').treed();
    });
</script>
<!-- /.row -->	

@endsection