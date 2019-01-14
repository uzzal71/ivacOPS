<!-- top tiles -->
<div class="row">
	<div class="content1 col-md-4">
   <div class="login_info">
     <div class="icon_setting">
       <img src="<?php echo base_url('media/icon/account.png'); ?>">
     </div>
     <div class="info_icon_right">
      <?php
      $where_data = array('employee_id' => $this->session->userdata('employee_id'));
      $employees = $this->db->get_where('employee', $where_data)->result_array();
      foreach($employees as $row):
        ?>
        <p>Loggin: <?php echo $row['employee_name'];?></p>
        <?php
      endforeach; 
       ?>
       <p>ID: <?php echo $this->session->userdata('employee_id'); ?></p>
     </div>
   </div> 
  </div>
  <div class="content2 col-md-4">
   <div class="center_info">
     <div class="icon_setting">
       <img src="<?php echo base_url('media/icon/center.png'); ?>">
     </div>
     <div class="center_icon_right">
       <?php
      $where_data = array('employee_id' => $this->session->userdata('employee_id'));
      $employees = $this->db->get_where('employee', $where_data)->result_array();
      foreach($employees as $row):
        ?>
        <p>Center Name:
        <?php 
        $data = array('center_id' => $row['center_id']);
        $centers = $this->db->get_where('centers', $data)->result_array();
        foreach($centers as $row):
          echo $row['center_name'];
        endforeach;
         ?></p>
        <?php
      endforeach; 
       ?>
     </div>
   </div> 
  </div>
  <div class="content3 col-md-4">
   <div class="default_info">
     <div class="icon_setting">
       <img src="<?php echo base_url('media/icon/clock.png'); ?>">
     </div>
     <div class="click_icon_right">
       <iframe src="http://free.timeanddate.com/clock/i6ehncej/n73/szw110/szh110/hoc222/hbw6/cf100/hgr0/hcw2/hcd88/fan2/fas20/fdi70/mqc000/mqs3/mql13/mqw4/mqd94/mhc000/mhs3/mhl13/mhw4/mhd94/mmc000/mml5/mmw1/mmd94/hwm2/hhs2/hhb18/hms2/hml80/hmb18/hmr7/hscf09/hss1/hsl90/hsr5" frameborder="0" width="110" height="110" style="margin-top: 20px;"></iframe>

     </div>
   </div> 
  </div>
</div>
<!-- /top tiles -->
