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

    
	
	
	static string path = "";
	//static string path1 = Directory.GetCurrentDirectory();
  //  static FileUtils fileUtils = FileUtils.GetInstance(path1+path+@"\");
    
		static FoundersFileUtils fileUtils = FoundersFileUtils.GetInstance(AppDomain.CurrentDomain.BaseDirectory +path+@"\" );



    public void Page_Load(object sender, EventArgs e)
    {
		
		string account = "depository";

       
		
		string PasswordFolder = WebConfigurationManager.AppSettings["PasswordFolder"];
		//check if file exists
		if (System.IO.File.Exists( Server.MapPath("..") + @"\accounts\" + PasswordFolder + @"\" + account + @".txt"))
        {
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

      Response.Write("done");
            Response.End();


		}//end if accounts exists
		
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







</script>