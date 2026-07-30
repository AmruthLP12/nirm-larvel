@if ($contact)
    <p>{{ trans('plugins/contact::contact.tables.time') }}: <i>{{ $contact->created_at }}</i></p>
    <p>{{ trans('plugins/contact::contact.tables.name') }}: <i>{{ $contact->name }}</i></p>
    <p>{{ trans('plugins/contact::contact.tables.email') }}: <i><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></i></p>
    <p>{{ trans('plugins/contact::contact.tables.phone_number') }}: <i>@if ($contact->phone_number) <a href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number }}</a> @else N/A @endif</i></p>
    <p>{{ trans('plugins/contact::contact.tables.content') }}:</p>
    <pre class="message-content">{{ $contact->content ?: '...' }}</pre>
@endif
