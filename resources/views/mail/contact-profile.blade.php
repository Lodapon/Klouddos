@extends("mail.template")
@section("content.tr")

    <tr>
        <td style="padding: 0px 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">

            <table style="border: none; width: 100%;">
                <tr>
                    <td style="width: 80px;vertical-align: top"><B>Subject</B></td>
                    <td style="text-align: start;width: 5%;vertical-align: top"><B> : </B></td>
                    <td style="text-align: start;vertical-align: top">{{ $textSubject }}</td>
                </tr>
                <tr>
                    <td style="width: 80px;vertical-align: top"><B>E-mail</B></td>
                    <td style="text-align: start;vertical-align: top"><B> : </B></td>
                    <td style="text-align: start;vertical-align: top">{{ $textEmail }}</td>
                </tr>
                <tr>
                    <td style="width: 80px;vertical-align: top"><B>Message</B></td>
                    <td style="text-align: start;vertical-align: top"><B> : </B></td>
                    <td style="text-align: start;vertical-align: top">{{ $textMessage }}</td>
                </tr>
            </table>


            <br/><br/>
        </td>
    </tr>

@endsection