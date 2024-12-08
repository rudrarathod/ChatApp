<?php
global $user;
global $posts;
global $follow_suggestions;
global $db;
$query = "SELECT * FROM `form_list` order by date(date_created) desc";
$result = mysqli_query($db, $query);
?>

<div class="container col-md-10 col-sm-12 col-lg-9 rounded-0 d-flex justify-content-between">
    <div class="col-md-8 col-sm-12" style="width:100%;">
        <h3 class="mt-3">Feedback Forms</h3>
        <hr class="border-primary">
        <div class="col-md-12">
            <table id="forms-tbl" class="table table-stripped">
                <thead>
                    <tr>
                        <th># &nbsp; </th>
                        <th>DateTime</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($result as $row) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td><?php echo $row['date_created'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><a href="./admin/form_builder/form.php?code=<?php echo $row['form_code'] ?>"><button type="button" class="btn btn-primary">Responde</button>
                                </a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>