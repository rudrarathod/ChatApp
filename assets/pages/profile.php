<?php
global $profile;
global $profile_post;
global $user;
?>
<div class="container col-md-9 col-sm-11 rounded-0">
    <?php
    if ($user['id'] == $profile['id']) {
    ?>
        <!-- <div class="flex-fill flex-row justify-content-evenly align-items-center m-2">
            <a class="m-2" style="text-decoration: none;color:black" href="?editprofile"><i class="bi bi-pencil-square"></i> Edit Profile</a>
        </div> -->
    <?php
    }
    ?>
    <div class="col-12 rounded p-4 mt-4 d-md-flex gap-5">
        <div class="col-md-4 col-sm-12 d-flex justify-content-center mx-auto align-items-start">
            <img src="assets/images/profile/<?= $profile['profile_pic'] ?>" class="img-thumbnail rounded-circle mb-3" style="width:170px;height:170px" alt="...">
        </div>
        <div class="col-md-8 col-sm-11">
            <div class="d-flex flex-column">
                <div class="d-flex gap-5 align-items-center">
                    <span style="font-size: xx-large;"><?= $profile['first_name'] ?> <?= $profile['last_name'] ?></span>

                    <?php
                    if ($user['id'] != $profile['id'] && !checkBS($profile['id'])) {
                    ?>
                        <div class="dropdown">
                            <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#chatbox" onclick="popchat(<?= $profile['id'] ?>)"><i class="bi bi-chat-fill"></i> Message</a></li>
                                <li><a class="dropdown-item " href="assets/php/actions.php?block=<?= $profile['id'] ?>&enrollment=<?= $profile['enrollment'] ?>"><i class="bi bi-x-circle-fill"></i> Block</a></li>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>



                </div>
                <span style="font-size: larger;" class="text-secondary">@<?= $profile['enrollment'] ?></span>
                <?php
                if (!checkBS($profile['id'])) {
                ?>
                    <div class="d-flex gap-2 align-items-center my-3">

                        <a class="btn btn-sm btn-primary"><i class="bi bi-file-post-fill"></i> <?= count($profile_post) ?> Posts</a>
                        <a class="btn btn-sm btn-primary <?= count($profile['followers']) < 1 ? 'disabled' : '' ?>" data-bs-toggle="modal" data-bs-target="#follower_list"><i class="bi bi-people-fill"></i> <?= count($profile['followers']) ?> Followers</a>
                        <a class="btn btn-sm btn-primary <?= count($profile['following']) < 1 ? 'disabled' : '' ?>" data-bs-toggle="modal" data-bs-target="#following_list"><i class="bi bi-person-fill"></i> <?= count($profile['following']) ?> Following</a>


                    </div>
                <?php

                }
                ?>

                <?php


                if ($user['id'] != $profile['id']) {
                ?>
                    <div class="d-flex gap-2 align-items-center my-1">
                        <?php
                        if (checkBlockStatus($user['id'], $profile['id'])) {
                        ?>
                            <button class="btn btn-sm btn-danger unblockbtn" data-user-id='<?= $profile['id'] ?>'>Unblock</button>

                        <?php
                        } else if (checkBlockStatus($profile['id'], $user['id'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-x-octagon-fill"></i> @<?= $profile['enrollment'] ?> blocked you !
                            </div>
                        <?php } else if (checkFollowStatus($profile['id'])) {
                        ?>
                            <button class="btn btn-sm btn-danger unfollowbtn" data-user-id='<?= $profile['id'] ?>'>Unfollow</button>

                        <?php
                        } else {
                        ?>
                            <button class="btn btn-sm btn-primary followbtn" data-user-id='<?= $profile['id'] ?>'>Follow</button>

                        <?php
                        }
                        ?>



                    </div>
                <?php
                }
                ?>

            </div>
        </div>


    </div>
    <h3 class="border-bottom">Posts</h3>
    <?php

    if (checkBS($profile['id'])) {
        $profile_post = array();

    ?>
        <div class="alert alert-secondary text-center" role="alert">
            <i class="bi bi-x-octagon-fill"></i> You are not allowed to see posts !
        </div>
    <?php

    } else if (count($profile_post) < 1) {
        echo "<p class='p-2 bg-white border rounded text-center my-3'>You don't have any post</p>";
    }
    ?>
    <div class="gallery d-flex flex-wrap gap-2 mb-4">
        <?php
        $loopCounter = 1; // Initialize the loop counter

        foreach ($profile_post as $post) {
            $likes = getLikes($post['id']);
        ?>
            <!-- <div id="postImg" data-bs-toggle="modal" data-bs-target="#postview<?= $post['id'] ?>" width="300px" class="rounded" style="background-image:url('assets/images/posts/<?= $post['post_img'] ?>');border: 1px solid gray;width:49%;background-color:white;height:49vw;background-size: contain;background-repeat: no-repeat;background-position: center;"></div> -->
            <?php
            if (!function_exists('isImage')) {
                // Function to check if the file is an image
                function isImage($filename)
                {
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    return in_array($ext, $imageExtensions);
                }
            }

            // Assuming $post['post_img'] is the filename of the image or PDF
            $postImg = $post['post_img'];
            // Check if it's an image or not
            if (isImage($postImg)) {
                // Display image
                echo '<div id="postImg" data-bs-toggle="modal" data-bs-target="#postview' . $post['id'] . '" width="300px" class="rounded" style="background-image:url(\'assets/images/posts/' . $postImg . '\');border: 1px solid gray;width:49%;background-color:white;height:49vw;background-size: contain;background-repeat: no-repeat;background-position: center;"></div>';
            } else {
                // Display PDF
                echo '<script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>';
                echo '<script type="module">';
                echo 'var url = \'assets/images/posts/' . $postImg . '\';';
                echo 'var { pdfjsLib } = globalThis;';
                echo 'pdfjsLib.GlobalWorkerOptions.workerSrc = \'//mozilla.github.io/pdf.js/build/pdf.worker.mjs\';';
                echo 'var loadingTask = pdfjsLib.getDocument(url);';
                echo 'loadingTask.promise.then(function(pdf) {';
                echo '    console.log(\'PDF loaded\');';
                echo '    var pageNumber = 1;';
                echo '    pdf.getPage(pageNumber).then(function(page) {';
                echo '        console.log(\'Page loaded\');';
                echo '        var scale = 1.5;';
                echo '        var viewport = page.getViewport({scale: scale});';
                echo '        var canvas = document.getElementById(\'the-canvas' . $loopCounter . '\');';
                echo '        var context = canvas.getContext(\'2d\');';
                echo '        canvas.height = viewport.height;';
                echo '        canvas.width = viewport.width;';
                echo '        var renderContext = {canvasContext: context, viewport: viewport};';
                echo '        var renderTask = page.render(renderContext);';
                echo '        renderTask.promise.then(function () {';
                echo '            console.log(\'Page rendered\');';
                echo '        });';
                echo '    });';
                echo '}, function (reason) {';
                echo '    console.error(reason);'; // PDF loading error
                echo '});';
                echo '</script>';
                echo '<canvas data-bs-toggle="modal" data-bs-target="#postview' . $post['id'] . '"  id="the-canvas' . $loopCounter . '" style="border: 1px solid gray;width:49%;background-color:white;height:49vw;"></canvas>';
                echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.js"></script>';
                echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js"></script>';
            }
            $loopCounter++;

            ?>


            <div class="modal fade" id="postview<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">

                        <div class="card-title d-flex justify-content-between  align-items-center">

                            <div class="d-flex align-items-center p-2">
                                <img src="assets/images/profile/<?= $profile['profile_pic'] ?>" alt="" height="30" width="30" class="rounded-circle border">&nbsp;&nbsp;<a href='?u=<?= $profile['enrollment'] ?>' class="text-decoration-none text-dark"><?= $profile['first_name'] ?> <?= $profile['last_name'] ?></a>
                            </div>
                            <div class="p-2">
                                <?php
                                if ($profile['id'] == $user['id']) {
                                ?>

                                    <div class="dropdown">

                                        <i class="bi bi-three-dots-vertical" id="option<?= $post['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

                                        <ul class="dropdown-menu" aria-labelledby="option<?= $post['id'] ?>">
                                            <li><a class="dropdown-item" href="assets/php/actions.php?deletepost=<?= $post['id'] ?>"><i class="bi bi-trash-fill"></i> Delete Post</a></li>
                                        </ul>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>

                        <div class="modal-body d-md-flex p-0">
                        <div class="col-md-8 col-sm-12">
                                <?php
                                if (!function_exists('isImage')) {
                                    // Function to check if the file is an image
                                    function isImage($filename)
                                    {
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                                        return in_array($ext, $imageExtensions);
                                    }
                                }

                                // Assuming $post['post_img'] is the filename of the image or PDF
                                $postImg = $post['post_img'];
                                // Check if it's an image or not
                                if (isImage($postImg)) {
                                    // Display image
                                    echo '<div class="pimg" style="background-image:url(\'assets/images/posts/' . $postImg . '\');width:100%;height:50vw;background-size: contain;background-repeat: no-repeat;background-position: center;"></div>';
                                } else {
                                ?>
                                    <!-- // // Display PDF
                                    // echo '<script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>';
                                    // echo '<script type="module">';
                                    // echo 'var url = \'assets/images/posts/' . $postImg . '\';';
                                    // echo 'var { pdfjsLib } = globalThis;';
                                    // echo 'pdfjsLib.GlobalWorkerOptions.workerSrc = \'//mozilla.github.io/pdf.js/build/pdf.worker.mjs\';';
                                    // echo 'var loadingTask = pdfjsLib.getDocument(url);';
                                    // echo 'loadingTask.promise.then(function(pdf) {';
                                    // echo '    console.log(\'PDF loaded\');';
                                    // echo '    var pageNumber = 1;';
                                    // echo '    pdf.getPage(pageNumber).then(function(page) {';
                                    // echo '        console.log(\'Page loaded\');';
                                    // echo '        var scale = 1.5;';
                                    // echo '        var viewport = page.getViewport({scale: scale});';
                                    // echo '        var canvas = document.getElementById(\'canvas' . $loopCounter . '\');';
                                    // echo '        var context = canvas.getContext(\'2d\');';
                                    // echo '        canvas.height = viewport.height;';
                                    // echo '        canvas.width = viewport.width;';
                                    // echo '        var renderContext = {canvasContext: context, viewport: viewport};';
                                    // echo '        var renderTask = page.render(renderContext);';
                                    // echo '        renderTask.promise.then(function () {';
                                    // echo '            console.log(\'Page rendered\');';
                                    // echo '        });';
                                    // echo '    });';
                                    // echo '}, function (reason) {';
                                    // echo '    console.error(reason);'; // PDF loading error
                                    // echo '});';
                                    // echo '</script>';
                                    // echo '<canvas style="width:100%;height:56.29%;" id="canvas' . $loopCounter . '"></canvas>';
                                    // echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.js"></script>';
                                    // echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js"></script>'; -->
                                    <script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>

                                    <script type="module">
                                        // If absolute URL from the remote server is provided, configure the CORS
                                        // header on that server.
                                        var url = 'assets/images/posts/' + '<?php echo $postImg; ?>';

                                        // Loaded via <script> tag, create shortcut to access PDF.js exports.
                                        var {
                                            pdfjsLib
                                        } = globalThis;

                                        // The workerSrc property shall be specified.
                                        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

                                        var pdfDoc = null,
                                            pageNum = 1,
                                            pageRendering = false,
                                            pageNumPending = null,
                                            scale = 2,
                                            canvas = document.getElementById('canvas<?php echo $loopCounter; ?>'),
                                            ctx = canvas.getContext('2d');

                                        /**
                                         * Get page info from document, resize canvas accordingly, and render page.
                                         * @param num Page number.
                                         */
                                        function renderPage(num) {
                                            pageRendering = true;
                                            // Using promise to fetch the page
                                            pdfDoc.getPage(num).then(function(page) {
                                                var viewport = page.getViewport({
                                                    scale: scale
                                                });
                                                canvas.height = viewport.height;
                                                canvas.width = viewport.width;

                                                // Render PDF page into canvas context
                                                var renderContext = {
                                                    canvasContext: ctx,
                                                    viewport: viewport
                                                };
                                                var renderTask = page.render(renderContext);

                                                // Wait for rendering to finish
                                                renderTask.promise.then(function() {
                                                    pageRendering = false;
                                                    if (pageNumPending !== null) {
                                                        // New page rendering is pending
                                                        renderPage(pageNumPending);
                                                        pageNumPending = null;
                                                    }
                                                });
                                            });

                                            // Update page counters
                                            document.getElementById('page_num<?php echo $loopCounter; ?>').textContent = num;
                                        }

                                        /**
                                         * If another page rendering in progress, waits until the rendering is
                                         * finised. Otherwise, executes rendering immediately.
                                         */
                                        function queueRenderPage(num) {
                                            if (pageRendering) {
                                                pageNumPending = num;
                                            } else {
                                                renderPage(num);
                                            }
                                        }

                                        /**
                                         * Displays previous page.
                                         */
                                        function onPrevPage() {
                                            if (pageNum <= 1) {
                                                return;
                                            }
                                            pageNum--;
                                            queueRenderPage(pageNum);
                                        }
                                        document.getElementById('prev<?php echo $loopCounter; ?>').addEventListener('click', onPrevPage);

                                        /**
                                         * Displays next page.
                                         */
                                        function onNextPage() {
                                            if (pageNum >= pdfDoc.numPages) {
                                                return;
                                            }
                                            pageNum++;
                                            queueRenderPage(pageNum);
                                        }
                                        document.getElementById('next<?php echo $loopCounter; ?>').addEventListener('click', onNextPage);

                                        /**
                                         * Asynchronously downloads PDF.
                                         */
                                        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
                                            pdfDoc = pdfDoc_;
                                            document.getElementById('page_count<?php echo $loopCounter; ?>').textContent = pdfDoc.numPages;

                                            // Initial/first page rendering
                                            renderPage(pageNum);
                                        });
                                    </script>

                                    

                                    <canvas style="width:100%;height:56.29%;" id="canvas<?php echo $loopCounter; ?>"></canvas>
                                    <div class="m-2">
                                        <button class="btn btn-primary btn-sm" id="prev<?php echo $loopCounter; ?>">Previous</button>
                                        <button class="btn btn-primary btn-sm" id="next<?php echo $loopCounter; ?>">Next</button>
                                        &nbsp; &nbsp;
                                        <span>Page: <span id="page_num<?php echo $loopCounter; ?>"></span> / <span id="page_count<?php echo $loopCounter; ?>"></span></span>
                                    </div>
                                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.js"></script>
                                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js"></script>

                                <?php
                                }
                                $loopCounter++;
                                ?>
                                
                            </div>



                            <div class="col-md-4 col-sm-12 d-flex flex-column">
                                <div class="d-flex align-items-center p-2 <?= $post['post_text'] ? '' : 'border-bottom' ?>">
                                    <!--<div><img src="assets/images/profile/<?= $profile['profile_pic'] ?>" alt="" height="50" width="50" class="rounded-circle border">
                                    </div>
                                    <div>&nbsp;&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-start">
                                        <h6 style="margin: 0px;"><?= $profile['first_name'] ?> <?= $profile['last_name'] ?></h6>
                                        <p style="margin:0px;" class="text-muted">@<?= $profile['enrollment'] ?></p>
                                    </div>-->

                                    <div class="d-flex flex-column align-items-end flex-fill">
                                        <div class=""></div>
                                        <div class="dropdown">
                                            <span class="<?= count($likes) < 1 ? 'disabled' : '' ?>" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= count($likes) ?> likes
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <?php
                                                foreach ($likes as $like) {
                                                    $lu = getUser($like['user_id']);
                                                ?>
                                                    <li><a class="dropdown-item" href="?u=<?= $lu['enrollment'] ?>"><?= $lu['first_name'] . ' ' . $lu['last_name'] ?> (@<?= $lu['enrollment'] ?>)</a></li>

                                                <?php
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                        <div style="font-size:small" class="text-muted">Posted <?= show_time($post['created_at']) ?> </div>

                                    </div>

                                </div>
                                <div class="border-bottom p-2 <?= $post['post_text'] ? '' : 'd-none' ?>"><?= $post['post_text'] ?> </div>


                                <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?= $post['id'] ?>" style="height: 100px;">

                                    <?php
                                    $comments = getComments($post['id']);
                                    if (count($comments) < 1) {
                                    ?>
                                        <p class="p-3 text-center my-2 nce">no comments</p>
                                    <?php
                                    }
                                    foreach ($comments as $comment) {
                                        $cuser = getUser($comment['user_id']);
                                    ?>
                                        <div class="d-flex align-items-center p-2">
                                            <div><img src="assets/images/profile/<?= $cuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border">
                                            </div>
                                            <div>&nbsp;&nbsp;&nbsp;</div>
                                            <div class="d-flex flex-column justify-content-start align-items-start">
                                                <h6 style="margin: 0px;"><a href="?u=<?= $cuser['enrollment'] ?>" class="text-decoration-none text-muted">@<?= $cuser['enrollment'] ?></a> - <?= $comment['comment'] ?></h6>
                                                <p style="margin:0px;" class="text-muted"><?= show_time($comment['created_at']) ?></p>
                                            </div>

                                        </div>

                                    <?php
                                    }
                                    ?>






                                </div>
                                <?php
                                if (checkFollowStatus($profile['id']) || $profile['id'] == $user['id']) {
                                ?>
                                    <div class="input-group p-2 border-top">
                                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.." aria-label="Recipient's enrollment" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button" id="button-addon2">Post</button>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="text-center p-2">
                                        if you want to comment follow this user</div>

                                <?php
                                }
                                ?>

                            </div>



                        </div>

                    </div>
                </div>
            </div>
        <?php
        }
        ?>


    </div>




</div>


<!-- Modal -->




<!-- this is for follower list -->
<div class="modal fade" id="follower_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Followers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                foreach ($profile['followers'] as $f) {
                    $fuser = getUser($f['follower_id']);
                    $fbtn = '';
                    if (checkFollowStatus($f['follower_id'])) {
                        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id=' . $fuser['id'] . ' >Unfollow</button>';
                    } else if ($user['id'] == $f['follower_id']) {
                        $fbtn = '';
                    } else {
                        $fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-id=' . $fuser['id'] . ' >Follow</button>';
                    }
                ?>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center p-2">
                            <div><img src="assets/images/profile/<?= $fuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-center">
                                <a href='?u=<?= $fuser['enrollment'] ?>' class="text-decoration-none text-dark">
                                    <h6 style="margin: 0px;font-size: small;"><?= $fuser['first_name'] ?> <?= $fuser['last_name'] ?></h6>
                                </a>
                                <p style="margin:0px;font-size:small" class="text-muted">@<?= $fuser['enrollment'] ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <?= $fbtn ?>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>



<!-- this is for following list -->
<div class="modal fade" id="following_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Following</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                foreach ($profile['following'] as $f) {
                    $fuser = getUser($f['user_id']);
                    $fbtn = '';
                    if (checkFollowStatus($f['user_id'])) {
                        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id=' . $fuser['id'] . ' >Unfollow</button>';
                    } else if ($user['id'] == $f['user_id']) {
                        $fbtn = '';
                    } else {
                        $fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-id=' . $fuser['id'] . ' >Follow</button>';
                    }
                ?>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center p-2">
                            <div><img src="assets/images/profile/<?= $fuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-center">
                                <a href='?u=<?= $fuser['enrollment'] ?>' class="text-decoration-none text-dark">
                                    <h6 style="margin: 0px;font-size: small;"><?= $fuser['first_name'] ?> <?= $fuser['last_name'] ?></h6>
                                </a>
                                <p style="margin:0px;font-size:small" class="text-muted">@<?= $fuser['enrollment'] ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <?= $fbtn ?>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>