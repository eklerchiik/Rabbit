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

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

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
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->

<!-- ##### Single Blog Area Start ##### -->
<div class="single-blog-wrapper section-padding-0-100">

    <!-- Single Blog Area  -->
    <div class="single-blog-area blog-style-2 mb-50">
        <div class="single-blog-thumbnail">
            <img src={{asset("img/bg-img/b2.png")}} alt="">
            <div class="post-tag-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- ##### Post Content Area ##### -->
            <div class="col-12 col-lg-9">

            <!-- Single Blog Area  -->
            <div class="single-blog-area blog-style-2 mb-50">
                <!-- Blog Content -->
                <div class="single-blog-content">
                    <p>{{$post->getCreatedAt()}}</p>
                    <a href="/search?searchField=category_id&searchValue={{$post->getCategory()->getCategoryId()}}&page=1&perPage=5&orderBy=created_at&orderDirection=ASC" class="post-tag">{{$post->getCategory()->getTitle()}}</a>
                    <h4><a href="#" class="post-headline mb-0">{{$post->getTitle()}}</a></h4>
                    <div class="post-meta mb-50">
                        <p>By <a href="#">{{$post->getAuthor()->getName()}}</a></p>
                        <p>{{$post->getCommentsCount()}} comments</p>
                        <p class="post_like_action" data-user-id="1" data-post-id="{{$post->getId()}}">{{$post->getLikesCount()}} likes</p>
                        <p class="post_dislike_action" data-user-id="1" data-post-id="{{$post->getId()}}">{{$post->getDislikesCount()}} dislikes</p>
                    </div>
                    <p>{{$post->getDescription()}}</p>
                </div>

            </div>

                <!-- Comment Area Start -->
                <div class="comment_area clearfix mt-70">
                    <h5 class="title">Comments</h5>
                    @foreach($comments as $comment)
                    <ol>
                        <!-- Single Comment Area -->
                        <li class="single_comment_area">
                            <!-- Comment Content -->
                            <div class="comment-content d-flex">
                                <!-- Comment Author -->
                                <div class="comment-author">
                                    <img src={{asset("img/bg-img/b8.jpg")}} alt="author">
                                </div>
                                <!-- Comment Meta -->
                                <div class="comment-meta">
                                    <a href="#" class="post-date"></a>
                                    <p><a href="#" class="post-author">{{$comment->getAuthor()->getName()}}</a></p>
                                    <p>{{$comment->getText()}}</p>
                                    <p class="like_action" data-user-id="2" data-comment-id="{{$comment->getId()}}">{{$comment->getLikesCount()}} likes</p>
                                    <p class="dislike_action" data-user-id="2" data-comment-id="{{$comment->getId()}}">{{$comment->getDislikesCount()}} dislikes</p>
                                    <a href="#" class="comment-reply">Reply</a>
                                </div>
                            </div>
                        </li>
                    </ol>
                    @endforeach
                </div>

                <div class="post-a-comment-area mt-70">
                    <h5>Leave a reply</h5>
                    <!-- Reply Form -->
                    <form method="POST" action="/comments">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="post_id" id="post_id" value="{{$post->getId()}}" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Post id</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="user_id" id="user_id" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>User id</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group">
                                    <textarea name="text" id="text" required></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Comment</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn original-btn">Reply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ##### Sidebar Area ##### -->
            <div class="col-12 col-md-4 col-lg-3">
                <div class="post-sidebar-area">

                    <!-- Latest posts -->
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
                                        <a href="#" class="post-tag">{{$post->category->title}}</a>
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
                                    <li><a href="/search?searchField=tag_id&searchValue={{$tag->getTagId()}}&page=1&perPage=5&orderBy=created_at&orderDirection=DESC">{{$tag->getTitle()}}</a></li>
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

                                <input type="email" name="email" id="subscribesForm" placeholder="Your e-mail here">
                                <button type="submit" class="btn original-btn">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Single Blog Area End ##### -->

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

    $( ".like_action" ).click(function() {
        var user_id = $( this ).attr("data-user-id");
        var comment_id = $( this ).attr("data-comment-id");

        $.post('/api/comments/vote', { user_id: user_id, comment_id: comment_id, vote: "LIKE" })
            .done(function( data ) {
                window.location.reload();
            });
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( ".dislike_action" ).click(function() {
        var user_id = $( this ).attr("data-user-id");
        var comment_id = $( this ).attr("data-comment-id");

        $.post('/api/comments/vote', { user_id: user_id, comment_id: comment_id, vote: "DISLIKE" })
            .done(function( data ) {
                window.location.reload();
            });
    });

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
</script>

</body>

</html>
