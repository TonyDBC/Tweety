<div class="bg-blue-100 rounded-lg p-4">
    <h3 class="font-bold text-xl mb-4">Followings</h3>

    <ul>
        @forelse(current_user()->follows as $user)
            <li class="{{$loop->last ? '': 'mb-4'}}">
                <div>
                    <a href="{{route('profile', $user)}}" class="flex items-center text-sm">
                        <img src="{{$user->avatar}}" alt="User Avatar" class="rounded-full mr-2" width="40" height="40">
                        {{$user->name}}
                    </a>
                </div>
            </li>
        @empty
            <li>No friends yet!</li>
        @endforelse
    </ul>
</div>