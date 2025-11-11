
# **IoT Software Simulation Assessment**

This is a repository containing a IoT Software Simulation Assessment

---

# **Description**

To design and simulate an Internet of Things (IoT) system capable of reading real-time temperature and humidity data using a DHT11 sensor and transmitting the data wirelessly through the NodeMCU ESP8266 microcontroller to a local server.

---

# **Table Of Content**

- [Installation](#installation)
- [Backend](#backend)
- [Simulator](#simulator)
- [Dashboard](#dashboard)
- [Design](#design)

---

# **Installation**

## **Step 1.0**

Go to the official Arduino website:
👉 https://www.arduino.cc/en/software

Download the installer

Choose Windows Installer (.exe) if you have admin rights.

Or choose Windows ZIP file if you want a portable version.

![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/Install%20arduino%20ide.PNG?raw=true)

---

## **Step 2.0**

## **Step 2.1: Add ESP8266 Board URL to Arduino IDE**

The Arduino IDE doesn’t include the ESP8266 by default — you must add its board package.

In the Arduino IDE, go to:
File → Preferences

Look for the box labeled “Additional Boards Manager URLs.”

Paste the following link inside the box:

https://arduino.esp8266.com/stable/package_esp8266com_index.json


Click OK to save.

✅ Tip: If you already have other URLs there, separate them with a comma (,).

![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/arduino%20ide%20reference.PNG?raw=true)

## **Step 2.2: Install ESP8266 Board Package**

Now go to:
Tools → Board → Boards Manager…

In the search bar, type “ESP8266”.

Find “esp8266 by ESP8266 Community.”

Click Install.

Wait for it to finish downloading (it may take several minutes depending on your internet speed).

Close the Boards Manager once complete.

## **Step 2.3: Select the NodeMCU Board**

Go to:
Tools → Board → ESP8266 Boards → NodeMCU 1.0 (ESP-12E Module)

Then verify the following under the Tools menu:

Flash Size: 4M (3M SPIFFS)

CPU Frequency: 80 MHz

Upload Speed: 115200

Port: Choose the COM port that appears when you plug in your NodeMCU

(If you’re not sure which port, unplug the NodeMCU and see which COM disappears — that’s the one.)

## **Step 2.4: Install USB Driver (if needed)**

Sometimes the computer doesn’t detect the NodeMCU until the USB driver is installed.

✅ For CP2102 (most common):

Download from:
👉 https://www.silabs.com/developers/usb-to-uart-bridge-vcp-drivers

✅ For CH340 (some cheaper NodeMCUs):

Download from:
👉 https://sparks.gogo.co.nz/ch340.html

After installing the driver:

Reconnect your NodeMCU.

Open Arduino IDE → Tools → Port → select the new COM port.

## **Step 2.5: Test the Installation**

Go to File → Examples → ESP8266 → Blink (or create a simple LED blink sketch).

Click the Upload (→) button.

Wait for the IDE to compile and upload the code.

The onboard LED (usually labeled D0 or D4) should start blinking.

---

## **Step 3.0**

Download XAMPP

Visit: https://www.apachefriends.org/download.html

Choose the version with PHP 8.x (latest recommended).

Run the Installer

Double-click the downloaded .exe file.

If Windows warns you, click Yes or Allow.

Choose the components you need:
✅ Apache
✅ MySQL
✅ PHP
✅ phpMyAdmin

![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/Install%20xampp.PNG?raw=true)

## **Step 4.0**

## **Step 4.1: Select Installation Folder**

Default folder is:

C:\xampp


You can change it, but it’s best to keep the default.

Click Next.

## **Step 4.2: Language Selection**

Choose English (or your preferred language).

Click Next.

## **Step 4.3: Begin Installation**

Click Next again to start installing.

Wait for the progress bar to finish (it may take a few minutes).

## **Step 4.4: Launch XAMPP Control Panel**

When installation finishes:

Make sure the box “Do you want to start the Control Panel now?” is checked.

Click Finish.

The XAMPP Control Panel will open automatically.

## **Step 4.5: Start Apache and MySQL**

In the Control Panel, click Start next to:

Apache → turns green when running

MySQL → turns green when running

If both are green ✅, your local server is ready!

## **Step 4.6: Test XAMPP Installation**

Open your web browser.

Type this in the address bar:

http://localhost/


You should see the XAMPP welcome page.

✅ That means Apache is working!
To test MySQL:
4. Go to:

http://localhost/phpmyadmin/


You’ll see the phpMyAdmin dashboard, used for managing MySQL databases.

## **Step 4.7: Place Your Project Files**

Go to your XAMPP installation folder:

C:\xampp\htdocs\


Create a new folder, e.g.:

C:\xampp\htdocs\dht11\


Place your PHP files (like receive.php, index.php) in that folder.

You can now access your project from a browser like this:

http://localhost/dht11/receive.php

---

# **Backend**

**1) Start the backend service using xampp control panel**

![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/start%20backend%20service.PNG?raw=true)

**2) All this file .php code create and coding using VScode in the folder c:/xampp/htdoc/dht11post**

**a)** connection.php Code: **c:/xampp/htdoc/dht11post/connection.php**
```php
# connection to localhost

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$database = "dht11";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);
?>

```
![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/connection%20php.PNG?raw=true)

**b)** install.php Code: **c:/xampp/htdoc/dht11post/install.php**
```php
# install dht11 database to localhost

<?php
//Create Data base if not exists
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE dht11";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	$conn->close();

	echo "<br>";
//Connect to database and create table
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "dht11";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	//Sr No, Station, Status(OK, NM, WM, ACK) Date, Time
	//1         A          NM                 11-11-25    12:15:00 am
	// sql to create table
	$sql = "CREATE TABLE logs (
		no INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`tarikh` DATE NULL,
		hari VARCHAR(30),
		`waktu` TIME NULL, 
		kawasan VARCHAR(30),
		suhu VARCHAR (10),
		kelembapan VARCHAR (10)
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table logs created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$conn->close();
?>

```
![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/install%20php.PNG?raw=true)

**c)** postdemo.php Code: **c:/xampp/htdoc/dht11post/postdemo.php**
```php
# postdemo database to localhost

<?php
	include "connection.php";
    
	// Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
 
    //Get current date and time
    date_default_timezone_set('Asia/Singapore'); 
	$seminggu = array("Minggu","Isnin","Selasa","Rabu","Khamis","Jumaat","Sabtu");
	$hari = date("w");
	$hari_ini = $seminggu[$hari];
    //$d = date("Y-m-d");
	$tarikh_sekarang = date("ymd");
    //echo " Date:".$d."<BR>";
    $jam_sekarang = date("H:i:s");
 
    if(!empty($_POST['status1'])  && !empty($_POST['status2']) && !empty($_POST['kawasan']))
    {
    	$status1 = $_POST['status1'];
		$status2 = $_POST['status2'];
    	$kawasan = $_POST['kawasan'];
 
	    $sql = "INSERT INTO logs (tarikh, hari, waktu, kawasan, suhu, kelembapan)
		
		VALUES ('".$tarikh_sekarang."',  '".$hari_ini."', '".$jam_sekarang."', '".$kawasan."', '".$status1."','".$status2."')";
 
		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
 
 
	$conn->close();
?>

```
![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/postdemo%20php.PNG?raw=true)

