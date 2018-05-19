<?php
$currency = Config::get('params.currency');
$orderPrefix = Config::get('params.order_prefix');
?>
<table style="width:100.0%" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td style="padding:0in 0in 0in 0in" valign="top">
                <p style="margin-top:0in;text-align:center" align="center"><img src="{{asset('')}}/front/images/email_logo.png" alt="{{ Config::get('params.site_name') }}" border="0" ><u></u><u></u></p>
                <div align="center">
                    <table style="width:6.25in;background:#fdfdfd;border:solid gainsboro 1.0pt;border-radius:6px!important" border="1" cellpadding="0" cellspacing="0" width="600">
                        <tbody>
                            <tr>
                                <td style="border:none;padding:0in 0in 0in 0in" valign="top">
                                    <div align="center">
                                        <table style="width:6.25in;background:#557da1;border-top-left-radius:6px!important;border-top-right-radius:6px!important;border-radius:3px 3px 0 0!important" border="0" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:0in 0in 0in 0in">
                                                        <h1 style="margin:0in;margin-bottom:.0001pt;line-height:150%"><span style="font-size:22.5pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:white">New customer order<u></u><u></u></span></h1>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="border:none;padding:0in 0in 0in 0in;border-radius:6px!important" valign="top">
                                    <div align="center">
                                        <table border="0" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td style="background:#fdfdfd;padding:0in 0in 0in 0in" valign="top">
                                                        <table style="width:100.0%;border-radius:6px!important" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding:15.0pt 15.0pt 15.0pt 15.0pt" valign="top">
                                                                        @if($message!="")
                                                                        <p style="line-height:150%"><span style="font-size:10.5pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:#737373"> {{ $message }} </span></p> @else
                                                                        Your lab order will be emailed to you within a 4 hour window of your order, during our hours of operation 8 AM PST to 10 PM PST. Please note if you have ordered a doctor consult, you must wait until your final results are complete before communication. We look forward to serving you! Tel.: <a href="tel:(800)%20519-2997" value="+18005192997" target="_blank">+1-800-519-2997</a> <a href="mailto:customerservice@newcenturylabs.com" target="_blank">customerservice@newcenturylabs.com</a>
                                                                        <p></p>


                                                                        @endif

                                                                        <h2 style="margin-right:0in;margin-bottom:6.0pt;margin-left:0in;line-height:130%"><span style="font-size:13.5pt;line-height:130%;font-family:&quot;Helvetica&quot;,sans-serif;color:#557da1"><a href="{{$link}}" target="_blank"><span style="color:#557da1;font-weight:normal">Order: {{$id}}</span></a>
                                                                                ({{date('F d Y',strtotime($order->orderDate))}})</span></h2>
                                                                        <table style="width:100.0%;border:solid #eeeeee 1.0pt" border="1" cellpadding="0" cellspacing="0" width="100%">
                                                                            <thead><tr>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><b>Product</b></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><b>Quantity</b></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><b>Price</b></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </thead><tbody>


                                                                                <?php
                                                                                $sum = 0;
                                                                                $i = 0;
                                                                                ?>
                                                                                @foreach ($order->products as $product)
                                                                                <?php
                                                                                $rowTotal = $product->price * $product->quantity;
                                                                                $sum += $rowTotal;
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt;word-wrap:break-word">
                                                                                        <p><?php echo $product->name; ?></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal">1<u></u><u></u></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p ><span>{{ $currency[Config::get('params.currency_default')]['symbol']}}</span><span ><?php echo $product->price ?></span></p>
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach


                                                                                <tr>
                                                                                    <td colspan="2" style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><b>Gender:</b></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><span></span><span>@if($order->gender=='f') Female @else Male @endif

                                                                                            </span><u></u><u></u></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2" style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><b>D.O.B.<u></u><u></u></b></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><span>{{date('F d Y',strtotime($order->dob))}}</span><u></u><u></u></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2" style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><b>Payment
                                                                                                Method:<u></u><u></u></b></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal">Credit
                                                                                            Card<u></u><u></u></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2" style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><b>Total:<u></u><u></u></b></p>
                                                                                    </td>
                                                                                    <td style="border:solid #eeeeee 1.0pt;padding:4.5pt 4.5pt 4.5pt 4.5pt">
                                                                                        <p class="MsoNormal"><span >{{ $currency[Config::get('params.currency_default')]['symbol']}}</span><span>{{$order->grandTotal}}</span><u></u><u></u></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <h2 style="margin-right:0in;margin-bottom:6.0pt;margin-left:0in;line-height:130%"><span style="font-size:13.5pt;line-height:130%;font-family:&quot;Helvetica&quot;,sans-serif;color:#557da1">Customer details</span></h2>
                                                                        <p style="line-height:150%"><strong><span style="font-size:10.5pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:#737373">Email:</span></strong><span style="font-size:10.5pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:#737373">
                                                                                <a href="mailto:{{$order->email}}" target="_blank">{{$order->email}}</a></span></p>
                                                                        <p style="line-height:150%"><strong><span style="font-size:10.5pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:#737373">Tel:</span></strong><span style="font-size:10.5pt;line-height:150%;font-family:&quot;Arial&quot;,sans-serif;color:#737373">
                                                                                <a href="tel:{{$order->phone}}" value="+{{$order->phone}}" target="_blank">{{$order->phone}}</a></span></p>
                                                                        <table  style="width:100.0%" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="width:50.0%;padding:0in 0in 0in 0in" valign="top" width="50%">
                                                                                        <h3 style="margin-right:0in;margin-bottom:6.0pt;margin-left:0in;line-height:130%"><span style="font-size:12.0pt;line-height:130%;font-family:&quot;Helvetica&quot;,sans-serif;color:#557da1">Billing
                                                                                                address</span></h3>
                                                                                        <p>{{$order->patientName}}<br>
                                                                                            {{$order->address}}<br>
                                                                                            {{$order->address2}}<br>
                                                                                            {{$order->zip}}<br/>
                                                                                            {{$order->city}}, {{$order->state}}, {{$order->country}} <br>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="border:none;padding:0in 0in 0in 0in" valign="top">
                                    <div align="center">
                                        {{ Config::get('params.site_name') }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="yj6qo"><strong>HIPAA Notice</strong>
    <p>
        The contents of this message, together with any attachments, are intended only for the use of the person(s) to which they are addressed and may contain confidential and/or privileged information. Further, any medical information herein is confidential and protected by law. It is unlawful for unauthorized persons to use, review, copy, disclose, or disseminate confidential medical information. If you are not the intended recipient, immediately advise the sender and delete this message and any attachments. Any distribution, or copying of this message, or any attachment, is prohibited.</p></div>





