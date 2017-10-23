<?php
    /*
    
    @author     David
    @copyright  2016 Multivitamin <multivitamin.wtf>
    @license    GPLv3 http://www.gnu.org/licenses/gpl.html
    @version    1.2beta

    Textfields Available Placeholders
        TEAMSPEAK:
            %status% - Displays online or offline
            %sid% - Displays Server ID currently used
            %sport% - Displays Server Port
            %platform% - Displays on wich Platform the Server runs
            %servername% - Displays the Server Name (top channel name)
            %serverversion% - Displays the Server Version
            %maxclients% - Displays Slots Available
            %realclients% - Displays Clients only 
            %clientsonline% - Displays amount of Clients online (Couns Queries aswell!)
            %channelcount% - Displays amount of channels
            %packetloss% - Displays average Packetloss (Like: 4.2134)
            %packetloss_00% - Displays average Packetloss (Like: 4.21)
            %packetloss_floored% - Displays average Packetloss (Like: 4)
            %ping% - Diplays Average Ping (Like:  64.2414)
            %ping_floored% - Diplays Average Ping floored (Like: 64)
            %nickname% - Displays the Nickname of the Client which is requesting the Banner
            %groupcount[<servergroupids>]% - Counts the Groups in the Square Brackets write it like '2,6' where 2 and 6 is a Server Group ID
        GENERAL
            %timeHi% - Displays Time in Hour:Minute Format
            %timeHis% - Displays Time in Hour:Minute:Second Format
            %date% - Displays Date in day.month.Year Format
        SOURCEQUERY
            %sqinfo[<server>][<key>]% - Displays the specified Info Key for the specified Server you have entered
            
        
    INFO for %nickname%:
        If you have a Textfield where you want to use the placeholder %nickname% then you are not able to use
        other Placeholders since this gets rendered individually for every client!

    What is SourceQuery?
        The SourceQuery PHP Library was written by xPAW (https://github.com/xPaw/PHP-Source-Query)
        It can access Informations of a Server which uses the Source Protocol 
        You can find a List of Supported Games in the Link above!
        
    Usage of %sqinfo[<server>][<key>]%
        The First Parameter <server> defines the server you want to use, this will be explained later how to login to a Server
        The Second Parameter <key> defines the Server Information you want to access, instructions on how to get all available Keys for a Server
        is also explained later in this config file
        
    IMPORTANT!
        CURRENTLY SUPPORTED FORMAT FOR BACKGROUND IMAGE IS .PNG ONLY!
        You need to give the folger cache/ write Permissions! 
        On Standard Debian Configuration you can do this while inside Banner Folder with the Command: 
                chown -R www-data cache
        
    TEAMSPEAK:
        Add in Teamspeak "Banner Gfx Url" the Web Path to your banner.php
        Change the "Gfx Interval" to 60 so the Client requests a new Banner every 60 Seconds!
        PERMISSIONS:
            b_virtualserver_servergroup_list
            b_serverinstance_version_view
            b_serverinstance_info_view
            b_virtualserver_connectioninfo_view
            b_virtualserver_client_list
            b_client_remoteaddress_view - For Nickname display
                and probably some more.... I will edit this List later lol....
   
    DIFFERENT FONTS:
        Currently available Fonts inside the "font" Folder is
            - arial.ttf
            - bank.ttf
            - neuropoliticalrg.ttf
        You can download fonts for example from http://www.dafont.com
        
        
    REQUIREMENTS
        PHP Version 5.5 or greater
        Web Server with php5-gd installed (apt-get install php5-gd)
        If SourceQuery is enabled it will need php5-gmp to operate!
            
        
            
    */
    
    $config = array('textfield' => [], 'sourcequery' => []);

    /*
    ** Teamspeak Configurations
    */

    $config['teamspeak']['ip'] = '<YOUR TEAMSPEAK IP>';
    $config['teamspeak']['queryport'] = '10011';
    $config['teamspeak']['serverport'] = '<YOUR TEAMSPEAK PORT>'; 
    $config['teamspeak']['loginname'] = 'serveradmin';
    $config['teamspeak']['loginpass'] = '<QUERY PASSWORD>';
    $config['backgroundimage'] = '<BACKGROUND TEMPLATE>';
    $config['syncintervall'] = 120;
    $config['sqenable'] = false;
    $config['sqlistfont'] = 'font/arial.ttf';
    
    /*
        Source Query Integration
        Uses Library from https://github.com/xPaw/PHP-Source-Query
        A List of Supported Games in the link above
    
     Example for SourceQuery*/
    
    /*
        $config['sourcequery']['server1'] = [
            //IP from Server
            'ip' => '5.104.104.99',
            //Port for Source Query
            'port' => '2303',
            //Timeout
            'timeout' => 1,
            //with this on true it will List all Available fields you can use directly on the banner
            'debug' => false,
        ];
        
    */

    /*
    ** Textfields
    ** text         = The Text which should be in the Field (all Available Placeholders on top of the config.php)
    ** xpos         = The X Position where the Textfield is located (in Pixel)
    ** ypos         = The Y Position where the Textfield is located (in Pixel)
    ** fontsize     = The Fontsize the Text should have
    ** fontfile     = The Font you want to use for the Text
    ** color        = Hex Color of the Font (Like: #34495e)
    
    ** EMPTY PRESET
    
        $config['textfield'][] = [
            'text' => '',
            'xpos' => '',
            'ypos' => '',
            'fontsize' => '',
            'fontfile' => 'font/bank.ttf',
            'color' => '',
        ];
        
    */ 
    $config['textfield'][] = [
        'text' => 'Date: %date%',
        'xpos' => '25',
        'ypos' => '50',
        'fontsize' => '24',
        'fontfile' => 'font/bank.ttf',
        'color' => '#ecf0f1',
    ];
    
    $config['textfield'][] = [
        'text' => 'Time: %timeHi%',
        'xpos' => '525',
        'ypos' => '50',
        'fontsize' => '24',
        'fontfile' => 'font/bank.ttf',
        'color' => '#ecf0f1',
    ];
    
    $config['textfield'][] = [
        'text' => '%realclients% mates online',
        'xpos' => '450',
        'ypos' => '350',
        'fontsize' => '24',
        'fontfile' => 'font/bank.ttf',
        'color' => '#ecf0f1',
    ];
	$config['textfield'][] = [
        'text' => 'Ping: %ping_floored% ms',
        'xpos' => '25',
        'ypos' => '350',
        'fontsize' => '24',
        'fontfile' => 'font/bank.ttf',
        'color' => '#ecf0f1',
    ];
    
    $config['textfield'][] = [
        'text' => 'Hello %nickname% <3',
        'xpos' => '250',
        'ypos' => '250',
        'fontsize' => '24',
        'fontfile' => 'font/bank.ttf',
        'color' => '#e74c3c',
    ];