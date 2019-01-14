<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Of Users</h2>
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
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Employee name</th>
                          <th>Employee ID</th>
                          <th>Center</th>
                          <th>Center Permission</th>
                          <th>Password</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $center_permitted = $this->session->userdata('center_permitted');
                        $expload_center = explode(',', $center_permitted);
                        $center_length = count($expload_center);
                        $count = 1;
                        for($i=0; $i<$center_length;$i++){

                        $where_data = array('center_id' => $expload_center[$i]);

                        $menus= $this->db->get_where('users', $where_data)->result_array();

                        foreach ($menus as $row):
                          ?>
                          <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php
                              $this->db->select('*');
                              $this->db->from('employee');
                              $this->db->where('employee_id', $row['employee_id']);
                              $employee_query = $this->db->get();
                              $employee_result = $employee_query->row();
                              echo $employee_result->employee_name;
                             ?></td>
                             <td><?php echo $row['employee_id']; ?></td>
                             <td><?php
                              $this->db->select('*');
                              $this->db->from('centers');
                              $this->db->where('center_id', $expload_center[$i]);
                              $query_result = $this->db->get();
                              $result = $query_result->row();
                              echo $result->center_name;
                            ?></td>
                             <td>
                              <?php

                              $get_centers = $row['center_role'];
                              $get_center_explode = explode(',', $get_centers);
                              $get_center_length = count($get_center_explode);

                                for($j=0; $j<$get_center_length;$j++)
                                {
                                  $this->db->select('*');
                                  $this->db->from('centers');
                                  $this->db->where('center_id', $get_center_explode[$j]);
                                  $center_query = $this->db->get();
                                  $center_result = $center_query->row();
                                  echo $center_result->center_name;
                                  echo "<br>";
                                }

                               ?>
                             </td>
                            <td><?php echo md5($row['password']);?></td>
                            <td>
                            <?php 
                             if ($row['status'] == 1) {echo 'Active';}
                             else{echo 'Inactive';}
                             ?>
                             </td>
                            <td align="center">
                              <a href="<?php echo site_url('user_controller/edit/' . $row['id'].'/'.$row['employee_id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-pencil"></span></a>
                            </td>
                            <td align="center">
                              <a onclick="return confirm(' you want to delete?');" href="<?php echo site_url('user_controller/destory/' . $row['id'].'/'.$row['employee_id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                          </tr>
                        <?php
                        endforeach;
                      }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Employee Name</th>
                          <th>Employee ID</th>
                          <th>Center</th>
                          <th>Center Permission</th>
                          <th>Password</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
</div>