@php use \Carbon\Carbon; @endphp

@component('mail::message')

    Hello {{ $name }},

    We hope this email finds you well. This is a reminder that you currently have an overdue library book.

    Please return the book as soon as possible to avoid any additional charges. If you have already returned the book, kindly disregard this email.

@component('mail::table')
| No.  | Book                               | Borrow Date      | Due Date           |
|:----:|:----------------------------------:|:----------------:|:------------------:|
@foreach($borrows as $i => $borrow)
| {{ $i + 1 }} | {{ $borrow->bookInstance->book->title }} | {{ Carbon::make($borrow->borrow_at)->toDateString() }} | {{ Carbon::make($borrow->expected_return_at)->toDateString() }}
@endforeach
@endcomponent


    Thank you for your prompt attention to this matter.

    Thanks,
    Best regards,
    Smart Lib
@endcomponent
