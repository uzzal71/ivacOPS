<div class="col-md-6 col-xs-12 col-md-offset-3">
<div class="x_panel">
  <div class="x_title">
    <h2>Edit Center Form</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Settings 1</a>
          </li>
          <li><a href="#">Settings 2</a>
          </li>
        </ul>
      </li>
      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br />
    <?php
    $where_data = array('id' => $id);
    $employee_scores = $this->db->get_where('employee_score', $where_data)->result_array();
    foreach($employee_scores as $score):
    ?>
    <form class="form-horizontal form-label-left" name="score_form" action="<?php echo site_url('scoreboard_controller/update/'.$id);?>" method="POST">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Center</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" name="center_id" id="center_id">
            <option selected>Center name</option>
            <?php
                $center_permitted = $this->session->userdata('center_permitted');
                $expload_center = explode(',', $center_permitted);
                $center_length = count($expload_center);
                $count = 1;
                for($i=0; $i<$center_length;$i++){
                  $where_center = array('center_id' => $expload_center[$i]);
                  $centers = $this->db->get_where('centers', $where_center)->result_array();
                  foreach($centers as $center)
                  {
                    ?>
                    <option value="<?php echo $center['center_id'] ?>"><?php echo $center['center_name'] ?></option>
                    <?php
                  }
                }
               ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee ID</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="employee_id" value="<?php echo $score['employee_id'];?>" readonly>
        </div>
      </div>
      <?php 
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('employee_id', $score['employee_id']);
        $query_result = $this->db->get();
        $result = $query_result->row();
       ?>
       <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee ID</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" value="<?php echo $result->employee_name;?>" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="date" value="<?php echo $score['date'];?>" id="datepicker">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Receive</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="recieve" value="<?php echo $score['receive'];?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Delivery</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="delivery" value="<?php echo $score['delivery'];?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Scanning</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="scanning" value="<?php echo $score['scanning'];?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Backend</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="backend" value="<?php echo $score['backend'];?>">
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="button" class="btn btn-primary">Cancel</button>
          <button type="reset" class="btn btn-primary">Reset</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>

    </form>
  <?php endforeach;?>
  </div>
</div>
</div>


<script type="text/javascript">
     var employee_id = $('#employee_id').val();
        var response;
        $.ajax({
          async: false,
          type: 'POST',
          url: '<?php echo base_url();?>scoreboard_controller/get_center_name',
          data:{ 
              employee_id: employee_id
            },
          //timeout: 4000,
          success: function(result) {
            var data = result.split(",");
            var center_id = data[0]
            var center_name = data[1]
            $("#center_id").val(center_id);
            $("#center_name").val(center_name);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
          }
        });

</script>
<script type="text/javascript">
  document.forms['score_form'].elements['center_id'].value = <?php echo $score['center_id']; ?>
</script>