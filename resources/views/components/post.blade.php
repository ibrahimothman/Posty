@props(['post' => $post])

<a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

<p class="mb-2">{{ $post->body }} </p>

<div>
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-1">
            @csrf
            @method('delete')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>

    @endcan
</div>
<div class="flex items-center">
    @auth
        @if ($post->likedByUser(auth()->user()))
            <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">Unlike</button>
            </form>

        @else
            <form action="{{ route('posts.like', ['post' => $post->id]) }}" method="post" class="mr-1">
                @csrf
                <button type="submit" class="text-blue-500">Like</button>
            </form>

        @endif

    @endauth

    <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
</div>
