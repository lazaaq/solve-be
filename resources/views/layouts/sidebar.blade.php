<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

            <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
            <li><a href="{{url('admin/dashboard')}}"><img src="{{asset('img/web_ic_home.png')}}" alt="" style="height:20px;margin-right:15px"><span>Dashboard</span></a></li>
            <li><a href="{{route('classroom.index')}}"><img src="{{asset('img/web_ic_home.png')}}" alt="" style="height:20px;margin-right:15px"><span>Classroom</span></a></li>
            <li><a href="{{url('admin/history')}}"><img src="{{asset('img/web_ic_home.png')}}" alt="" style="height:20px;margin-right:15px"><span>History</span></a></li>
            <li class="navigation-header"><span>Master Data</span> <i class="icon-menu" title="Main pages"></i></li>
            <li><a href="{{route('quizcategory.index')}}"><img src="{{asset('img/web_ic_category.png')}}" alt="" style="height:20px;margin-right:15px"> <span>Category</span></a></li>
            <li><a href="{{route('quiztype.index')}}"><img src="{{asset('img/web_ic_type.png')}}" alt="" style="height:20px;margin-right:15px"> <span>Type</span></a></li>
            <li><a href="{{route('quiz.index')}}"><img src="{{asset('img/web_ic_quiz.png')}}" alt="" style="height:20px;margin-right:15px"> <span>Quiz</span></a></li>
            @if(Auth::user()->hasRole('admin school'))
            <li><a href="{{route('lecture.index')}}"><img src="{{asset('img/web_ic_user.png')}}" alt="" style="height:20px;margin-right:15px"> <span>Teacher</span></a></li>
            @endif
            @if(Auth::user()->hasRole('admin'))
            <li><a href="{{route('banner.index')}}"><img src="{{asset('img/web_ic_banner.png')}}" alt="" style="height:20px;margin-right:15px"> <span>Banner</span></a></li>
            <li><a href="{{route('school.index')}}"><img src="{{asset('img/web_ic_home.png')}}" alt="" style="height:20px;margin-right:15px"><span>School</span></a></li>
            <li><a href="{{route('version.index')}}"><img src="{{asset('img/web_ic_version.png')}}" alt="" style="height:20px;margin-right:15px"> <span>Version</span></a></li>
            <li><a href="{{route('user.index')}}"><img src="{{asset('img/web_ic_user.png')}}" alt="" style="height:20px;margin-right:15px"> <span>User</span></a></li>
            <li><a href="{{route('role.index')}}"><img src="{{asset('img/web_ic_user.png')}}" alt="" style="height:20px;margin-right:15px"> <span>Role</span></a></li>
            <!-- /main -->
            @endif
        </ul>
    </div>
</div>
