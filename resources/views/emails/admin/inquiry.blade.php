<x-mail::message>
# New General Inquiry Received

A new general inquiry has been submitted via the RYB Vehicle Trading Contact portal.

**From:** {{ $inquiry->user->name }} ({{ $inquiry->user->email }})
**Subject:** {{ $inquiry->subject }}

**Message Details:**
<x-mail::panel>
{{ $inquiry->message }}
</x-mail::panel>

<x-mail::button :url="url('/admin/inquiries')">
View in Admin Panel
</x-mail::button>

Thanks,<br>
RYB System Automations
</x-mail::message>