                        <?php
                        if($user->isLoggedIn()) {
                        ?>    
                        <li><a href="dashboard">dashboard</a></li>
                        <li><a href="posts">posts</a></li>
                        <li><a href="pages">pages</a></li>
                        <li><a href="media">media</a></li>
                        <li><a href="settings">settings</a></li>
                        <li><a href="logout">logout</a></li>
                        <?php
                        }
                        else {
                        ?>
                        <li><a href="login">login</a></li>
                        <li><a href="../index">go back to website</a></li>
                        <?php
                        }
                        ?>
            