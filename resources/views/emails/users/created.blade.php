@extends('emails.layouts.app')

@section('content')
    <div class="content">
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="container590">
            <tr>
                <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                    <!-- section text ======-->

                    <p style="line-height: 24px; margin-bottom:15px;">
                        Dear customer!
                    </p>

                    <p style="line-height: 24px; margin-bottom:20px;">
                        Thank you for requesting your access data {{ $team?->display_name }}. You can easily log in to your profile via the following link.
                        <br><br>
                        <a href="{{ $url }}">Login Link</a>
                        <br><br>
                        Thank you for using our {{ $team?->display_name }}!.
                    </p>

                    @include('emails.layouts.footer', ['url' => $url])
                </td>
            </tr>
        </table>
    </div>
@endsection

