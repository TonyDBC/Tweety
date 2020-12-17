<x-app>
    <div>
        @foreach($users as $user)
            <a class="flex items-center mb-5" href="{{$user->path()}}">
                <img src="{{$user->avatar}}" alt="{{$user->username}}'s' avatar" width="60" class="mr-4 rounded">
                <div>
                    <h4 class="font-bold">{{'@' . $user->username}}</h4>
                </div>
            </a>
        @endforeach

        {{$users->links()}}
    </div>
</x-app>