<%@ Page Language="C#" Debug="true"  Async="true"%>
<%@ Import namespace="System.Collections.Generic" %>
<%@ Import namespace="System" %>
<%@ Import namespace="System.Web" %>
<%@ Import namespace="System.Web.Configuration" %>
<%@ Import namespace="System.Web.UI" %>
<%@ Import Namespace="System.Web.UI.WebControls" %>

<%@ Import Namespace="System.Runtime.InteropServices" %>

<!DOCTYPE html>

<script language="c#" runat="server">
 

    public void Page_Load(object sender, EventArgs e)
    {
		
     string tag = CheckParameter("tag");
            string email = CheckParameter("Email");

            if (tag != "" && email != "")
            {
              //  HLDownload.NavigateUrl = "http://" + WebConfigurationManager.AppSettings["thisServerPath"] + @"/checks.aspx?id=" + tag;

                try
                {
                    System.Web.Mail.MailMessage msg = new System.Web.Mail.MailMessage();
                    msg.Body = "A Cloud Coin Check has been issued to you. To cash your check and receive your coins click the following link: " +
                        "http://" + WebConfigurationManager.AppSettings["thisServerPath"] + @"/checks.aspx?id=" + tag;

                    string smtpServer = "localhost"; //WebConfigurationManager.AppSettings["smtpServer"];
                    string userName = "CloudCoin@Protonmail.com";//WebConfigurationManager.AppSettings["smtpLogin"];
                    string password = "EadBdw-Dkqre017434w23A";////WebConfigurationManager.AppSettings["smtpPassword"];
                    string fromEmail = "sean@bank.CloudCoin.global";
                    int port = 1025;

                    int cdoBasic = 1;
                    int cdoSendUsingPort = 2;

                    if (userName.Length > 0)
                    {
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/smtpserver", smtpServer);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/smtpserverport", port);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/sendusing", cdoSendUsingPort);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/smtpauthenticate", cdoBasic);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/sendusername", userName);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/sendpassword", password);
                    }
                    msg.To = "Sean@worthington.net";//CheckParameter("Email");
                    msg.From = fromEmail;
                    msg.Subject = "CloudCoins";
                    msg.BodyEncoding = System.Text.Encoding.UTF8;
                    System.Web.Mail.SmtpMail.SmtpServer = smtpServer;
                    try{
                    System.Web.Mail.SmtpMail.Send(msg);
                        }catch(COMException ce){

                            Response.Write(ce.Message);
                        }

                }
                catch (Exception ex)
                {
                    int x = 0;
                }
            }
            else
            {
                Response.Write( "Mail Failed" );
            }
            

            Response.Write( tag );

/*
 MailMessage myMail = new MailMessage();
    myMail.From = "from@microsoft.com";
    myMail.To = "to@microsoft.com";
    myMail.Subject = "UtilMailMessage001";
    myMail.Priority = MailPriority.Low;
    myMail.BodyFormat = MailFormat.Html;
    myMail.Body = "<html><body>UtilMailMessage001 - success</body></html>";
//MailAttachment myAttachment = new MailAttachment("c:\attach\attach1.txt", MailEncoding.Base64);
myMail.Attachments.Add(myAttachment);
    SmtpMail.SmtpServer = "127.0.0.1";
    SmtpMail.Send(myMail);
*/
        }// end page load

       public string CheckParameter(string param)
        {
            if (Request[param] != null)
                return Request[param];
            else
                return "";
        }

 
	
  
</script>