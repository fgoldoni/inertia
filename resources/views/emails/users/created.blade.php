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
                        Thank you for requesting your access data {{ env('APP_NAME', 'Wedo37') }}. You can easily log in to your profile via the following link.
                        <br><br>
                        <a href="{{ $url }}">Login Link</a>
                        <br><br>
                        Thank you for using our {{ env('APP_NAME', 'Wedo37') }}!.
                    </p>

                    @include('emails.layouts.footer', ['url' => $url])
                </td>
            </tr>
        </table>
    </div>
@endsection

