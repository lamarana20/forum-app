<!-- user/profile.blade.php -->
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <div id="userProfileContent">
        <h5>Posts de {{ $user->name }}</h5>
        <ul>
            @foreach ($posts as $post)
                <li>{{ $post->body }}</li>
            @endforeach
        </ul>

        <h5>Threads de {{ $user->name }}</h5>
        <ul>
            @foreach ($threads as $thread)
                <li>{{ $thread->title }}</li>
            @endforeach
        </ul>
    </div>
</div>
