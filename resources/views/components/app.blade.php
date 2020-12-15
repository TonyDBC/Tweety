<x-master>

    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-between">
                @if(auth()->check())
                    <div class="lg:w-32">
                        @include('_sidebar-links')
                    </div>
                @endif
                <div class="lg:flex-1 lg:mx-10" style="max-width: 700px">
                    {{$slot}}
                </div>
                <div class="lg:w-1/6 bg-blue-100 rounded-lg p-4">
                    @if(auth()->check())
                        @include('_friends-list')
                    @endif
                </div>
            </div>
        </main>
    </section>

</x-master>