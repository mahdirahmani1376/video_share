@extends('layout')
@section('content')
    <div class="row">
        <!-- Watch -->
        <div class="col-md-8">
            <div id="watch">

                <!-- Video Player -->
                <h1 class="video-title">{{ $video->name }}</h1>
                <div class="video-code">
                    <video controls style="height: 100%; width: 100%;">
                        <source src="{{ $video->url }}" type="video/mp4">
                    </video>
                </div><!-- // video-code -->

                <div>
                    <p>
                        {{ $video->description }}
                    </p>
                </div>

                <div class="video-share">
                    <ul class="like">
                        <li><a class="deslike" href={{ route('dislike',['likeable_type' => 'Video','likeable_id' => $video]) }}> {{ $videoDislikes }} <i class="fa fa-thumbs-down"></i></a></li>
                        <li><a class="like" href="{{ route('like',['likeable_type' => 'Video','likeable_id' => $video]) }}"> {{ $videoLikes }} <i class="fa fa-thumbs-up"></i></a></li>
                    </ul>
                    <ul class="social_link">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="youtube" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="google" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                    </ul><!-- // Social -->
                </div><!-- // video-share -->
                <!-- // Video Player -->


                <!-- Chanels Item -->
                <div class="chanel-item">
                    <div class="chanel-thumb">
                        <a href="#"><img src="/demo_img/ch-1.jpg" alt=""></a>
                    </div>
                    <div class="chanel-info">
                        <a class="title" href="#">داود طاهری</a>
                        <span class="subscribers">436,414 ویدیو</span>
                    </div>
                    <a href="#" class="subscribe">مشاهده همه ویدیوهای داوود طاهری</a>
                </div>
                <!-- // Channels Item -->


                <!-- Comments -->
                <div id="comments" class="post-comments">
                    <h3 class="post-box-title"><span>19</span> نظرات</h3>
                    <ul class="comments-list">
                        @foreach($video->comments as $comment)
                            <li>
                                <div class="post_author">
                                    <div class="img_in">
                                        <a href="#"><img src="{{asset('/demo_img/c1.jpg')}}" alt=""></a>
                                    </div>
                                    <a href="#" class="author-name">{{ $comment->user_id }}</a>
                                    <time datetime="{{ $comment->created_at }}">{{ $comment->created_at_for_human }}</time>
                                </div>
                                <p>
                                    {{ $comment->text }}
                                </p>


                            </li>
                        @endforeach

                    </ul>

                    @auth()
                    <h3 class="post-box-title">ارسال نظرات</h3>
                        <form action="{{ route('videos.comments.store',$video) }}" method="post">
                            @csrf
                            <textarea class="form-control" rows="8" id="Message" placeholder="پیام" name="text"></textarea>
                            <button type="submit" id="contact_submit" class="btn btn-dm">ارسال پیام</button>
                        </form>
                        @foreach($errors->all() as $e)
                            <li class="">{{ $e }}</li>
                        @endforeach
					@endauth
                </div>
                <!-- // Comments -->


            </div><!-- // watch -->
        </div><!-- // col-md-8 -->
        <!-- // Watch -->

        <!-- Related Posts-->
        <div class="col-md-4">
            <x-related-videos :video="$video" />
        </div><!-- // col-md-4 -->
        <!-- // Related Posts -->
    </div>

@endsection
