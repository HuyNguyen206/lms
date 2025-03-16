<x-mail::message>
# Introduction

Sorry, your request has been rejected

<x-mail::button :url="$link">
Go to your dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
