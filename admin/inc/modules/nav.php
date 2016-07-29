                        <?php
                        if($user->isLoggedIn()) {
                        ?>    
                        <li><a class="hvr-underline-from-center" href="dashboard">dashboard</a></li>
                        <li><a class="hvr-underline-from-center" href="posts">posts</a></li>
                        <li><a class="hvr-underline-from-center" href="pages">pages</a></li>
                        <li><a class="hvr-underline-from-center" href="media">media</a></li>
                        <li><a class="hvr-underline-from-center" href="settings">settings</a></li>
                        <li><a class="hvr-underline-from-center" href="logout">logout</a></li>
                        <?php
                        }
                        else {
                        ?>
                        <li><a class="hvr-underline-from-center" href="login">login</a></li>
                        <li><a class="hvr-underline-from-center" href="../index">go back to website</a></li>
                        <?php
                        }
                        ?>
            