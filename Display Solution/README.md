# Display Solution
Cycle through image files in a declared directory for informative displays.

## Getting Started
To view the web page go to the servers address that it's placed on and append ../{FolderPath}/Display_Solution.php
#### ex. http://localhost/Folder/Display_Solution.php
The naming scheme for the images will be an incremental number in order to control the sequence of the images.
#### ex. 1.jpg, 2.jpg, 3.jpg....10.jpg, etc.

## Deployment
Edit the config.ini file with the needed parameters to run, ex:
#### directory = the directory the images folder will be in with backward slashes '\'
#### countDirect = the same directory as the 'directory' parameter above, except the folder slashes are forward slashes '/' not back
#### extension = the file extension for the images, this must be the same format for all the images ex. .jpg, .jpeg, .png
#### seconds = the number of seconds before the script will display the next image

### A finished example of the config.ini should look something similar to this:
[application]
directory = images
extension = .jpg
seconds = 7

### Author
Developed by Scott Grivner.

### Version Release and Date
v1.0 - 03/22/17

### License
This project is licensed for public use with permission from the Author.