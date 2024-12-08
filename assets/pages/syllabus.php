<script>
    function next(){
        window.location.search = "post";
    }
</script>
<div class="container col-md-10 col-sm-12 col-lg-9 rounded-0 d-flex justify-content-between">
    <div class="col-md-8 col-sm-12" style="width:100%;">
    <div class="d-flex justify-content-end mt-2">

            <!-- Add 'onchange' attribute to the checkbox to call the function when its state changes -->
            <div class="form-check form-switch">
            <button onclick="next()" class="btn btn-outline-primary" type="button">Post</button>
            <button class="btn btn-primary" type="button">Syllabus</button>
            </div>


        </div>

    <h5 class="modal-title m-2">Search Syllabus</h5>
<form name="syllabus" onsubmit="check()" method="POST">
    <!-- <div>
        <select name="branch" id="branch" class="form-select mt-1" aria-label="Select Branch">
            <option value="" selected>Select Branch</option>
            <option value="co">Computer Engineering</option>
        </select>
    </div> -->

    <!-- <div>
        <select name="sem" id="sem" class="form-select mt-1" aria-label="Select Semester">
            <option value="" selected>Select Semester</option>
            <option value="1">I</option>
            <option value="2">II</option>
        </select>
    </div>

    <div>
        <select name="scheme" id="scheme" class="form-select mt-1" aria-label="Select Scheme">
            <option value="" selected>Select Scheme</option>
            <option value="I">I</option>
            <option value="K">K</option>
        </select>
    </div> -->

    <div>
        <select name="code" id="subject_code" class="form-select mt-1" aria-label="Select Scheme">
            <option value="" selected>Select sem code</option>
            <option value="CO-1-k">CO-1-k</option>
            <option value="CO-2-k">CO-2-k</option>
            <option value="CO-3-k">CO-3-k</option>
            <option value="CO-4-k">CO-4-k</option>
            <option value="CO-5-k">CO-5-k</option>
            <option value="CO-6-k">CO-6-k</option>
            <option value="CO-4-i">CO-4-i</option>
            <option value="CO-5-i">CO-5-i</option>
            <option value="CO-6-i">CO-6-i</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary m-2">Search</button>
</form>
<hr><br>

<?php
function check(){
    return true;
}

// $branch = $_POST['branch'];
// $sem = $_POST['sem'];
// $scheme = $_POST['scheme'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];


$subjects = getSubject($code);

if (!empty($subjects)) {
    $no = 0;
    echo "<table class='table table-bordered' >
            <thead>
                <tr>
                    <th scope='col'>ID</th>
                    <!--<th scope='col'>Code</th>-->
                    <th scope='col'>Subject Code</th>
                    <th scope='col'>Subject Name</th>
                    <th scope='col'>Curriculum</th>
                </tr>
            </thead>
            <tbody class='table-group-divider'>";

    foreach ($subjects as $subject) {
        $url = 'assets/images/syllabus/'.$subject['subject_data'].'.pdf';
        $no+=1;
        echo "<tr>
                <th scope='row'> $no</th>
               <!-- <td>{$subject['code']}</td>-->
                <td>{$subject['subject_code']}</td>
                <td>{$subject['subject_name']}</td>
                <td><form action='$url' method='post' target='_blank'>
                <input class='btn btn-primary m-2'type='submit' value='Download'>
            </form></td>
              </tr>";
              if(isset($_GET["file"])){
                header("Content-Disposition: attachment; filename = " . basename($_GET["file"]));
                readfile($_GET["file"]);
                exit();
              }
            
              
    }

    echo "</tbody>
        </table>";
} else {
    echo "No data found for your sem code.";
}

}
else{
    echo "Select someting to search";
}
?>

    </div>
</div>





