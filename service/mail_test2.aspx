<%@ Page Language="C#" Debug="true"  Async="true"%>
<%@ Import namespace="System.Collections.Generic" %>
<%@ Import namespace="System" %>
<%@ Import namespace="System.Web" %>
<%@ Import namespace="System.Web.Configuration" %>
<%@ Import namespace="System.Web.UI" %>
<%@ Import namespace="System.Web.UI.WebControls" %>
<%@ Import namespace="System.Runtime.InteropServices" %>
<%@ Import namespace="System.Net.Mail" %>



<!DOCTYPE html>

<script language="c#" runat="server">
 

    public void Page_Load(object sender, EventArgs e)
    {
		
        SmtpClient smtpClient = new SmtpClient("127.0.0.1", 25);

        //smtpClient.Credentials = new System.Net.NetworkCredential("CloudCoinBanker@protonmail.com", "_GpEhmWLTd9QtyTh-e_YLg");
        smtpClient.UseDefaultCredentials = false;
        smtpClient.DeliveryMethod = SmtpDeliveryMethod.Network;
        smtpClient.EnableSsl = false;
        MailMessage mail = new MailMessage();

        //Setting From , To and CC
        mail.From = new MailAddress("Sean@Cloudcoin.global", "Learn.CloudCoin.Global");
        mail.To.Add(new MailAddress("sean@worthington.net"));
        mail.CC.Add(new MailAddress("sean.worthington@gmail.com"));

        smtpClient.Send(mail);
            

            Response.Write( "done" );


        }// end page load


	
  
</script>