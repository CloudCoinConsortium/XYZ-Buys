<%@ Page Language="C#" Debug="true"  Async="true"%>
<%@ Import namespace="System.Web.Configuration" %>
<%@ Import namespace="System" %>
<%@ Import namespace="System.IO" %>
<%@ Import namespace="System.Data.SqlClient" %>
<%@ Import namespace="System.Web.Configuration" %>
<%@ Import namespace="System.Web.Script.Serialization" %>
<%@ Import namespace="System.Security.Cryptography" %>
<%@ Import namespace="System.Threading.Tasks" %>

<script language="c#" runat="server">

    public class ServiceResponse
    {
        public string bank_server;
        public string status;
        public string receipt;
        public string message;
        public string time;
    }//End Service Response class

	
	
	static string path = "";
	//static string path1 = Directory.GetCurrentDirectory();
  //  static FileUtils fileUtils = FileUtils.GetInstance(path1+path+@"\");
    
		static FoundersFileUtils fileUtils = FoundersFileUtils.GetInstance(AppDomain.CurrentDomain.BaseDirectory +path+@"\" );



    public void Page_Load(object sender, EventArgs e)
    {
		ServiceResponse serviceResponse = new ServiceResponse();
	//	pk = Request["pk"];
		string account = Request["account"];

        if ( account == "")
        {
            //Response.Write("Request Error: Private key or Account ID not specified");
            //Response.End();
            serviceResponse.message = "Request Error: Private key or Account ID not specified";
            var json = new JavaScriptSerializer().Serialize(serviceResponse);
            Response.Write(json);
            Response.End();
        }

		
		string PasswordFolder = WebConfigurationManager.AppSettings["PasswordFolder"];
		//check if file exists
		if (System.IO.File.Exists( Server.MapPath("..") + @"\accounts\" + PasswordFolder + @"\" + account + @".txt")){
		string pk = System.IO.File.ReadAllText( Server.MapPath("..") + @"\accounts\" + PasswordFolder + @"\" + account + @".txt");
		
		
		
		//serviceResponse.account = account;
		
/*      
	  if ( fileContents != pk )
        {
            serviceResponse.status = "fail";
            serviceResponse.message = "Private key not correct";
            var serialjson = new JavaScriptSerializer().Serialize(serviceResponse);
            Response.Write(serialjson);
            Response.End();
        }
	*/	
	//Response.Write( Server.MapPath("..") + @"\accounts\" + pk );
     //       Response.End();
	fileUtils = FoundersFileUtils.GetInstance(Server.MapPath("..") + @"\accounts\" + pk + @"\");
	

//Move any left over files from import folder to failed import folder. 

    empty_import_folder( fileUtils.importFolder , fileUtils.importFolder + @"/failed_import" );


        string stack = Request.Form["stack"];
        Importer importer = new Importer(fileUtils);
        
        if (stack == null || stack =="")
		{
           ServiceResponse response = new ServiceResponse();
            response.bank_server = WebConfigurationManager.AppSettings["thisServerName"];
            response.status = "error";
        //    response.message = stack;
			response.message = "The CloudCoin stack was empty or not included in the post.";
            response.time = DateTime.UtcNow.ToString("o");
            response.receipt = "";
            var json = new JavaScriptSerializer().Serialize(response);
            Response.Write(json);
            Response.End();	
		}
			string import = "false";
			import = importer.importJson(stack);
		
        if ( import != "true")//Moves all CloudCoins from the Import folder into the Suspect folder. 
        {
            ServiceResponse response = new ServiceResponse();
            response.bank_server = WebConfigurationManager.AppSettings["thisServerName"];
            response.status = "error";
        //    response.message = stack;
			response.message = "Error:" + import;
            response.time = DateTime.UtcNow.ToString("o");
            response.receipt = "";
            var json = new JavaScriptSerializer().Serialize(response);
            Response.Write(json);
            Response.End();
        }
		
        else
        {
           RegisterAsyncTask(new PageAsyncTask(detect));
        }//end if coins to import

		}else{
			serviceResponse.status = "fail";
            serviceResponse.message = "Account not correct";
            var serialjson = new JavaScriptSerializer().Serialize(serviceResponse);
            Response.Write(serialjson);
            Response.End();
		
		}
		
		
    }//End Page Load

    private void empty_import_folder( String fromDirectory, String toDirectory )
    {
        //This will move all files in the import folder to the failed_import folder.
        //If we don't do this, the receipt will not be acurate
        DirectoryInfo dirInfo = new DirectoryInfo(toDirectory);
        if (dirInfo.Exists == false)
            Directory.CreateDirectory(toDirectory);

        List<String> allFiles = Directory
                           .GetFiles( fromDirectory, "*.*", SearchOption.AllDirectories).ToList();

        foreach (string file in allFiles)
        {
            FileInfo mFile = new FileInfo(file);
            // to remove name collisions
            if (new FileInfo(dirInfo + "\\" + mFile.Name).Exists == false) 
            {
                 mFile.MoveTo(dirInfo + "\\" + mFile.Name);
            }
        }
    }// end for empty import folder





    private async Task detect()
    {
        string receiptFileName = await multi_detect();
        ServiceResponse response = new ServiceResponse();
        response.bank_server = WebConfigurationManager.AppSettings["thisServerName"];
        response.receipt = receiptFileName;
        response.status = "importing";
        response.message = "The stack file has been imported and detection will begin automatically so long as they are not already in bank. Please check your receipt.";
        response.time = DateTime.UtcNow.ToString("o");
        Grader grader = new Grader(fileUtils);
        int[] detectionResults = grader.gradeAll(5000, 2000, receiptFileName);
        var json = new JavaScriptSerializer().Serialize(response);
        Response.Write(json);
        Response.End();
    }


    public static async Task<string> multi_detect() 
    {

        MultiDetect multi_detector = new MultiDetect(fileUtils);
        string receiptFileName;
        using (var rng = RandomNumberGenerator.Create())
        {
            byte[] cryptoRandomBuffer = new byte[16];
            rng.GetBytes(cryptoRandomBuffer);

            Guid pan = new Guid(cryptoRandomBuffer);
            receiptFileName = pan.ToString("N");
        }

        //Calculate timeout
        int detectTime = 20000;  

        await multi_detector.detectMulti(detectTime, receiptFileName);
        return receiptFileName;
    }//end multi detect

</script>