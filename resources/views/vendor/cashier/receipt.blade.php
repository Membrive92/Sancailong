<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Invoice</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin-right: 20%;
            font-size: 20px;
        }
        address{
            margin-top:15px;
        }
        h2 {
            font-size:28px;
            color:#cccccc;
        }
        .container {
            padding-top:30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .logo {
            padding-bottom: 10px;
        }
        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }
        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }
        .well {
            margin-top: 15px;
        }

    </style>
</head>

<body >
<div class="container" style="margin-right: 20%">
    <table style="margin-left: auto; margin-right: auto" width="550">
        <tr>
            <td width="160">
                &nbsp;
            </td>

            <!-- Organization Name / Image -->
            <td align="left" style="font-size: 40px">
                <strong>{{ $header ?? $vendor }}</strong>
            </td>
        </tr>

        <tr valign="top">
            <!-- Organization Details -->
            <td style="font-size:9px;">

                @if (isset($street))
                    {{ $street }}<br>
                @endif
                @if (isset($location))
                    {{ $location }}<br>
                @endif
                @if (isset($phone))
                    <strong>T</strong> {{ $phone }}<br>
                @endif
                @if (isset($vendorVat))
                    {{ $vendorVat }}<br>
                @endif
                @if (isset($url))
                    <a href="{{ $url }}">{{ $url }}</a>
                @endif
            </td>
            <td style="margin-right: 10%">


        <tr class="receipt" valign="top">
            <td>
                <br><br>
                <strong>Para:</strong> {{ $owner->email ?: $owner->name }}
                <br>
                <strong>Fecha:</strong> {{ $invoice->date()->toFormattedDateString() }}
            </td>


            <td>
                <p>
                    <br><br>
                    <strong>Producto:</strong> {{ $product }}<br>

                    <strong>Numero de Factura:</strong> {{ $id ?? $invoice->id }}<br>
                </p>
            </td>
        </tr>







                <!-- Extra / VAT Information -->
                @if (isset($vat))
                    <p>
                        {{ $vat }}
                    </p>
                @endif

                <br><br>

                <!-- Invoice Table -->
                <table width="100%" class="table" border="0" style="padding-left: 35%; padding-top: 5%">
                    <tr>
                        <th align="left"  >Descripcion</th>
                        <th align="right"  >Fecha</th>
                        <th align="right" >Cantidad</th>
                    </tr>


                    <!-- Display The Invoice Items -->
                    @foreach ($invoice->invoiceItems() as $item)
                        <tr>
                            <td colspan="2">{{ $item->description }}</td>
                            <td>{{ $item->total() }}</td>
                        </tr>
                    @endforeach

                    <!-- Display The Subscriptions -->
                    @foreach ($invoice->subscriptions() as $subscription)
                        <tr>
                            <td>Subscripcion ({{ $subscription->quantity }})</td>
                            <td>
                                {{ $subscription->startDateAsCarbon()->formatLocalized('%B %e, %Y') }} -
                                {{ $subscription->endDateAsCarbon()->formatLocalized('%B %e, %Y') }}
                            </td>
                            <td>{{ $subscription->total() }}</td>
                        </tr>
                    @endforeach

                    <!-- Display The Discount -->
                    @if ($invoice->hasDiscount())
                        <tr>
                            @if ($invoice->discountIsPercentage())
                                <td>{{ $invoice->coupon() }} ({{ $invoice->percentOff() }}% Off)</td>
                            @else
                                <td>{{ $invoice->coupon() }} ({{ $invoice->amountOff() }} Off)</td>
                            @endif
                            <td>&nbsp;</td>
                            <td>-{{ $invoice->discount() }}</td>
                        </tr>
                    @endif

                    <!-- Display The Tax Amount -->
                    @if ($invoice->tax_percent)
                        <tr>
                            <td>Tax ({{ $invoice->tax_percent }}%)</td>
                            <td>&nbsp;</td>
                            <td>{{ Laravel\Cashier\Cashier::formatAmount($invoice->tax) }}</td>
                        </tr>
                    @endif

                    <!-- Display The Final Total -->
                    <tr style="border-top:2px solid #000;">
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>Total</strong></td>
                        <td><strong>{{ $invoice->total() }}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
