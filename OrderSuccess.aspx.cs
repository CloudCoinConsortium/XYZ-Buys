using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class OrderSuccess : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

            string tag = CheckParameter("tag");
            string email = CheckParameter("Email");

            if (tag != "" && email != "")
            {
                HLDownload.NavigateUrl = "http://" + WebConfigurationManager.AppSettings["thisServerPath"] + @"/checks.aspx?id=" + tag;

                try
                {
                    System.Web.Mail.MailMessage msg = new System.Web.Mail.MailMessage();
                    msg.Body = "A Cloud Coin Check has been issued to you. To cash your check and receive your coins click the following link: " +
                        "http://" + WebConfigurationManager.AppSettings["thisServerPath"] + @"/checks.aspx?id=" + tag;

                    string smtpServer = WebConfigurationManager.AppSettings["smtpServer"];
                    string userName = WebConfigurationManager.AppSettings["smtpLogin"];
                    string password = WebConfigurationManager.AppSettings["smtpPassword"];
                    int cdoBasic = 1;
                    int cdoSendUsingPort = 2;
                    if (userName.Length > 0)
                    {
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/smtpserver", smtpServer);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/smtpserverport", int.Parse(WebConfigurationManager.AppSettings["smtpPort"]));
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/sendusing", cdoSendUsingPort);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/smtpauthenticate", cdoBasic);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/sendusername", userName);
                        msg.Fields.Add("http://schemas.microsoft.com/cdo/configuration/sendpassword", password);
                    }
                    msg.To = CheckParameter("Email");
                    msg.From = WebConfigurationManager.AppSettings["FromEmail"];
                    msg.Subject = "CloudCoins";
                    msg.BodyEncoding = System.Text.Encoding.UTF8;
                    System.Web.Mail.SmtpMail.SmtpServer = smtpServer;
                    System.Web.Mail.SmtpMail.Send(msg);
                }
                catch (Exception ex)
                {
                    int x = 0;
                }
            }
            else
            {
                //Response.Redirect("OrderFailure.aspx");
            }
            
        }

        string CheckParameter(string param)
        {
            if (Request[param] != null)
                return Request[param];
            else
                return "";
        }
    }
