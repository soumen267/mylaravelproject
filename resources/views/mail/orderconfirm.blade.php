<html>

<head>
<title></title>
</head>

<body data-gr-ext-installed="" data-new-gr-c-s-check-loaded="14.1071.0">
	<div style="background-color: rgb(242, 242, 242);">&nbsp;
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
			<tbody>
				<tr>
					<td align="left" style="padding-bottom: 8px; padding-left: 2px;" valign="bottom"><span
							style="font-family: &quot;Lucida Grande&quot;,&quot;Lucida Sans&quot;,&quot;Lucida Sans Unicode&quot;,Arial,Helvetica,Verdana,sans-serif; color: rgb(68, 68, 68); font-size: 20px; line-height: 1em ! important;">
							<!--Add Your Company Name Or Logo Here-->
						</span></td>
					<td align="right" style="padding-bottom: 8px;" valign="bottom">
						<div
							style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; color: rgb(68, 68, 68); font-size: 20px; line-height: 1em ! important;">
							Order Confirmation</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="600">
			<tbody>
				<tr>
					<td bgcolor="#ffffff" style="border: 1px solid rgb(227, 227, 227);" width="600">
						<table align="center" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td style="padding: 20px 0pt;">
										<table align="center" border="0" cellpadding="0" cellspacing="0" width="570">
											<tbody>
												<tr>
													<td align="left">
														<div
															style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; color: rgb(0, 0, 0); font-size: 13px; line-height: 0.92em ! important; font-weight: bold;">
															Order Number: <a
																style="color: rgb(0, 0, 0); font-weight: normal;">{{
																$orddata['order_id'] }}</a></div>
													</td>
													<td align="right">
														<div
															style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; color: rgb(0, 0, 0); font-size: 12px; line-height: 1em ! important;">
															Ordered On: {{ \Carbon\Carbon::now() }}</div>
													</td>
												</tr>
												<tr>
													<td colspan="2"
														style="padding-top: 15px; border-bottom: 1px solid rgb(204, 204, 204); font-size: 1px; line-height: 1px;">
														&nbsp;</td>
												</tr>
												<tr>
													<td colspan="2" style="padding: 15px 0pt 34px;">
														<table align="center" border="0" cellpadding="0" cellspacing="0"
															width="548">
															<tbody>
																<tr>
																	<td valign="top" width="45">
																		<div
																			style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; color: rgb(102, 102, 102); font-size: 11px; line-height: 1.45em; padding-right: 5px;">
																			Bill to</div>
																	</td>
																	<td style="border-right: 1px solid rgb(227, 227, 227);"
																		valign="top" width="172">
																		<div
																			style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; color: rgb(0, 0, 0); font-size: 10px; line-height: 1.6em;">
																			{{ $orddata['firstname'] }} {{
																			$orddata['lastname'] }}<br />
																			{{ $orddata['address_1'] }} {{
																			$orddata['address_2'] ?? '' }} {{
																			$orddata['postcode'] }}<br />
																			{{ $orddata['city'] }}, {{
																			$orddata['zone_id'] }}<br />
																			{{ $orddata['country'] }}</div>
																	</td>
																	<td bgcolor="#e5e5e5"
																		style="padding-top: 15px; font-size: 1px; line-height: 1px;"
																		width="1">&nbsp;</td>
																	<td style="padding-left: 22px;" valign="top"
																		width="45">
																		<div
																			style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; color: rgb(102, 102, 102); font-size: 11px; line-height: 1.45em; font-weight: bold; padding-right: 10px;">
																			Ship to</div>
																	</td>
																	<td valign="top" width="154">
																		<div
																			style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; color: rgb(0, 0, 0); font-size: 10px; line-height: 1.6em;">
																			{{ $orddata['firstname'] }} {{
																			$orddata['lastname'] }}<br />
																			{{ $orddata['address_1'] }} {{
																			$orddata['address_2'] }}<br />
																			{{ $orddata['city'] }}, {{
																			$orddata['zone_id'] }} {{
																			$orddata['postcode'] }}<br />
																			{{ $orddata['country'] }}</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>

										<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
											<tbody>
												<tr>
													<td align="left" bgcolor="#2d5e9f"
														style="padding: 6px 0pt 8px 10px; background: none repeat scroll 0% 0% rgb(0, 0, 0);"
														valign="top">
														<div
															style="color: white; font-size: 13px; font-weight: bold; line-height: 1em ! important; font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;">
															Items in Your Order</div>
													</td>
												</tr>
												<tr>
													<td align="left" valign="top">&nbsp;</td>
												</tr>
											</tbody>
										</table>

										<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
											<tbody>
												<tr>
													<td style="padding-top:18px" width="15">&nbsp;</td>
													<td align="left" style="padding-top:18px" valign="top" width="645">
														<div
															style="font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;color:rgb(0,0,0);font-size:12px;line-height:1em;font-weight:bold">
															<br>
															<br>

															<table cellpadding="2" cellspacing="0"
																id="m_-3235369352343845744orderTotalSummary"
																width="100%" style="font-size:inherit">

																<tbody>
																	<tr style="font-weight:bold">

																		<td align="left">Product Name</td>
																		<td align="left">Base</td>
																		<td style="text-align:right;width:48px">Qty</td>
																		<td
																			style="text-align:right;padding-right:8px;width:90px">
																			Price</td>
																	</tr>
																	@foreach ($product as $row)
																	@php
																	$subtotal = 0;
																	$total = 0;
																	$qty = 0;
																	$price = 0;
																	@endphp
																	@foreach ($row->payment as $row)
																	@php
																	$data = [];
																	foreach($productdata as $value){
																	if($value->id == $row->productname){
																	$data = $value->name;
																	}
																	}
																	@endphp
																	<tr>
																		<td>{{ $data ?? '' }}</td>
																		<td>${{ number_format($row['price'], 2) ?? '' }}
																		</td>
																		<td align="right">{{ $row['qty'] }}</td>
																		<td align="right">${{
																			number_format($row['price'], 2) ?? '' }}
																		</td>
																	</tr>
																	@php
																	$qty = $row->qty;
																	$price = $row->price;
																	$subtotal += $qty * $price;
																	$total = $subtotal;
																	@endphp
																	@endforeach
																	@endforeach
																	<tr>
																		<td colspan="4">
																			<h3
																				style="width:100%;border-bottom:1px solid #e5e5e5">
																			</h3>
																		</td>
																	</tr>

																	<tr>
																		<td style="font-weight:bold" colspan="3"
																			align="right">Sub Total</td>
																		<td align="right"><b>${{
																				number_format($subtotal, 2) ?? '0'
																				}}</b></td>
																	</tr>

																	<tr>
																		<td style="font-weight:bold" colspan="3"
																			align="right">Shipping</td>
																		<td align="right"><b>$0.00</b></td>
																	</tr>



																	<tr>
																		<td style="font-weight:bold" colspan="3"
																			align="right">Sales Tax</td>
																		<td align="right"><b> (0.00%) $0.00</b></td>
																	</tr>

																	@if (session()->get('thankyoudata.couponamount'))
																	@php
																	$total = $subtotal -
																	session()->get('thankyoudata.couponamount');
																	@endphp
																	<tr>
																		<td style="font-weight:bold" colspan="3"
																			align="right">Coupon</td>
																		<td align="right"><b>${{
																				number_format(session()->get('thankyoudata.couponamount'),
																				2) ?? '0' }}</b></td>
																	</tr>
																	@endif


																	<tr>
																		<td colspan="4">
																			<h3
																				style="width:100%;border-bottom:1px solid #e5e5e5">
																			</h3>
																		</td>
																	</tr>

																	<tr>
																		<td align="right" colspan="3">
																			<h2>Total Billed</h2>
																		</td>
																		<td align="right">
																			<h2 style="display:inline">${{
																				number_format($total, 2) ?? '0' }}</h2>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
													<td align="right" style="padding-top:18px" valign="top" width="76">
														<div
															style="font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;color:rgb(121,121,121);font-size:11px;line-height:1.09em;padding-left:5px">
															&nbsp;</div>
													</td>
													<td align="right" style="padding-top:18px" valign="top" width="56">
														<div
															style="font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;color:rgb(121,121,121);font-size:11px;line-height:1.09em;padding-left:5px">
															&nbsp;</div>
													</td>
													<td align="right" style="padding-top:18px" valign="top" width="103">
														<div
															style="font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;color:rgb(0,0,0);font-size:12px;line-height:1em;padding-left:5px">
															&nbsp;</div>
													</td>
												</tr>
												<tr>
													<td colspan="5"
														style="padding-top:15px;border-bottom:1px solid rgb(204,204,204);font-size:1px;line-height:1px">
														&nbsp;</td>
												</tr>
												<tr>
													<td style="padding-top:15px" width="15">&nbsp;</td>
													<td align="right" colspan="4" style="padding-top:15px" valign="top"
														width="600">
														<table align="right" border="0" cellpadding="0" cellspacing="0"
															width="205">
															<tbody>
																<tr>
																	<td align="right" style="padding-top:8px"
																		valign="top" width="102">
																		<div
																			style="font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;color:rgb(0,0,0);font-size:12px;line-height:1em;font-weight:bold">
																			Order Total:</div>
																	</td>
																	<td align="right" style="padding-top:8px"
																		valign="top" width="103">
																		<div
																			style="font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;color:rgb(0,0,0);font-size:12px;line-height:1em;font-weight:bold;padding-left:5px">
																			<div align="left">${{ number_format($total,
																				2) ?? '0' }}</div>
																		</div>
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
					</td>
				</tr>
			</tbody>
		</table>

		<p>&nbsp;</p>

		<p>&nbsp;</p>
	</div>
</body>

</html>