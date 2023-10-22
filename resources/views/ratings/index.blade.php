@foreach($complaints as $complaint)
    <p>{{ $complaint->title }}</p>
    <!-- Add more details or actions as needed -->
@endforeach
@foreach($ratings as $rating)
    <p>{{ $rating->rating_value }}</p>
    <!-- Add more details or actions as needed -->
@endforeach
