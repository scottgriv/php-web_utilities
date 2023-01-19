# Display Solution
Cycle through image files in a declared directory for informative displays.

![Demo](./docs/images/demo.gif)

## Getting Started
- Go to the full ``Display_Solution.php`` web server address in your web browser.

    ``ex. http://localhost/Folder/Display_Solution.php``

- The naming scheme for the images will be an incremental number in order to control the sequence of the images.

    ``ex. 1.jpg, 2.jpg, 3.jpg....10.jpg, etc.``

## Deployment
Edit the ``config.ini`` file with the necessary parameters to run, ex:

- **directory** = the directory the images folder will be in with backward slashes '\\'
- **countDirect** = the same directory as the 'directory' parameter above, except the folder slashes are forward slashes '/' not back slashes
- **extension** = the file extension for the images, this must be the same format for all the images ex. .jpg, .jpeg, .png
- **seconds** = the number of seconds before the script will display the next image

A finished example of the ``config.ini`` should look something similar to this (you can change the image path to use remote folders, by default it uses the ``images`` folder in the script root directory):
```
[application]
directory = images
countDirect = images
extension = .jpg
seconds = 7
```

## Changing the image size on the screen
- Go to ``Display_Solution.php`` and change the width and height in the following code to adjust the size of the slides (i.e. 100% for full screen):
```
<img src="docs/images/logo.jpg" width="100%" height="100%" id="rotator"/>
```
- Feel free to add your company's logo by replacing the ``docs/logo.jpg`` file (which indicates the start of the slide show).

-----

## Credit
**Author:** Scott Grivner <br>
**Email:** scott.grivner@gmail.com <br>
**Website:** [scottgrivner.dev](https://www.scottgriv.dev) <br>
**Reference:** [Main Branch](https://github.com/scottgriv/php-web_utilities)
