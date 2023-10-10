@component('mail::message')
# {{ $task }}

Limit Date: {{ $limit_date }}

@component('mail::button', ['url' => $url])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
