<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

            <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home4"></i><span>Dashboard</span></a></li>
            <li><a href="{{route('classroom.index')}}"><i class="icon-users4"></i><span>Classroom</span></a></li>
            <li>
                <a href="#"><i class="icon-history"></i><span>History</span></a>
                <ul>
                    <li><a href="{{url('admin/history')}}">History by School</a></li>
                    <li><a href="{{url('admin/history-quiz')}}">History by Quiz</a></li>
                </ul>
            </li>
            <li class="navigation-header"><span>Master Data</span> <i class="icon-menu" title="Main pages"></i></li>
            <li><a href="{{route('quizcategory.index')}}"><i class="icon-books"></i><span>Category</span></a></li>
            <li><a href="{{route('quiztype.index')}}"><i class="icon-book3"></i><span>Type</span></a></li>
            <li><a href="{{route('quiz.index')}}"><i class="icon-question4"></i><span>Quiz</span></a></li>
            @if(Auth::user()->hasRole('admin school'))
            <li><a href="{{route('lecture.index')}}"><i class="icon-user"></i><span>Teacher</span></a></li>
            @endif
            @if(Auth::user()->hasRole('admin'))
            <li><a href="{{route('banner.index')}}"><i class="icon-images2"></i><span>Banner</span></a></li>
            <li><a href="{{route('school.index')}}"><i class="icon-home2"></i><span>School</span></a></li>
            <li><a href="{{route('version.index')}}"><i class="icon-versions"></i><span>Version</span></a></li>
            <li>
                <a href="#"><i class="icon-user"></i><span>User</span></a>
                <ul>
                    <li><a href="{{route('user.index')}}">User</a></li>
                    <li><a href="{{route('role.index')}}">Role</a></li>
                </ul>
            </li>
            <!-- /main -->
            @endif
        </ul>
    </div>
</div>