**d)** view.php Code: **c:/xampp/htdoc/dht11post/view.php**
```html
# view database from website

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="7">
<title>Pemantauan Masa, Suhu dan Kelembapan</title>
  
</head>


<body>
<style>
#c4ytable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
 
#c4ytable td, #c4ytable th {
    border: 1px solid #ddd;
    padding: 8px;
}
 
#c4ytable tr:nth-child(even){background-color: #f2f2f2;}
 
#c4ytable tr:hover {background-color: #ddd;}
 
#c4ytable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #00A8A9;
    color: white;
}
</style>
    
    <div id="cards" class="cards">
	
    <table id="c4ytable" width="700" height="119" align="center" border="2" bordercolor="#000000">
    <tr>  						<td width="36"><strong><center>NO			</center><strong></td> 
                                <td width="90"><strong><center>TARIKH	    </center><strong></td>
								<td width="90"><strong><center>HARI	        </center><strong></td>
                                <td width="75"><strong><center>WAKTU		</center><strong></td>
                                <td width="130"><strong><center>KAWASAN	    </center><strong></td>
                                <td width="130"><strong><center>SUHU 		</center><strong></td>
								<td width="200"><strong><center>KELEMBAPAN	</center><strong></td>
                                
    </tr>
    
   <?php
	error_reporting(E_ALL);
   ini_set('display_errors', 1);
	require_once('connection.php');
	$query1="select * from logs ";		
	$result=mysqli_query($conn,$query1);
	
	$no  = 1;
	while($data=mysqli_fetch_array($result))
	{
	
	?>
			<tr>
				<td height="80" align="center"><?php echo $no++ ?></td>
			    <td align="center"><?php echo $data['tarikh'] ?></td>
				<td align="center"><?php echo $data['hari'] ?></td>
				<td align="center"><?php echo $data['waktu'] ?></td>
				<td align="center"><?php echo $data['kawasan'] ?></td>
				<td align="center"><?php echo $data['suhu'] ?></td>
				<td align="center"><?php echo $data['kelembapan'] ?></td>
								
		  </td>
        </tr>
    <?php
    }
    ?>
    </table>
 


</body>
</html>

```
![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/view%20php.PNG?raw=true)

