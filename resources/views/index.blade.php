<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Reddit</title>

    <!-- Favicon -->
    <link rel="icon" href={{asset("img/core-img/favicon.ico")}}>

    <!-- Style CSS -->
    <link rel="stylesheet" href={{asset("style.css")}}>

</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div class="preload-content">
        <div id="original-load"></div>
    </div>
</div>

<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Nav Area -->
    <div class="original-nav-area" id="stickyNav">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between">

                    <a href="#" style="font-size: x-large">Reddit</a>

                    <!-- Menu -->
                    <div class="classy-menu" id="originalNav">
                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="/">Home</a></li>

                                <li><a href="#">Category</a>
                                    <ul class="dropdown">
                                        @foreach($categories as $category)
                                            <div class="widget-content">
                                                <ul class="tags">
                                                    <li><a href="/search?searchField=category_id&searchValue={{$category->getCategoryId()}}&page=1&perPage=5&orderBy=created_at&orderDirection=DESC">{{$category->getTitle()}}</a></li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                            <div class="form-outline">
                                <input class="search_action form-control" type="search" id="searchForm" name="search_value" placeholder="Search" aria-label="Search"/>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->

<!-- ##### Blog Wrapper Start ##### -->
<div class="blog-wrapper section-padding-100 clearfix">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9">

                @foreach($posts as $post)
                    <!-- Single Blog Area  -->
                        <div class="single-blog-area blog-style-2 mb-50 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1000ms">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <div class="single-blog-thumbnail">
                                        <img src={{asset("img/blog-img/3.jpg")}} alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- Blog Content -->
                                    <div class="single-blog-content">
                                        <p>{{$post->created_at}}</p>
                                    <a href="/search?searchField=category_id&searchValue={{$post->category_id}}&page=1&perPage=5&orderBy=created_at&orderDirection=ASC" class="post-tag">{{$post->category->title}}</a>
                                        <h4><a href="/posts/{{$post->id}}" class="post-headline">{{$post->title}}</a></h4>
                                        <p>{{$post->description}}</p>
                                        <div class="post-meta">
                                            <p>By <a href="#">{{$post->author->name}}</a></p>
                                            <p>{{$post->comments_count}} comments</p>
                                            <p class="post_like_action" data-user-id="1" data-post-id="{{$post->id}}">{{$post->likes_count}} likes</p>
                                            <p class="post_dislike_action" data-user-id="1" data-post-id="{{$post->id}}">{{$post->dislikes_count}} dislikes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach

                {{ $posts->links('components.pagination') }}

            </div>

            <!-- ##### Sidebar Area ##### -->
            <div class="col-12 col-md-4 col-lg-3">
                <div class="post-sidebar-area">

                    <!-- Latest Posts -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Latest Posts</h5>

                        @foreach($latestPosts as $post)
                        <div class="widget-content">

                            <!-- Single Blog Post -->
                            <div class="single-blog-post d-flex align-items-center widget-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                    <img src={{asset("img/blog-img/lp2.jpg")}} alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <a href="/search?searchField=category_id&searchValue={{$post->category_id}}&page=1&perPage=5&orderBy=created_at&orderDirection=ASC" class="post-tag">{{$post->category->title}}</a>
                                    <h4><a href="/posts/{{$post->id}}" class="post-headline">{{$post->title}}</a></h4>
                                    <div class="post-meta">
                                        <p><a href="#">{{$post->created_at}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tags -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Tags</h5>
                        @foreach($tags as $tag)
                            <div class="widget-content">
                                <ul class="tags">
                                    <li><a href="/search?searchField=tag_id&searchValue={{$tag->getTagId()}}&page=1&perPage=5&orderBy=created_at&orderDirection=ASC">{{$tag->getTitle()}}</a></li>
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <!-- Subscribe button -->
                    <div class="sidebar-widget-area">
                        <h5 class="title subscribe-title">Subscribe to my newsletter</h5>
                        <div class="widget-content">
                            <form method="POST" action="/subscriptions" class="newsletterForm">
                                @csrf

                                <input type="email" name="email" id="email" placeholder="Your e-mail here">
                                <button type="submit" class="btn original-btn">Subscribe</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Blog Wrapper End ##### -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src={{asset("js/jquery/jquery-2.2.4.min.js")}}></script>
<!-- Popper js -->
<script src={{asset("js/popper.min.js")}}></script>
<!-- Bootstrap js -->
<script src={{asset("js/bootstrap.min.js")}}></script>
<!-- Plugins js -->
<script src={{asset("js/plugins.js")}}></script>
<!-- Active js -->
<script src={{asset("js/active.js")}}></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( ".post_like_action" ).click(function() {
        var user_id = $( this ).attr("data-user-id");
        var post_id = $( this ).attr("data-post-id");

        $.post('/api/posts/postVote', { user_id: user_id, post_id: post_id, vote: "LIKE" })
            .done(function( data ) {
                window.location.reload();
            });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( ".post_dislike_action" ).click(function() {
        var user_id = $( this ).attr("data-user-id");
        var post_id = $( this ).attr("data-post-id");

        $.post('/api/posts/postVote', { user_id: user_id, post_id: post_id, vote: "DISLIKE" })
            .done(function( data ) {
                window.location.reload();
            });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( ".search_action" ).on('keypress',function(e) {
        if(e.which === 13) {
            var search_value = $( this ).val();
            window.location.href = '/search?searchField=title&searchValue='+search_value+'&page=1&perPage=5&orderBy=created_at&orderDirection=DESC';
        }
    });

</script>

</body>

</html>
