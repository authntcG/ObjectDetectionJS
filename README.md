<h1><span style="font-family:Arial,Helvetica,sans-serif"><strong>Simple Web-Based Object Detection</strong></span></h1>

<h2>Description</h2>

<p>This website was created with the aim of detecting objects using any device that can access a browser and camera. This website was created using:</p>

<ul>
	<li>Laravel, as a website framework</li>
	<li>TensorflowJS, as a deep learning model library</li>
	<li>Single Shot Detector, as the pre-trained model used.</li>
</ul>

<h2>Screenshot</h2>
<details>
<summary>Running on desktop 🖥️</summary>
    <p align="center">
        <a href="https://ibb.co.com/h9sjv52"><img src="https://i.ibb.co.com/vq1G85L/chrome-capture-2024-8-1.gif" alt="chrome-capture-2024-8-1" border="0"></a>
        <a href="https://ibb.co/c35f8bV" target="_blank"><img src="https://i.ibb.co/g91qWvh/pixelspotdetect-itenas-ac-id.png" alt="pixelspotdetect-itenas-ac-id" border="0"></a>
        <a href="https://ibb.co/mqPpw4F" target="_blank"><img src="https://i.ibb.co/NjGRPKn/pixelspotdetect-itenas-ac-id-video-detect.png" alt="pixelspotdetect-itenas-ac-id-video-detect" border="0"></a>
    </p>
</details>

<details>
<summary>Running on mobile 📱</summary>
    <p align="center">
        <a href="https://ibb.co.com/qRc31Z8"><img src="https://i.ibb.co.com/brCMdfV/Screenshot-20240802-110622-Chrome.jpg" alt="Screenshot-20240802-110622-Chrome" border="0" height="800"></a>
        <a href="https://ibb.co.com/JCD3J8Z"><img src="https://i.ibb.co.com/HX5h8RZ/Screenshot-20240802-110723-Chrome.jpg" alt="Screenshot-20240802-110723-Chrome" border="0" height="800"></a>
    </p>
</details>

<h2>Notes</h2>
There are several things you need to pay attention to when using this website:</p>

<ul>
	<li>You can use, modify and develop this program privately by including the project source in the form of this github page.</li>
	<li>You are <u><strong>STRICTLY PROHIBITED</strong></u> from trading this program in any form or using this program FOR ANY COMMERCIAL PURPOSES.</li>
	<li>The detection system used in this program does not guarantee accuracy in detecting objects, so do it at your own risk.</li>
	<li>If you find a bug in this application, please open an issue on this github page.</li>
</ul>

<h2>Usage</h2>
There are several ways to run this program, namely locally and using the preview website provided.<br />

<strong>Method 1: use the website preview</strong>

<ol>
	<li>You can access a preview of this website on the page <a href="https://pixelspotdetect.itenas.ac.id/" target="_blank">https://pixelspotdetect.itenas.ac.id/</a></li>
</ol>

<strong>Method 2: run locally</strong>

<ol>
	<li>Download the latest program on the releases page</li>
	<li>Unzip the program on the <em>htdocs/www</em> page on your local server<sup>1</sup> program</li>
	<li>Run the local server program, then access the program directory that was unzipped earlier using the command prompt</li>
	<li>Type &quot;php artisan serve&quot;<sup>2,3</sup>&nbsp;at the command prompt</li>
	<li>Website pages can be accessed locally from the IP provided by the artisan</li>
</ol>

<p><sup>1</sup>&nbsp;You need a local server application like XAMPP/Laragon/etc to access this web page<br />
<sup>2</sup>&nbsp;If you use XAMPP, then you need composer to run this command<br />
<sup>3</sup>&nbsp;If you are using Laragon, skip this command because Laragon has done the configuration for the Laravel project automatically.</p>

<p>&nbsp;</p>
