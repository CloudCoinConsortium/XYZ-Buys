<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="OrderSuccess.aspx.cs" Inherits="OrderSuccess" %>

<!DOCTYPE html>
<link href="GPOrder.css" rel="stylesheet" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div class="col-50">
            <div id="PurchaseInfo" class="container">
                <div id="PurchaseInfoHeader"><h2>Your Order</h2></div>
                <p><span class="PIText">The check cleared successfully, please click on the link below to download your coins. </span></p>
                <p><span class="PIText">A copy has also been sent to your email address. </span></p>
                <svg class="checkmark" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
                <hr />
                <p><span class="PIText">Download: </span><asp:HyperLink id="HLDownload" runat="server" style="color: deepskyblue;" Text="Stack File"></asp:HyperLink> </p>
                
            </div>
        </div>
    </form>
</body>
</html>
