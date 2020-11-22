@component('mail::message')
# Your post has new like

{{ $liker->username }} has liked your post

@component('mail::button', ['url' => route('posts.show', $post)])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
