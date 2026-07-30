{{ header }}

<table width="100%">
    <tbody>
        <tr>
            <td class="wrapper" width="700" align="center">
                <table class="section" cellpadding="0" cellspacing="0" width="700" bgcolor="#f8f8f8">
                    <tr>
                        <td class="column" align="left">
                            <table>
                                <tbody>
                                <tr>
                                    <td align="left" style="padding: 20px 50px;">
                                        <p><strong>New application submitted:</strong></p>
                                        <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/person.png"
                                                alt="Name" width="20" style="margin-right: 10px;" /> {{ applicant_name }}</p>
                                        <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/order.png"
                                                alt="Application No" width="20" style="margin-right: 10px;" /> {{ application_no }}</p>
                                        <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/email.png"
                                                alt="Post" width="20" style="margin-right: 10px;" /> {{ post_applied }}</p>
                                        <p><img src="{{ site_url }}/vendor/core/core/base/images/emails/calendar.png"
                                                alt="Submitted" width="20" style="margin-right: 10px;" /> {{ submitted_at }}</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
{{ footer }}
