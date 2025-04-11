To use:
1) Move the entire folder to your php directory (the same directory used in WA5 - probably C:/php)
2) Open in VsCode
3) Open a terminal, sign into your mysql
4) Open a SEPERATE terminal, find your current working directory (for me, the command was cd - the directory is probably C:/php/DB_proj)
5) In the mysql terminal, run the command source /(your current working directory)/init.SQL
- for me, the command was source C:/Users/benwa/OneDrive/Desktop/DB_proj/init.SQL
6) In your second terminal, run the command php -S localhost:8080 or ./php -S localhost:8080
7) Open your browser and go to localhost:8080/DB_proj/login.php





