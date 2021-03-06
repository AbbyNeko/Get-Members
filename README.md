# Senate Members JSON

This PHP application does a GET request to this URL: https://www.senate.gov/general/contact_information/senators_cfm.xml. Then, it takes the XML data from this URL and converts it to a JSON format to display on the screen.

## Installation

To test this PHP application on macOS, you would need to install PHP on macOS.
The fastest way to install PHP is by using Homebrew linked <a href="https://brew.sh/" target="_blank">here</a>.
After Homebrew is installed, run the command 'brew install php' in the terminal to install PHP.

After that, navigate to the folder in terminal like so: 'cd <foldername>'. Stop at least one directory below the 'Get-Members' repo/folder.
Type in the command: 'php -S localhost:3000 -t <foldername>/' and it will run a local server. Folder Name is 'Get-Members' in this. I used port 3000 but you are welcome to use a different port if need be.

If you navigate to http://localhost:3000, index.php will run and display a JSON of all the US Senate Members.

If you do not have a macOS, you can test PHP pages through a PHP development environment you can download online.

Below are a few links that people recommend using for setting up a PHP development environment:

<a href="https://www.mamp.info/en/windows/" target="_blank">MAMP</a><br>
<a href="https://www.wampserver.com/en/" target="_blank">WampServer</a><br>
<a href="https://www.apachefriends.org/index.html" target="_blank">XAMPP</a>
