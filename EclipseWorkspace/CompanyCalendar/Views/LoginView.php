<!Doctype html/>
<html>
    <head>
        <link rel="stylesheet" href="Resources/normalize.css" />
        <link rel="stylesheet" href="Resources/skeleton.css" />
        <link rel="stylesheet" href="Resources/style.css" />
        
    </head>
    <body>
        <div id="login_box">
            <div class="row">
                <div class="u-full-width">
                    <br>
                        
                    <form action="index.php?page=login&action=login" method="post">
                        <label>Username:</label>
                        <input type="text" class=login_input" name="username" />
                        
                        <br>
                        
                        <label>Password:</label>
                        <input type="password" class=login_input" name="password" />
                        
                        <br>
                            
                        <input type="submit" value="Submit" />
                    </form>
                    
                    <br>
                </div>
            </div>
        </div>
    </body>
</html>