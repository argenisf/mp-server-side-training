# MP Support Server Side Training

Hybrid Client-Server side implementation testing environment. This project can be used to test a Web app environment using the `javascript` and `php` libraries.

## How to Setup the Environment

<div style="position: relative; margin-bottom: 10px; padding-left: 50px;">
	<img src="media/mamp.png" alt="MAMP" width="40px" style="position: absolute; top: 0; left: 0;" />
	<p style="margin: 0">The first step is to setup a webserver with PHP and MySQL enabled. On a Mac, the easiest way is to <a href="https://www.mamp.info/en/downloads/" target="_blank">download and install MAMP</a>. Once downloaded and installed, use MAMP's pannel to start the web server. Do note that the Wizard downloads 2 MAMP Apps (Free and Pro versions), start the free one in the Applications/MAMP folder. The default URLs for each once the services are running are:</p>
</div>

  * **Web server:** [http://localhost:8888/](http://localhost:8888/)
  * **phpMyAdmin:** [http://localhost:8888/phpMyAdmin/?lang=en](http://localhost:8888/phpMyAdmin/?lang=en)

**Note:** you also need to have git installed. On current versions of Mac OS, it is included with the Xcode Command Line Tools. To check (or install it), just open your terminal and run `git --version`. If it prints out the version, it is already installed. Otherwise, you will be prompted to install them.

---

#### Download the files

Alright, now that you have your PHP environment, let's download the files you need. Open terminal, and navigate to the root folder of your MAMP webserver. You can do this by typing `cd /Applications/MAMP/htdocs/`.

Now, let's clone the repository. Run the following command: `git clone https://github.com/argenisf/mp-server-side-training`. Once it finishes, you will have the project files in your computer. You can also view them in your finder by opening a Finder window, and going to Applications -> MAMP -> htdocs -> mp-server-side-training.

#### Install the Database

Open the phpMyAdmin page ([default link](http://localhost:8888/phpMyAdmin/?lang=en)), click on "new" on the left side panel, and head to the "Import tap" on the top menu. You will be able to select a file to import. Choose the file named "database_backup.sql" which is in your downloaded files in the `server-config` folder.

#### Finish Configuration (optional)

In case you are copying the repo to a different folder, and thus, your local server address for this is different to the default, you can change it. In the `server-config` folder, open the `config.php` file, and in the `$rootURL` variable, change the value from "" to your site's URL (the default would be: http://localhost:8888/mp-server-side-training/) although you can adapt it.

#### Done

You're all set up to start using the MP Task Manager Project

