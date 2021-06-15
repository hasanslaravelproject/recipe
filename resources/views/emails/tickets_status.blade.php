<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Bus Schedule</title>
    <style>

        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }
        tbody {
            background: white;
        }
        body {
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%; }
        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
            padding: 10px 5px;
        }
        .body {
            width: 100%;
        }
        .container {
            display: block;
            margin: 0 auto !important;
            max-width: 580px;
            padding: 10px;
            width: 580px;
        }
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
        }
        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }
        .wrapper {
            box-sizing: border-box;
            padding: 20px;
        }
        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }
        .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #999999;
            font-size: 12px;
            text-align: center;
        }
        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }
        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }
        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }
        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }
        a {
            color: #3498db;
            text-decoration: underline;
        }
        .btn {
            box-sizing: border-box;
            width: 100%; }
        .btn > tbody > tr > td {
            padding-bottom: 15px; }
        .btn table {
            width: auto;
        }
        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
        }
        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #3498db;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }
        .btn-primary table td {
            background-color: #3498db;
        }
        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }
        .powered-by a {
            text-decoration: none;
        }
        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0;
        }
        .logo {
            background: #009959;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        img {
            text-align: center;
            width: 260px;
            margin: 1% 25%;
        }
        p.intro {
            text-align: center;
            margin: 12px;
            font-size: 30px;
        }
        .footer {
            margin-top: 45px;
        }
        @media only screen and (max-width: 620px) {

            img {
                text-align: center;
                width: 260px;
                margin: 0;
            }

            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }
            table[class=body] .content {
                padding: 0 !important;
            }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }
            table[class=body] .btn table {
                width: 100% !important;
            }
            table[class=body] .btn a {
                width: 100% !important;
            }
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        @media all {
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }
            .btn-primary table td:hover {
                background-color: #34495e !important;
            }
            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }
    </style>
</head>
<body class="">
<span class="preheader">welcome from Bus Schedule.</span>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">
                <table role="presentation" class="main">
                    <tr>
                        <td class="wrapper">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div class="logo">
                                            <center>
                                                <h2 style="color: #fff; padding: 10px;">Bus Schedule</h2>
                                            </center>

                                        </div>
                                        <p class="intro">Hi, {{ $details['first_name'] }}</p>

                                        <p>
                                            Your Ticket Invoce is here:
                                        </p>
                                        <table border="1">
                                            <tr>
                                                <td>First Name : </td>
                                                <td>{{ $details['first_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Last Name : </td>
                                                <td>{{ $details['last_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email : </td>
                                                <td>{{ $details['email'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone : </td>
                                                <td>{{ $details['phone'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Compartment</td>
                                                <td>{{ $details['compartment'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Booking Id</td>
                                                <td>{{ $details['booking_id'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Booking Status</td>
                                                <td>Booked</td>
                                            </tr>
                                            <tr>
                                                <td>Seat</td>
                                                <td>{{ $details['seat_id'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Price</td>
                                                <td>
                                                    @if( $details['s_price'] == 0)
                                                        ${{ $details['price'] }}
                                                    @else
                                                        $<del>{{ $details['price'] }}</del>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Special Price</td>
                                                <td>
                                                    @if( $details['s_price'] == 0)
                                                        Not available
                                                    @else
                                                        $ {{ $details['s_price'] }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment Status</td>
                                                <td>Unpaid</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Method</td>
                                                <td>
                                                    @if($details['payment_method'] == 'online')
                                                        Online
                                                    @else
                                                        Cash
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>

                                        <br>
                                        <br>
                                        <center>
                                            <p style="color: red">This ticket will expired on {{ date($details['created'], strtotime("+2 hours")) }} </p>
                                        </center>
                                        <p class="footer">
                                            <b>Yours, Bus Schedule Team</b><br>
                                            <a href="mailto:support@test.com">support@test.com</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>