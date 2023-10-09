@foreach($posts as $post)
    <p>{{ $post->title }}</p>
    <p>{{ $post->content }}</p>
    <!-- Add more details or actions as needed -->
@endforeach