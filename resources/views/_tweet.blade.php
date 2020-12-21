<!--$loop is a Laravel built-in variable. We can use the first/last of the loop and assign properties to that particular item -->
<div class="flex p-4 {{$loop->last ? '' : 'border-b border-b-gray-400'}}">
    <div class="mr-2 flex-shrink-0">
        <!-- This avatar belongs to the user who post the tweet -->
        <a href="{{$tweet->user->path()}}"><img src="{{$tweet->user->avatar}}" alt="User Avatar" class="rounded-full mr-2" width="50" height="50"></a>
    </div>
    <div>
        <h5 class="font-bold mb-2"><a href="{{$tweet->user->path()}}">{{$tweet->user->name}}</a></h5>
        <p class="text-sm mb-3">{{$tweet->body}}</p>

        @auth
        <x-like-buttons :tweet='$tweet'></x-like-buttons>
        @endauth
    </div>
</div>