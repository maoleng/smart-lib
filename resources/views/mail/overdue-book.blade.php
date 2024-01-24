@php use \Carbon\Carbon; @endphp

@component('mail::message')

    Hello {{ $name }},

    We hope this email finds you well. This is a reminder that you currently have an overdue library book.

    Please return the book as soon as possible to avoid any additional charges. If you have already returned the book, kindly disregard this email.

    <table style="border-collapse: collapse;width: 100%">
        <thead>
        <tr>
            <th style="border: 1px solid #000;">Book</th>
            <th style="border: 1px solid #000;">Borrow Date</th>
            <th style="border: 1px solid #000;">Due Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($borrows as $borrow)
            <tr>
                <td style="border: 1px solid #000;">{{ $borrow->bookInstance->book->title }}</td>
                <td style="border: 1px solid #000;">{{ Carbon::make($borrow->borrow_at)->toDateString() }}</td>
                <td style="border: 1px solid #000;">{{ Carbon::make($borrow->expected_return_at)->toDateString() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


    Thank you for your prompt attention to this matter.

    Thanks,
    Best regards,
    Smart Lib
@endcomponent
