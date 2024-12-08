<?php
global $user;
global $post_post;
?>
<script>
    function next(){
        window.location.search = "syllabus";
    }
</script>
<div class="container col-md-10 col-sm-12 col-lg-9 rounded-0 d-flex justify-content-between">
    <div class="col-md-8 col-sm-12" style="width:100%;">
        <div class="d-flex justify-content-end mt-2">

            <!-- Add 'onchange' attribute to the checkbox to call the function when its state changes -->
            <div class="form-check form-switch">
            <button  class="btn btn-primary" type="button">Post</button>
            <button onclick="next()" class="btn btn-outline-primary" type="button">Syllabus</button>
            </div>


        </div>
        <h5 class="modal-title m-2">Search Post</h5>

        <form name="search" onsubmit="check()" method="POST">
            <select name="branch" id="branch" class="form-select mt-1" aria-label="Select Branch" onclick="getsubject()" onblur="getsubject()">
                <option value="" selected>Select Branch</option>
                <option value="co">Computer Engineering</option>
            </select>

            <select name="sem" id="sem" class="form-select mt-1" aria-label="Select Semester" onclick="getsubject()" onblur="getsubject()">
                <option value="" selected>Select Semester</option>
                <option value="1">I</option>
                <option value="2">II</option>
                <option value="3">III</option>
                <option value="4">IV</option>
                <option value="5">V</option>
                <option value="6">VI</option>
            </select>

            <select name="scheme" id="scheme" class="form-select mt-1" aria-label="Select Scheme" onclick="getsubject()" onblur="getsubject()">
                <option value="" selected>Select Scheme</option>
                <option value="I">I</option>
                <option value="K">K</option>
            </select>

            <select name="subject" class="form-select mt-1" aria-label="Select Subject" onclick="getsubject()" onblur="getsubject()">
                <option value="" disabled selected>Select branch sem & scheme to select Subject</option>
                <!-- Computer Engineering, Semester 6, Scheme I subjects -->
                <optgroup hidden id="coSem6SchemeI" label="Computer Engineering - Semester 6 - Scheme I">
                    <option value="22509">Management</option>
                    <option value="22616">Programming with Python</option>
                    <option value="22617">Mobile Application Development</option>
                    <option value="22618">Emerging Trends in Computer and Information Technology</option>
                    <option value="22619">Web-Based Application Development using PHP</option>
                </optgroup>
                <!-- Computer Engineering - Semester 4 - Scheme I -->
                <optgroup hidden id="coSem4SchemeI" label="Computer Engineering - Semester 4 - Scheme I">
                    <option value="22412">Java Programming</option>
                    <option value="22413">Software Engineering</option>
                    <option value="22414">Data Communication and Computer Network</option>
                    <option value="22415">Microprocessors</option>
                    <option value="22416">GUI Application Development using VB.Net</option>
                </optgroup>

                <!-- Computer Engineering - Semester 5 - Scheme I -->
                <optgroup hidden id="coSem5SchemeI" label="Computer Engineering - Semester 5 - Scheme I">
                    <option value="22447">Environmental Studies</option>
                    <option value="22516">Operating System</option>
                    <option value="22517">Advanced Java Programming</option>
                    <option value="22518">Software Testing</option>
                    <option value="22519">Client-Side Scripting Language</option>
                </optgroup>

                <!-- Computer Engineering - Semester 3 - Scheme I -->
                <optgroup hidden id="coSem3SchemeI" label="Computer Engineering - Semester 3 - Scheme I">
                    <option value="22316">Object Oriented Programming with C++</option>
                    <option value="22317">Data Structures using C</option>
                    <option value="22319">Computer Graphics</option>
                    <option value="22320">Digital Techniques</option>
                </optgroup>

            </select>

            <button type="submit" class="btn btn-primary m-2">Search</button>
        </form><hr>
        <script <?= time() ?>>
            function getsubject() {
                var branch = document.getElementById("branch").value;
                var sem = document.getElementById("sem").value;
                var scheme = document.getElementById("scheme").value;
                var subjectSelect = document.querySelector('select[name="subject"]');

                // Hide all optgroups initially
                var optgroups = document.querySelectorAll('optgroup');
                optgroups.forEach(function(optgroup) {
                    optgroup.setAttribute("hidden", "hidden");
                });

                // Check if the conditions are met to show the specific optgroup
                var targetOptgroupID = branch + "Sem" + sem + "Scheme" + scheme;
                var targetOptgroup = document.getElementById(targetOptgroupID);

                if (targetOptgroup) {
                    targetOptgroup.removeAttribute("hidden");
                    subjectSelect.removeAttribute("disabled");
                } else {
                    subjectSelect.value = "";
                }
            }
        </script>


        <?php
        function check()
        {
            return true;
        }

        if (check()) {
            if (isset($_POST['branch'], $_POST['sem'], $_POST['scheme']) && !isset($_POST['subject'])) {

                if ($_POST['branch'] == '' && $_POST['sem'] == '' && $_POST['scheme'] == '') {
                    echo ('Please select the category you want to search');
                } else {
                    $formData = [
                        'branch' => $_POST['branch'],
                        'sem' => $_POST['sem'],
                        'scheme' => $_POST['scheme'],
                    ];

                    $response = getPostsBySearch();
                    $post_post = getfilterPosts($response, $formData);
                }
            } elseif (isset($_POST['subject'])) {
                $formData = [
                    'subject' => $_POST['subject'],  // Include the subject in the form data
                ];
                $response = getPostsBySearch();
                $post_post = getfilterPosts($response, $formData);
            }
        }
        ?>
        <?php
        if (is_array($post_post) || is_object($post_post)) {
            $loopCounter = 1; // Initialize the loop counter


            foreach ($post_post as $post) {
                $likes = getLikes($post['id']);
                $comments = getComments($post['id']);
        ?>
                <div class="card mt-4 ">
                    <div class="card-title d-flex justify-content-between  align-items-center">

                        <div class="d-flex align-items-center p-2">
                            <img src="assets/images/profile/<?= $post['profile_pic'] ?>" alt="" height="30" width="30" class="rounded-circle border">&nbsp;&nbsp;<a href='?u=<?= $post['enrollment'] ?>' class="text-decoration-none text-dark"><?= $post['first_name'] ?> <?= $post['last_name'] ?></a>
                        </div>
                        <div class="p-2">
                            <?php
                            if ($post['uid'] == $user['id']) {
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

                    <!-- <div class="pimg" style="background-image:url('assets/images/posts/<?= $post['post_img'] ?>');width:100%;height:50vw;background-size: contain;background-repeat: no-repeat;background-position: center;"></div> -->

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

                    <h4 style="font-size: x-larger " class="p- border-bottom d-flex">
                        <span class="m-2">
                            <?php
                            if (checkLikeStatus($post['id'])) {
                                $like_btn_display = 'none';
                                $unlike_btn_display = '';
                            } else {
                                $like_btn_display = '';
                                $unlike_btn_display = 'none';
                            }
                            ?>
                            <i class="bi bi-heart-fill unlike_btn text-danger" style="display:<?= $unlike_btn_display ?>" data-post-id='<?= $post['id'] ?>'></i>
                            <i class="bi bi-heart like_btn" style="display:<?= $like_btn_display ?>" data-post-id='<?= $post['id'] ?>'></i>

                        </span>
                        &nbsp;&nbsp;<i class="bi bi-chat-left d-flex align-items-center"><span class="p-1 mx-2 text-small" style="font-size:small"><?= count($comments) ?> comments</span></i>
                    </h4>

                    <div>
                        <span class="p-1 mx-2" data-bs-toggle="modal" data-bs-target="#likes<?= $post['id'] ?>"><span id="likecount<?= $post['id'] ?>"><?= count($likes) ?></span> likes</span>
                        <span style="font-size:small" class="text-muted">Posted</span> <?= show_time($post['created_at']) ?>

                    </div>
                    <?php
                    if ($post['post_text']) {
                    ?>
                        <div class="card-body">
                            <?= $post['post_text'] ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="input-group p-2 <?= $post['post_text'] ? 'border-top' : '' ?>" data-bs-toggle="modal" data-bs-target="#postview<?= $post['id'] ?>">

                        <!-- <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.." aria-label="Recipient's enrollment" aria-describedby="button-addon2"> -->
                        <span class="form-control rounded-0 border-0 comment-input" aria-label="Recipient's enrollment" aria-describedby="button-addon2">say something..</span>
                        <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page='wall' data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button" id="button-addon2">Post</button>
                    </div>

                </div>
                <div class="modal fade" id="postview<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">

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
                                    <div class="d-flex align-items-center p-2 border-bottom">
                                        <div>
                                            <img src="assets/images/profile/<?= $post['profile_pic'] ?>" alt="" height="50" width="50" class="rounded-circle border">
                                        </div>
                                        <div>&nbsp;&nbsp;&nbsp;</div>
                                        <div class="d-flex flex-column justify-content-start">
                                            <h6 style="margin: 0px;"><?= $post['first_name'] ?> <?= $post['last_name'] ?></h6>
                                            <p style="margin:0px;" class="text-muted">@<?= $post['enrollment'] ?></p>
                                        </div>
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


                                    <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?= $post['id'] ?>" style="max-height:50vh;min-height:10vh">

                                        <?php
                                        if (count($comments) < 1) {
                                        ?>
                                            <p class="p-3 text-center my-2 nce">no comments</p>
                                        <?php
                                        }
                                        foreach ($comments as $comment) {
                                            $cuser = getUser($comment['user_id']);
                                        ?>
                                            <div class="d-flex align-items-center p-2">
                                                <div>
                                                    <img src="assets/images/profile/<?= $cuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border">
                                                </div>
                                                <div>&nbsp;&nbsp;&nbsp;</div>
                                                <div class="d-flex flex-column justify-content-start align-items-start flex-grow-1">
                                                    <h6 style="margin: 0px;">
                                                        <a href="?u=<?= $cuser['enrollment'] ?>" class="text-decoration-none text-dark text-small text-muted">@<?= $cuser['enrollment'] ?></a> - <?= $comment['comment'] ?>
                                                    </h6>
                                                    <p style="margin:0px;" class="text-muted">(<?= show_time($comment['created_at']) ?>)</p>
                                                </div>
                                                <div class="ml-auto p-2"> <!-- Use 'ml-auto' to push the delete option to the right -->
                                                    <?php
                                                    if ($comment['user_id'] == $user['id'] || $post['user_id'] == $user['id']) {
                                                    ?>
                                                        <div>
                                                            <a class="dropdown-item" href="assets/php/actions.php?deletecomment=<?= $comment['id'] ?>">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </a>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>


                                        <?php
                                        }
                                        ?>






                                    </div>
                                    <div class="input-group p-2 border-top">
                                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.." aria-label="Recipient's enrollment" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button" id="button-addon2">Post</button>
                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="likes<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Likes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <?php
                                if (count($likes) < 1) {
                                ?>
                                    <p>Currently No Likes</p>
                                <?php
                                }
                                foreach ($likes as $f) {

                                    $fuser = getUser($f['user_id']);
                                    $fbtn = '';
                                    if (checkBS($f['user_id'])) {
                                        continue;
                                    } else if (checkFollowStatus($f['user_id'])) {
                                        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id=' . $fuser['id'] . ' >Unfollow</button>';
                                    } else if ($user['id'] == $f['user_id']) {
                                        $fbtn = '';
                                    } else {
                                        $fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-id=' . $fuser['id'] . ' >Follow</button>';
                                    }
                                ?>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center p-2">
                                            <div>
                                                <img src="assets/images/profile/<?= $fuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border">
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

        <?php
            }
        }
        ?>
    </div>


</div>
</div>