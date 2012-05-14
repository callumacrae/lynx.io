<info>
title: How to set up a PHP/MySQL Server on Windows
author: samhaines
date: 1294639200
tags: server, php, mysql, install
summary: In this tutorial I will describe the process of configuring a PHP and MySQL server on a Windows computer with running the Apache Web Server version 2.2. This configuration is ideal for developing websites on your own computer, without the need for a server.
</info>

<p>In this tutorial I will describe the process of configuring a PHP and MySQL server on a Windows computer with running the Apache Web Server version 2.2. This configuration is ideal for developing websites on your own computer, without the need for a server.</p>
<p>There are many other methods to achieve this, and it is not limited to running on Windows or Apache, however this is most common configuration for developers. There are many other guides available on the internet describing setting up PHP and MySQL on other configurations.</p>
<p>The procedure for installation will be:</p>
<ul>
  <li>Installation of MySQL</li>
  <li>Installation of PHP</li>
  <li>Finalisation &amp; Testing</li>
</ul>
<h2>Prerequisites</h2>
<p>You will need the following to be able to follow this tutorial successfully:</p>
<ul>
  <li>Windows XP / Vista / 7</li>
  <li>Apache Web Server version 2.2, already set up and working (available to download from <a href="http://httpd.apache.org/">http://httpd.apache.org/</a>)</li>
  <li>PHP Windows binary</li>
  <ul>
    <li>The version required for use with Apache 2.2 on Windows is VC6 x86 Thread Safe (2010-Jul-21 20:06:17)</li>
    <li>This is available to download from <a href="http://windows.php.net/download/">http://windows.php.net/download/</a></li>
  </ul>
  <li>About 45 minutes to spare</li>
  <li>It is worth disabling anti-virus during the installation, to avoid conflicts. Remember to re-enable it after installation is complete.</li>
</ul>
<h2>Installing MySQL</h2>
<ol>
  <li>The first step it to install MySQL onto your computer. To start run the file with the extension .msi </li>
  <li>Choose the typical installation option and click “Next” </li>
  <li>Now click the “Install” button </li>
  <li>Wait for the installation to complete, then opt to not register with the MySQL website </li>
  <li>Ensure that the option to start the MySQL Config Wizard is selected and click “Finish”. </li>
  <li>The MySQL Config Wizard will now open; press “Next” to proceed </li>
  <li>Select “Detailed Configuration” and click “Next” </li>
  <li>Now select “Developer Machine” if this is for developers, or “Server Machine” for servers, then press “Next” </li>
  <li>Select “Multifunctional Database” then click “Next” </li>
  <li>If “InnoDB Tablespace Settings” appears just click “Next” </li>
  <li>Select “Decision Support (DSS) / OLAP” and click “Next” </li>
  <li>Ensure that both “Enable TCP/IP Networking” and “Enable strict mode” are both selected, then click “Next” </li>
  <li>Select “Standard Character Set” for Western scripts (eg English, French, German) or “Bes t Support for Multilingualism” if you want to support different scripts (eg Arabic). Then click “Next”</li>
  <li>Ensure that “Install as Windows Service” is ticked then press “Next” </li>
  <li>This page is the security of the MySQL server. It is best to change the password for the root account, but make a note of it because it impossible to recover. Ensure that “enable root access from remote machines” is NOT ticked and “create an anonymous account” is also NOT ticked. Then click “Next” </li>
  <li>Now press “Execute”</li>
</ol>
<p>You have now successfully installed MySQL.</p>
<h2>Installing PHP</h2>
<ol>
  <li>Run the PHP installer file<br /><img src="{{ articleimages }}/00.jpeg" alt="" title="setupphp00" width="272" height="89" /></li>
  <li>Click “Next” on the welcome page<br /><img src="{{ articleimages }}/01.jpeg" alt="" title="setupphp01" width="509" height="396" /></li>
  <li>Agree to the license agreement and click “Next” <br /><img src="{{ articleimages }}/02.jpeg" alt="" title="setupphp02" width="509" height="396" /></li>
  <li>The default installation directory is fine, but you can change it here. When you’re happy with it, click “Next”<br /><img src="{{ articleimages }}/03.jpeg" alt="" title="setupphp03" width="509" height="396" /></li>
  <li>Select “Apache 2.2.x Module” from the list of Web Servers, then click “Next”<br /><img src="{{ articleimages }}/04.jpeg" alt="" title="setupphp04" width="509" height="396" /></li>
  <li>Click “Browse…” to navigate to the Apache Configuration Directory (by default C:\Program Files\Apache Software Foundation\Apache2.2\conf ), then click “Next”<br /><img src="{{ articleimages }}/05.jpeg" alt="" title="setupphp05" width="509" height="396" /></li>
  <li>The default settings for the items to install are fine, but if you wish to install extras, such as PHP manual, extra extensions, you can do so here. Once you’re happy, click “Next”<br /><img src="{{ articleimages }}/06.jpeg" alt="" title="setupphp06" width="509" height="396" /></li>
  <li>If you wish to review any settings, now click “Back”. If you’re happy, click “Next”<br /><img src="{{ articleimages }}/07.jpeg" alt="" title="setupphp07" width="509" height="396" /></li>
  <li>The PHP installer will now install everything which takes one or two minutes on a modern computer<br /><img src="{{ articleimages }}/08.jpeg" alt="" title="setupphp08" width="509" height="396" /></li>
  <li>Once complete you should see the following page. Click “Finish” to exit the installer.<br /><img src="{{ articleimages }}/09.jpeg" alt="" title="setupphp09" width="509" height="396" /></li>
</ol>
<h2>Finalising &amp; Testing</h2>
<p>PHP &amp; MySQL have both now been installed; however everything isn’t quite finished yet. You should now:</p>
<ol>
  <li>Restart the Apache service. You can do this either:</li>
  <ul>
    <li>Through the Start Menu: navigate to All Programs, Apache, Restart </li>
    <li>Through the Services application: Start, Run, type “services.msc”, find Apache2.2, right click and select “Restart” </li>
    <li>Restarting your computer</li>
  </ul>
  <li>Test that it has installed correctly</li>
  <ul>
    <li>Do this by creating a page called test.php with the following text:<br />
      &lt;?php phpinfo(); ?&gt;<br />
      Then, open a web browser, browse to test.php on your server and request the page. You should see a page detailing your PHP configuration.</li>
  </ul>
  <li>Remember to re-enable your anti-virus if you disabled it</li>
</ol>
<p>PHP &amp; MySQL should now be successfully set up on your computer! Have fun with developing interactive web applications!</p>
<h2>Further Reading</h2>
<p>Detailed instruction on the installation of MySQL, along with screenshots, can be found at:</p>
<p><a href="http://dev.mysql.com/doc/refman/5.1/en/windows-install-wizard.html">http://dev.mysql.com/doc/refman/5.1/en/windows-install-wizard.html</a></p>
<p><a href="http://dev.mysql.com/doc/refman/5.1/en/mysql-config-wizard-starting.html">http://dev.mysql.com/doc/refman/5.1/en/mysql-config-wizard-starting.html</a></p>
