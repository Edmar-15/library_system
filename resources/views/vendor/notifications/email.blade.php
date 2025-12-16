<x-mail::message>

{{-- Greeting --}}
<h1 style="color:#3A2F28;margin-bottom:16px;">
    {{ $greeting ?? 'Hello!' }}
</h1>

{{-- Intro Lines --}}
@foreach ($introLines as $line)
<p style="color:#7B6754;font-size:15px;line-height:1.6;margin:0 0 12px 0;">
    {{ $line }}
</p>
@endforeach

{{-- Action Button --}}
@isset($actionText)
<table role="presentation" cellpadding="0" cellspacing="0" style="margin:24px 0;">
    <tr>
        <td align="center">
            <a href="{{ $actionUrl }}"
               style="
                    background-color:#E07B16;
                    border:1px solid #E07B16;
                    border-radius:6px;
                    color:#FFFFFF;
                    display:inline-block;
                    font-size:16px;
                    font-weight:600;
                    padding:12px 24px;
                    text-decoration:none;
               ">
                {{ $actionText }}
            </a>
        </td>
    </tr>
</table>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
<p style="color:#7B6754;font-size:14px;line-height:1.6;margin:0 0 12px 0;">
    {{ $line }}
</p>
@endforeach

{{-- Salutation --}}
<p style="color:#3A2F28;font-size:14px;margin-top:24px;">
    Regards,<br>
    <strong>{{ config('app.name') }}</strong>
</p>

{{-- Subcopy --}}
@isset($actionText)
<hr style="border:none;border-top:1px solid #E6D4B8;margin:24px 0;">

<p style="color:#7B6754;font-size:12px;line-height:1.6;">
    If you're having trouble clicking the "{{ $actionText }}" button, copy and paste this URL into your browser:
</p>

<p style="font-size:12px;word-break:break-all;">
    <a href="{{ $actionUrl }}" style="color:#E07B16;">
        {{ $displayableActionUrl }}
    </a>
</p>
@endisset

</x-mail::message>
