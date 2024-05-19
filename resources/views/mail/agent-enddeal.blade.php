@extends("mail.template")
@section("content.tr")

    <tr>
        <td style="padding: 0px 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
            <h1 style="margin: 0 0 10px; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">Congratulation, {{ $hotelName }}</h1>
            <h2 style="margin: 0 0 10px; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">{{ $forumTopic }}</h2>
            <p style="margin: 0 0 10px;">Your forum & quotation was dealt by <B>{{ $agentName }}</B>.</p>
            <br/><br/>
        </td>
    </tr>
    <tr>
        <td style="padding: 0 20px 20px;">
            <br/>
            <!-- Button : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                <tbody>
                <tr>
                    <td style="border-radius: 4px; text-align: center">
                        <h3>This deal is yours! Continue contact directly.</h3>
                        <p style="font-weight: bold">{{ $agentName }}</p>
                        <p>{{ $agentTel }}</p>
                        <p>{{ $agentEmail }}</p>

                    </td>
                </tr>
                </tbody>
            </table>
            <!-- Button : END -->
        </td>
    </tr>

@endsection