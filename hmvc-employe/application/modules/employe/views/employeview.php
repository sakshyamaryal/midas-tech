<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">
    <?php  echo validation_errors(); ?>

    <?php //echo form_open('form'); ?>
    <form action="" method="post">
    <div class="row">
        <div class="col-md-4 form-group">
            <lable>Employe Name</lable>
            <input type="text" class="form-control" name="EMPLOYENAME" id="employename" value="<?php if (!empty($col)) echo $col->EMPLOYENAME; ?>" />
        </div>

        <div class="col-md-4 form-group">
            <lable>Employe ID</lable>
            <input type="text" class="form-control" name="EMPLOYEID" id="employeid" value="<?php if (!empty($col)) echo $col->EMPLOYEID; ?>" />
        </div>

        <div class="col-md-4 form-group">
            <lable>Employe Email</lable>
            <input type="text" class="form-control" name="EMPLOYEMAIL" id="employemail" value="<?php if (!empty($col)) echo $col->EMPLOYEMAIL; ?>" />
        </div>

        <input type="button" value="Create" id="createBtn" />

    </div>
    </form>

    <?php if (empty($col)) { ?>

        <div class="form-group" id="read" style="border:2px solid black">
            <H1>PHP</H1>
            <table>
                <tbody>

                    <tr>
                        <th>EMPLOYEE NAME</th>
                        <th>EMPLOYEE ID</th>
                        <th>EMPLOYEE EMAIL</th>
                    </tr>
                    <?php if (!empty($row)) { ?>
                        <?php foreach ($row as $key) { ?>
                            <tr>
                                <td><?php echo $key['EMPLOYENAME'] ?></td>
                                <td><?php echo $key['EMPLOYEID'] ?></td>
                                <td><?php echo $key['EMPLOYEMAIL'] ?></td>

                                <td><a href="employe/update?updateid=<?php echo $key['EMPLOYEID'] ?>">Update</a></td>
                                <td><a href="employe/delete?id=<?php echo $key['EMPLOYEID'] ?>">delete</a></td>
                            </tr>

                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
</div>

<div class="form-group" id="read" style="border:2px solid black">
    <H1>JQUERY</H1>
    <table>
        <tbody>


            <tr class="">
                <th>EMPLOYEE NAME</th>
                <th>EMPLOYEE ID</th>
                <th>EMPLOYEE EMAIL</th>
            </tr>
            <!-- <tr class=""> -->
        <tbody class="ajax-list">

        </tbody>

    </table>
</div>


</div>

</div>

<?php } ?>


<script>
    $(function() {
        listEmploye();
    });

    function listEmploye() {
        $.ajax({
            type: 'ajax',
            url: 'Employe/show',
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';

                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + data[i].EMPLOYENAME + '</td>' +
                        '<td>' + data[i].EMPLOYEID + '</td>' +
                        '<td>' + data[i].EMPLOYEMAIL + '</td>' +
                        '<td>' + '<button>' + '<a href="employe/update?updateid=' + data[i].EMPLOYEID + '">Update</a>' + '</button>' + '</td>' +
                        '<td>' + '<button type="submit" id="delete">'+'<a href="employe/delete?id=' + data[i].EMPLOYEID + '">DELETE</a></button>' + '</td>' +
                        '</td>' +
                        '<tr>'
                }

                $('.ajax-list').html(html);
            }

        });
    }

    $("#createBtn").click(function() {
        var employename = $("#employename").val();
        var employeid = $("#employeid").val();
        var employemail = $("#employemail").val();

        // saveupdate("#createBtn","getTableData");

        // var url = "http://192.168.100.251/priyanka/2291/3643/accounts/Employe/saveEmployee";

        var url = "<?php echo base_url() . "employe/saveEmployee" ?>";

        $.post(url, {
                employename,
                employeid,
                employemail
            },
            function(checkdata) {

                checkdata = JSON.parse(checkdata);

                if (checkdata.status == "success") {
                    alert(" Data saved");
                } else {
                    alert("failed");
                }
                location.reload(true);
            });

    });

    $('#delete').on('click',function(){
		var empId = $('#EMPLOYEID').val();
		$.ajax({
			type : "POST",
			url  : "employe/delete",
			dataType : "JSON",  
			data : {EMPLOYEID:empId},
			success: function(data){
				$("#"+empId).remove();
				$('#EMPLOYEID').val("");
				listEmployee();
			}
        // alert("hello");
		});
		return false;
	});
</script>