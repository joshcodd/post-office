@foreach (Auth::User()->notifications as $notification)
    <div class="border-b flex  items-center py-3 pl-6 w-full">
        <div>
            <svg height="20" width="20">
                <circle cx="10" cy="10" r="8" stroke="black" stroke-width="1.5"
                    fill="{{ $notification->read() ? 'none' : 'black' }}" />
            </svg>
        </div>
        <div class="px-5">
            <a href="{{ $notification->data['user_link'] }}" class="font-bold hover:underline">
                {{ $notification->data['first_name'] }}
                {{ $notification->data['surname'] }}
            </a>
            @if ($notification->type == 'App\Notifications\RecievedLike')
                has liked your
                <a href="{{ $notification->data['post_link'] }}" class="font-bold hover:underline">
                    {{ $notification->data['type'] }}
                </a>
            @elseif($notification->type == "App\Notifications\RecievedComment")
                commented on your
                <a href="{{ $notification->data['post_link'] }}" class="font-bold hover:underline">
                    post
                </a>
            @endif

            <time-stamp :timestamp="'{{ $notification->created_at->format('c') }}'"
                class-style="block text-xs font-thin">
            </time-stamp>
        </div>
    </div>
@endforeach