**2) This .ino file create on the arduino ide and compile this coding to nodemcu esp8266 (send and receive data)**

nodemcu_xampp_dht11.ino Source Code:
```c++
# This .ino file for nodemcu esp8266 wifi module


#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
WiFiClient client;

#include "DHT.h"
#define DHTPIN D5
#define DHTTYPE DHT11   // DHT 11
DHT dht(DHTPIN, DHTTYPE);
/* Set these to your desired credentials. */
const char *ssid = "okey";  //ENTER YOUR WIFI SETTINGS
const char *password = "12345678";

//Web/Server address to read/write from 
const char *host = "192.168.43.5";   // IP address of server

//=======================================================================
//                    Power on setup
//=======================================================================

void setup() {
  dht.begin();
  delay(1000);
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  Serial.begin(9600);
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");

  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
}

//=======================================================================
//                    Main Program Loop
//=======================================================================
void loop() {
  HTTPClient http;    //Declare object of class HTTPClient
  String postData, kawasan, suhu, kelembapan, link;
  

  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();
  
  suhu= String(temperature);   //String to interger conversion
  kelembapan= String(humidity);   //String to interger conversion
  kawasan= "B";
  
  //Post Data
  postData = "&status1=" + suhu+ "&status2=" + kelembapan+ "&kawasan=" + kawasan;
  link = "http://192.168.43.5/dht11post/postdemo.php";
  
  http.begin(client,link);              //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header

  int httpCode = http.POST(postData);   //Send the request
  String payload = http.getString();    //Get the response payload

  Serial.println(httpCode);   //Print HTTP return code
  Serial.println(payload);    //Print request response payload

  http.end();  //Close connection
  
  delay(10000);  //Post Data at every 10 seconds
}
//=======================================================================


```
![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/arduino%20ide%201.PNG?raw=true)

![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/arduino%20ide%202.PNG?raw=true)
---

# **Simulator**

# **Dashboard**
**1) This table 1 and table 2 show the data that receive from nodemcu esp8266 wifi module**

**a) Table 1**
![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/Table%20data%201.PNG?raw=true)

**b) Table 2**
![image URL](https://github.com/amirulhakimizaini23/IoT-Software-Simulation-Assessment/blob/main/images/Table%20data%202.PNG?raw=true)
---

# **Design**
