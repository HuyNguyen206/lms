<x-mail::message>
# Introduction

Your request have been approved

<x-mail::button :url="$link">
Go to your dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
