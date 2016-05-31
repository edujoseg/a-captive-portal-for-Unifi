# a-captive-portal-for-Unifi
Another Captive Portal for Unifi connected to WuBook Zak

How to use getInfobR.php

Perform a request as:

$.post("getInfobR.php", { toDate: td, fromDate: fd }, function(result){
			html_out += "<table id='datatable'><tr><th>rcode</th><th>sn</th><th>vat_8</th><th>vat_16</th>	<th>camount</th><th>dpayamount</th><th>gen_doc_type</th><th>get_doc_number</th><th>birthdate</th><th>first_name</th><th>last_name</th><th>cash</th><th>cc</th><th>other</th><th>adults</th><th>th</th><th>dfrom</th><th>dto</th></tr>";
			$.each(result, function(index, obj) {
				html_out += "<tr>";
				$.each(obj, function(key, value) {
					html_out += "<td>" + value + "</td>";
				});
				html_out += "</tr>";
      });
      html_out += "</table>";
			$("#demo").html(html_out);
			$("#downloads").attr("style", "visibility: visible");
}, "json");

where td and fd are start date of reservation and end date of reservation respectively, using format D-M-YYYY.
