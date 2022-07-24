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
                        You have successfully applied for the position  {{ $applicant->job?->name }}. One of our specialists in this category will contact you shortly.
                        <br><br>
                        By clicking on the following link, you can connect to the job search portal:
                        <br><br>
                        <a href="{{ $url }}">Login Link</a>
                        <br><br>
                        Thank you for using our {{ $team?->display_name }} Portal!.
                    </p>

                    @include('emails.layouts.footer', ['url' => $url])
                </td>
            </tr>
        </table>
    </div>
@endsection

