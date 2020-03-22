@component('mail::message')
# New contact request from SnagPodcast.com

### Name:
<p>{{ $data['first-name'] . $data['last-name'] }}</p>

### Email:
{{ $data['email'] }}

### Message:
<p>{{ $data['message'] }}</p>
@endcomponent
