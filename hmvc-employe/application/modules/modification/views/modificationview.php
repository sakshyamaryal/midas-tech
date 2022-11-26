<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">
    <form action="">
        <div class="row">
            <div class="col-md-4 form-group">
                <lable>Project Name</lable>
                <input type="text" class="form-control" name="projectname" id="projectname" />
            </div>

            <div class="col-md-4 form-group">
                <lable>Modification ID</lable>
                <input type="text" class="form-control" name="modificationid" id="modificationid" />
            </div>
            <div class="col-md-4 form-group">
                <lable>Purpose</lable>
                <input type="text" class="form-control" name="purpose" id="purpose" />
            </div>
            <div class="col-md-4 form-group">
                <lable>OLD VALUE</lable>
                <input type="text" class="form-control" name="oldvalue" id="oldvalue" />
            </div>

            <div class="col-md-4 form-group">
                <lable>New Alter</lable>
                <input type="text" class="form-control" name="newalter" id="newalter" />
            </div>
            <input type="button" value="Create" id="createBtn" />
            <div class="form-group" id="read">
        <table>
            <tbody>
               
                <tr>
                    <th>Project NAME</th>
                    <th>Modification ID</th>
                    <th>purpose </th>
                    <th>Old Value</th>
                    <th>New Alter</th>

                </tr>
                <?php if(!empty($row)){?>
                <?php foreach ($row as $key) { ?>
                    <tr>
                    <td><?php echo $key['projectname'] ?></td>
                    <td><?php echo $key['modificationid'] ?></td>
                    <td><?php echo $key['purpose'] ?></td>
                    <td><?php echo $key['oldvalue'] ?></td>
                    <td><?php echo $key['newalter'] ?></td>
                    <td><a href="modification/update?updateid=<?php echo $key['modificationid'] ?>">Update</a></td>
                    <td><a href="modification/delete?id=<?php echo $key['modificationid'] ?>" >delete</a></td>
                    </tr>

                <?php } }?>
            </tbody>
        </table>

    </div>

</div>

</div>




        </div>
    </form>


</div>

</div>

<script>
    $("#createBtn").click(function() {
        var projectname = $("#projectname").val();
        var modificationid = $("#modificationid").val();
        var purpose = $("#purpose").val();
        var oldvalue = $("#oldvalue").val();
        var newalter = $("#newalter").val();

        var url = "<?php echo base_url() . "modification/saveModification" ?>";

        $.post(url,{
            projectname,
            modificationid,
            purpose,
            oldvalue,
            newalter

        },
        
        function (checkdata){
            checkdata = JSON.parse(checkdata);
            if(checkdata.status == "success"){
                alert("Datasaved");
            }
            else{
                alert("failed");
            }
            location.reload(true);
        });
    });


</script>